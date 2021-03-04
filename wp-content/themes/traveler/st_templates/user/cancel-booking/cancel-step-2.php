<?php 
/**
*@since 1.2.8
*	Cancel booking step 1 - Get order infomation and confirm
**/
if( !isset( $order_id ) ):
?>
<div class="text-danger">
	<?php echo __('Can not get data. Try again!', ST_TEXTDOMAIN); ?>
</div>
<?php else: ?>
<div class="alert alert-info mt20" role="alert">
	<div class=""><strong><?php echo __('Select your account that admin can refund for you:', ST_TEXTDOMAIN); ?></strong></div>
	<div class="text-danger" style="font-size: 12px;"><em>(<?php echo __('You need to enter all fields required', ST_TEXTDOMAIN); ?>)</em></div>
	<form action="" class="form mt10" method="post">
		<div class="form-group">
			<label for="">
				<input type="radio" name="select_account" value="your_bank" class="required">
				<span><?php echo __('Your bank account', ST_TEXTDOMAIN); ?></span>
			</label>
		</div>
		<div class="form-group">
			<label for="">
				<input type="radio" name="select_account" value="your_paypal" class="required">
				<span><?php echo __('Your paypal account', ST_TEXTDOMAIN); ?></span>
			</label>
		</div>
		<div class="form-group">
			<label for="">
				<input type="radio" name="select_account" value="your_stripe" class="required">
				<span><?php echo __('Your stripe transaction ID', ST_TEXTDOMAIN); ?></span>
			</label>
		</div>
		<div class="form-group">
			<label for="">
				<input type="radio" name="select_account" value="your_payfast" class="required">
				<span><?php echo __('Your payfast transaction ID', ST_TEXTDOMAIN); ?></span>
			</label>
		</div>
		<div class="form-get-account-inner">
			
		</div>
	</form>
</div>
<div class="hidden form-get-account">
	<div data-value="your_bank">
		<div class="form-group">
			<label for=""><?php echo __('Account Name: ', ST_TEXTDOMAIN) ?><span class="text-danger">(*)</span></label>
			<input type="text" class="form-control required" name="account_name" value="" required="required">

			<label for=""><?php echo __('Account Number: ', ST_TEXTDOMAIN) ?><span class="text-danger">(*)</span></label>
			<input type="text" class="form-control required" name="account_number" value="" required="required">

			<label for=""><?php echo __('Bank Name: ', ST_TEXTDOMAIN) ?><span class="text-danger">(*)</span></label>
			<input type="text" class="form-control required" name="bank_name" value="" required="required">

			<label for=""><?php echo __('Swift Code: ', ST_TEXTDOMAIN) ?><span class="text-danger">(*)</span></label>
			<input type="text" class="form-control required" name="swift_code" value="" required="required">
		</div>
	</div>
	<div data-value="your_paypal">
		<div class="form-group">
			<label for=""><?php echo __('Paypal email: ', ST_TEXTDOMAIN) ?><span class="text-danger">(*)</span></label>
			<input type="text" class="form-control required" name="paypal_email" value="" required="required">
			<i><?php esc_html_e("We will pay you in your purchase account.",STP_TEXTDOMAIN) ?></i>
		</div>
	</div>
	<div data-value="your_stripe">
		<div class="form-group">
			<label for=""><?php echo __('Transaction ID: ', ST_TEXTDOMAIN) ?><span class="text-danger">(*)</span></label>
			<input type="text" class="form-control required" name="transaction_id" value="" required="required">
		</div>
	</div>
	<div data-value="your_payfast">
		<div class="form-group">
			<label for=""><?php echo __('Transaction ID: ', ST_TEXTDOMAIN) ?><span class="text-danger">(*)</span></label>
			<input type="text" class="form-control required" name="transaction_id" value="" required="required">
		</div>
	</div>
</div>
<?php endif; ?>