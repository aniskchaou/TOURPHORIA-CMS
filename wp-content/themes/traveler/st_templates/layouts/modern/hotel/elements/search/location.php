<?php
    $enable_tree = st()->get_option( 'bc_show_location_tree', 'off' );
    $location_id = STInput::get( 'location_id', '' );
    $location_name = STInput::get( 'location_name', '' );
    if(empty($location_name)){
        if(!empty($location_id)){
            $location_name = get_the_title($location_id);
        }
    }
    if ( $enable_tree == 'on' ) {
        $lists     = TravelHelper::getListFullNameLocation( 'st_hotel' );
        $locations = TravelHelper::buildTreeHasSort( $lists );
    } else {
        $locations = TravelHelper::getListFullNameLocation( 'st_hotel' );
    }
    $has_icon = ( isset( $has_icon ) ) ? $has_icon : false;
?>
<div class="form-group form-extra-field dropdown clearfix field-detination <?php if ( $has_icon ) echo 'has-icon' ?>">
    <?php
        if ( $has_icon ) {
            echo TravelHelper::getNewIcon('ico_maps_search_box');
        }
    ?>
    <div class="dropdown" data-toggle="dropdown" id="dropdown-destination">
    <label><?php echo __( 'Destination', ST_TEXTDOMAIN ); ?></label>
        <div class="render">
            <span class="destination">
                <?php
                if(empty($location_name)) {
                    echo __('Where are you going?', ST_TEXTDOMAIN);
                }else{
                    echo $location_name;
                }
                ?>
            </span>
        </div>
        <input type="hidden" name="location_name" value="<?php echo esc_attr($location_name); ?>"/>
        <input type="hidden" name="location_id" value="<?php echo esc_attr($location_id); ?>"/>
    </div>
    <ul class="dropdown-menu" aria-labelledby="dropdown-destination">
        <?php
            if ( $enable_tree == 'on' ) {
                New_Layout_Helper::buildTreeOptionLocation( $locations, $location_id );
            } else {
                if ( is_array( $locations ) && count( $locations ) ):
                    foreach ( $locations as $key => $value ):
                        ?>
                        <li class="item" data-value="<?php echo $value->ID; ?>">
                            <?php echo TravelHelper::getNewIcon('ico_maps_search_box'); ?>
                            <span><?php echo $value->fullname; ?></span></li>
                    <?php
                    endforeach;
                endif;
            }
        ?>
    </ul>

</div>