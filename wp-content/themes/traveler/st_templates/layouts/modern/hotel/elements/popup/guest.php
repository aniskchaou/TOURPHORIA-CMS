<?php
$room_num_search = STInput::get( 'room_num_search', 1 );
$adult_number    = STInput::get( 'adult_number', 1 );
$child_number    = STInput::get( 'child_number', 0 );
?>
<div class="st-popup popup-guest hidden-lg hidden-md">
	<h3 class="popup-title">
		<?php echo __('Guest', ST_TEXTDOMAIN); ?>
		<span class="popup-close"><?php echo TravelHelper::getNewIcon('Ico_close', '#A0A9B2', '20px', '20px'); ?></span>
	</h3>
	<div class="popup-content">
		<ul>
            <li class="item">
                <label><?php echo esc_html__( 'Rooms', ST_TEXTDOMAIN ) ?></label>
                <div class="select-wrapper">
                    <div class="st-number-wrapper">
                        <input type="text" name="room_num_search" value="<?php echo $room_num_search; ?>" class="form-control st-input-number" autocomplete="off" readonly data-min="1" data-max="20"/>
                    </div>
                </div>
            </li>
			<li class="item">
				<label><?php echo esc_html__( 'Adults', ST_TEXTDOMAIN ) ?></label>
				<div class="select-wrapper">
                    <div class="st-number-wrapper">
                        <input type="text" name="adult_number" value="<?php echo $adult_number; ?>" class="form-control st-input-number" autocomplete="off" readonly data-min="1" data-max="20"/>
                    </div>
				</div>
			</li>
			<li class="item">
				<label><?php echo esc_html__( 'Children', ST_TEXTDOMAIN ) ?></label>
				<div class="select-wrapper">
                    <div class="st-number-wrapper">
                        <input type="text" name="child_number" value="<?php echo $child_number; ?>" class="form-control st-input-number" autocomplete="off" readonly data-min="0" data-max="20"/>
                    </div>
				</div>
			</li>
		</ul>
        <button class="btn btn-link btn-guest-apply"><?php echo __('Apply', ST_TEXTDOMAIN); ?></button>
	</div>
</div>