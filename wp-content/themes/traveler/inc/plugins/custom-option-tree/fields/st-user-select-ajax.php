<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/4/14
 * Time: 3:29 PM
 */

class STUserSelectAjax extends STCustomOptiontree
{
    public $dir;

    public $url;


    function __construct()
    {

        //Check Role
        if(!current_user_can('edit_pages')) return;

        parent::__construct();

        $this->init();
    }

    function init()
    {

        //Default Fields
        add_filter( 'ot_user_select_ajax_unit_types', array($this,'unit_types'), 10, 2 );

        add_filter( 'ot_option_types_array', array($this,'option_types') );

        add_action('wp_ajax_st_user_select_ajax',array($this,'st_user_select_ajax'));

        add_action('admin_enqueue_scripts',array($this,'add_scripts'));
    }

    function add_scripts()
    {
        wp_register_script('st_user_select_ajax',$this->url.'/fields/js/st-user-select.js',array('select2'),null,true);

        wp_register_style('st_post_select_ajax',$this->url.'/css/post_select_ajax.css',array('select2'));
    }

    function st_user_select_ajax()
    {


        $arg=array();

        if(isset($_GET['q']))
        $arg['search']='*'.$_GET['q'].'*';

        $arg['number']=10;

        //$arg['orderby']='nicename';

        $users=get_users($arg);

        $result=array(
            'total_count'=>0,
            'items'=>array(),
        );

        if(!empty($users))
        {
            foreach($users as $key=>$value)
            {
                //$user->user_login.' (#'.$user->ID.' - '.$user->user_email.')';
                $result['items'][]=array(
                    'id'=>$value->ID,
                    'name'=>$value->user_login.' (#'.$value->ID.' - '.$value->user_email.')',
                    'description'=>''
                );
            }
        }


        echo json_encode($result);

        die;
    }

    function unit_types($types)
    {
        $types['user_select_ajax']       = __('User Select Ajax',ST_TEXTDOMAIN);

        return $types;
    }
    function option_types($array=array(), $id=false )
    {
        return apply_filters( 'user_select_ajax', $array, $id );
    }


}

new STUserSelectAjax();



if(!function_exists('ot_type_user_select_ajax')):
    function ot_type_user_select_ajax($args = array())
    {

        $default=array(

            'field_placeholder'=>__('Search for a User',ST_TEXTDOMAIN)
        );

        $args=wp_parse_args($args,$default);

        wp_enqueue_script( 'st_user_select_ajax' );
        wp_enqueue_style( 'st_post_select_ajax' );

        extract($args);

        $post_type=$field_post_type;

        /* verify a description */
        $has_desc = $field_desc ? true : false;

        /* format setting outer wrapper */
        echo '<div class="format-setting type-post_select_ajax ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
        /* description */
        echo balanceTags($has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '');
        /* format setting inner wrapper */
        echo '<div class="format-setting-inner">';
        /* allow fields to be filtered */
        $post_select_ajax = apply_filters( 'ot_recognized_post_select_ajax_fields', $field_value, $field_id );

        $pl_name='';
        $pl_desc='';
        if($field_value)
        {
            $user=get_userdata($field_value);
            if($user)
            {
                $pl_name=$user->user_login.' (#'.$user->ID.' - '.$user->user_email.')';
                $pl_desc="";//"ID: ".get_the_ID($field_value);
            }
        }

        echo '<div class="option-tree-ui-user_select_ajax-input-wrap">';
        echo "<input data-pl-name='{$pl_name}' data-pl-desc='{$pl_desc}' data-placeholder='{$field_placeholder}' value='{$field_value}' data-post-type='{$post_type}' type=hidden class='st_user_select_ajax' id='". esc_attr( $field_id ) . "' name='". esc_attr( $field_name ) ."'/>";
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
endif;