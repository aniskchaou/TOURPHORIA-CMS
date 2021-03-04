<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel price
 *
 * Created by ShineTheme
 *
 */

$default = array(
    'align' => 'right'
);
if (isset($attr)) {
    extract(wp_parse_args($attr, $default));
} else {
    extract($default);
}

$price = STHotel::get_price();
$show_price = st()->get_option('show_price_free');
?>
<?php if ($show_price == 'on' || $price): ?>
    <p class="booking-item-header-price text-<?php echo esc_html($align) ?>">
        <?php if (STHotel::is_show_min_price()) { ?>
            <small><?php _e("price from", ST_TEXTDOMAIN) ?></small>
        <?php } else { ?>
            <small><?php _e("price avg", ST_TEXTDOMAIN) ?></small>

        <?php } ?>

        <span class="text-lg" itemprop="priceRange"><?php echo TravelHelper::format_money($price) ?></span>/<?php st_the_language('night') ?>
    </p>
<?php endif; ?>