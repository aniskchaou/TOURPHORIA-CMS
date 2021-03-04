<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/27/2019
 * Time: 8:53 AM
 */
class ST_Config
{
    protected static $_allConfigs = [];


    protected static function loadFile($file)
    {
        $new_layout = st()->firstGetOption('st_theme_style', 'classic');

        $path_origin = get_template_directory().'/inc/configs/'.$file.'.php';
        if ($new_layout == 'modern') {
            $path = get_template_directory().'/inc/layouts/modern/configs/'.$file.'.php';
            if(file_exists($path))
            {
               $path_origin = $path;
            }

        }

        if(file_exists($path_origin))
        {
            self::$_allConfigs[$file]=(include $path_origin);
        }
    }

    /**
     * @param $key string format: filename.params.keys
     * @param $default mixed
     * @return mixed
     */
    public static function get($key,$default = null){

        $explode = explode('.',$key);

        if(count($explode)<2){
            if(empty(self::$_allConfigs[$explode[0]])){
                self::loadFile($explode[0]);
                return self::$_allConfigs[$explode[0]];
            }
        }

        if(empty(self::$_allConfigs[$explode[0]])) self::loadFile($explode[0]);

        if(!isset(self::$_allConfigs[$explode[0]][$explode[1]])) return $default;

        $return = self::$_allConfigs[$explode[0]][$explode[1]];

        for($i=2;$i<count($explode);$i++)
        {
            $return = isset($return[$explode[$i]])?$return[$explode[$i]]:$default;
        }

        return $return;
    }

}