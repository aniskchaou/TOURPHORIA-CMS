<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 4/9/15
 * Time: 3:33 PM
 */

if(!class_exists('ST_Hotel_Admin_Controller'))
{
    class ST_Hotel_Admin_Controller extends ST_Abstract_Admin_Controller
    {
        function __construct()
        {
            parent::__construct(array(
                'post_type'         =>'hotel',
                'module_file'       =>__FILE__
            ));

            $this->get_data();

        }

        function get_data()
        {
            $html= $this->load_view('admin/index',null,array('data'=>'xxxxx'));

        }

    }

    new ST_Hotel_Admin_Controller();
}