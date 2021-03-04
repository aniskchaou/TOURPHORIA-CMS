<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/7/2019
 * Time: 2:49 PM
 */

$hotel_id = get_post_meta(get_the_ID(), 'room_parent', true);
$start          = STInput::get( 'check_in', date( TravelHelper::getDateFormat() ) );
$end            = STInput::get( 'check_out', date( TravelHelper::getDateFormat(), strtotime( "+ 1 day" ) ) );
$date           = STInput::get( 'check_in_out', $start . '-' . $end );
$booking_period = intval( get_post_meta( $hotel_id, 'hotel_booking_period', true ) );
$price = get_post_meta(get_the_ID(), 'price', true);

?>
<div class="price-wrapper">
    <?php echo sprintf(__('FROM %s PER NIGHT', ST_TEXTDOMAIN), '<span>'. TravelHelper::format_money($price) .'</span>'); ?>
</div>
<div class="sts-booking-form">
    <div class="loader-wrapper">
        <div class="st-loader"></div>
    </div>
    <form class="" action="POST">
        <div class="item checkin-out people" data-format="<?php echo TravelHelper::getDateFormatMoment() ?>">
            <div class="date-wrapper">
                <div class="title">
                    <span><?php echo __('Check In-Out', ST_TEXTDOMAIN); ?></span>
                    <?php //echo TravelHelper::getNewIcon('calendar-disable', '#1A2B48', '23px', '23px', true) ?>
                </div>
                <span class="value"><?php echo $start . ' - ' . $end; ?></span>
            </div>
            <input type="hidden" class="check-in-input" value="<?php echo esc_attr( $start ) ?>" name="check_in">
            <input type="hidden" class="check-out-input" value="<?php echo esc_attr( $end ) ?>" name="check_out">
            <input type="text" class="sts-checkin-out"
                   data-minimum-day="<?php echo esc_attr( $booking_period ); ?>"
                   data-room-id="<?php echo get_the_ID() ?>"
                   data-action="st_get_availability_hotel_room"
                   value="<?php echo esc_attr( $date ); ?>" data-s="<?php echo wp_create_nonce('st_frontend_security'); ?>" name="check_in_out">
        </div>
        <div class="item people">
            <div class="title">
                <span><?php echo __('Rooms', ST_TEXTDOMAIN); ?></span>
                <?php
                $rooms = get_post_meta(get_the_ID(), 'number_room', true);
                ?>
                <select name="room_num_search">
                    <?php
                    for($i = 1; $i <= $rooms; $i++){
                        echo '<option value="'. $i.'">'. $i .'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="item people">
            <div class="title">
                <span><?php echo __('Adults', ST_TEXTDOMAIN); ?></span>
                <?php
                    $adult_num_search = ST_Single_Hotel::inst()->getMaxPeopleSearchForm();
                    $adult_selected = STInput::get('adult_num_search', 1);
                    if($adult_selected > $adult_num_search)
                        $adult_selected = $adult_num_search;

                    if($adult_selected < 1)
                        $adult_selected = 1;
                ?>
                <select name="adult_number">
                    <?php
                        for($i = 1; $i <= $adult_num_search; $i++){
                            $selected = '';
                            if($adult_selected == $i)
                                $selected = 'selected';
                            echo '<option value="'. $i.'" '. $selected .'>'. $i .'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="item people">
            <div class="title">
                <span><?php echo __('Children', ST_TEXTDOMAIN); ?></span>
                <?php
                    $children_num_search = ST_Single_Hotel::inst()->getMaxPeopleSearchForm('child');
                    $child_selected = STInput::get('children_num_search', 0);
                    if($child_selected > $children_num_search)
                        $child_selected = $children_num_search;

                    if($child_selected < 0)
                        $child_selected = 0;
                ?>
                <select name="child_number">
                    <?php
                    for($i = 0; $i <= $children_num_search; $i++){
                        $selected = '';
                        if($child_selected == $i)
                            $selected = 'selected';
                        echo '<option value="'. $i.'" '. $selected .'>'. $i .'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="item extra">
            <?php echo st()->load_template( 'layouts/modern/single_hotel/elements/extras', '' ); ?>
        </div>
        <input type="hidden" name="action" value="st_add_to_cart" />
        <input type="hidden" name="item_id" value="<?php echo $hotel_id; ?>" />
        <input type="hidden" name="room_id" value="<?php echo get_the_ID(); ?>" />
        <input type="hidden" name="is_search_room" value="true" />
        <div class="message alert alert-danger"></div>
        <button type="submit" class="sts-single-room-check sts-btn"><span><?php echo __('CHECK AVAILABILITY', ST_TEXTDOMAIN); ?> <i class="fa fa-spinner fa-spin"></i></span></button>
    </form>
</div>
