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
						foreach ( $list as $k => $v ) {
							$selected = '';
							if ( $v == $value ) {
								$selected = 'selected="selected"';
							}
							?>

                            <option class=""
                                    value="<?php echo $v; ?>" <?php echo $selected; ?> ><?php echo esc_html( $k ); ?></option>
							<?php
						}
						break;
					case 'post_type':
						foreach ( $list as $k => $v ) {
							$selected = '';
							if ( $v['value'] == $value ) {
								$selected = 'selected="selected"';
							}
							?>

                            <option class=""
                                    value="<?php echo $v['value']; ?>" <?php echo $selected; ?> ><?php echo esc_html( $v['label'] ); ?></option>
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


