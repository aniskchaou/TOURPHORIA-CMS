<?php
    $has_icon        = ( isset( $has_icon ) ) ? $has_icon : false;
    $room_num_search = STInput::get( 'room_num_search', 1 );
    $adult_number    = STInput::get( 'adult_number', 1 );
    $child_number    = STInput::get( 'child_number', 0 );
?>
<div class="form-group form-extra-field dropdown clearfix field-guest <?php if ( $has_icon ) echo ' has-icon '; ?>">
    <?php
        if ( $has_icon ) {
            echo TravelHelper::getNewIcon( 'ico_guest_search_box' );
        }
    ?>
    <div class="dropdown" data-toggle="dropdown" id="dropdown-1">
        <label><?php echo __( 'Guests', ST_TEXTDOMAIN ); ?></label>
        <div class="render">
            <span class="adult" data-text="<?php echo __( 'Adult', ST_TEXTDOMAIN ); ?>"
                  data-text-multi="<?php echo __( 'Adults', ST_TEXTDOMAIN ); ?>"><?php echo sprintf( _n( '%s Adult', '%s Adults', $adult_number, ST_TEXTDOMAIN ), $adult_number ) ?></span>
            -
            <span class="children" data-text="<?php echo __( 'Child', ST_TEXTDOMAIN ); ?>"
                  data-text-multi="<?php echo __( 'Children', ST_TEXTDOMAIN ); ?>"><?php echo sprintf( _n( '%s Child', '%s Children', $child_number, ST_TEXTDOMAIN ), $child_number ); ?></span>
        </div>
    </div>
    <ul class="dropdown-menu" aria-labelledby="dropdown-1">
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
        <span class="hidden-lg hidden-md hidden-sm btn-close-guest-form"><?php echo __('Close', ST_TEXTDOMAIN); ?></span>
    </ul>
    <i class="fa fa-angle-down arrow"></i>
</div>