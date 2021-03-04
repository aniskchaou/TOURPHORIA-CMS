<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/12/2019
 * Time: 10:18 AM
 */

get_header('hotel-activity');
wp_enqueue_script( 'checkout-js' );
?>
    <div class="st-single-hotel-modern-page">
        <?php echo st()->load_template('layouts/modern/single_hotel/elements/banner'); ?>
        <div class="container">
            <div class="st-checkout-page">
                <?php
                echo STTemplate::message();
                ?>

                <?php if ( !STCart::check_cart() ): ?>
                    <div class="alert alert-danger">
                        <p><?php esc_html_e('Sorry! Your cart is currently empty.','traveler') ?></p>
                    </div>
                <?php else: ?>

                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <h3 class="title">
                                <?php echo __('Your Booking', ST_TEXTDOMAIN); ?>
                            </h3>
                            <div class="cart-info" id="cart-info">
                                <?php
                                $all_items = STCart::get_items();

                                if ( !empty( $all_items ) and is_array( $all_items ) ) {
                                    foreach ( $all_items as $key => $value ) {
                                        if ( get_post_status( $key ) ) {
                                            if(class_exists('STRoom')) {
                                                echo st()->load_template('layouts/modern/single_hotel/room/cart_item', '', [ 'item_id' => $key ]);
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <h3 class="title">
                                <?php echo __('Booking Submission', ST_TEXTDOMAIN); ?>
                            </h3>
                            <div class="check-out-form">
                                <div class="entry-content">
                                    <?php
                                    while ( have_posts() ) {
                                        the_post();
                                        the_content();
                                    }
                                    ?>
                                </div>
                                <form id="cc-form" class="" method="post" onsubmit="return false">
                                    <?php echo st()->load_template( 'layouts/modern/checkout/check_out' ) ?>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <span class="hidden st_template_checkout"></span>
<?php
get_footer('hotel-activity');