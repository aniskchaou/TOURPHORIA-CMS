<div class="content-section">
	<h4 class="heading"><?php echo esc_html($st_title); ?></h4>
	<div class="line-heading bgr-main"></div>
	<form action="" class="form form-availability-style3">
	<div class="row">
		<div class="col-xs-6 col-sm-4 col-lg-2">
			<div class="form-group">
				<label for=""><?php echo __('Check In', ST_TEXTDOMAIN); ?></label>
				<?php $check_in = STInput::request('start', ''); ?>
				<input readonly="readonly" id="field-hotel-start" data-post-id="<?php echo get_the_ID(); ?>" placeholder="<?php echo TravelHelper::getDateFormatJs(__("Select date", ST_TEXTDOMAIN)); ?>" class="form-control checkin_hotel" value="<?php echo esc_html($check_in); ?>" name="start" type="text">
			</div>
		</div>
		<div class="col-xs-6 col-sm-4 col-lg-2">
			<div class="form-group">
				<label for=""><?php echo __('Check Out', ST_TEXTDOMAIN); ?></label>
				<?php $check_out = STInput::request('end', ''); ?>
				<input readonly="readonly" id="field-hotel-end" data-post-id="<?php echo get_the_ID(); ?>" placeholder="<?php echo TravelHelper::getDateFormatJs(__("Select date", ST_TEXTDOMAIN)); ?>" class="form-control checkout_hotel" value="<?php echo esc_html($check_out); ?>" name="end" type="text">
			</div>
		</div>
		<div class="col-xs-6 col-sm-4 col-lg-2">
			<div class="form-group form-select">
				<label for=""><?php echo __('No. Room(s)', ST_TEXTDOMAIN); ?></label>
				<select id="field-hotel-room" name="room_num_search" class=" form-control">
                    <?php
                    $max_room = HotelHelper::_get_max_number_room(get_the_ID());
                    for($i = 1; $i <= $max_room; $i++){
                        $select = selected($i,$room_num);
                        echo '<option '.$select.' value="'.$i.'">'.$i.'</option>';
                    }
                    ?>
                </select>
			</div>
		</div>
		<div class="col-xs-6 col-sm-4 col-lg-2">
			<div class="form-group form-select">
				<label for=""><?php echo __('No. Adult(s)', ST_TEXTDOMAIN); ?></label>
				<select  name="adult_number" class="form-control">
	                <?php
	                	$max = st()->get_option('hotel_max_adult',14);
	                	for($i = 1; $i <= $max; $i++){
	                    	$select=selected($i,STInput::get('adult_number',1));
	                    	echo "<option {$select} value='{$i}'>{$i}</option>";
	                	}
	                ?>
	            </select>
			</div>
		</div>
		<div class="col-xs-6 col-sm-4 col-lg-2">
			<div class="form-group form-select">
				<label for=""><?php echo __('No. Children', ST_TEXTDOMAIN); ?></label>
				<select id="field-hotel-children" name="child_number" class="form-control">
	                <?php
	                	$max = st()->get_option('hotel_max_child',14);
	                	for($i = 1; $i <= $max; $i++){
	                    	$select=selected($i,STInput::get('adult_number',1));
	                    	echo "<option {$select} value='{$i}'>{$i}</option>";
	                	}
	                ?>
	            </select>
			</div>
		</div>
		<div class="col-xs-6 col-sm-4 col-lg-2">
			<div class="form-group">
				<a href="#" onclick="return false" class="btn btn-primary btn-do-search-room"><?php echo __('Check Availability', ST_TEXTDOMAIN); ?></a>
			</div>
		</div>
	</div>
	</form>
</div>