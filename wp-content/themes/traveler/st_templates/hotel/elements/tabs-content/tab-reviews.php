<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 5/31/2017
 * Version: 1.0
 */

$review_detail = st()->load_template('hotel/elements/review_detail', false, null);

echo do_shortcode($review_detail);

echo '<div class="st-tour-comment-form">';
if(comments_open() and st()->get_option( 'activity_tour_review' ) != 'off') {
    ob_start();
    comments_template( '/reviews/reviews.php' );
    echo @ob_get_clean();
}
echo '</div>';