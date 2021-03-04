<?php
/**
 * Created by PhpStorm.
 * User: Dungdt
 * Date: 1/12/2016
 * Time: 3:29 PM
 */

$post_id = STInput::request('id');
?>
<?php if(empty($hide_tab)){?>
<div class="tab-pane fade" id="tab-cancel-booking">
<?php }?>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="st_allow_cancel"><?php _e("Allow Cancel",ST_TEXTDOMAIN) ?>:</label>
				<select id="st_allow_cancel" name="st_allow_cancel" class="form-control">
					<option value="off"><?php _e('No',ST_TEXTDOMAIN) ?></option>
					<option value="on" <?php selected(STInput::post('st_allow_cancel',get_post_meta($post_id,'st_allow_cancel',true)),'on') ?>><?php _e('Yes',ST_TEXTDOMAIN) ?></option>
				</select>
				<div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_allow_cancel'),'danger') ?></div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="st_cancel_number_days"><?php _e("Number of days before the arrival",ST_TEXTDOMAIN) ?>:</label>
				<input type="text" id="st_cancel_number_days" class="form-control" name="st_cancel_number_days" value="<?php echo STInput::post('st_cancel_number_days',get_post_meta($post_id,'st_cancel_number_days',true))?>">
				<div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_cancel_number_days'),'danger') ?></div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="st_cancel_percent"><?php _e("Percent of total price",ST_TEXTDOMAIN) ?>:</label>
				<input type="text" id="st_cancel_percent" class="form-control" name="st_cancel_percent" value="<?php echo STInput::post('st_cancel_percent',get_post_meta($post_id,'st_cancel_percent',true)) ?>">
                <?php $partner_commission = st()->get_option('partner_commission','0'); ?>
                <i><?php echo sprintf(esc_html__("Your percentage should be more than the commission percentage of the admin. The commission percentage of the admin is %s",ST_TEXTDOMAIN),$partner_commission."%") ?></i>
				<div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_cancel_percent'),'danger') ?></div>
			</div>
		</div>
	</div>

<?php if(empty($hide_tab)){?>

    </div>
<?php }?>

