<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User Withdrawal
 *
 * Created by ShineTheme
 *
 */
$validator= STWithdrawal::$validator;
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$total_earning = STUser_f::st_get_data_reports_total_all_time_partner();
$total_earning_split_adaptivepayment = STUser_f::_get_total_price_split_adaptivepayment($user_id);
$total_price_payout = STAdminWithdrawal::_get_total_price_payout($user_id);
$your_balance = $total_earning['average_total'] - $total_price_payout - $total_earning_split_adaptivepayment;
?>
<div class="st-create">
    <h2  class="pull-left"><?php _e("Withdrawal",ST_TEXTDOMAIN) ?></h2>
</div>
<div class="row" style="margin-top: 15px;">
    <div class="col-md-4">
        <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-3">
            <div class="visual">
                <i class="fa fa-cogs"></i>
            </div>
            <div class="title">
                <?php _e("Your Balance",ST_TEXTDOMAIN) ?>
            </div>
            <div class="details">
                <div class="number">
                    <?php
                    if($total_earning['average_total'] > 0){
                        echo TravelHelper::format_money($total_earning['average_total']) ;
                    }else{
                        echo "0";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-2">
            <div class="visual">
                <i class="fa fa-calculator"></i>
            </div>
            <div class="title">
                <?php _e("Money Availability",ST_TEXTDOMAIN) ?>
            </div>
            <div class="details">
                <div class="number">
                    <?php
                    if($your_balance > 0){
                        echo TravelHelper::format_money($your_balance) ;
                    }else{
                        echo "0";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="st-create">
    <h2  class="pull-left"><?php _e("PayOut",ST_TEXTDOMAIN) ?></h2>
</div>
<div class="msg">
    <?php echo STTemplate::message() ?>
    <?php echo STWithdrawal::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <?php wp_nonce_field('user_setting','st_partner_withdrawal'); ?>
    <input type="hidden" name="st_is_partner_withdrawal" value="true">
    <div class="row st_partner_payout_item text-center">
        <?php $st_partner_payout =  STInput::request('st_partner_payout',get_user_meta($current_user->ID , 'st_partner_payout' , true)) ?>
        <div class="col-md-4">
            <div class="item-pay <?php if($st_partner_payout =='bank_transfer') echo "active";  ?>">
                <img alt="<?php echo TravelHelper::get_alt_image(); ?>" src="<?php echo ST_TRAVELER_URI.'/img/user/banktransfer.png' ?>" class="img-thumbnail st_payout" />
            </div>
            <input class="i-radio st_partner_payout" type="radio" name="st_partner_payout" value="bank_transfer" <?php if($st_partner_payout =='bank_transfer') echo "checked";  ?> />
        </div>
        <div class="col-md-4">
            <div class="item-pay <?php if($st_partner_payout =='paypal') echo "active";  ?>">
                <img alt="<?php echo TravelHelper::get_alt_image(); ?>" src="<?php echo ST_TRAVELER_URI.'/img/user/paypal_logo.jpg' ?>" class="img-thumbnail active st_payout" />
            </div>
            <input class="i-radio st_partner_payout" type="radio" name="st_partner_payout" value="paypal"  <?php if($st_partner_payout =='paypal') echo "checked";  ?> />
        </div>
        <div class="col-md-4">
            <div class="item-pay <?php if($st_partner_payout =='stripe') echo "active";  ?>">
                <img alt="<?php echo TravelHelper::get_alt_image(); ?>" src="<?php echo get_template_directory_uri().'/img/user/stripe_logo.jpg' ?>" class="img-thumbnail st_payout" />
            </div>
            <input class="i-radio st_partner_payout" type="radio" name="st_partner_payout" value="stripe" <?php if($st_partner_payout =='stripe') echo "checked";  ?> />
        </div>
    </div>
    <div class="row item st_partner_payout_item control">
        <div class="col-md-8">
            <div class='form-group form-group-icon-left'>
                <?php $price_min = st()->get_option('partner_withdrawal_payout_price_min',0); ?>
                <label><?php _e("Amount",ST_TEXTDOMAIN) ?>:</label>
                <i class="fa fa-money input-icon input-icon-hightlight"></i>
                <input  name="st_partner_price" type="number"  placeholder="<?php _e("Amount",ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo STInput::request('st_partner_price',$price_min) ?>">

                <i><?php _e("Minimum value :",ST_TEXTDOMAIN); echo TravelHelper::format_money($price_min) ?></i>
            </div>
        </div>
    </div>
    <div class="row st_partner_payout_item_paypal item st_partner_payout_item">
        <div class="col-md-8">
            <div class='form-group form-group-icon-left'>
                <label><?php _e("Paypal Email",ST_TEXTDOMAIN) ?> (<span class="color-red">*</span>):</label>
                <i class="fa fa-envelope-o input-icon input-icon-hightlight"></i>
                <input  name="st_partner_paypal_email" type="text"  placeholder="<?php _e("Paypal Email",ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo STInput::request('st_partner_paypal_email',get_user_meta($current_user->ID , 'st_partner_paypal_email' , true)) ?>">
            </div>
        </div>
        <div class="col-md-8">
            <div class='form-group form-group-icon-left'>
                <label><?php _e("Confirm Paypal Email",ST_TEXTDOMAIN) ?> (<span class="color-red">*</span>):</label>
                <i class="fa fa-envelope-o input-icon input-icon-hightlight"></i>
                <input  name="st_partner_confirm_paypal_email" type="text"  placeholder="<?php _e("Confirm Paypal Email",ST_TEXTDOMAIN) ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row st_partner_payout_item_stripe item st_partner_payout_item">
        <div class="col-md-8">
            <div class='form-group form-group-icon-left'>
                <label><?php _e("Secret Key",ST_TEXTDOMAIN) ?> (<span class="color-red">*</span>):</label>
                <i class="fa fa-cc-stripe input-icon input-icon-hightlight"></i>
                <input  name="st_partner_stripe_key" type="text"  placeholder="<?php _e("Secret Key",ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo STInput::request('st_partner_stripe_key',get_user_meta($current_user->ID , 'st_partner_stripe_key' , true)) ?>">
            </div>
        </div>
    </div>
    <div class="row st_partner_payout_item_bank_transfer item st_partner_payout_item">
        <div class="col-md-8">
            <div class='form-group form-group-icon-left'>
                <label><?php _e("Bank Infomation",ST_TEXTDOMAIN) ?> (<span class="color-red">*</span>):</label>
                <textarea name="st_partner_bank_transfer_info" class="form-control"><?php echo STInput::request('st_partner_bank_transfer_info',get_user_meta($current_user->ID , 'st_partner_bank_transfer_info' , true)) ?></textarea>
                <div class="text-muted"><em><?php echo _e('(Bank name, Bank account, Swift code, ...)', ST_TEXTDOMAIN); ?></em></div>
            </div>
        </div>
    </div>
    <div class="row item st_partner_payout_item control">
        <div class="col-md-8">
            <input type="submit" class="btn btn-primary" value="<?php _e("Submit",ST_TEXTDOMAIN) ?>">
        </div>
    </div>
</form>