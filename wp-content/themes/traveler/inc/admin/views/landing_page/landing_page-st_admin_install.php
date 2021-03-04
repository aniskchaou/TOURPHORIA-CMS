<?php
$packages=apply_filters('st_demo_packages',array());
$check_purchase = STAdminlandingpage::checkValidatePurchaseCode();
if(!$check_purchase){
    ?>
    <div class="error" style="padding: 8px 10px 5px 10px !important; margin-left: 0px; margin-top: 15px;">
        <p class="about-description"><?php printf(__("Please register product before install demo content %s",ST_TEXTDOMAIN),'<a href="'. admin_url('admin.php?page=st_product_reg') .'" target="_blank">Click here.</a>')?></p>
    </div>
    <?php
    return;
}
?>

<div class="traveler-important-notice">
    <p class="about-description"><?php printf(__("The Demo content is a replication of the Live Content. By importing it, you could get several sliders, sliders,pages, posts, theme options, widgets, sidebars and other settings.To be able to get them, make sure that you have installed and activated these plugins:  Contact form 7 , Option tree and Visual Composer <br><span style=\"color:#f0ad4e\">WARNING: By clicking Import Demo Content button, your current theme options, sliders and widgets will be replaced. It can also take a minute to complete.</span> <br><span style=\"color:red\"><b>Please back up your database before doing this.</b> %s ",ST_TEXTDOMAIN),'<a href="http://shinetheme.com/demosd/documentation/category/traveler/demo-contents-traveler/" target="_blank">View more info here.</a>')?></p>
</div>

<div class="console_iport" style="margin-bottom: 20px;"></div>

<div class="traveler-demo-themes">

            <?php
            if(!empty($packages)){
                $arr_packages_new = array();
                $arr_packages = array();
                if(isset($packages['light']))
                    $arr_packages['light'] = $packages['light'];

                if(isset($packages['rental']))
                    $arr_packages_new['rental'] = $packages['rental'];

                if(isset($packages['car']))
                    $arr_packages_new['car'] = $packages['car'];

                if(isset($packages['single_hotel']))
                    $arr_packages_new['single_hotel'] = $packages['single_hotel'];

	            if(isset($packages['mixmap']))
		            $arr_packages_new['mixmap'] = $packages['mixmap'];

                if(isset($packages['hotel']))
                    $arr_packages_new['hotel'] = $packages['hotel'];

                if(isset($packages['tour']))
                    $arr_packages_new['tour'] = $packages['tour'];

                if(isset($packages['activity']))
                    $arr_packages_new['activity'] = $packages['activity'];

                if(isset($packages['arabic']))
                    $arr_packages['arabic'] = $packages['arabic'];

                if(isset($packages['hotel_tour']))
                    $arr_packages['hotel_tour'] = $packages['hotel_tour'];

                ?>
    <div class="st-install feature-section theme-browser rendered">
        <div class='st_landing_page_admin_grid' style="overflow: hidden">
                <h2 style="font-size: 20px;"><?php echo __('Style 1', ST_TEXTDOMAIN); ?></h2>
                <span></span>
                <span></span>
                <?php
                foreach($arr_packages_new as $key=>$value)
                {
                    ?>
                    <div class="theme">
                        <div class="theme-screenshot">
                            <img src="<?php echo esc_attr($value['preview_image']) ?>" alt="<?php echo TravelHelper::get_alt_image() ?>">
                        </div>
                        <h3 class="theme-name" id="classic"><?php echo esc_html($value['title']) ?></h3>
                        <div class="theme-actions">
                            <a onclick="return false" class="button button-primary st-install-demo" data-demo-id="<?php echo esc_attr($key) ?>" href="#"><?php _e('Install',ST_TEXTDOMAIN)?></a>
                        </div>

                        <div class="demo-import-loader preview-all"></div>
                        <div class="demo-import-loader preview-classic"><i class="dashicons dashicons-admin-generic"></i></div>
                    </div>
                    <?php
                }

                ?>
        </div>
    </div>
    <div class="st-install feature-section theme-browser rendered">
        <div class='st_landing_page_admin_grid' style="overflow: hidden">
                <h2 style="font-size: 20px;"><?php echo __('Style 2', ST_TEXTDOMAIN); ?></h2>
                <span></span>
                <span></span>

                <?php
                foreach($arr_packages as $key=>$value)
                {
                    ?>
                    <div class="theme">
                        <div class="theme-screenshot">
                            <img src="<?php echo esc_attr($value['preview_image']) ?>" alt="<?php echo TravelHelper::get_alt_image() ?>">
                        </div>
                        <h3 class="theme-name" id="classic"><?php echo esc_html($value['title']) ?></h3>
                        <div class="theme-actions">
                            <a onclick="return false" class="button button-primary st-install-demo" data-demo-id="<?php echo esc_attr($key) ?>" href="#"><?php _e('Install',ST_TEXTDOMAIN)?></a>
                        </div>

                        <div class="demo-import-loader preview-all"></div>
                        <div class="demo-import-loader preview-classic"><i class="dashicons dashicons-admin-generic"></i></div>
                    </div>
                    <?php
                }
                ?>
        </div>
    </div>
                <?php
            } ?>

</div>