<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 5/30/2017
 * Version: 1.0
 */

extract($atts);

?>
<div class="st-hotel-title-address <?php echo esc_attr($extra_class.' '.$align); ?>">
    <h3 class="title title-tour"><?php echo do_shortcode(get_the_title(get_the_ID())) ?></h3>
    <ul class="review-stars">
        <?php
        $avg = STReview::get_avg_rate();
        echo TravelHelper::rate_to_string($avg);
        echo '<span class="review-number">'.esc_html(number_format($avg,1)).'</span>';
        ?>
    </ul>
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
