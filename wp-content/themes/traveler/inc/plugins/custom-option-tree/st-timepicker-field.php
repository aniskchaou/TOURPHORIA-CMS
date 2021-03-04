<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 11/24/14
 * Time: 8:58 AM
 */
class ST_TimePicker_Field
{
    public  $url;
    public $dir;

    function __construct(){

        $this->dir=st()->dir('plugins/custom-option-tree');
        $this->url=st()->url('plugins/custom-option-tree');


        add_action('admin_enqueue_scripts',array($this,'add_scripts'));
    }
    function init(){


        if( !class_exists( 'OT_Loader' ) ) return false;


        //Default Fields


        add_filter( 'ot_option_types_array', array($this,'ot_add_custom_option_types') );

        include_once $this->dir.'/custom-css-output.php';

    }

    function add_scripts(){
        wp_register_style('st_timepicker.css', $this->url.'/css/st_timepicker.css');
    	wp_register_script('st_timepicker',$this->url.'/js/st_timepicker.js',array('jquery'),null,true);
    }

    function ot_add_custom_option_types( $types ) {
        $types['st_timepicker']       = __('Timepicker',ST_TEXTDOMAIN);

        return $types;
    }




}


$b =new ST_TimePicker_Field();
$b ->init();


if(!function_exists('ot_type_st_timepicker')):
function ot_type_st_timepicker($args = array())
{
    wp_enqueue_script( 'jquery-ui-timepicker' );
    wp_enqueue_script('st_timepicker.css');
    wp_enqueue_script('st_timepicker');

    $st_custom_ot = new ST_TimePicker_Field();

    $url = $st_custom_ot->url;


    $default=array(
        'field_desc'=> 'Timepicker'
    );



    $args = wp_parse_args($args,$default);


    extract($args);

    /* verify a description */
    $has_desc = $field_desc ? true : false;

    echo '<div class="format-setting ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

    echo balanceTags($has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '');

        echo '<div class="format-setting-inner">';
        $pl_name='';
        $pl_desc='';
        if($field_value){
            $pl_name = get_the_title($field_value);
            $pl_desc="ID: ".get_the_ID($field_value);
        }

        echo '<input class="widefat option-tree-ui-input st_timepicker" value="'.esc_attr(!empty($field_value) ? $field_value : $field_std).'" placeholder="hh:mm tt" name="'.esc_attr( $field_name ).'" id="'.esc_attr( $field_id ).'">';
        echo '</div>';
        echo '</div>';
}
endif;