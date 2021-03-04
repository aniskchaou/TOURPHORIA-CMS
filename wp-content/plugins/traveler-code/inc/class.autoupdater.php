<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 5/4/15
 * Time: 6:09 PM
 *
 * @since 1.0.7
 */
if(!class_exists('STP_Autoupdater'))
{
    class STP_Autoupdater
    {
        /**
         *
         *
         * @since 1.07
         * */
        static $remote_url='http://shinetheme.com/demosd/traveler_code/update.php';

        /**
         *
         *
         * @since 1.07
         * */
        static $current_version;

        static $plugin_url;
        static $plugin_slug;

        static $last_request_data=array();

        /**
         *
         *
         * @since 1.07
         * */
        static function _init()
        {
            self::$current_version=STTravelCode::$plugins_data['Version'];
            self::$plugin_url=STTravelCode::$plugins_data['plugin_basename'];
            list ($t1, $t2) = explode('/', self::$plugin_url);
            self::$plugin_slug = str_replace('.php', '', $t2);


            add_filter ('pre_set_site_transient_update_plugins', array(__CLASS__,'check_update'));

            // Define the alternative response for information checking
            add_filter('plugins_api', array(__CLASS__, 'check_info'), 10, 3);
        }

        /**
         * Add our self-hosted description to the filter
         *
         * @param boolean $false
         * @param array $action
         * @param object $arg
         * @return bool|object
         */
        static  public function check_info($false, $action, $arg)
        {
            $arg=wp_parse_args($arg,array(
                'slug'=>''
            ));
            if (isset($arg->slug) and $arg->slug === self::$plugin_slug) {
                $information = self::getRemote_information();
                return $information;
            }
            return false;
        }

        /**
         * Get information about the remote version
         * @return bool|object
         */
        static public function getRemote_information()
        {
            $request = wp_remote_post(self::$remote_url, array('body' => array('action' => 'info')));
            if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
                return unserialize($request['body']);
            }
            return false;
        }

        /**
         *
         *
         * @since 1.07
         * */
        static public function check_update( $transient ) {

            if ( empty( $transient->checked ) ) {
                return $transient;
            }

            // Get the remote version
            $remote_version = self::get_remote_version();


            // If a newer version is available, add the update
            if ( version_compare( self::$current_version, $remote_version, '<' ) ) {

                $update_URL=self::$remote_url;

                if($update_URL){
                    $obj = new stdClass();
                    $obj->slug = self::$plugin_slug;
                    $obj->new_version = $remote_version;
                    $obj->url = '';
                    $obj->package = $update_URL;
                    $transient->response[self::$plugin_url] = $obj;
                }

    return $transient;
            }

            return $transient;
        }

        static function get_remote_version()
        {
            $request = wp_remote_post( self::$remote_url,array('body' => array('action' => 'version')) );
            if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {

                self::$last_request_data=$request['body'];
                return $request['body'];
            }
            return false;
        }
    }

    STP_Autoupdater::_init();
}