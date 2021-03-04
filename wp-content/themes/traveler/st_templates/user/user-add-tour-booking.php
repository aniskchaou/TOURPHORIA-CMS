<?php 
/**
*@since 1.1.9
* use for Booking Tour
**/
wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' ); 
wp_enqueue_script( 'st-qtip' );

?>
<div class="st-create">
    <h2><?php _e("Add New Tour Booking",ST_TEXTDOMAIN) ?></h2>
</div>
<form action="" method="post" id="form-add-booking-partner" class="form-add-booking-partner <?php echo STUser_f::get_status_msg(); ?>">
	<?php wp_nonce_field('add_booking_partner','add_booking_partner_field'); ?>
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
    		<div class="panel-heading" role="tab" id="headingOne">
      			<h2 class="panel-title">
        			<a style="font-size: 22px; font-weight: 400;"  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          				<?php echo __('Customer Information', ST_TEXTDOMAIN); ?>
        			</a>
      			</h2>
    		</div>
    		<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      			<div class="panel-body">
      				<div class="form-group form-group-icon-left">
				        
				        <label for="id_user" class="head_bol"><?php _e("Booker ID",ST_TEXTDOMAIN) ?>:</label>
				        <?php 
				        	$id_user='';
				            $pl_name='';
				        	$id_user = get_current_user_id();
				            if($id_user){
				                $user = get_userdata($id_user);
				                if($user){
				                    $pl_name = $user->ID.' - '.$user->user_email;
				                }
				            }
				        ?>
				        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
				        <input id="id_user" name="id_user" type="text" readonly="readonly" class="form-control" value="<?php echo $pl_name; ?>">
				    </div>
				    <div class="row">
				    	<div class="col-xs-12 col-sm-6">
				    		<div class="form-group form-group-icon-left">
						    	
						        <label for="st_first_name" class="head_bol"><?php _e('Customer First Name', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
						        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
						        <input id="st_first_name" name="st_first_name" type="text" class="form-control" value="<?php if(isset($_POST['st_first_name'])) echo $_POST['st_first_name']; ?>">
						    </div>
				    	</div>
				    	<div class="col-xs-12 col-sm-6">
				    		<div class="form-group form-group-icon-left">
						    	
						        <label for="st_last_name" class="head_bol"><?php _e('Customer Last Name', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
						        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
						        <input id="st_last_name" name="st_last_name" type="text" class="form-control" value="<?php if(isset($_POST['st_last_name'])) echo $_POST['st_last_name']; ?>">
						    </div>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="col-xs-12 col-sm-6">
				    		<div class="form-group form-group-icon-left">
						    	
						        <label for="st_email" class="head_bol"><?php _e('Customer Email', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
						        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
						        <input id="st_email" name="st_email" type="text" class="form-control" value="<?php if(isset($_POST['st_email'])) echo $_POST['st_email']; ?>">
						    </div>
				    	</div>
				    	<div class="col-xs-12 col-sm-6">
				    		<div class="form-group form-group-icon-left">
						    	
						        <label  for="st_phone" class="head_bol"><?php _e('Customer Phone', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
						        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
						        <input id="st_phone" name="st_phone" type="text" class="form-control" value="<?php if(isset($_POST['st_phone'])) echo $_POST['st_phone']; ?>">
						    </div>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="col-xs-12 col-sm-6">
				    		<div class="form-group form-group-icon-left">
						    	
						        <label for="st_address" class="head_bol"><?php _e('Customer Address', ST_TEXTDOMAIN); ?>:</label>
						        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
						        <input id="st_address" name="st_address" type="text" class="form-control" value="<?php if(isset($_POST['st_address'])) echo $_POST['st_address']; ?>">
						    </div>
				    	</div>
				    	<div class="col-xs-12 col-sm-6">
				    		<div class="form-group form-group-icon-left">
						    	
						        <label for="st_address2" class="head_bol"><?php _e('Customer Address 2', ST_TEXTDOMAIN); ?>:</label>
						        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
						        <input id="st_address2" name="st_address2" type="text" class="form-control" value="<?php if(isset($_POST['st_address2'])) echo $_POST['st_address2']; ?>">
						    </div>
				    	</div>
				    </div>
				    <div class="row">
				    	<div class="col-xs-12 col-sm-4">
				    		<div class="form-group form-group-icon-left">
						    	
						        <label for="st_city" class="head_bol"><?php _e('Customer City', ST_TEXTDOMAIN); ?>:</label>
						        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
						        <input id="st_city" name="st_city" type="text" class="form-control" value="<?php if(isset($_POST['st_city'])) echo $_POST['st_city']; ?>">
						    </div>
				    	</div>
				    	<div class="col-xs-12 col-sm-4">
				    		<div class="form-group form-group-icon-left">
						    	
						        <label for="st_province" class="head_bol"><?php _e('State/Province/Region', ST_TEXTDOMAIN); ?>:</label>
						        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
						        <input id="st_province" name="st_province" type="text" class="form-control" value="<?php if(isset($_POST['st_province'])) echo $_POST['st_province']; ?>">
						    </div>
				    	</div>
				    	<div class="col-xs-12 col-sm-4">
				    		<div class="form-group form-group-icon-left">
						    	
						        <label for="st_country" class="head_bol"><?php _e('ZIP code/Postal code', ST_TEXTDOMAIN); ?>:</label>
						        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
						        <input id="st_country" name="st_country" type="text" class="form-control" value="<?php if(isset($_POST['st_country'])) echo $_POST['st_country']; ?>">
						    </div>
				    	</div>
				    </div>
      			</div>
      		</div>
      	</div>	
      	<div class="panel panel-default">
    		<div class="panel-heading" role="tab" id="headingTwo">
      			<h2 class="panel-title">
        			<a style="font-size: 22px; font-weight: 400;"  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          				<?php echo __('Booking Information', ST_TEXTDOMAIN); ?>
        			</a>
      			</h2>
    		</div>
    		<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
    			<div id="overlay">
    				<div class="spinner user_img_loading loaded">
				        <div class="bounce1"></div>
				        <div class="bounce2"></div>
				        <div class="bounce3"></div>
				    </div>
    			</div>
      			<div class="panel-body">
	      			<div class="row">
	      				<div class="col-xs-12">
	      					<div class="form-group">
						        <label for="tour_id" class="head_bol"><?php _e('Tour', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
						        <?php 
			                        $tour_id = isset($_POST['item_id']) ? $_POST['item_id'] : '';
			                        $tour_name = (intval($tour_id) > 0) ? get_the_title($tour_id) : ""; 
			                        
			                    ?>
			                    <input id="tour_id" type="hidden" name="item_id" value="<?php echo $tour_id; ?>" data-post-type="st_tours" class="form-control custom-form-control st_post_select_ajax " data-pl-name="<?php echo $tour_name; ?>" data-user-id="<?php echo get_current_user_id(); ?>">
		      				</div>
	      				</div>
	      			</div>
	      			<div class="row">
	      				<div class="col-xs-12 col-sm-6">
	      					<div class="form-group">
	      						<label for="type-tour-wrapper" class="head_bol"><?php _e('Type tour', ST_TEXTDOMAIN); ?>:</label>
	      						<div id="type-tour-wrapper"></div>
	      					</div>
	      				</div>
	      				<div class="col-xs-12 col-sm-6">
	      					<div class="form-group">
	      						<label for="max_people" class="head_bol"><?php _e('Max people', ST_TEXTDOMAIN); ?>:</label>
	      						<input type="text" readonly="readonly" name="max_people" value="" id="max_people" class="form-control">
	      					</div>
	      				</div>
	      			</div>
	      			<div class="row">
	      				<div class="col-xs-6 col-sm-3">
	      					<div class="form-group">
	      						<a href="#" class="btn btn-primary" id="tour_time" data-toggle="modal" data-target="#calendar_tour_modal"><?php echo __('Select a day', ST_TEXTDOMAIN); ?></a>
	      					</div>
	      				</div>
	      			</div>
      				<div class="row">
      					<div class="col-xs-12 col-sm-4">
      						<div class="form-group">
		      					<label for="adult_price" class="head_bol"><?php _e('Adult Price', ST_TEXTDOMAIN); ?>:</label>
		      					<input id="adult_price" readonly type="text" name="adult_price" value="" class="form-control">
		      				</div>
      					</div>
      					<div class="col-xs-12 col-sm-4">
      						<div class="form-group">
		      					<label for="child_price" class="head_bol"><?php _e('Children Price', ST_TEXTDOMAIN); ?>:</label>
		      					<input id="child_price" readonly type="text" name="child_price" value="" class="form-control">
		      				</div>
      					</div>
      					<div class="col-xs-12 col-sm-4">
      						<div class="form-group">
		      					<label for="infant_price" class="head_bol"><?php _e('Infant Price', ST_TEXTDOMAIN); ?>:</label>
		      					<input id="infant_price" readonly type="text" name="infant_price" value="" class="form-control">
		      				</div>
      					</div>
      				</div>

      				<div class="row">
      					<div class="col-xs-12 col-sm-4">
      						<div class="form-group">
		      					<label for="adult_number" class="head_bol"><?php _e('No. Adults', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
		      					<div id="adult-wrapper">
	      						<?php 
		      						$adult_number = isset($_POST['adult_number']) ? intval($_POST['adult_number']) : 1;
		      					?>
		      						<select name="adult_number" class="form-control" style="width: 100px;">
		      						<?php for($i = 1; $i <= $adult_number; $i++): ?>
		      							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		      						<?php endfor; ?>
		      						</select>
		      					</div>
		      				</div>
      					</div>
      					<div class="col-xs-12 col-sm-4">
      						<div class="form-group">
		      					<label for="child_number" class="head_bol"><?php _e('No. Children', ST_TEXTDOMAIN); ?>:</label>
		      					<div id="child-wrapper">
	      						<?php 
		      						$child_number = isset($_POST['child_number']) ? intval($_POST['child_number']) : 0;
		      					?>
		      						<select name="child_number" class="form-control" style="width: 100px;">
		      						<?php for($i = 0; $i <= $child_number; $i++): ?>
		      							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		      						<?php endfor; ?>
		      						</select>
		      					</div>
		      				</div>
      					</div>
      					<div class="col-xs-12 col-sm-4">
      						<div class="form-group">
		      					<label  for="infant_number" class="head_bol"><?php _e('No. Infant', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
		      					<div id="infant-wrapper">
	      						<?php 
		      						$infant_number = isset($_POST['infant_number']) ? intval($_POST['infant_number']) : 0;
		      					?>
		      						<select name="infant_number" class="form-control" style="width: 100px;">
		      						<?php for($i = 0; $i <= $infant_number; $i++): ?>
		      							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		      						<?php endfor; ?>
		      						</select>
		      					</div>
		      				</div>
      					</div>
      				</div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="check_in_tour" class="head_bol"><?php _e('Departure date', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
                                <?php
                                $check_in = isset($_POST['check_in']) ? $_POST['check_in'] : '';
                                ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-checkin"><i class="fa fa-calendar"></i></span>
                                    <input readonly data-date-format="<?php echo TravelHelper::getDateFormatJs() ?>" aria-describedby="basic-checkin" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" autocomplete="off" type="text" name="check_in" id="check_in_tour" value="<?php echo $check_in; ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="extra-price-wrapper"  class="head_bol"><?php _e('Extra', ST_TEXTDOMAIN); ?>:</label>
                                <div id="extra-price-wrapper">

                                </div>
                            </div>
                        </div>

      					<div class="col-xs-12 col-sm-6">
      						<div class="form-group">
		      					<label for="check_out_tour" class="head_bol"><?php _e('Return date', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
		      					<?php 
		      						$check_out = isset($_POST['check_out']) ? $_POST['check_out'] : '';
		      					?>
		      					<div class="input-group">
			      					<span class="input-group-addon" id="basic-checkout"><i class="fa fa-calendar"></i></span>
								  	<input data-date-format="<?php echo TravelHelper::getDateFormatJs() ?>" readonly aria-describedby="basic-checkout" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" autocomplete="off" type="text" name="check_out" id="check_out_tour" value="<?php echo $check_out; ?>" class="form-control">
							  	</div>
		      				</div>
      					</div>
      				</div>
      				<div class="form-group">
      					<input type="hidden" name="action" value="booking_form_submit">
      					<input type="hidden" name="booking_by" value="partner">
      					<input type="hidden" name="sc" value="<?php echo get_query_var('sc'); ?>">
      					<input type="hidden" name="st_payment_gateway" value="st_submit_form"/>
      					<input value="1" name="term_condition" type="hidden"/>
      					<input type="hidden" name="allow_capcha" value="on">
					    <input type="hidden" name="security" value="<?php echo wp_create_nonce( 'travel_order' ) ?>">
					    <input name='st_payment_gateway_st_submit_form'  class="st_payment_gatewaw_submit" type="hidden" value="<?php st_the_language('submit_request')?>">    
      				</div>
      				<div class="form-group">
      					<a href="#" id="partner-booking-button" class="btn btn-primary"><?php echo __('Book Now',ST_TEXTDOMAIN); ?></a>
      				</div>
      				<div class="form-group">
      					<div class="alert form_alert hidden"></div>
      				</div>
      			</div>
      		</div>
      	</div>			
	</div>
</form>
<div id="tour_time_content" style="padding:15px; display: none">
    <div class="row calendar-wrapper calendar-wrapper-inner">
        <div class="col-xs-12">
        	<div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
            <div class="calendar-content">
                
            </div>
        </div>
    </div>
</div>