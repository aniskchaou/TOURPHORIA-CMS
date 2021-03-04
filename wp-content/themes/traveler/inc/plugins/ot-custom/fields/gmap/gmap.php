<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 1/20/15
 * Time: 2:35 PM
 */
if(!class_exists('BTOTGmap'))
{
    class BTOTGmap extends BTOptionField
    {
        static  $instance=null;
        public $curent_key;

        function __construct()
        {
            parent::__construct(__FILE__);

            parent::init(array(
                'id'=>'bt_gmap',
                'name'          =>__('Gmap Location',ST_TEXTDOMAIN)
            ));

            add_action('admin_enqueue_scripts',array($this,'add_scripts'));

            add_action('save_post',array($this,'_save_separated_field'));
        }

        /**
         *
         *
         * @since 1.0
         * */
        function _save_separated_field( $post_id )
        {

            $st_google_map = get_post_meta($post_id,'st_google_map',true);
            if(!empty($st_google_map)){
                $default=array(
                    'lat'=>'',
                    'lng'=>'',
                    'zoom'=>'',
                    'type'=>'',
                );

                $meta_value=wp_parse_args($st_google_map,$default);
                
                update_post_meta($post_id,'map_lat',$meta_value['lat']);
                update_post_meta($post_id,'map_lng',$meta_value['lng']);
                update_post_meta($post_id,'map_zoom',$meta_value['zoom']);
                update_post_meta($post_id,'map_type',$meta_value['type']);

            }
        }
        function add_scripts()
        {
            wp_register_script('gmapv3',$this->_url.'js/gmap3.min.js',array('jquery','gmap-apiv3'),false,true);
            wp_register_script('bt-gmapv3-init',$this->_url.'js/init.js',array('gmapv3'),false,true);
            wp_register_style('bt-gmapv3',$this->_url.'css/bt-gmap.css');
        }


        static function instance()
        {
            if(self::$instance==null)
            {
                self::$instance=new self();
            }

            return self::$instance;
        }

    }

    BTOTGmap::instance();

    if(!function_exists('ot_type_bt_gmap'))
    {
        function ot_type_bt_gmap($args = array())
        {
            $default=array(
                'field_name'=>''
            );
            $args=wp_parse_args($args,$default);

            wp_enqueue_script('bt-gmapv3-init');
            wp_enqueue_style('bt-gmapv3');

            BTOTGmap::instance()->curent_key=$args['field_name'];

            echo BTOTGmap::instance()->load_view(false,array('args'=>$args));
        }
    }

    if(!function_exists('ot_type_bt_gmap_html'))
    {
        function ot_type_bt_gmap_html($args = array())
        {
            $default=array(
                'field_name'=>'gmap'
            );
            $args=wp_parse_args($args,$default);

            wp_enqueue_script('bt-gmapv3-init');
            wp_enqueue_style('bt-gmapv3');

            BTOTGmap::instance()->curent_key=$args['field_name'];

            echo BTOTGmap::instance()->load_view(false,array('args'=>$args));
        }
    }
}
