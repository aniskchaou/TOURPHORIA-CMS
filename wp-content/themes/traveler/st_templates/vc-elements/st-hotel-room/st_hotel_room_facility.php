<div class="room-facility about_listing">
	<h3 class="booking-item-title"><?php echo __('About This Listing', ST_TEXTDOMAIN); ?></h3>
	<?php 
		$adult_number = intval(get_post_meta(get_the_ID(), 'adult_number', true));
		$children_number = intval(get_post_meta(get_the_ID(), 'children_number', true));
		$bed_number = intval(get_post_meta(get_the_ID(), 'bed_number', true));
		$room_footage = intval(get_post_meta(get_the_ID(), 'room_footage', true));
		$html_price = get_post_meta(get_the_ID(), 'price', true);
		$discount = get_post_meta(get_the_ID(), 'discount_rate', true);
		if ($is_sale = get_post_meta(get_the_ID(), 'is_sale_schedule' , true) =="on"){
			$sale_price_from = get_post_meta(get_the_ID(), 'sale_price_from', true);
			$sale_price_to = get_post_meta(get_the_ID(), 'sale_price_to', true);
		}

		$room_parent = intval(get_post_meta(get_the_ID(), 'room_parent', true));
		$check_in_time = get_post_meta($room_parent, 'check_in_time', true);
		$check_out_time = get_post_meta($room_parent, 'check_out_time', true);
	?>
	<div class="row list-facility">
		<div class="col-xs-12 item">
			<div class="row">
				<div class="col-xs-5 col-sm-3">
					<strong><?php echo __('Check in/out time', ST_TEXTDOMAIN); ?></strong>
				</div>
				<div class="col-xs-7 col-sm-9">
					<div class="row">
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Check In time', ST_TEXTDOMAIN) ?>: <strong><?php if($check_in_time) echo esc_html($check_in_time); ?></strong></span>
						</div>
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Check Out time', ST_TEXTDOMAIN) ?>: <strong><?php if($check_out_time) echo esc_html($check_out_time); ?></strong></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 item">
			<div class="row">
				<div class="col-xs-5 col-sm-3">
					<strong><?php echo __('The Space', ST_TEXTDOMAIN); ?></strong>
				</div>
				<div class="col-xs-7 col-sm-9">
					<div class="row">
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Adult number', ST_TEXTDOMAIN) ?>: <strong><?php echo esc_html($adult_number); ?></strong></span>
						</div>
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Bed number', ST_TEXTDOMAIN) ?>: <strong><?php echo esc_html($bed_number); ?></strong></span>
						</div> 
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Children number', ST_TEXTDOMAIN) ?>: <strong><?php echo esc_html($children_number); ?></strong></span>
						</div>
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Room Footage', ST_TEXTDOMAIN) ?>: <strong><?php echo esc_html($room_footage); ?></strong></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 item">
			<div class="row">
				<div class="col-xs-5 col-sm-3">
					<strong><?php echo __('Prices', ST_TEXTDOMAIN); ?></strong>
				</div>
				<div class="col-xs-7 col-sm-9">
					<div class="row">
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Price', ST_TEXTDOMAIN) ?>: <strong><?php echo TravelHelper::format_money($html_price)?></strong></span>
						</div>
						<?php  if(!empty($sale_price_from)): ?>
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Sale price from', ST_TEXTDOMAIN) ?>: <strong><?php echo date_i18n(TravelHelper::getDateFormat(),strtotime($sale_price_from)); ?></strong></span>
						</div>
						<?php endif; ?>
						<?php if(!empty($sale_price_to)): ?>
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Sale price to', ST_TEXTDOMAIN) ?>: <strong><?php  echo date_i18n(TravelHelper::getDateFormat(),strtotime($sale_price_to)); ?></strong></span>
						</div>
						<?php endif; ?>
                        <?php
                        $deposit_type = get_post_meta( get_the_ID(), 'deposit_payment_status', true );
                        $deposit = '';
                        switch ( $deposit_type ) {
                            case 'percent':
                                $deposit = (float) get_post_meta(get_the_ID(), 'deposit_payment_amount', true) . ' % ';
                                break;
                            default:
                                $deposit = '';
                                break;
                        }
                        ?>
						<?php if(!empty($discount) || !empty( $deposit ) ): ?>
						<div class="col-xs-12 col-sm-6 sub-item">
                            <?php if( !empty( $discount ) ): ?>
							<span><?php echo __('Discount', ST_TEXTDOMAIN) ?>: <strong><?php echo esc_html($discount); ?> </strong> %</span>
                            <?php endif; ?>
							<?php if( !empty( $deposit ) ): ?>
							<div class="clearfix">
								<p>
									<span><?php echo __('Deposit', ST_TEXTDOMAIN) ?>: <strong><?php echo esc_html($deposit); ?></strong></span>
								</p>
							</div>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php 
			$discount_by_day = get_post_meta( get_the_ID(), 'discount_by_day', true);
			$discount_type = get_post_meta( get_the_ID(), 'discount_type_no_day', true);
			if( !$discount_type || $discount_type == 'percent' ) 
				$discount_type = '%';
			else $discount_type = TravelHelper::get_current_currency('symbol');
			if( !empty( $discount_by_day ) ):
		?>
		<div class="col-xs-12 item">
			<div class="row">
				<div class="col-xs-12 col-sm-3">
					<strong><?php echo __('Discount by day', ST_TEXTDOMAIN) ?></strong>
				</div>
				<div class="col-xs-12 col-sm-9">
					<table class="table">
						<tr>
							<th>#</th>
							<th><?php echo __('Package', ST_TEXTDOMAIN); ?></th>
							<th><?php echo __('No. day (s)', ST_TEXTDOMAIN); ?></th>
							<th><?php echo __('Discount',ST_TEXTDOMAIN); ?> <?php if( $discount_type ) echo '( '. $discount_type . ' )'; ?></th>
						</tr>
						<?php $i = 1; foreach( $discount_by_day as $item ): ?>
						<tr>
							<td><?php echo esc_html($i); ?></td>
							<td><?php echo esc_html($item['title']); ?></td>
							<td><?php echo esc_html($item['number_day']); ?></td>
							<td><?php echo esc_html($item['discount']); ?></td>
						</tr>
						<?php $i++; endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php
			if(is_array($args) && count($args)){
				extract($args);
			}
			if(!empty($choose_taxonomies)){
				$choose_taxonomies = explode(',', $choose_taxonomies);
			}
			if(is_array($choose_taxonomies) && count($choose_taxonomies)):
				foreach($choose_taxonomies as $terms):
					$tax = get_taxonomy($terms);
					$term = get_the_terms(get_the_ID(), $terms);
					if(is_array($term) && count($term)):
		?>
		<div class="col-xs-12 item">
			<div class="row">
				<div class="col-xs-5 col-sm-3">
					<strong><?php echo esc_html($tax->labels->name); ?></strong>
				</div>
				<div class="col-xs-7 col-sm-9">
					<div class="row">
						<?php 
							if($term):
								foreach($term as $key => $val):
						?>
						<div class="col-xs-12 col-sm-6 sub-item">
							
							<span>
								<?php if (function_exists('get_tax_meta') and $icon = get_tax_meta($val->term_id, 'st_icon')): ?>
                                <i class="<?php echo TravelHelper::handle_icon($icon) ?> mr10"></i>
                            	<?php endif; ?>

                                <?php echo esc_html( $val->name) ?>
                        	</span>
						</div>

						<?php endforeach; endif;?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; endforeach; endif; ?>
		<?php 
			$other_facility = get_post_meta(get_the_ID(),'add_new_facility', true); 
			if(is_array($other_facility) && count($other_facility)):
		?>
		<div class="col-xs-12 item">
			<div class="row">
				<div class="col-xs-5 col-sm-3">
					<strong><?php echo __('Other', ST_TEXTDOMAIN); ?></strong>
				</div>
				<div class="col-xs-7 col-sm-9">
					<div class="row">
						<?php 
							$other_facility = get_post_meta(get_the_ID(),'add_new_facility', true);
							foreach($other_facility as $item):
						?>
						<div class="col-xs-12 col-sm-6 sub-item">
							
							<span><?php if(!empty($item['facility_icon'])): ?><i class="<?php echo TravelHelper::handle_icon($item['facility_icon']); ?> mr10"></i><?php endif; ?><?php echo esc_html($item['title']); ?>: <strong><?php echo esc_html($item['facility_value']); ?></strong></span>
						</div>

						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
		<?php  endif; ?>

        <?php
        //Cancel policy
        //$other_facility = get_post_meta(get_the_ID(),'add_new_facility', true);
        $cancel_policy = get_post_meta(get_the_ID(),'st_allow_cancel', true);
        if($cancel_policy == 'on'):
            ?>
            <div class="col-xs-12 item">
                <div class="row">
                    <div class="col-xs-5 col-sm-3">
                        <strong><?php echo __('Cancellation', ST_TEXTDOMAIN); ?></strong>
                    </div>
                    <div class="col-xs-7 col-sm-9">
                        <p><?php
                            $cancel_policy_day = get_post_meta(get_the_ID(),'st_cancel_number_days', true);
                            $cancel_policy_amount = get_post_meta(get_the_ID(),'st_cancel_percent', true);
                            echo sprintf(__('Cancellation within %s Day(s) before the date of arrival %s%s will be charged.', ST_TEXTDOMAIN), $cancel_policy_day, $cancel_policy_amount, '%');
                            ?></p>
                    </div>
                </div>
            </div>
        <?php  endif; ?>

		<?php 
			$room_description = get_post_meta(get_the_ID(),'room_description', true);
			if(!empty($room_description)):
		?>
		<div class="col-xs-12 item">
			<div class="row">
				<div class="col-xs-5 col-sm-3">
					<strong><?php echo __('Description', ST_TEXTDOMAIN); ?></strong>
				</div>
				<div class="col-xs-7 col-sm-9">
					<div class="row">
						<div class="col-xs-12 sub-item">
							<div class="text-justify">
								<div id="show-description">
									<?php echo TravelHelper::substr($room_description, 100); ?>
								</div>
								<a class="button-readmore text-color" href="javascript:;"><?php echo __('Read more', ST_TEXTDOMAIN); ?></a>
								<div id="read-more" class="hidden">
									<?php echo balanceTags($room_description); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php  endif; ?>
	</div>
</div>