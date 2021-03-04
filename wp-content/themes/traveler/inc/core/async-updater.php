<?php
/**
 * Created by PhpStorm.
 * User: h2 gaming
 * Date: 6/27/2018
 * Time: 11:49 PM
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'WP_Async_Request', false ) ) {
    include_once( ST_TRAVELER_DIR . '/inc/plugins/wp-async-request.php' );
}

if ( ! class_exists( 'WP_Background_Process', false ) ) {
    include_once( ST_TRAVELER_DIR . '/inc/plugins/wp-background-process.php' );
}

if(!class_exists('ST_AsyncUpdater') and class_exists('WP_Background_Process'))
{
    class ST_AsyncUpdater extends WP_Background_Process{

        /**
         * @var string
         */
        protected $action = 'traveler_db_updater';


        public function dispatch() {
            $dispatched = parent::dispatch();

            if ( is_wp_error( $dispatched ) ) {
                ST_Admin_Notices::addError('async_updater','Unable to dispatch Traveler DB updater: '.$dispatched->get_error_message());
            }
        }

        public function handle_cron_healthcheck() {
            if ( $this->is_process_running() ) {
                // Background process already running.
                return;
            }

            if ( $this->is_queue_empty() ) {
                // No data to process.
                $this->clear_scheduled_event();
                return;
            }

            $this->handle();
        }

        /**
         * Schedule fallback event.
         */
        protected function schedule_event() {
            if ( ! wp_next_scheduled( $this->cron_hook_identifier ) ) {
                wp_schedule_event( time() + 10, $this->cron_interval_identifier, $this->cron_hook_identifier );
            }
        }

        /**
         * Is the updater running?
         * @return boolean
         */
        public function is_updating() {
            return false === $this->is_queue_empty();
        }


        protected function task( $args ) {
            if(!defined('TRAVELER_UPDATING')) define('TRAVELER_UPDATING',true);

            $callback = [$args[0],$args[1]];
            $params = $args;
            unset($params[0]);
            unset($params[1]);

            if ( is_callable( $callback ) ) {
                call_user_func( $callback,$params );
            } else {
                ST_Admin_Notices::addError('async_updater','Traveler Updater: Can not reach callback: '.$callback[1]);
            }

            return false;
        }

        protected function complete() {

            ST_DBMigration::updateDBVersion();

            parent::complete();
        }
    }
}
