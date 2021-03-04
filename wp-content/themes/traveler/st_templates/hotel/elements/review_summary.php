<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel reviews summary
 *
 * Created by ShineTheme
 *
 */
$avg=STReview::get_avg_rate();
?>
<div class="booking-item-meta">
    <?php if($avg>=2):?>
    <h2 class="lh1em">
        <?php
        if($avg<2){

        }
        elseif($avg<=3){
            st_the_language('pleasant');
        }elseif($avg<=4)
        {
            st_the_language('good');
        }elseif($avg<5){
            st_the_language('very_good');
        }elseif($avg==5){
            st_the_language('wonderful');
        }
        ?>
    </h2>
    <?php endif;?>
    
    <h3><?php echo STReview::get_percent_recommend()?>% <small><?php st_the_language('of_guest_recommend')?></small></h3>

    <div class="booking-item-rating">
        <ul class="icon-list icon-group booking-item-rating-stars">
            <?php
            echo  TravelHelper::rate_to_string($avg);
            ?>
        </ul><span class="booking-item-rating-number"><b><?php echo balanceTags($avg)?></b> <?php st_the_language('of_5_guest_rating')?></span>
        <p><a class="text-default" href="<?php echo get_comments_link() ?>"><?php comments_number(st_get_language('no_review'),st_get_language('based_on_1_review'),st_get_language('based_on_s_review'));?></a>
        </p>
    </div>
    <?php echo st()->load_template('hotel/share') ?>
    <?php echo st()->load_template('user/html/html_add_wishlist',null,array("title"=>st_get_language('add_to_wishlist'),'class'=>'btn-sm')) ?>
</div>