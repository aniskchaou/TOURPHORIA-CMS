<?php 
/**
*@since 1.2.8
*	success paypal
**/
?>
<i class="fa fa-check round box-icon-large box-icon-center box-icon-success mb30"></i>
<h4 class="text-center"><?php echo __('You had sent successful refund request to us.', ST_TEXTDOMAIN); ?></h4>
<p class="text-center"><?php echo __('Please wait for confirmation from our billing team!', ST_TEXTDOMAIN); ?></p>
<div class="alert alert-info mt20" role="alert">
	<p><strong><?php echo __('Admin will give a refund for you with your account:', ST_TEXTDOMAIN); ?></strong></p>
	<p class="mt20"><strong><?php echo __('Your paypal email: ') ?></strong> <em><?php echo $cancel_data['your_paypal']['paypal_email']; ?></em></p>
	<p class="mt10"><strong><?php echo __('Amount: ') ?></strong> <em><?php echo TravelHelper::format_money_raw( $cancel_data['refunded'], $cancel_data['currency'] ); ?></em></p>
	<!-- <p class="mt20"><strong><?php echo __('Description: ') ?></strong> <em><?php echo $cancel_data['detail']; ?></em></p> -->
</div>