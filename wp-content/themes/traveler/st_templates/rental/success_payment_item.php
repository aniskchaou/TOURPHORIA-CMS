<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Rental payment success item
 *
 * Created by ShineTheme
 *
 */
$format=TravelHelper::getDateFormat();
if(isset($data) and $key){
    ?>
    <li>
        <div class="row">
            <div class="col-xs-9">
                <h5><i class="fa fa-plane"></i><?php echo get_the_title($key) ?></h5>
                <p>
                    <?php if(isset($data['data']['check_in'])):?>
                    <small><?php echo date_i18n($format,strtotime($data['data']['check_in'])) ?>
                    <?php endif;?>
                    <?php if(isset($data['data']['check_out'])):?>
                    <?php st_the_language('to') ; echo date_i18n($format,strtotime($data['data']['check_out'])) ?>
                    <?php endif;?></small>
                </p>
            </div>
            <div class="col-xs-3">
                <p class="text-right"><span class="text-lg">
                    <?php
                        $money=STCart::get_hotel_price($data['data'],$data['price'],$data['number']);
                        echo TravelHelper::format_money($money);
                    ?>
                </span>
                </p>
            </div>
        </div>
    </li>
    <?php
}