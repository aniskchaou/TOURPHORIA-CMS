<?php 
/**
*@since 1.1.9
* use for Booking Car
**/
wp_enqueue_script('bootstrap-datepicker.js' );
wp_enqueue_script( 'bootstrap-timepicker.js' );
?>
<div class="st-create">
    <h2><?php _e("Add New Car Booking",ST_TEXTDOMAIN) ?></h2>
</div>
<form action="" method="post" id="form-add-booking-partner" class="form-add-booking-partner <?php echo STUser_f::get_status_msg(); ?>  main-search">
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
				        <label class="head_bol"><?php _e("Booker ID",ST_TEXTDOMAIN) ?>:</label>
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
						    	
						        <label for="st_phone" class="head_bol"><?php _e('Customer Phone', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
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
						        <label for="car_id" class="head_bol"><?php _e('Car', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
						        <?php 
			                        $car_id = isset($_POST['item_id']) ? $_POST['item_id'] : '';
			                        $car_name = (intval($car_id) > 0) ? get_the_title($car_id) : ""; 
			                        
			                    ?>
			                    <input id="car_id" type="hidden" name="item_id" value="<?php echo $car_id; ?>" data-post-type="st_cars" class="form-control custom-form-control st_post_select_ajax " data-pl-name="<?php echo $car_name; ?>" data-user-id="<?php echo get_current_user_id(); ?>">
		      				</div>
	      				</div>
	      			</div>
      				<div class="row">
      					<div class="col-xs-12 col-sm-3">
      						<div class="form-group">
		      					<label  for="item_price" class="head_bol"><?php _e('Price', ST_TEXTDOMAIN); ?>:</label>
		      					<input id="item_price" readonly type="text" name="price" value="" class="form-control">
		      				</div>
      					</div>
      					<div class="col-xs-12 col-sm-6">
      						<div class="form-group">
		      					<label  for="selected_equipments" class="head_bol"><?php _e('Equipments', ST_TEXTDOMAIN); ?>:</label>
		      					<div id="equipments-price-wrapper">
		      						
		      					</div>
		      					<input type="hidden" name="selected_equipments" id="selected_equipments" value="">
		      				</div>
      					</div>
      				</div>
      				<div class="row">
                        <!-- <div class="col-xs-12 col-sm-12">
                            <?php
                            $st_google_location_pickup = STInput::request('st_google_location_pickup', '');
                            $st_locality_up = STInput::request('st_locality_up', '');
                            $st_sublocality_level_1_up = STInput::request('st_sub_up', '');
                            $st_administrative_area_level_1_up = STInput::request('st_admin_area_up', '');
                            $st_country_up = STInput::request('st_country_up', '');
                        
                            $st_google_location_dropoff = STInput::request('st_google_location_dropoff', '');
                            $st_locality_off = STInput::request('st_locality_off', '');
                            $st_sublocality_level_1_off = STInput::request('st_sub_off', '');
                            $st_administrative_area_level_1_off = STInput::request('st_admin_area_off', '');
                            $st_country_off = STInput::request('st_country_off', '');
                            ?>
                            <div class="form-group form-group-icon-left">
                                <label for="field-st-address"><?php _e('Pick Up', ST_TEXTDOMAIN); ?></label>
                                <i class="fa fa-map-marker input-icon"></i>
                                <div class="st-google-location-wrapper pickup">
                                    <input id="st_google_location_pickup" autocomplete="off" type="text" class="st_google_location form-control" name="st_google_location_pickup" value="<?php echo esc_attr($st_google_location_pickup); ?>">
                                    <input type="hidden" name="st_locality_up" value="<?php echo esc_attr($st_locality_up); ?>">
                                    <input type="hidden" name="st_sub_up" value="<?php echo esc_attr($st_sublocality_level_1_up); ?>">
                                    <input type="hidden" name="st_admin_area_up" value="<?php echo esc_attr($st_administrative_area_level_1_up); ?>">
                                    <input type="hidden" name="st_country_up" value="<?php echo esc_attr($st_country_up); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" class="diff-location"><?php echo __('Different Location'); ?></a>
                                <a href="#" class="same-location hide"><?php echo __('Same Location'); ?></a>
                            </div>
                            <div class="form-group hide form-group-icon-left">
                                <label for="field-st-address"><?php _e('Drop Off', ST_TEXTDOMAIN); ?></label>
                                <i class="fa fa-map-marker input-icon"></i>
                                <div class="st-google-location-wrapper dropoff">
                                    <input id="st_google_location_dropoff" autocomplete="off" type="text" class="st_google_location form-control" name="st_google_location_dropoff" value="<?php echo esc_attr($st_google_location_dropoff); ?>">
                                    <input type="hidden" name="st_locality_off" value="<?php echo esc_attr($st_locality_off); ?>">
                                    <input type="hidden" name="st_sub_off" value="<?php echo esc_attr($st_sublocality_level_1_off); ?>">
                                    <input type="hidden" name="st_admin_area_off" value="<?php echo esc_attr($st_administrative_area_level_1_off); ?>">
                                    <input type="hidden" name="st_country_off" value="<?php echo esc_attr($st_country_off); ?>">
                                </div>
                            </div>
                        </div> -->

      					<div class="col-xs-12 col-sm-6">
      						<div class="form-group">
		      					<label for="pick_up" class="head_bol"><?php _e('Pick Up', ST_TEXTDOMAIN);?> <span class="text-small text-danger">(*)</span>:</label>
		      					<?php 
		      						$pick_up = isset($_POST['location_id_pick_up']) ? intval($_POST['location_id_pick_up']) : '';
		      						$pick_up_name = (intval($pick_up) > 0) ? get_the_title($pick_up) : ""; 
		      					?>
		      					<input id="pick_up" type="hidden" name="location_id_pick_up" value="<?php /*echo $pick_up; */?>" data-post-type="location" class="form-control custom-form-control st_post_select_ajax " data-pl-name="<?php /*echo $pick_up_name; */?>">
		      				</div>
      					</div>
      					<div class="col-xs-12 col-sm-6">
      						<div class="form-group">
		      					<label  for="drop_off" class="head_bol"><?php _e('Drop Off', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
		      					<?php 
		      						$drop_off = isset($_POST['location_id_drop_off']) ? intval($_POST['location_id_drop_off']) : '';
		      						$drop_off_name = (intval($drop_off) > 0) ? get_the_title($drop_off) : ""; 
		      					?>
		      					<input id="drop_off" type="hidden" name="location_id_drop_off" value="<?php /*echo $drop_off; */?>" data-post-type="location" class="form-control custom-form-control st_post_select_ajax " data-pl-name="<?php /*echo $drop_off_name; */?>">
		      				</div>
      					</div>
      				</div>
      				<div class="row">
      					<div class="col-xs-12 col-sm-3">
      						<div class="form-group">
		      					<label for="check_in_car" class="head_bol"><?php _e('Pick Up Date', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
		      					<?php 
		      						$pick_up_date = isset($_POST['pick-up-date']) ? $_POST['pick-up-date'] : '';
		      					?>
		      					<div class="input-group">
								  	<span class="input-group-addon" id="basic-checkin"><i class="fa fa-calendar"></i></span>
								  	<input readonly aria-describedby="basic-checkin" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" autocomplete="off" type="text" name="pick-up-date" id="check_in_car" value="<?php echo $pick_up_date; ?>" class="form-control">
								</div>
		      					
		      				</div>
      					</div>
      					<div class="col-xs-12 col-sm-3">
      						<div class="form-group">
		      					<label for="check_in_car" class="head_bol"><?php _e('Pick Up Time', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
		      					<?php 
		      						$pick_up_time = isset($_POST['pick-up-time']) ? $_POST['pick-up-time'] : '';
		      					?>
		      					<div class="input-group">
								  	<span class="input-group-addon" id="basic-checkin"><i class="fa fa-calendar"></i></span>
								  	<input readonly aria-describedby="basic-checkin" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" autocomplete="off" type="text" name="pick-up-time" id="check_in_time" value="<?php echo $pick_up_time; ?>" class="st_timepicker form-control">
								</div>
		      					
		      				</div>
      					</div>
      					<div class="col-xs-12 col-sm-3">
      						<div class="form-group">
		      					<label for="check_out_car" class="head_bol"><?php _e('Drop Off Date', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
		      					<?php 
		      						$drop_off_date = isset($_POST['drop-off-date']) ? $_POST['drop-off-date'] : '';
		      					?>
		      					<div class="input-group">
								  	<span class="input-group-addon" id="basic-checkin"><i class="fa fa-calendar"></i></span>
								  	<input readonly aria-describedby="basic-checkin" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" autocomplete="off" type="text" name="drop-off-date" id="check_out_car" value="<?php echo $drop_off_date; ?>" class="form-control">
								</div>
		      					
		      				</div>
      					</div>
      					<div class="col-xs-12 col-sm-3">
      						<div class="form-group">
		      					<label for="check_out_time" class="head_bol"><?php _e('Drop Off Time', ST_TEXTDOMAIN); ?> <span class="text-small text-danger">(*)</span>:</label>
		      					<?php 
		      						$drop_off_time = isset($_POST['drop-off-time']) ? $_POST['drop-off-time'] : '';
		      					?>
		      					<div class="input-group">
								  	<span class="input-group-addon" id="basic-checkin"><i class="fa fa-calendar"></i></span>
								  	<input readonly aria-describedby="basic-checkin" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" autocomplete="off" type="text" name="drop-off-time" id="check_out_time" value="<?php echo $pick_up_time; ?>" class="st_timepicker form-control">
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