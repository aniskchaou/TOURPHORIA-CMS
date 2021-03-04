<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity element review detail
 *
 * Created by ShineTheme
 *
 */
$hotel=STActivity::inst();?>
<div class="mt20">
    <div class="row">
        <div class="col-md-7">
            <?php $total=get_comments_number(); ?>
            <h4 class="lh1em"><?php esc_html_e('Traveler rating','traveler')?></h4>
            <ul class="list booking-item-raiting-list">

                <?php $rate_exe=STReview::count_review_by_rate(null,5);?>
                <li>
                    <div class="booking-item-raiting-list-title"><?php esc_html_e('Excellent','traveler')?></div>
                    <div class="booking-item-raiting-list-bar">
                        <div style="width:<?php echo TravelHelper::cal_rate($rate_exe,$total)?>%;"></div>
                    </div>
                    <div class="booking-item-raiting-list-number"><?php echo esc_html( $rate_exe) ?></div>
                </li>

                <?php $rate_good=STReview::count_review_by_rate(null,4);?>
                <li>
                    <div class="booking-item-raiting-list-title"><?php esc_html_e('Very Good','traveler') ?></div>
                    <div class="booking-item-raiting-list-bar">
                        <div style="width:<?php echo TravelHelper::cal_rate($rate_good,$total)?>%;"></div>
                    </div>
                    <div class="booking-item-raiting-list-number"><?php echo esc_html( $rate_good) ?></div>
                </li>

                <?php $rate_avg=STReview::count_review_by_rate(null,3);?>
                <li>
                    <div class="booking-item-raiting-list-title"><?php esc_html_e('Average','traveler')?></div>
                    <div class="booking-item-raiting-list-bar">
                        <div style="width:<?php echo TravelHelper::cal_rate($rate_avg,$total)?>%;"></div>
                    </div>
                    <div class="booking-item-raiting-list-number"><?php echo esc_html( $rate_avg)?></div>
                </li>
                <?php $rate_poor=STReview::count_review_by_rate(null,2);?>
                <li>
                    <div class="booking-item-raiting-list-title"><?php esc_html_e('Poor','traveler')?></div>
                    <div class="booking-item-raiting-list-bar">
                        <div style="width:<?php echo TravelHelper::cal_rate($rate_poor,$total)?>%;"></div>
                    </div>
                    <div class="booking-item-raiting-list-number"><?php echo esc_html( $rate_poor) ?></div>
                </li>

                <?php $rate_terible=STReview::count_review_by_rate(null,1);?>
                <li>
                    <div class="booking-item-raiting-list-title"><?php esc_html_e('Terrible','traveler')?></div>
                    <div class="booking-item-raiting-list-bar">
                        <div style="width:<?php echo TravelHelper::cal_rate($rate_terible,$total)  ?>%;"></div>
                    </div>
                    <div class="booking-item-raiting-list-number"><?php echo esc_html( $rate_terible )?></div>
                </li>
            </ul>
            <a href="<?php echo get_comments_link()?>" class="btn btn-primary"><?php esc_html_e('Write a review','traveler')?></a>
        </div>

        <?php $hotel_stats=$hotel->get_review_stats();
        if(!empty($hotel_stats) and is_array($hotel_stats))
        {
            ?>
            <div class="col-md-5">
                <h4 class="lhem activity-review-sum"><?php esc_html_e('Summary','traveler')?></h4>
                <ul class="list booking-item-raiting-summary-list">
                    <?php
                    //$post_stats=get_post_meta(get_the_ID(),'review_stats',true);

                    foreach($hotel_stats as $key=>$value)
                    {

                        ?>
                        <li>
                            <div class="booking-item-raiting-list-title"><?php echo esc_html( $value['title'])?></div>
                            <ul class="icon-group booking-item-rating-stars">
                                <?php for($i=1;$i<=5;$i++)
                                {
                                    //$avg=TravelHelper::find_in_array($post_stats,'title',sanitize_title($value['title']),'stat_value');
                                    $avg=STReview::get_avg_stat(get_the_ID(),$value['title']);
                                    $class='';

                                    if($i>$avg)
                                    {
                                        $class='text-gray';
                                    }

                                    echo '<li><i class="fa fa-smile-o '.$class.'"></i>';
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }?>

                </ul>
            </div>
        <?php

        }
        ?>
    </div>
</div>
