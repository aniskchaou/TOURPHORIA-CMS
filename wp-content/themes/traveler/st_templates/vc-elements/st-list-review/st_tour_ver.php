<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.2.3
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
<div class="div_review st_tour_ver">
    <div class="div_review_inner">
        <div class="div_review_half left">
            <i class="fa fa-arrow-left text-white"></i>
        </div>
        <div class="div_review_half right">
            <i class="fa fa-arrow-right text-white"></i>
        </div>
    </div>
    <div class="row">
        <div class="st_tour_ver_review">
        <?php
            wp_list_comments( array(
                'style'       => 'div',
                'short_ping'  => false,
                'avatar_size' => 74,
                'callback'=>array('TravelHelper','review_list_st_tour_ver'),
                'per_page'=>$st_list_review_number
            ) );
        ?>
        </div>
    </div>
</div><!-- #comments -->
