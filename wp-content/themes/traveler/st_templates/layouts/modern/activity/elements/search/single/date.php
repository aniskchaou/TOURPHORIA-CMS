<?php
    $start    = STInput::post( 'check_in', date( TravelHelper::getDateFormat() ) );
    $end      = STInput::post( 'check_out', date( TravelHelper::getDateFormat(), strtotime( "+ 1 day" ) ) );
    $date     = STInput::request( 'date', date( 'd/m/Y h:i a' ) . '-' . date( 'd/m/Y h:i a', strtotime( '+1 day' ) ) );
    $has_icon = ( isset( $has_icon ) ) ? $has_icon : false;
?>
<div class="form-group form-date-field form-date-search clearfix <?php if ( $has_icon ) echo ' has-icon '; ?>"
     data-format="<?php echo TravelHelper::getDateFormatMoment() ?>">
    <?php
        if ( $has_icon ) {
            echo TravelHelper::getNewIcon( 'ico_calendar_search_box' );
        }
    ?>
    <div class="date-wrapper clearfix">
        <div class="check-in-wrapper">
            <label><?php echo __( 'Date', ST_TEXTDOMAIN ); ?></label>
            <div class="render check-in-render"><?php echo $start; ?></div>
        </div>
        <i class="fa fa-angle-down arrow"></i>
    </div>
    <input type="text" class="check-in-input" value="<?php echo esc_attr( $start ) ?>" name="check_in">
    <input type="hidden" class="check-out-input" value="<?php echo esc_attr( $end ) ?>" name="check_out">
    <input type="text" class="check-in-out-input" value="<?php echo esc_attr( $date ) ?>" name="check_in_out">
</div>