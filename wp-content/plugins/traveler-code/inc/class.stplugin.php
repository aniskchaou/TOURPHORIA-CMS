<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 11/13/14
 * Time: 9:11 AM
 */
class STPlugin{

    public $plugin_url;
    public  $plugin_dir;

    function __construct()
    {

    }

    public function __plugins_loaded()
    {
       $file=array(

            'custom-posttype',
            'inc/st.shortcode',
            'inc/class.language',

        );

        $this->load_libs($file);
    }


    function dir($url=false)
    {

        return $this->plugin_dir.$url;
    }

    function url($url=false)
    {
        return $this->plugin_url.$url;
    }



    function load_libs($libs)
    {

        if(!empty($libs)){
            foreach($libs as $value){

                $file=$this->dir($value.'.php');


                if(file_exists($file)){

                    require_once($file);

                }

            }
        }
    }

    static function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
	                error_log( print_r( $log, true ) );
	            } else {
	                error_log( $log );
	    	}	
    	}
    }
}