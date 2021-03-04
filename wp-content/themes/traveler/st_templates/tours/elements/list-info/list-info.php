<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 5/30/2017
 * Version: 1.0
 */

$type_tour = get_post_meta(get_the_ID(),'type_tour',true);

?>
<div class="st-tour-information-list text-center <?php echo ($type_tour != 'daily_tour'?'info-4-col':'')?>">
    <ul>
        <li>
            <div class="item">
                <img src="<?php echo ST_TRAVELER_URI.'/img/icons-new/icon-1.png'; ?>" width="65" height="63" alt="info-icon">
                <p class="rating_title"><?php echo esc_html__('Price', ST_TEXTDOMAIN)?></p>
                <p class="detail"><?php echo STTour::get_price_html(get_the_ID(),false,'<br>'); ?></p>
            </div>
        </li>
        <li>
            <div class="item">
                <img src="<?php echo ST_TRAVELER_URI.'/img/icons-new/icon-2.png'; ?>" width="65" height="63" alt="info-icon">
                <p class="rating_title"><?php echo esc_html__('Trips', ST_TEXTDOMAIN)?></p>
                <p class="detail">
                    <?php
                    if($type_tour == 'daily_tour') echo esc_html__('Daily Tour', ST_TEXTDOMAIN); else echo esc_html__('Specific Date', ST_TEXTDOMAIN) ?>
                </p>
            </div>
        </li>
        <?php if($type_tour == 'daily_tour'){ ?>
        <li>
            <div class="item">
                <img src="<?php echo ST_TRAVELER_URI.'/img/icons-new/icon-4.png'; ?>" width="65" height="63" alt="info-icon">
                <p class="rating_title"><?php echo esc_html__('Duration', ST_TEXTDOMAIN)?></p>
                <p class="detail"><?php echo STTour::get_duration_unit(); ?></p>
            </div>
        </li>
        <?php } ?>
        <li>
            <div class="item">
                <img src="<?php echo ST_TRAVELER_URI.'/img/icons-new/icon-5.png'; ?>" width="65" height="63" alt="info-icon">
                <p class="rating_title"><?php echo esc_html__('Group Size', ST_TEXTDOMAIN)?></p>
                <?php $max_people = get_post_meta(get_the_ID(),'max_people', true) ?>
                <p class="detail">
                    <?php
                    if( !$max_people || $max_people == 0 ){
                        $max_people = esc_html__('Unlimited', ST_TEXTDOMAIN);
                    }
                    echo sprintf(esc_html__('Max %s people', ST_TEXTDOMAIN), $max_people);
                    ?>
                </p>
            </div>
        </li>
        <li>
            <div class="item">
                <img src="<?php echo ST_TRAVELER_URI.'/img/icons-new/icon-6.png'; ?>" width="65" height="63" alt="info-icon">
                <p class="rating_title"><?php echo esc_html__('Location', ST_TEXTDOMAIN)?></p>
                <p class="detail"><?php echo TravelHelper::locationHtml(get_the_ID()); ?></p>
            </div>
        </li>
    </ul>
</div>
