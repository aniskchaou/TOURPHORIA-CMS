<?php
/**
 * Plugin Name: Traveler-code
 * Plugin URI: #
 * Description: Plugin only for Theme: Shinetheme Traveler. Please only use with Shinetheme Traveler
 * Version: 2.7
 * Author: Shinetheme
 * Author URI: http://shinetheme.com
 * Requires at least: 4.0
 * Tested up to: 4.7
 */
// don't load directly

if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_name = wp_get_theme();
$theme_used=$theme_name->get('TextDomain');
if(!$theme_used){
    $theme_used=$theme_name->get('Template');
}

if(!defined('STP_TEXTDOMAIN'))
{
    define('STP_TEXTDOMAIN','traveler-code');
}


if($theme_used == 'traveler') {

    if(!defined('ST_TEXTDOMAIN'))
    {
        define('ST_TEXTDOMAIN','traveler');
    }

    if(!defined('ST_PLUGIN_DIR'))
    {
        require_once plugin_dir_path(__FILE__) . 'inc/class.stplugin.php';


    if(!class_exists('STTravelCode'))
    {
        class STTravelCode extends STPlugin
        {
            protected static $_inst;

            static $plugins_data;
            function __construct()
            {
                $this->plugin_url=plugin_dir_url(__FILE__);
                $this->plugin_dir=plugin_dir_path(__FILE__);

                add_action('after_setup_theme',array($this,'__after_setup_theme'));
                add_action('plugins_loaded',array($this,'_plugins_loaded'));
                add_action('admin_init',array($this,'_hook_init'));
                $this->load_tax_meta();
                $this->loadComposer();
            }

            public function __after_setup_theme()
            {

                //require plugin_dir_path(__FILE__).'/importer/st.init.php';
                require plugin_dir_path(__FILE__).'/update_taxonomy.php';


                $file = array(
                    'importer/st.init',
                    'plugins/cool-php-captcha/captcha',
                    'plugins/TwitterAPIExchange',
                    'plugins/class-wp-twitter-api',
                    'include/attribute_meta',
                    //'user/user'
                );
                $this->load_libs($file);

            }
            public function _hook_init()
            {
                self::$plugins_data=get_plugin_data(__FILE__);
                self::$plugins_data['plugin_basename']=plugin_basename(__FILE__);
                $this->load_autoupdater();
            }
            public function _plugins_loaded()
            {

                parent::__plugins_loaded();

                load_plugin_textdomain('traveler-code',false,trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) . trailingslashit( 'lang' ));

            }

            public function load_tax_meta()
            {
                $file = array(
                    'plugins/Tax-meta-class/Tax-meta-class',
                );

               parent::load_libs($file);
            }

            public function loadComposer()
            {
                if (version_compare(phpversion(), '5.3', '<')) {
                }else{
                    $file = array(
                        'plugins/vendor/autoload',
                    );

                   parent::load_libs($file);
                }


            }

            public function load_autoupdater()
            {
                if(!is_admin()) return;
                self::$plugins_data=get_plugin_data(__FILE__);
                self::$plugins_data['plugin_basename']=plugin_basename(__FILE__);
                $file = array(
                    'inc/class.autoupdater',
                );

                parent::load_libs($file);
            }


            public static function inst()
            {
                if(!self::$_inst)
                {
                    self::$_inst=new self();
                }

                return self::$_inst;
            }

        }

        STTravelCode::inst();
    }


}

}


