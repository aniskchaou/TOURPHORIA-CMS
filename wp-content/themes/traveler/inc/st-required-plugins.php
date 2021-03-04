<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * ST Required Plugins
 *
 * Created by ShineTheme
 *
 */

if(!class_exists('STRequiredPlugins'))
{
    class STRequiredPlugins{


        function __construct()
        {

            add_action('tgmpa_register',array($this,'st_register_required_plugins'));
        }

        function st_register_required_plugins()
        {

            $plugins = array(
                array(
                    'name'               => 'WPBakery Visual Composer', // The plugin name.
                    'slug'               => 'js_composer', // The plugin slug (typically the folder name).
                    'source'                => ST_TRAVELER_DIR.('/inc/files/js_composer.zip'), // The plugin source.
                    'required'           => true, // If false, the plugin is only 'recommended' instead of required.
                    'version'            => "5.7",
                ),
                array(
                    'name'               => 'Option Tree', // The plugin name.
                    'slug'               => 'option-tree', // The plugin slug (typically the folder name).
                    'source'                => ST_TRAVELER_DIR.('/inc/files/option-tree.zip'), // The plugin source.
                    'required'           => true, // If false, the plugin is only 'recommended' instead of required.
                    'version'            => "2.7.0",
                ),
                array(
                    'name'      => 'Contact Form 7',
                    'slug'      => 'contact-form-7',
                    'required'  => true,
                ),
                array(
                    'name'      => 'Traveler code',
                    'slug'      => 'traveler-code',
                    'required'  => true,
                    'source'     => ST_TRAVELER_DIR.('/inc/files/traveler-code.zip'),
                    'version'     => "2.7",
                ),
                array(
                    'name'      =>'MailChimp for WordPress',
                    'slug'      =>'mailchimp-for-wp',
                    'required'  =>false
                ),
                array(
                    'name'      =>'Woocommerce',
                    'slug'      =>'woocommerce',
                    'required'  =>false
                )

            );

            /**
             * Array of configuration settings. Amend each line as needed.
             * If you want the default strings to be available under your own theme domain,
             * leave the strings uncommented.
             * Some of the strings are added into a sprintf, so see the comments at the
             * end of each line for what each argument will be.
             */
            $config = array(
                'default_path' => '',                      // Default absolute path to pre-packaged plugins.
                'menu'         => 'tgmpa-install-plugins', // Menu slug.
                'has_notices'  => true,                    // Show admin notices or not.
                'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
                'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
                'is_automatic' => false,                   // Automatically activate plugins after installation or not.
                'message'      => '',                      // Message to output right before the plugins table.
                'strings'      => array(
                    'page_title'                      => __( 'Install Required Plugins', ST_TEXTDOMAIN ),
                    'menu_title'                      => __( 'Install Plugins', ST_TEXTDOMAIN ),
                    'installing'                      => __( 'Installing Plugin: %s', ST_TEXTDOMAIN ), // %s = plugin name.
                    'oops'                            => __( 'Something went wrong with the plugin API.', ST_TEXTDOMAIN ),
                    'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', ST_TEXTDOMAIN ), // %1$s = plugin name(s).
                    'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', ST_TEXTDOMAIN ), // %1$s = plugin name(s).
                    'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', ST_TEXTDOMAIN ), // %1$s = plugin name(s).
                    'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', ST_TEXTDOMAIN ), // %1$s = plugin name(s).
                    'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', ST_TEXTDOMAIN ), // %1$s = plugin name(s).
                    'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', ST_TEXTDOMAIN ), // %1$s = plugin name(s).
                    'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', ST_TEXTDOMAIN ), // %1$s = plugin name(s).
                    'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', ST_TEXTDOMAIN ), // %1$s = plugin name(s).
                    'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', ST_TEXTDOMAIN ),
                    'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', ST_TEXTDOMAIN ),
                    'return'                          => __( 'Return to Required Plugins Installer', ST_TEXTDOMAIN ),
                    'plugin_activated'                => __( 'Plugin activated successfully.', ST_TEXTDOMAIN ),
                    'complete'                        => __( 'All plugins installed and activated successfully. %s', ST_TEXTDOMAIN ), // %s = dashboard link.
                    'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
                )
            );
            tgmpa( $plugins, $config );
        }
    }
}

new STRequiredPlugins();