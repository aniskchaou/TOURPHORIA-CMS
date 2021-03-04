<?php
/*
Template Name: Confirm Order
*/
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Template Name : Order Confirmation
 *
 * Created by ShineTheme
 *
 */
$hotel_parent = st()->get_option('hotel_alone_assign_hotel');
if(!empty($hotel_parent)){
    echo st()->load_template('layouts/modern/single_hotel/page/confirm');
    return;
}


if(New_Layout_Helper::isNewLayout()){
    echo st()->load_template('layouts/modern/page/confirm');
    return;
}
get_header();
$message=STTemplate::get_message();
?>
<div class="gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php if($message['type']):?>
            <i class="fa fa-check round box-icon-large box-icon-center box-icon-success mb30"></i>
            <?php else:?>
                <i class="fa fa-close round box-icon-large box-icon-center box-icon-danger mb30"></i>
            <?php endif;?>
            <h2 class="text-center">
                <?php echo esc_html($message['content']);
                STTemplate::clear(); ?>
            </h2>
        </div>
    </div>
</div>
<?php
get_footer();