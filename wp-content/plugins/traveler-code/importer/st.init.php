<?php

$packages=glob(plugin_dir_path(__FILE__).'xml/*');
$packages = array_filter($packages, 'is_dir');
if(!empty($packages))
{
	foreach($packages as $key=>$value)
	{
		$file=$value.'/package.php';
		if(file_exists($file))
		{
			include_once ($file);
		}
	}
}

if(!function_exists('show_import_page'))
{
    function show_import_page()
    {
        if(!is_admin()) return;

        require 'st.importer.php';
        STImporter::add_css();
        require 'st.menu.exporter.php';
        STImporter::register();

        if(isset($_REQUEST['st_export_icon']) and $_REQUEST['st_export_icon']){
            if(class_exists('STImporter')){
                STImporter::st_export_icon();
            }
        }
        if(isset($_REQUEST['st_export_airline']) and $_REQUEST['st_export_airline']){
            if(class_exists('STImporter')){
                STImporter::st_export_airline_meta();
            }
        }
        if(isset($_REQUEST['st_export_airport']) and $_REQUEST['st_export_airport']){
            if(class_exists('STImporter')){
                STImporter::st_export_airport_meta();
            }
        }
    }
    add_action('admin_init','show_import_page');

}
if(!function_exists('get_html_import'))
{
    function get_html_import(){
        $html = 'The Demo content is a replication of the Live Content. By importing it, you could get several sliders, sliders,
pages, posts, theme options, widgets, sidebars and other settings.
To be able to get them, make sure that you have installed and activated these plugins:  Contact form 7 , Option tree and Visual Composer <br><span style="color:#f0ad4e">
WARNING: By clicking Import Demo Content button, your current theme options, sliders and widgets will be replaced. It can also take a minute to complete.
Please back up your database before doing this.</span> <br><span style="color:red"><b>Please back up your database before  it.</b></span></span><br><br><br><br>
				<a id="btn_import" data_url="'.admin_url("themes.php?page=st-importer-content&start_import=1&step=1&version=light").'" class="button button-primary" >Import Demo Content Light</a>
				<a id="btn_import" data_url="'.admin_url("themes.php?page=st-importer-content&start_import=1&step=1&version=dark").'" class="button button-primary" >Import Demo Content Dark</a>
				<a id="btn_import" data_url="'.admin_url("themes.php?page=st-importer-content&start_import=1&step=1&version=arabic").'" class="button button-primary" >Import Demo Content Arabic</a>
				<br>
				  <div class="console_iport">
				</div>
				';
        return $html;

    }

}
add_action('admin_menu', 'register_my_custom_submenu_page',50);

function register_my_custom_submenu_page() {
    //add_submenu_page(apply_filters('ot_theme_options_menu_slug','st_traveler_options'), 'Importer Content', 'Importer Content', 'manage_options', 'st-importer-content', 'st_show_importer_content' );
}
if(!function_exists('st_show_importer_content'))
{
    function st_show_importer_content() {


        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
        echo '<h2>Import Demo Content</h2>';
        echo 'The Demo content is a replication of the Live Content. By importing it, you could get several sliders, sliders,
pages, posts, theme options, widgets, sidebars and other settings.
To be able to get them, make sure that you have installed and activated these plugins:  Contact form 7 , Option tree and Visual Composer <br><span style="color:#f0ad4e">
WARNING: By clicking Import Demo Content button, your current theme options, sliders and widgets will be replaced. It can also take a minute to complete.
Please back up your database before doing this.</span> <br><span style="color:red"><b>Please back up your database before  it.</b></span></span><br><br><br><br>
				<a id="btn_import" data_url="'.admin_url("admin.php?page=st-importer-content&start_import=1&step=1&version=light").'" class="button button-primary" >Import Demo Content </a>

				<a id="btn_import" data_url="'.admin_url("admin.php?page=st-importer-content&start_import=1&step=1&version=arabic").'" class="button button-primary" >Import Demo Content Arabic</a>
				<br>
				  <div class="console_iport">
				</div>
				';
        echo '</div>';
    }

}
function my_admin_notice() {
    if(!empty($_REQUEST['update_check_import_content'])){
        update_option( 'check_import_content', 'true' );
    }
    if(!empty($_REQUEST['reset_check_import_content'])){
        update_option( 'check_import_content', '' );
    }
    $check =  get_option( 'check_import_content' );
    if(empty($check)){
        ?>
            <div class="updated">
                <p><?php _e( 'Easily import content by only one click', STP_TEXTDOMAIN ); ?></p>
                <p class="submit">
                    <a class="button-primary" href="admin.php?page=st-importer-content&update_check_import_content=true"><?php _e('Import now',STP_TEXTDOMAIN) ?></a>
                    <a class="skip button" href="admin.php?update_check_import_content=true"><?php _e('No import',STP_TEXTDOMAIN) ?></a>
                </p>
            </div>
        <?php
    }

}
//add_action( 'admin_notices', 'my_admin_notice' );