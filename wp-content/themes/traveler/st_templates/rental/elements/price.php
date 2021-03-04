<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Rental price
 *
 * Created by ShineTheme
 *
 */

$default=array(
    'align'=>'right'
);
if(isset($attr))
{
    extract(wp_parse_args($attr,$default));
}else{
    extract($default);
}

$new_price=STRental::get_price();
$is_sale=STRental::is_sale();
$show_price = st()->get_option('show_price_free');
?>

<p class="booking-item-header-price">
    <?php
        if($is_sale):

            echo "<span class='booking-item-old-price'>".TravelHelper::format_money(STRental::get_orgin_price())."</span>";
        endif;
    ?>
    <?php if($show_price == 'on' || $new_price): ?>
    <span class="text-lg"><?php echo TravelHelper::format_money($new_price)?></span>/<?php st_the_language('rental_night')?></p>
    <?php endif; ?>