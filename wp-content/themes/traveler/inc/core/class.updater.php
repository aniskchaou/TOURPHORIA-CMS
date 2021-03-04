<?php
/**
 * Created by PhpStorm.
 * User: Dungdt
 * Date: 12/3/2015
 * Time: 5:28 PM
 *
 * @since 1.2.0
 */
if(!class_exists('ST_Traveler_Updater'))
{
    class ST_Traveler_Updater
    {
        /**
         * @since 1.2.0
         */
        static $_inst;
        private $_username=false;
        private $_api_key=false;
        private $_purchase_code=false;
        private $_api_url='http://shinetheme.com/demosd/updater/index.php';

        public $theme_id=false;
		/**
		 * @var string
		 * @update 1.2.4 // Hard-code for updater
		 */
        public $theme_slug='traveler';
		public $theme_version=FALSE;

        /**
         * @since 1.2.0
         */
        function __construct()
        {
            add_action('init',array( $this, 'add_transient'));
        }
        

        function add_transient()
        {
            //$this->_username=st()->get_option('envato_username',false);
            //$this->_api_key=st()->get_option('envato_apikey',false);
            $this->_purchase_code = get_option('envato_purchasecode',false);

            $theme_info = wp_get_theme();

            if($theme_info->parent())
            {
                $theme_info=$theme_info->parent();
            }

            $this->theme_id = $theme_info->get( 'Name' );
            $this->theme_version = $theme_info->get('Version');
            if($this->_purchase_code)
            {
                add_filter( 'pre_set_site_transient_update_themes', array( $this, 'check_for_update' ) );
            }
        }

        /**
         * @since 1.2.0
         */
        function check_for_update($transient)
        {   
            if( empty( $transient->checked ) )  {
                return $transient;
            }

            $request_args = array(
                'id' => $this->theme_id,
                'slug' => $this->theme_slug,
                'version' => $transient->checked[$this->theme_slug],
            );


            $filename = trailingslashit( ST_TRAVELER_DIR ) . 'log.txt';

            $raw_response = $this->request('check_update',$request_args);
            $response = null;
            if( ! is_wp_error( $raw_response ) && ( $raw_response['response']['code'] == 200 ) ) {
                $response = json_decode( $raw_response['body'], true );
            }

            if( ! empty( $response ) ) { // Feed the update data into WP updater
				$remote_version=isset($response['version'])?$response['version']:FALSE;
				// If a newer version is available, add the update
				if ( $remote_version and version_compare( $this->theme_version, $remote_version, '<' ) ) {
					$transient->response[$this->theme_slug] = $response;
				}

            }

//            $handle = fopen($filename, 'a');
//            fwrite($handle, json_encode($raw_response));
//            fwrite($handle, json_encode($raw_response));

            return $transient;
        }

        /**
         * @param $action
         * @param $args
         * @return array
         * @since 1.2.0
         */
        function request($action,$args)
        {
            global $wp_version;

            //$args['envato_username'] = $this->_username;
            //$args['envato_api_key'] = $this->_api_key;
            $args['customer_purchase_code'] = $this->_purchase_code;

            $request= array(
                'body' => array(
                    'action' => $action,
                    'request' => $args,
                    'api-key' => md5(home_url())
                ),
                'user-agent' => 'WordPress/'. $wp_version .'; '. home_url()
            );

            return wp_remote_post($this->_api_url,$request);
        }

        /**
         * @since 1.2.0
         */
        static function instance()
        {
            if(!self::$_inst)
            {
                self::$_inst=new self();
            }
            return self::$_inst;
        }
    }

    ST_Traveler_Updater::instance();
}