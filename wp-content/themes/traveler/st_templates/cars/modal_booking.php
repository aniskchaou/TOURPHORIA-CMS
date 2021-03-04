<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars modal booking
 *
 * Created by ShineTheme
 *
 */
//Logged in User Info
global $firstname , $user_email;
wp_get_current_user();

?>
<div class="row">
    <div class="col-xs-12 col-md-8">
        <h3><?php printf(st_get_language('you_are_booking_for_s'),get_the_title())?></h3>
        <form id="booking_modal_<?php echo get_the_ID() ?>" class="booking_modal_form" action="" method="post" onsubmit="return false">
            <div>
                <input type="hidden" name="action" value="booking_form_submit">
                <?php echo st()->load_template('check_out/check_out',null,array('post_id'=>get_the_ID()))?>
            </div>
        </form>
    </div>
    <div class="col-xs-12 col-md-4">
        <h4><?php st_the_language('your_booking') ?>:</h4>
        <div class="booking-item-payment">
            <?php
            $all_items = STCart::get_items();
            if (!empty($all_items) and is_array($all_items)) {
                foreach ($all_items as $key => $value) {
                    if (get_post_status($key)) {
                        $post_type = get_post_type($key);
                        switch ($post_type) {
                            case "st_hotel":
                                $hotel = new STHotel();
                                echo balanceTags($hotel->get_cart_item_html($key));
                                break;
                            case "st_cars":
                                $cars = new STCars();
                                echo balanceTags($cars->get_cart_item_html($key));
                                break;
                            case "st_tours":
                                $tours = new STTour();
                                echo balanceTags($tours->get_cart_item_html($key));
                                break;
                            case "st_rental":
                                $object = STRental::inst();
                                echo balanceTags($object->get_cart_item_html($key));
                                break;
                            case "st_activity":
                                $object = STActivity::inst();
                                echo balanceTags($object->get_cart_item_html($key));
                                break;
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
</div>
