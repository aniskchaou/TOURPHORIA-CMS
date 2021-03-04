<?php
    /*
     * Template Name: Checkout
    */
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Template checkout
     *
     * Created by ShineTheme
     *
     */

    $hotel_parent = st()->get_option('hotel_alone_assign_hotel');
    if(!empty($hotel_parent)){
        echo st()->load_template('layouts/modern/single_hotel/page/checkout');
        return;
    }

    if(New_Layout_Helper::isNewLayout()){
        echo st()->load_template('layouts/modern/page/checkout');
        return;
    }

    get_header();

    wp_enqueue_script( 'checkout-js' );

?>
    <div class="gap"></div>
    <div class="container">
        <?php
            echo STTemplate::message();
        ?>
        <?php if ( !STCart::check_cart() ): ?>
            <div class="alert alert-danger">
                <p><?php esc_html_e('Sorry! Your cart is currently empty.','traveler') ?></p>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="row row-wrap">
                        <div class="col-md-12">
                            <h3><?php esc_html_e('Booking Submission','traveler')?></h3>

                            <div class="entry-content">
                                <?php
                                    while ( have_posts() ) {
                                        the_post();
                                        the_content();
                                    }
                                ?>
                            </div>
                            <form id="cc-form" class="" method="post" onsubmit="return false">
                                <?php echo st()->load_template( 'check_out/check_out' ) ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4><?php esc_html_e('Your Booking','traveler') ?>:</h4>

                    <div class="booking-item-payment">
                        <?php
                        $all_items = STCart::get_items();
                        if ( !empty( $all_items ) and is_array( $all_items ) ) {
                                foreach ( $all_items as $key => $value ) {
                                    if ( $key == 'car_transfer' ) {
                                        $transfer = new STCarTransfer();
                                        echo balanceTags( $transfer->get_cart_item_html( $key ) );
                                        break;
                                    } else {
                                        if ( get_post_status( $key ) ) {
                                            $post_type = get_post_type( $key );
                                            switch ( $post_type ) {
                                                case "st_hotel":
                                                    if(class_exists('STHotel')) {
                                                        $hotel = new STHotel();
                                                        echo balanceTags($hotel->get_cart_item_html($key));
                                                    }
                                                    break;
                                                case "hotel_room":
                                                    if(class_exists('STRoom')) {
                                                        $room = new STRoom();
                                                        echo balanceTags($room->get_cart_item_html($key));
                                                    }
                                                    break;
                                                case "st_cars":
                                                    if(class_exists('STCars')) {
                                                        $cars = new STCars();
                                                        echo balanceTags($cars->get_cart_item_html($key));
                                                    }
                                                    break;
                                                case "st_tours":
                                                    if(class_exists('STTour')) {
                                                        $tours = new STTour();
                                                        echo balanceTags($tours->get_cart_item_html($key));
                                                    }
                                                    break;
                                                case "st_rental":
                                                    if(class_exists('STRental')) {
                                                        $object = STRental::inst();
                                                        echo balanceTags($object->get_cart_item_html($key));
                                                    }
                                                    break;
                                                case "st_activity":
                                                    if(class_exists('STActivity'))
                                                    {
                                                        $object = STActivity::inst();
                                                        echo balanceTags( $object->get_cart_item_html( $key ) );
                                                    }
                                                    break;
                                                case "st_flight":
                                                    if ( class_exists( 'ST_Flight_Checkout' ) ) {
                                                        echo ST_Flight_Checkout::inst()->get_cart_item_html( $key );
                                                    }
                                                    break;
                                                case "car_transfer":
                                                    if ( class_exists( 'STCarTransfer' ) ) {
                                                        echo STCarTransfer::inst()->get_cart_item_html( $key );
                                                    }
                                                    break;
                                            }
                                        }
                                    }

                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
    <span class="hidden st_template_checkout"></span>
<?php


    get_footer();