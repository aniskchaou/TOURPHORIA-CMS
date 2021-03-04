<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 5/30/2017
 * Version: 1.0
 */

extract($atts);
$type_tour = get_post_meta(get_the_ID(),'type_tour',true);
?>
<div class="st-tour-title-address <?php echo esc_attr($extra_class); ?>">
    <h4 class="location"><?php if($type_tour == 'daily_tour') echo esc_html__('Daily Tour', ST_TEXTDOMAIN); else echo esc_html__('Specific Date', ST_TEXTDOMAIN) ?></h4>
    <h3 class="title title-tour"><?php echo do_shortcode(get_the_title(get_the_ID())) ?></h3>
<?php
$address = get_post_meta(get_the_ID(),'address',true);
if(!empty($address)) {
    echo '<p class="address"><i class="fa fa-map-marker"></i> ' . $address . '</p>';
}

if (has_excerpt(get_the_ID())) {
    echo '<p class="description">' . get_the_excerpt(get_the_ID()) . '</p>';
}
?>
</div>
