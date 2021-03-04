<?php
	global $post;
	$post_id = $post->ID;
	if(is_page_template( 'template-user.php' )){
		$post_id = isset($_GET['id']) ? (int)$_GET['id']: 0;
	}
	if(empty($post_id)){
		return;
	}
?>
<?php 
	$args = [
		'post_type' => 'hotel_room',
		'posts_per_page' => -1,
		'meta_query' => [
			[
				'key' => 'room_parent',
				'value' => $post_id,
				'compare' => '='
			]
		]
	];

	$rooms = [];
	$query = new WP_Query($args);
	while($query->have_posts()): $query->the_post();
		$rooms[] = [
			'id' => get_the_ID(),
			'name' => get_the_title()
		];
?>

<?php endwhile; wp_reset_postdata();
wp_enqueue_script('bulk-calendar' );
?>

<div class="calendar-wrapper">
    <div class="st-inventory-form">
        <span class="mr10"><strong><?php echo esc_html__( 'View by period:', ST_TEXTDOMAIN ); ?></strong></span>
        <input type="text" name="st-inventory-start" class="st-inventory-start disabled" value="" autocomplete="off"
               placeholder="<?php echo esc_html__( 'Start date', ST_TEXTDOMAIN ) ?>">
        <input type="text" name="st-inventory-end" class="st-inventory-end disabled" value="" autocomplete="off"
               placeholder="<?php echo esc_html__( 'End date', ST_TEXTDOMAIN ) ?>">
        <button class="st-inventory-goto"><?php echo esc_html__( 'View', ST_TEXTDOMAIN ); ?></button>
        <button type="button" id="calendar-bulk-edit" class="option-tree-ui-button button button-primary button-large btn btn-primary btn-sm" style="float: right;"><?php echo esc_html__('Bulk Edit', ST_TEXTDOMAIN); ?></button>
    </div>
    <div class="gantt wpbooking-gantt st-inventory" data-id="<?php echo esc_attr( $post_id ); ?>"
         data-rooms="<?php echo esc_attr( json_encode( $rooms ) ); ?>">
    </div>
    <div class="st-inventory-color">
        <div class="inventory-color-item">
            <span class="available"></span> <?php echo esc_html__( 'Available', ST_TEXTDOMAIN ); ?>
        </div>
        <div class="inventory-color-item">
            <span class="unavailable"></span> <?php echo esc_html__( 'Unavailable', ST_TEXTDOMAIN ); ?>
        </div>
        <div class="inventory-color-item">
            <span class="out_stock"></span> <?php echo esc_html__( 'Out of Stock', ST_TEXTDOMAIN ); ?>
        </div>
    </div>
    <input type="hidden" value="<?php echo esc_html('Edit number of room', ST_TEXTDOMAIN); ?>" id="inventory-text-eidt-room" />
    <div class="panel-room-number-wrapper">
        <div class="panel-room">
            <input class="input-price" type="number" name="input-room-number" value="" placeholder="">
            <input class="input-room-id" type="hidden" name="input-room-id" value="" placeholder="" min="0">
            <a href="javascript: void(0);" class="button btn-add-number-room" style="margin-left: 10px;">Update <i class="fa fa-spin fa-spinner loading-icon"></i></a>
            <span class="close">
                <i class="fa fa-times"></i>
            </span>
            <div class="message-box"></div>
        </div>
    </div>

    <!-- Bulk Edit -->

    <div id="form-bulk-edit" class="fixed">
        <div class="form-container">
            <div class="overlay">
                <span class="spinner is-active"></span>
            </div>
            <div class="form-title">
                <h3 class="clearfix">
                    <?php echo esc_html__( 'Select a Room', ST_TEXTDOMAIN ); ?>
                    <select name="post-id" class="ml20 post-bulk">
                        <option
                                value=""><?php echo esc_html__( '---- room ----', ST_TEXTDOMAIN ); ?></option>
                        <?php
                        foreach ( $rooms as $room ) {
                            echo '<option value="' . esc_attr( $room[ 'id' ] ) . '">' . esc_html( $room[ 'name' ] ) . '</option>';
                        }
                        ?>
                    </select>
                    <button style="float: right;" type="button" id="calendar-bulk-close" class="calendar-bulk-room-close button button-small btn btn-default btn-sm"><?php echo __('Close',ST_TEXTDOMAIN); ?></button>
                </h3>
            </div>
            <div class="form-content clearfix">
                <div class="form-group">
                    <div class="form-title">
                        <h4 class=""><input type="checkbox" class="check-all" data-name="day-of-week"> <?php echo __('Days Of Week', ST_TEXTDOMAIN); ?></h4>
                    </div>
                    <div class="form-content">
                        <label class="block"><input type="checkbox" name="day-of-week[]" value="Sunday" style="margin-right: 5px;"><?php echo __('Sunday', ST_TEXTDOMAIN); ?></label>
                        <label class="block"><input type="checkbox" name="day-of-week[]" value="Monday" style="margin-right: 5px;"><?php echo __('Monday', ST_TEXTDOMAIN); ?></label>
                        <label class="block"><input type="checkbox" name="day-of-week[]" value="Tuesday" style="margin-right: 5px;"><?php echo __('Tuesday', ST_TEXTDOMAIN); ?></label>
                        <label class="block"><input type="checkbox" name="day-of-week[]" value="Wednesday" style="margin-right: 5px;"><?php echo __('Wednesday', ST_TEXTDOMAIN); ?></label>
                        <label class="block"><input type="checkbox" name="day-of-week[]" value="Thursday" style="margin-right: 5px;"><?php echo __('Thursday', ST_TEXTDOMAIN); ?></label>
                        <label class="block"><input type="checkbox" name="day-of-week[]" value="Friday" style="margin-right: 5px;"><?php echo __('Friday', ST_TEXTDOMAIN); ?></label>
                        <label class="block"><input type="checkbox" name="day-of-week[]" value="Saturday" style="margin-right: 5px;"><?php echo __('Saturday', ST_TEXTDOMAIN); ?></label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-title">
                        <h4 class=""><input type="checkbox" class="check-all" data-name="day-of-month"> <?php echo __('Days Of Month', ST_TEXTDOMAIN); ?></h4>
                    </div>
                    <div class="form-content">
                        <?php for( $i = 1; $i <= 31; $i ++):
                            if( $i == 1){
                                echo '<div>';
                            }
                            ?>
                            <label style="width: 40px;"><input type="checkbox" name="day-of-month[]" value="<?php echo $i; ?>" style="margin-right: 5px;"><?php echo $i; ?></label>

                            <?php
                            if( $i != 1 && $i % 5 == 0 ) echo '</div><div>';
                            if( $i == 31 ) echo '</div>';
                            ?>

                        <?php endfor; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-title">
                        <h4 class=""><input type="checkbox" class="check-all" data-name="months"> <?php echo __('Months', ST_TEXTDOMAIN); ?>(*)</h4>
                    </div>
                    <div class="form-content">
                        <?php
                        $months = array(
                            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                        );
                        foreach( $months as $key => $month ):
                            if( $key == 0 ){
                                echo '<div>';
                            }
                            ?>
                            <label style="width: 100px;"><input type="checkbox" name="months[]" value="<?php echo $month; ?>" style="margin-right: 5px;"><?php echo $month; ?></label>

                            <?php
                            if( $key != 0 && ($key + 1) % 2 == 0 ) echo '</div><div>';
                            if( $key + 1 == count( $months ) ) echo '</div>';
                            ?>

                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-title">
                        <h4 class=""><input type="checkbox" class="check-all" data-name="years"> <?php echo __('Years', ST_TEXTDOMAIN); ?>(*)</h4>
                    </div>
                    <div class="form-content">
                        <?php
                        $year = date('Y');
                        $j = $year -1 ;
                        for( $i = $year; $i <= $year + 2; $i ++ ):
                            if( $i == $year ){
                                echo '<div>';
                            }
                            ?>
                            <label style="width: 100px;"><input type="checkbox" name="years[]" value="<?php echo $i; ?>" style="margin-right: 5px;"><?php echo $i; ?></label>

                            <?php
                            if( $i != $year && ($i == $j + 2 ) ) { echo '</div><div>'; $j = $i; }
                            if( $i == $year + 2 ) echo '</div>';
                            ?>

                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="form-content flex lh30 clearfix">
                <label class="block mr10"><span><strong><?php echo esc_html__( 'Price', ST_TEXTDOMAIN ); ?>
                            : </strong></span><input
                            type="text" value="" name="price-bulk" id="price-bulk"
                            placeholder="<?php echo esc_html__( 'Price', ST_TEXTDOMAIN ); ?>"></label>
                <label class="block">
                    <span><strong><?php echo esc_html__( 'Status', ST_TEXTDOMAIN ); ?>: </strong></span>
                    <select name="status">
                        <option value="available"><?php echo esc_html__( 'Available', ST_TEXTDOMAIN ) ?></option>
                        <option
                                value="unavailable"><?php echo esc_html__( 'Unavailable', ST_TEXTDOMAIN ) ?></option>
                    </select>
                </label>
                <input type="hidden" class="type-bulk" name="type-bulk" value="accommodation">
                <div class="clear"></div>
                <div class="form-message" style="margin-top: 20px;"></div>
            </div>
            <div class="form-footer">
                <button type="button" id="calendar-bulk-save" class="button button-primary button-large btn btn-primary btn-sm"><?php echo __('Save',ST_TEXTDOMAIN); ?></button>
            </div>
        </div>
    </div>
</div>