<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User overview
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'gmapv3' );
?>
<?php $data = STUser_f::get_info_total_traveled(); ?>

<div class="st-create">
    <h2 class="pull-left clearfix"><?php _e("Overview",ST_TEXTDOMAIN) ?></h2>
</div>
<ul class="list list-inline user-profile-statictics mb30">
        <?php if (st_check_service_available("st_hotel")): ?>
            <li><img src="<?php echo get_template_directory_uri()."/v2/images/dashboard/ico_hotel.svg";?>" alt="" class="st-icon-menu"></i>
                <h5><?php echo esc_html($data['st_hotel']) ?></h5>
                <p><?php if($data['st_hotel'] > 1)st_the_language('hotels');else st_the_language('hotel'); ?></p>
            </li>
        <?php endif; ?>
        <?php if (st_check_service_available("st_rental")): ?>
            <li><i class="fa fa-home user-profile-statictics-icon"></i>
                <h5><?php echo esc_html($data['st_rental']) ?></h5>
                <p><?php if($data['st_rental'] > 1)st_the_language('rentals');else st_the_language('rental'); ?></p>
            </li>
        <?php endif; ?>
        <?php if (st_check_service_available("st_cars")): ?>
            <li><i class="fa fa-car  user-profile-statictics-icon"></i>
                <h5><?php echo esc_html($data['st_cars']) ?></h5>
                <p><?php if($data['st_cars'] > 1)st_the_language('cars');else st_the_language('car'); ?></p>
            </li>
        <?php endif; ?>
        <?php if (st_check_service_available("st_tours")): ?>
            <li><i class="fa fa-flag-o user-profile-statictics-icon"></i>
                <h5><?php echo esc_html($data['st_tours']) ?></h5>
                <p><?php if($data['st_tours'] > 1)st_the_language('tours');else st_the_language('tour'); ?></p>
            </li>
        <?php endif; ?>
        <?php if (st_check_service_available("st_activity")): ?>
            <li><i class="fa fa-bolt user-profile-statictics-icon"></i>
                <h5><?php echo esc_html($data['st_activity']) ?></h5>
                <p><?php if($data['st_activity'] > 1)st_the_language('activities');else st_the_language('activity'); ?></p>
            </li>
        <?php endif; ?>
</ul>
<div>
    <?php $json = str_ireplace(array("'"),'\"',json_encode($data['address'])); ?>
    <span class="hidden st_user_overview"
        data-overview ='<?php echo ($json) ?>'
    ></span>
    <div>
        <div class="st_google_map_user"></div>
    </div>
</div>