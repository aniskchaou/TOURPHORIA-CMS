<?php
    $picker_style = ( isset( $picker_style ) ) ? $picker_style : '';
    $date_now     = current_time( 'timestamp' );
    $date_next    = strtotime( '+1 day', $date_now );
    $check_in     = STInput::get( 'checkin_y' ) . "-" . STInput::get( 'checkin_m' ) . "-" . STInput::get( 'checkin_d' );
    if ( $check_in == '--' ) $check_in = ''; else$check_in = date( TravelHelper::getDateFormat(), strtotime( $check_in ) );
    if ( empty( $check_in ) ) {
        $check_in = date( TravelHelper::getDateFormat() );
    }

    $check_out = STInput::get( 'checkout_y' ) . "-" . STInput::get( 'checkout_m' ) . "-" . STInput::get( 'checkout_d' );
    if ( $check_out == '--' ) $check_out = ''; else$check_out = date( TravelHelper::getDateFormat(), strtotime( $check_out ) );
    if ( empty( $check_out ) ) {
        $check_out = date( TravelHelper::getDateFormat(), strtotime( '+1 day', strtotime( date( 'Y-m-d' ) ) ) );
    }
    $check_in_out = current_time( TravelHelper::getDateFormat() ) . '-' . date( TravelHelper::getDateFormat(), strtotime( '+1 day', current_time( 'timestamp' ) ) );

    $id = 'check-in-out_' . rand( 0, time() );
?>
<div
    class="helios-form-control col-md-<?php echo esc_attr( $layout_size ); ?> col-sm-<?php echo esc_attr( $layout_size ); ?> col-xs-6 item-search datepicker-field helios-form-<?php echo esc_attr( $field_attribute ); ?>">
    <div class="date-group clearfix">
        <?php if ( !empty( $label ) ) { ?>
            <label><?php echo esc_attr( $label ) ?></label>
        <?php } ?>
        <div class="item-search-content">
            <div class="options cursor">
                <div class="day">
                    00
                </div>
                <div class="month">
                    <span><?php esc_html_e( "Month", ST_TEXTDOMAIN ) ?></span>
                    <i class="fa fa-angle-down"></i>
                </div>
            </div>
            <input type="hidden" class="checkin_d" name="checkin_d"
                   value="<?php echo STInput::get( 'checkin_d', date( 'j', $date_now ) ) ?>"/>
            <input type="hidden" class="checkin_m" name="checkin_m"
                   value="<?php echo STInput::get( 'checkin_m', date( 'n', $date_now ) ) ?>"/>
            <input type="hidden" class="checkin_y" name="checkin_y"
                   value="<?php echo STInput::get( 'checkin_y', date( 'Y', $date_now ) ) ?>"/>
            <input type="text" name="check_in" class="wpbooking-date-start helios-input wb-" readonly
                   value="<?php echo esc_html( $check_in ) ?>">
            <input class="wpbooking-check-in-out <?php echo esc_attr( $picker_style ); ?>"
                   data-custom-class="<?php echo esc_attr( $picker_style ); ?>" type="text"
                   name="check_in_out"
                   value="<?php echo esc_html( STInput::get( 'check_in_out', $check_in_out ) ); ?>">
        </div>
        <div class="item-search-content">
            <div class="options cursor">
                <div class="day">
                    00
                </div>
                <div class="month">
                    <span><?php esc_html_e( "Month", ST_TEXTDOMAIN ) ?></span>
                    <i class="fa fa-angle-down"></i>
                </div>
            </div>
            <input type="hidden" class="checkout_d" name="checkout_d"
                   value="<?php echo STInput::get( 'checkout_d', date( 'j', $date_next ) ) ?>"/>
            <input type="hidden" class="checkout_m" name="checkout_m"
                   value="<?php echo STInput::get( 'checkout_m', date( 'n', $date_next ) ) ?>"/>
            <input type="hidden" class="checkout_y" name="checkout_y"
                   value="<?php echo STInput::get( 'checkout_y', date( 'Y', $date_next ) ) ?>"/>
            <input type="text" name="check_out" class="wpbooking-date-end helios-input" readonly
                   value="<?php echo esc_html( $check_out ) ?>">
        </div>
    </div>
</div>
