<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/1/2017
 * Version: 1.0
 */
?>
<div class="st-tab-payment">
    <div class="tab-content-price">
        <span class="single-price">
            <?php
            echo STTour::get_price_html(get_the_ID(),false,'<br>');
            ?>
        </span>
         <span class="duration">
             <?php
             $type_tour = get_post_meta(get_the_ID(),'type_tour',true);
             if($type_tour == 'daily_tour'){
                 ?>
                 <span class="unit-tour">
                <?php
                echo STTour::get_duration_unit();
                ?>
            </span>
             <?php } ?>
         </span>
        </div>
    <div class="content-price-payment">
        <div class="service-content-section">
            <h3 class="policies-title"><?php echo esc_html__('Payment Policies', ST_TEXTDOMAIN)?></h3>
            <div class="service-details">
                <div class="service-detail-item deposit">
                    <div class="service-detail-title"><?php echo esc_html__('Prepayment / Cancellation', ST_TEXTDOMAIN)?></div>
                    <div class="service-detail-content">
                        <ul>
                            <?php
                            $deposit_payment_status = get_post_meta(get_the_ID(),'deposit_payment_status', true);
                            if($deposit_payment_status =='amount') $deposit_payment_status='percent';
                            $deposit = '';
                            if($deposit_payment_status == ''){
                                $deposit = esc_html__('no', ST_TEXTDOMAIN);
                            }elseif($deposit_payment_status == 'percent'){
                                $deposit = get_post_meta(get_the_ID(), 'deposit_payment_amount', true).'%';
                            }else{
                                $deposit = TravelHelper::format_money(get_post_meta(get_the_ID(), 'deposit_payment_amount', true));
                            }
                            ?>
                            <li><?php echo esc_html__('Deposit', ST_TEXTDOMAIN)?>: <?php echo esc_attr($deposit); ?> &nbsp;&nbsp;<span class="enforced_red"><?php echo ($deposit_payment_status != ''?esc_html__('required', ST_TEXTDOMAIN):''); ?></span></li>
                            <?php $allow_cancel = get_post_meta(get_the_ID(), 'st_allow_cancel', true); ?>
                            <li><?php echo esc_html__('Allowed Cancellation', ST_TEXTDOMAIN)?>: <?php echo ($allow_cancel == 'on'?esc_html__('Yes', ST_TEXTDOMAIN):esc_html__('No', ST_TEXTDOMAIN)); ?></li>
                            <?php if($allow_cancel == 'on'){
                                $st_cancel_number_days = get_post_meta(get_the_ID(),'st_cancel_number_days', true);
                                if(!empty($st_cancel_number_days)){
                                    echo '<li>'.esc_html__('Number of day can cancellation', ST_TEXTDOMAIN).': '.(int)$st_cancel_number_days.' '._n('day','days', (int)$st_cancel_number_days, ST_TEXTDOMAIN).'</li>';
                                }
                                $st_cancel_percent = get_post_meta(get_the_ID(), 'st_cancel_percent', ST_TEXTDOMAIN);
                                if(!empty($st_cancel_percent)){
                                    echo '<li>'.esc_html__('Percent of total price for the canceling: ', ST_TEXTDOMAIN).$st_cancel_percent.'%</li>';
                                }
                                ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <?php
                $enable_tax = st()->get_option('tax_enable', 'off');
                if($enable_tax == 'on'){
                    $tax_value = st()->get_option('tax_value', '0');
                    $st_tax_include_enable = st()->get_option('st_tax_include_enable', 'off');
                ?>
                <div class="service-detail-item vat">
                    <div class="service-detail-title"><?php echo esc_html__('Tax', ST_TEXTDOMAIN)?></div>
                    <div class="service-detail-content">
                        <ul>
                            <li><?php echo esc_html__('V.A.T', ST_TEXTDOMAIN)?>: <?php echo esc_attr($tax_value); ?>% &nbsp;&nbsp;<span class="enforced_red"><?php echo ($st_tax_include_enable== 'on'?esc_html__('included', ST_TEXTDOMAIN):esc_html__('not included', ST_TEXTDOMAIN))?></span> &nbsp;&nbsp;</li>
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>