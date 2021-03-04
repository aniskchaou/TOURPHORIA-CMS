<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 11/24/14
 * Time: 11:55 AM
 */
class STPOrder
{
    protected  $table="st_order_items";

    function __construct()
    {

    }

    function init()
    {
        add_action( 'init',array($this,'register_orders_pt') );
    }

    function register_orders_pt()
    {
        $labels = array(
            'name'               => __( 'Orders', STP_TEXTDOMAIN ),
            'singular_name'      => __( 'Order', STP_TEXTDOMAIN ),
            'menu_name'          => __( 'Orders', STP_TEXTDOMAIN ),
            'name_admin_bar'     => __( 'Order', STP_TEXTDOMAIN ),
            'add_new'            => __( 'Add New', STP_TEXTDOMAIN ),
            'add_new_item'       => __( 'Add New Order', STP_TEXTDOMAIN ),
            'new_item'           => __( 'New Order', STP_TEXTDOMAIN ),
            'edit_item'          => __( 'Edit Order', STP_TEXTDOMAIN ),
            'view_item'          => __( 'View Order', STP_TEXTDOMAIN ),
            'all_items'          => __( 'All Orders', STP_TEXTDOMAIN ),
            'search_items'       => __( 'Search Orders', STP_TEXTDOMAIN ),
            'parent_item_colon'  => __( 'Parent Orders:', STP_TEXTDOMAIN ),
            'not_found'          => __( 'No Orders found.', STP_TEXTDOMAIN ),
            'not_found_in_trash' => __( 'No Orders found in Trash.', STP_TEXTDOMAIN )
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'st_orders' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            //'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
        );

        register_post_type('st_orders',$args);
    }

    function activation_hook(){
        // do NOT forget this global
        global $wpdb;

        // this if statement makes sure that the table doe not exist already
        if($wpdb->get_var("show tables like '{$wpdb->prefix}{$this->table}'") != "{$wpdb->prefix}{$this->table}")
        {
            $sql = "CREATE TABLE {$wpdb->prefix}{$this->table} (
            id int NOT NULL AUTO_INCREMENT,
            check_in_date varchar(200) ,
            check_out_date varchar(200) ,
            object_id   int,
            PRIMARY KEY ( id )
            );";
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }
}

$a=new STPOrder();
$a->init();