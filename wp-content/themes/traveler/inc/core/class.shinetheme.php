<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STFramework
 *
 * Created by ShineTheme
 *
 */
if (!class_exists('STFramework')) {
    /**
     * Class STFramework
     */
    class STFramework
    {

        /**
         * @var string
         */
        public $template_dir = "st_templates";

        public $plugin_name = "";

        protected $_cachedOptions = [];


        /**
         *
         */
        function __construct()
        {

        }

        /**
         *
         * @since 1.1.7
         * @update 1.2.0
         */
        static function _class_init()
        {
            $libs = array(
                'core/admin-notices',
//                'core/db-migration',
                'core/class.assets',
                'core/class.optiontree',
                'core/class.template',
                'core/class.updater',
                'core/model',
                'core/class.config',
                'st-hook-functions',
                'helpers/class.newhook_functions',
                'st-hook-register',
                'plugins/BFI_Thumb',
                'plugins/otf_regen_thumbs',
                'plugins/class-tgm-plugin-activation',
                'st-required-plugins',
                'helpers/class.sthelper',
                'helpers/class.input',
                'helpers/class.string',
                'helpers/class.upload-fonticon',
            );

            self::load_libs($libs);
        }

        static function dir($url = false)
        {
            //$template = locate_template('/inc/'. $url);
            return ST_TRAVELER_DIR . '/inc/' . $url;
        }

        /**
         *
         *
         *
         * @since 1.0.7
         * */
        static function dir_name($url = false)
        {
            return "inc/" . $url;
        }

        function url($url = false)
        {
            return get_template_directory_uri() . '/inc/' . $url;
        }

        /**
         * @param bool $url
         * @return string
         */
        function plugin_dir($url = false)
        {
            return ABSPATH . 'wp-content/plugins/' . $this->plugin_name . '/' . $url;
        }

        function plugin_url($url = false)
        {
            return plugins_url() . '/' . $this->plugin_name . '/' . $url;
        }

        static function firstGetOption($option_id, $default)
        {
            global $sitepress;
            if ($sitepress)
                $key_option = 'option_tree_' . ICL_LANGUAGE_CODE;
            else
                $key_option = 'option_tree';

            $st_traveler_cached_options = get_option($key_option);

            if (isset($st_traveler_cached_options[$option_id]))
                return $st_traveler_cached_options[$option_id];

            return $default;
        }

        static function load_libs($libs = array())
        {
            if (!empty($libs) and is_array($libs)) {
                foreach ($libs as $value) {
                    //Check load lib new layout
                    $new_layout = self::firstGetOption('st_theme_style', 'classic');

                    if ($new_layout == 'modern') {
                        $file_new_layout = ST_TRAVELER_DIR . '/inc/layouts/modern/' . $value . '.php';
                        if (file_exists($file_new_layout)) {
                            include_once $file_new_layout;
                        } else {
                            $file = ST_TRAVELER_DIR . '/inc/' . $value . '.php';
                            if (file_exists($file)) {
                                include_once $file;
                            }
                        }
                    } else {
                        $file = ST_TRAVELER_DIR . '/inc/' . $value . '.php';
                        if (file_exists($file)) {
                            include_once $file;
                        }
                    }
                }
            }
        }


        /*---------Begin Helper Functions----------------*/


        function get_option($option_id, $default = false)
        {
            return st_traveler_get_option($option_id, $default);
        }

        function load_template($slug, $name = false, $data = array())
        {
            if (is_array($data))
                extract($data);

            if ($name) {
                $slug = $slug . '-' . $name;
            }

            //Find template in folder st_templates/
            $template = locate_template($this->template_dir . '/' . $slug . '.php');


            if (!$template) {
                //If not, find it in plugins folder
                $template = $this->plugin_dir() . '/' . $slug . '.php';

            }

            if (st()->get_option('st_theme_style', '') == 'modern') {
                $_template = locate_template($this->template_dir . '/layouts/modern/' . $slug . '.php');
                if (is_file($_template)) {
                    $template = $_template;
                }
            }


            //If file not found
            if (is_file($template)) {
                ob_start();

                include $template;

                $data = @ob_get_clean();

                return $data;
            }


        }

        static function write_log($log)
        {
            if (true === WP_DEBUG) {
                if (is_array($log) || is_object($log)) {
                    error_log(print_r($log, true));
                } else {
                    error_log($log);
                }
            }
        }
    }
}

