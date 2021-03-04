<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 1/20/15
 * Time: 2:36 PM
 */

if(!class_exists('BTOptionField'))
{
    class BTOptionField
    {
        protected $_url;
        protected $_dir;

        protected $type=array(
            'id'=>'',
            'name'=>''
        );

        function __construct($file)
        {
            $this->_dir=BTCustomOT::$_dir.'/fields/'.basename(dirname($file)).'/';
            $this->_url=BTCustomOT::$_uri.'/fields/'.basename(dirname($file)).'/';
        }

        function init($type=array())
        {
            $this->type=$type;


            //Default Fields
            add_filter( 'ot_'.$type['id'].'_unit_types', array($this,'ot_ajax_unit_type'), 10, 2 );

            add_filter( 'ot_option_types_array', array($this,'ot_add_custom_option_types') );
        }

        function ot_add_custom_option_types( $types ) {
            extract($this->type);

            if($id and $name)
                $types[$id]       = $name;


            return $types;
        }
        function ot_ajax_unit_type($array, $id )
        {

            if($this->type['id'])
                return apply_filters( $this->type['id'], $array, $id );

            return $array;
        }

        function load_view($view=false,$data=array()){

            if(!$view) $view='index';

            $file_name=$this->_dir.'views/'.$view.'.php';

            if(file_exists($file_name)){
                extract($data);

                ob_start();

                include $file_name;

                return @ob_get_clean();
            }
        }
    }
}
