<?php
$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
$class      = isset( $settings['class'] ) ? $settings['class'] : '';
$list       = array();
$stype      = isset( $settings['stype'] ) ? $settings['stype'] : 'tax';
$sparam     = isset( $settings['sparam'] ) ? $settings['sparam'] : 'hotel_room';
$sauto      = isset( $settings['sautocomplete'] ) ? $settings['sautocomplete'] : 'no';

$class = isset( $settings['class'] ) ? $settings['class'] : '';
$w     = isset( $settings['w'] ) ? $settings['w'] : '';

if ( empty( $value ) ) {
	$value = isset( $settings['std'] ) ? $settings['std'] : '';
}

switch ( $stype ) {
	case 'tax':
		$list = hotel_alone_list_taxonomy();
		break;
	case 'post_type':
		$list = st_hotel_alone_get_type_services_data( $sparam );
		break;
    case 'list_tax':
        $list = st_list_taxonomy( $sparam );
        break;
    case 'list_post_type':
	    $list1 = ( STLocation::get_post_type_list_active() );

	    $list = array();
	    $list = array( __( '--Select--' , ST_TEXTDOMAIN ) => '' );
	    if(!empty( $list1 ) and is_array( $list1 )) {
		    foreach( $list1 as $kk => $vv ) {
			    if($vv == 'st_cars') {
				    $list[ __( 'Car' , ST_TEXTDOMAIN ) ] = $vv;
			    }
			    if($vv == 'st_tours') {
				    $list[ __( 'Tour' , ST_TEXTDOMAIN ) ] = $vv;
			    }
			    if($vv == 'st_hotel') {
				    $list[ __( 'Hotel' , ST_TEXTDOMAIN ) ] = $vv;
			    }
			    if($vv == 'st_rental') {
				    $list[ __( 'Rental' , ST_TEXTDOMAIN ) ] = $vv;
			    }
			    if($vv == 'st_activity') {
				    $list[ __( 'Activity' , ST_TEXTDOMAIN ) ] = $vv;
			    }
			    if($vv == 'hotel_room') {
				    $list[ esc_html__('Room',ST_TEXTDOMAIN)] = $vv;
			    }
		    }
	    }
        break;
    case 'list_post_tax':
	    $list = st_get_post_taxonomy($sparam,false);
        break;
    case 'list_location':
	    $list_location = TravelerObject::get_list_location();
	    $list[ __( '-- Select --' , ST_TEXTDOMAIN ) ] = '';
	    if(!empty( $list_location )) {
		    foreach( $list_location as $kkk => $vvv ) {
			    $list[ $vvv[ 'title' ] ] = $vvv[ 'id' ];
		    }
	    }
        break;
    case 'list_terms':
	    $menus = get_terms($sparam, array('hide_empty' => true));
	    $list = array();
	    foreach ($menus as $kk => $vv) {
		    $list[$vv->name] = $vv->slug;
	    }
        break;

}

?>
<div class="my_param_block">
    <div class="edit_form_line st_checkbox_item">
        <div class="ui-widget">
			<?php
			if ( ! empty( $list ) ) {
				$class_auto = '';
				if ( $sauto == 'yes' ) {
					$class_auto = 'sautocomplete';
				}

				echo '<select name="' . $param_name . '" class="' . $class_auto . ' wpb_vc_param_value wpb-input wpb-select number_post dropdown 2 ' . esc_attr( $class ) . ' "
                        data-option="2">';
				switch ( $stype ) {
					case 'tax':
                    case 'list_tax':
                    case 'list_post_type':
                    case 'list_location':
                    case 'list_terms':
						foreach ( $list as $k => $v ) {
							$selected = '';
							if ( $v == $value ) {
								$selected = 'selected="selected"';
							}
							?>
                            <option class=""
                                    value="<?php echo esc_html($v); ?>" <?php echo esc_html($selected); ?> ><?php echo esc_html( $k ); ?></option>
							<?php
						}
						break;
					case 'post_type':
                    case 'list_post_tax':
						foreach ( $list as $k => $v ) {
							$selected = '';
							if ( $v['value'] == $value ) {
								$selected = 'selected="selected"';
							}
							?>

                            <option class=""
                                    value="<?php echo esc_html($v['value']); ?>" <?php echo esc_html($selected); ?> ><?php echo esc_html( $v['label'] ); ?></option>
							<?php
						}
						break;
				}
				echo ' </select>';
			}
			?>
        </div>
    </div>
</div>


