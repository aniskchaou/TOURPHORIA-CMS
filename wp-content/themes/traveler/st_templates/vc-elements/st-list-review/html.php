<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Reviews
 *
 * Created by ShineTheme
 *
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
global $st_list_review_number;
if(empty($st_list_review_number))$st_list_review_number=5;
if ( post_password_required() )
    return;
?>
<div class="gap gap-small"></div>
<div class="div_review">
        <ul class="booking-item-reviews list">
            <?php
            wp_list_comments( array(
                'style'       => 'ul',
                'short_ping'  => false,
                'avatar_size' => 74,
                'callback'=>array('TravelHelper','reviewlist'),
                'per_page'=>$st_list_review_number
            ) );
            ?>
        </ul>
        <div class=" mb10">
            <a class="btn btn-primary" href="<?php echo get_comments_link() ?>"><?php _e("All Reviews",ST_TEXTDOMAIN) ?></a>
        </div>
        <!-- .comment-list -->
        <div class="gap gap-small"></div>
    <div class="gap gap-small"></div>
</div><!-- #comments -->
