<?php 
/**
*@since 1.2.5
*	Shopping Cart showing header
**/

if (empty($container)){$container = "div"; }
if (empty($class)) {$class = "nav-drop nav-symbol" ;}

$st_is_woocommerce_checkout = apply_filters('st_is_woocommerce_checkout',false);
if($st_is_woocommerce_checkout):
	$cart_url = wc_get_cart_url();
	$cart_total_item = (int) WC()->cart->get_cart_contents_count();
	$cart_total_amount = WC()->cart->get_cart_total();
?>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  slimmenu-sub-menu st_menu_mobile_new" style="display: none">
	<a href="<?php echo esc_url( $cart_url ); ?>">
        <?php _e("Cart",ST_TEXTDOMAIN) ?>
        <span class="badge"><?php echo esc_html($cart_total_item); ?></span>
    </a>
</li>
<?php else:
    $cart_total_amount = (float) STCart::get_total();
    $check_out_url = (int) st()->get_option('page_checkout','');
    $check_out_url = get_permalink( $check_out_url );
    ?>
    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  slimmenu-sub-menu st_menu_mobile_new" style="display: none">
        <a href="<?php echo esc_url( $check_out_url ); ?>">
            <?php _e("Cart",ST_TEXTDOMAIN) ?>
            <span class="badge"><?php echo esc_html($cart_total_amount); ?></span>
        </a>
    </li>
<?php endif; ?>
