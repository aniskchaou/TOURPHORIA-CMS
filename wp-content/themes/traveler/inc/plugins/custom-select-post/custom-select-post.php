<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 11/24/14
 * Time: 8:58 AM
 */
class STCustomselectpost
{
    public  $url;
    public $dir;

    function __construct()
    {
        $this->dir=st()->dir('plugins/custom-select-post');
        $this->url=st()->url('plugins/custom-select-post');
        add_action('admin_enqueue_scripts',array($this,'add_scripts'));
        add_action('wp_ajax_st_post_select',array($this,'st_post_select_func'));
        add_action( 'wp_ajax_nopriv_st_post_select', array($this,'st_post_select_func'));

    }

    function add_scripts()
    {
       if(!in_array(get_post_type( ) , array('product', 'shop_order'))){
         wp_enqueue_script('select2_js',$this->url.'/js/select2-3.5.2/select2.min.js',array('jquery'),null,true);
        $lang = get_locale();
        $lang_file = ST_TRAVELER_DIR.'/js/select2/select2_locale_'.$lang.'.js';
        if(file_exists($lang_file)){
            wp_register_script('select2-lang', get_template_directory_uri().'/js/select2/select2_locale_'.$lang.'.js',array('jquery','select2'),null,true);
        }else{
            $locale_array = explode('_',$lang);
            if(!empty($locale_array) and $locale_array[0]){
                $locale = $locale_array[0];

                $lang_file = ST_TRAVELER_DIR.'/js/select2/select2_locale_'.$locale.'.js';
                if(file_exists($lang_file))
                    wp_register_script('select2-lang',get_template_directory_uri().'/js/select2/select2_locale_'.$locale.'.js',array('jquery','select2'),null,true);
            }
        }
        wp_register_style('select2_css',$this->url.'/js/select2-3.5.2/select2.css');
        wp_register_script('st_post_select',$this->url.'/js/st_post_select.js',array('jquery'),null,true);
       }
    }
    function st_post_select_func()
    {

        if(!current_user_can('upload_files')) return;

        $result=array(
            'total_count'=>0,
            'items'=>array(),
        );

        $q=STInput::get('q');
        $post_type=STInput::get('post_type');

        if($q)
        {
            if(!$post_type) $post_type='st_hotel';
            $arg = array(
                'post_type'=>$post_type,
                'posts_per_page'=>20,
                's'=>$q,
                'post_status' => 'publish'
            );
            $author=STInput::get('author');
            if($author){
                $arg = array(
                    'post_type'=>$post_type,
                    'posts_per_page'=>20,
                    's'=>$q,
                    'author'=>$author,
                    'post_status' => 'publish'
                );
            }
            $query=new WP_Query($arg);
            while($query->have_posts())
            {
                $query->the_post();
                $result['items'][]=array(
                    'id'=>get_the_ID(),
                    'name'=>get_the_title(),
                    'description'=>"ID: ".get_the_ID()
                );

            }

            global $wp_query;

            $result['total_count']=$wp_query->found_posts;
            wp_reset_query();
        }
        echo json_encode($result);
        die();
    }
}

$a = new STCustomselectpost();

