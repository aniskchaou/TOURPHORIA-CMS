<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 2/5/15
 * Time: 4:43 PM
 */

class STProductSelectAjax extends STCustomOptiontree
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
        add_filter( 'ot_product_select_ajax_unit_types', array($this,'unit_types'), 10, 2 );

        add_filter( 'ot_option_types_array', array($this,'option_types') );

        add_action('wp_ajax_st_product_select_ajax',array($this,'_get_post_ajax'));

        add_action('admin_enqueue_scripts',array($this,'add_scripts'));
        add_action('save_post', array( $this, '_save_coupon_meta'), 10, 2 );
    }

    function _save_coupon_meta( $post_id, $post){
        if( $post->post_type != 'st_coupon_code'){
            return $post_id;
        }
         global $pagenow;

          /* don't save if $_POST is empty */
          if ( empty( $_POST ) )
            return $post_id;
          
          /* don't save during quick edi
          t */
          if ( $pagenow == 'admin-ajax.php' )
            return $post_id;
            
          /* don't save during autosave */
          if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return $post_id;

          /* don't save if viewing a revision */
          if ( $post_object->post_type == 'revision' || $pagenow == 'revision.php' )
            return $post_id;

          /* check permissions */
          if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) )
              return $post_id;
          } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
              return $post_id;
          }

          update_post_meta( $post_id, 'include_products-type', $_POST['include_products-type'] );
          update_post_meta( $post_id, 'exclude_products-type', $_POST['exclude_products-type'] );
    }
    function add_scripts()
    {
        wp_register_script('st_product_select_ajax',$this->url.'/fields/js/st-product-select.js',array('select2'),null,true);

        wp_register_style('st_post_select_ajax',$this->url.'/css/post_select_ajax.css',array('select2'));
    }

    function _get_post_ajax()
    {


        $arg=array();

        if(isset($_GET['q']))
            $arg['s']=$_GET['q'];

        $arg['posts_per_page']=10;
        $arg['post_type']=$_GET['post_type'];

        //$arg['orderby']='nicename';

        $query=new WP_Query($arg);

        $result=array(
            'total_count'=>0,
            'items'=>array(),
        );

        while($query->have_posts())
        {
            $query->the_post();
                //$user->user_login.' (#'.$user->ID.' - '.$user->user_email.')';
                $result['items'][]=array(
                    'id'=>get_the_ID(),
                    'name'=>get_the_title(),
                    'description'=>get_post_meta(get_the_ID(),'address',true)
                );
        }
        wp_reset_query();


        echo json_encode($result);

        die;
    }

    function unit_types($types)
    {
        $types['product_select_ajax']       = __('Product Select Ajax',ST_TEXTDOMAIN);

        return $types;
    }
    function option_types($array=array(), $id=false )
    {
        return apply_filters( 'product_select_ajax', $array, $id );
    }


}

new STProductSelectAjax();



if(!function_exists('ot_type_product_select_ajax')):
    function ot_type_product_select_ajax($args = array())
    {
        $booking_types=STTraveler::booking_type();
        $default=array(

            'field_placeholder'=>__('Search for a Product',ST_TEXTDOMAIN)
        );

        $args=wp_parse_args($args,$default);

        wp_enqueue_script( 'st_product_select_ajax' );
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

        $ids=explode(',',$field_value);
        $ids_str=array();

        if(!empty($ids)){
            foreach($ids as $key){
                $ids_str[]=array(
                    'id'=>$key,
                    'name'=>get_post_type($key).' - '.get_the_title($key),
                    'description'=>get_post_meta($key,'address',true)
                );
            }
        }


        echo '<div class="option-tree-ui-user_select_ajax-input-wrap">';
        ?>
        <label ><?php _e('Type:',ST_TEXTDOMAIN);  ?></label>
        <br>
            <select class="" name="<?php echo $field_id; ?>-type">

                <?php if(!empty($booking_types)):?>
                <?php 

                $counpon_type = get_post_meta( get_the_ID(), $field_id.'-type', true);
                //if( !$counpon_type ) $counpon_type = 'st_hotel';
                ?>
                    <option <?php echo selected( '-1', $counpon_type, false ); ?> value="-1"><?php echo '----- ' . __('No Services', ST_TEXTDOMAIN) . ' -----'; ?></option>
                <?php
                foreach($booking_types as $key=>$value):
                        if(post_type_exists($value))
                        {
                            $post_type_obj=get_post_type_object($value);

                            echo "<option ". selected( $value, $counpon_type, false ) ." value='{$value}' >{$post_type_obj->labels->singular_name}</option>";
                        }
                    endforeach; endif;?>
            </select>
        <br>
        <label><?php _e('Product: ',ST_TEXTDOMAIN) ?></label>
        <?php
        echo "<input data-old='".esc_attr(json_encode($ids_str))."' data-placeholder='{$field_placeholder}' value='{$field_value}' data-post-type='{$post_type}' type=hidden class='st_product_select_ajax' id='". esc_attr( $field_id ) . "' name='". esc_attr( $field_name ) ."'/>";
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
endif;