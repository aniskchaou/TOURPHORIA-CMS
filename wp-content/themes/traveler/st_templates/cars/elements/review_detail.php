<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel reviews detail
 *
 * Created by ShineTheme
 *
 */
$cars=new STCars();?>
<div class="">
    <div class="row">
        <div class="col-md-8">
            <?php $total=get_comments_number(); ?>
            <h4 class="lh1em"><?php st_the_language('traveler_rating')?></h4>
            <ul class="list booking-item-raiting-list">

                <?php $rate_exe=STReview::count_review_by_rate(null,5);?>
                <li>
                    <div class="booking-item-raiting-list-title"><?php st_the_language('exellent')?></div>
                    <div class="booking-item-raiting-list-bar">
                        <div style="width:<?php echo TravelHelper::cal_rate($rate_exe,$total)?>%;"></div>
                    </div>
                    <div class="booking-item-raiting-list-number"><?php echo esc_html($rate_exe) ?></div>
                </li>

                <?php $rate_good=STReview::count_review_by_rate(null,4);?>
                <li>
                    <div class="booking-item-raiting-list-title"><?php st_the_language('very_good')?></div>
                    <div class="booking-item-raiting-list-bar">
                        <div style="width:<?php echo TravelHelper::cal_rate($rate_good,$total)?>%;"></div>
                    </div>
                    <div class="booking-item-raiting-list-number"><?php echo esc_html($rate_good) ?></div>
                </li>

                <?php $rate_avg=STReview::count_review_by_rate(null,3);?>
                <li>
                    <div class="booking-item-raiting-list-title"><?php st_the_language('average')?></div>
                    <div class="booking-item-raiting-list-bar">
                        <div style="width:<?php echo TravelHelper::cal_rate($rate_avg,$total)?>%;"></div>
                    </div>
                    <div class="booking-item-raiting-list-number"><?php echo esc_html($rate_avg) ?></div>
                </li>
                <?php $rate_poor=STReview::count_review_by_rate(null,2);?>
                <li>
                    <div class="booking-item-raiting-list-title"><?php st_the_language('poor')?></div>
                    <div class="booking-item-raiting-list-bar">
                        <div style="width:<?php echo TravelHelper::cal_rate($rate_poor,$total)?>%;"></div>
                    </div>
                    <div class="booking-item-raiting-list-number"><?php echo esc_html($rate_poor) ?></div>
                </li>

                <?php $rate_terible=STReview::count_review_by_rate(null,1);?>
                <li>
                    <div class="booking-item-raiting-list-title"><?php st_the_language('terrible')?></div>
                    <div class="booking-item-raiting-list-bar">
                        <div style="width:<?php echo TravelHelper::cal_rate($rate_terible,$total)  ?>%;"></div>
                    </div>
                    <div class="booking-item-raiting-list-number"><?php echo esc_html($rate_terible)?></div>
                </li>
            </ul>
            <a href="<?php echo get_comments_link()?>" class="btn btn-primary"><?php st_the_language('write_a_review')?></a>
        </div>

        <?php $cars_stats=$cars->get_review_stats();
        if(!empty($cars_stats) and is_array($cars_stats))
        {
            ?>
            <div class="col-md-4">
                <h4 class="lhem"><?php st_the_language('summary')?></h4>
                <ul class="list booking-item-raiting-summary-list">
                    <?php
                    foreach($cars_stats as $key=>$value)
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
