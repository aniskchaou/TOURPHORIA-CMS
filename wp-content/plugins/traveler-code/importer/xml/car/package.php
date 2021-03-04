<?php
/**
 * Created by PhpStorm.
 * User: Dungdt
 * Date: 1/7/2016
 * Time: 5:57 PM
 */
if(!class_exists('ST_Car_Package'))
{
	class ST_Car_Package
	{
		static $_instance;

		function __construct()
		{
			add_filter('st_demo_packages',array($this,'_add_package'));
			add_filter('st_demo_packages_config_car',array($this,'_get_config'));
		}
		function _get_config()
		{
			return array(
				'st_over_menus'=>array(
					"Hotel Menu" => "primary",
				),
				'homepage_default'=>'Home page',
				'homepost_default'=>''
			);
		}
		function _add_package($package)
		{
			$package['car']=array(
				'object'=>$this,
				'title'=>__("Car",'traveler'),
				'preview_image'=>plugin_dir_url(__FILE__).'/preview.png'
			);
			return $package;
		}
		static function instance(){
			if(!self::$_instance){
				self::$_instance=new self();
			}

			return self::$_instance;
		}

	}

	ST_Car_Package::instance();
}