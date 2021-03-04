<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STAdminLocation
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('STAdminLocation'))
{

    class STAdminLocation {

        function __construct()
        {
            //add location type custom fields
            $this->add_location_type_meta();

        }

        function add_location_type_meta()
        {
            /*
                 * prefix of meta keys, optional
                 */
            $prefix = 'st_';
            /*
             * configure your meta box
             */
            $config = array(
                'id' => 'st_extra_infomation',          // meta box id, unique per meta box
                'title' => __('Extra Information',ST_TEXTDOMAIN),          // meta box title
                'pages' =>array('st_location_type'),        // taxonomy name, accept categories, post_tag and custom taxonomies
                'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
                'fields' => array(),            // list of meta fields (can be added by field arrays)
                'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
                'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
            );

            if(!class_exists('Tax_Meta_Class'))
            {
                STFramework::write_log('Tax_Meta_Class not found in class.attribute.php line 121');
                return;
            }

            /*
             * Initiate your meta box
             */
            $my_meta =  new Tax_Meta_Class($config);

            /*
             * Add fields to your meta box
             */

            //text field
            $my_meta->addSelect($prefix.'label',
                array(
                    'default'=>__('Default',ST_TEXTDOMAIN),
                    'primary'=>__('Primary',ST_TEXTDOMAIN),
                    'success'=>__('Success',ST_TEXTDOMAIN),
                    'info'=>__('Info',ST_TEXTDOMAIN),
                    'warning'=>__('Warning',ST_TEXTDOMAIN),
                    'danger'=>__('Danger',ST_TEXTDOMAIN),
                )
                ,
                array('name'=> __('Label Type',ST_TEXTDOMAIN)));
            $my_meta->Finish();
        }


    }

    new STAdminLocation();
}