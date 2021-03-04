<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours price
 *
 * Created by ShineTheme
 *
 */

$default=array(
    'align'=>'left'
);
if(isset($attr))
{
    extract(wp_parse_args($attr,$default));
}else{
    extract($default);
}

?>
<p class="booking-item-header-price text-<?php echo esc_attr($align) ?>">
<?php echo STTour::get_price_html(get_the_ID(),false,'<br>') ?>
</p>