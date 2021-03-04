<?php 
/**
*@since 1.2.8
*	success bank
**/
?>
<i class="fa fa-check round box-icon-large box-icon-center box-icon-success mb30"></i>
<h4 class="text-center"><?php echo __('You had sent successful refund request to us.', ST_TEXTDOMAIN); ?></h4>
<p class="text-center"><?php echo __('Please wait for confirmation from our billing team!', ST_TEXTDOMAIN); ?></p>

<div class="alert alert-info mt20" role="alert">
	<p><strong><?php echo __('Admin will give a refund for you with your account:', ST_TEXTDOMAIN); ?></strong></p>
	<p class="mt20"><strong><?php echo __('Account Name: ') ?></strong> <em><?php echo $cancel_data['your_bank']['account_name']; ?></em></p>
	<p class="mt10"><strong><?php echo __('Account Number: ') ?></strong> <em><?php echo $cancel_data['your_bank']['account_number']; ?></em></p>
	<p class="mt10"><strong><?php echo __('Bank Name: ') ?></strong> <em><?php echo $cancel_data['your_bank']['bank_name']; ?></em></p>
	<p class="mt10"><strong><?php echo __('Swift Code: ') ?></strong> <em><?php echo $cancel_data['your_bank']['swift_code']; ?></em></p>
	<p class="mt10"><strong><?php echo __('Amount: ') ?></strong> <em><?php echo TravelHelper::format_money_raw( $cancel_data['refunded'], $cancel_data['currency'] ); ?></em></p>
</div>
