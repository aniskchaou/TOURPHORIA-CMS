<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 1/20/15
 * Time: 2:34 PM
 */

if(!class_exists('BTCustomOT'))
{
    class BTCustomOT
    {
        static $_dir;
        static $_uri;

        static function init()
        {
            $app_dir='inc';
            self::$_dir=ST_TRAVELER_DIR.'/'.$app_dir.'/plugins/ot-custom';
            self::$_uri=get_template_directory_uri().'/'.$app_dir.'/plugins/ot-custom';

            if(is_admin()){
                self::load_fields();
            }
        }

        static function load($file){
            $file_name=self::$_dir.'/'.$file.'.php';

            if(is_file($file_name))
                require $file_name;
        }

        /**
         *
         *
         * @update 1.0
         * */
        static function load_fields()
        {
            //Base
            self::load('bt-ot-field');
            $dir_list=glob(self::$_dir.'/fields/*');

            if(!$dir_list) return;

            $dirs=array_filter(glob(self::$_dir.'/fields/*'),'is_dir');

            if(!empty($dirs))
            {
                foreach($dirs as $key=>$value){
                    $field_name=basename($value);

                    self::load('fields/'.$field_name.'/'.$field_name);
                }
            }
        }
    }

    BTCustomOT::init();
}
