<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity success payment item
 *
 * Created by ShineTheme
 *
 */
if(isset($data) and $key){
    ?>
    <li>
        <div class="row">
            <div class="col-xs-9">
                <h5><i class="fa fa-plane"></i><?php echo get_the_title($key) ?></h5>
                <p>
                    <?php if(isset($data['data']['check_in'])):?>
                    <small><?php echo mysql2date('d M, Y',$data['data']['check_in']) ?>
                    <?php endif;?>
                    <?php if(isset($data['data']['check_out'])):?>
                    <?php esc_html_e('to','traveler'); echo mysql2date(' d M, Y',$data['data']['check_out']) ?>
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