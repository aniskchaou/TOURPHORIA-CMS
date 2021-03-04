<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 1/14/15
 * Time: 9:35 AM
 */
class STTravelerDemo
{

    static function init(){

        add_action('init',array(__CLASS__,'_event_init'));
        add_action('wp_footer',array(__CLASS__,'_add_toolbar'));
        add_action('wp_enqueue_scripts',array(__CLASS__,'_add_scripts'));

    }
    static function _add_scripts()
    {
		wp_enqueue_style('switcher',get_template_directory_uri().'/demo/css/switcher.css');
        wp_enqueue_script('switcher',get_template_directory_uri().'/demo/js/switcher.js',array(),false,true);

        ob_start();
            get_template_part('demo/custom_css_demo');
        $css=@ob_get_clean();

        wp_localize_script('jquery','st_demo_css',array(
            'color'=>$css
        ));


    }
    static function _add_toolbar()
    {
        get_template_part('demo/toolbar');
    }
    static function _event_init()
    {
        $demo_mode=st()->get_option('edv_enable_demo_mode','off');

        if($demo_mode=='on')
        {
            do_action('st_before_traveler_demo');
            do_action('st_end_traveler_demo');
        }
    }

}

STTravelerDemo::init();