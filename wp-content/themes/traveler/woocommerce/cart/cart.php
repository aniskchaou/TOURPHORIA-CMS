<?php
/**
 * Cart Page
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<div class="row">
    <div class="col-sm-8">
<form action="<?php echo esc_url(wc_get_cart_url() ); //echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' );

?>
    <ul class="booking-list booking-list-wishlist woocommerce_cart_table">
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $product_url='';
            $product_title='';
            $post_type=false;

            // Traveler
            if(isset($cart_item['st_booking_data']) and !empty($cart_item['st_booking_data']))
            {
                $st_booking_data=$cart_item['st_booking_data'];

                $post_type=isset($st_booking_data['st_booking_post_type'])?$st_booking_data['st_booking_post_type']:false;

                $booking_id=isset($st_booking_data['st_booking_id'])?$st_booking_data['st_booking_id']:false;
                if($booking_id)
                {

                     $product_url=get_permalink($booking_id);
                }
            }

            $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if(!$product_url) $product_url= $_product->get_permalink( $cart_item );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_title=$_product->get_title();
                if(isset($booking_id))
                $product_title=get_the_title($booking_id);
                ?>
                <li class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <?php
                    do_action('st_before_cart_item_'.$post_type);

                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a class="fa fa-times booking-item-wishlist-remove" href="%s" rel="tooltip" data-placement="top" title="" data-original-title="%s"></a>
', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), __( 'Remove this item', ST_TEXTDOMAIN ) ), $cart_item_key );
                    ?>
                    <div class="booking-item">
                        <div class="row">
                            <div class="col-md-3">

                                <?php
                                if(isset($cart_item['st_booking_data']) and !empty($cart_item['st_booking_data']))
                                {
                                    $st_booking_data=$cart_item['st_booking_data'];
                                    $booking_id=isset($st_booking_data['st_booking_id'])?$st_booking_data['st_booking_id']:false;

                                    printf( '<a href="%s" target="_blank">%s</a>', get_permalink( $booking_id ), get_the_post_thumbnail($booking_id, 'thumbnail', array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($booking_id )))));

                                }else{
                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                    if ( ! $_product->is_visible() )
                                        echo $thumbnail;
                                    else
                                        printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
                                }

                                ?>
                            </div>
                            <div class="col-md-5">

                                <h5 class="booking-item-title">
                                    <?php
                                    if ( ! $_product->is_visible() )
                                        echo apply_filters( 'woocommerce_cart_item_name', $product_title, $cart_item, $cart_item_key ) . '&nbsp;';
                                    else
                                        echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" target="_blank">%s </a>',$product_url, $product_title ), $cart_item, $cart_item_key );

                                    // Meta data
                                    echo wc_get_formatted_cart_item_data( $cart_item );

                                    // Backorder notification
                                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
                                        echo '<p class="backorder_notification">' . __( 'Available on backorder', ST_TEXTDOMAIN ) . '</p>';
                                    ?>
                                </h5>
                                <?php
                                    if(isset($cart_item['st_booking_data']) and !empty($cart_item['st_booking_data']))
                                    {
                                        $st_booking_data=$cart_item['st_booking_data'];
                                        $st_booking_data['cart_item_key'] =$cart_item_key ;

                                        $booking_id=isset($st_booking_data['st_booking_id'])?$st_booking_data['st_booking_id']:false;

                                        if($post_type and $booking_id)
                                        {
                                            $address=get_post_meta($booking_id,'address',true);
                                            if($address){
                                                echo '<p class="booking-item-address"><i class="fa fa-map-marker"></i> '.$address.'</p>';
                                            }

                                            do_action('st_wc_cart_item_information_'.$post_type,$st_booking_data);
                                        }

                                    }
                                ?>
                            </div>

                            <div class="col-md-4">
                                <span class="booking-item-price">
                                    <?php
                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                    ?>
                                </span>
                                <?php
                                if ( $_product->is_sold_individually() ) {
                                    $product_quantity = sprintf( '<input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                } else {
                                    $product_quantity = woocommerce_quantity_input( array(
                                        'input_name'  => "cart[{$cart_item_key}][qty]",
                                        'input_value' => $cart_item['quantity'],
                                        'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                        'min_value'   => '0'
                                    ), $_product, false );
                                }

                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
                                ?>
                                <?php
                                    if(isset($cart_item['st_booking_data']) and !empty($cart_item['st_booking_data']))
                                    {
                                        $st_booking_data=$cart_item['st_booking_data'];

                                        $booking_id=isset($st_booking_data['st_booking_id'])?$st_booking_data['st_booking_id']:false;

                                        if($post_type and $booking_id)
                                        {
                                            $is_collapse = apply_filters('st_woo_cart_is_collapse' , false);
                                            if ($is_collapse){
                                                do_action('st_wc_cart_item_information_btn_'.$post_type,$cart_item_key);
                                            }
                                        }

                                    }
                                ?>
                            </div>

                        </div>
                    </div>


                </li>
            <?php
            }
        }

        do_action( 'woocommerce_cart_contents' );
        ?>
    </ul>

<table class="shop_table cart" cellspacing="0">

    <tbody>

        <tr>
            <td colspan="6" class="actions">

                <?php if ( WC()->cart->coupons_enabled() ) { ?>
                    <div class="coupon">

                        <label for="coupon_code"><?php _e( 'Coupon', ST_TEXTDOMAIN ); ?>:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', ST_TEXTDOMAIN ); ?>" /> <input type="submit" class="btn btn-primary" name="apply_coupon" value="<?php _e( 'Apply Coupon', ST_TEXTDOMAIN ); ?>" />

                        <?php do_action( 'woocommerce_cart_coupon' ); ?>

                    </div>
                <?php } ?>

                <input type="submit" class="btn btn-primary" name="update_cart" value="<?php _e( 'Update Cart', ST_TEXTDOMAIN ); ?>" />

                <?php do_action( 'woocommerce_cart_actions' ); ?>

                <?php wp_nonce_field( 'woocommerce-cart' ); ?>
            </td>
        </tr>

        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
    </tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>
</div>
        <div class="col-sm-4">

            <div class="cart-collaterals">

                <?php do_action( 'woocommerce_cart_collaterals' ); ?>

            </div>
        </div>
    </div>
<?php do_action( 'woocommerce_after_cart' ); ?>
