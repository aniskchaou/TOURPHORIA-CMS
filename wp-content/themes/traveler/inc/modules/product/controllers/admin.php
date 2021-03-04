<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 4/20/15
 * Time: 2:47 PM
 */

if(!class_exists('ST_Product_Admin_Controller'))
{
    class ST_Product_Admin_Controller extends ST_Abstract_Admin_Controller
    {
        function __construct()
        {
            parent::__construct(array(
                'post_type'         =>'product',
                'module_file'       =>__FILE__
            ));

            add_action('init',array($this,'_add_metabox'));
        }



        function _add_metabox()
        {
            $my_meta_box = array(
                'id'          => 'st_product_options',
                'title'       => __( 'Product Options', ST_TEXTDOMAIN ),
                'pages'       => array( 'product' ),
                'context'     => 'normal',
                'priority'    => 'high',
                'fields'      => array(
                    array(
                        'id'=>'set_new_product',
                        'label'=>__('Set as new product',ST_TEXTDOMAIN),
                        'type'=>'on-off',
                        'std'=>'off',

                    )
                )
            );

            if ( function_exists( 'ot_register_meta_box' ) )
                ot_register_meta_box( $my_meta_box );
        }
    }

    new ST_Product_Admin_Controller();
}