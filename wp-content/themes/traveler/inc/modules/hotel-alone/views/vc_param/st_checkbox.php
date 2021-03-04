<?php
$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
$class      = isset( $settings['class'] ) ? $settings['class'] : '';
$list = array();
$stype = isset( $settings['stype'] ) ? $settings['stype'] : 'tax';
$sparam = isset( $settings['sparam'] ) ? $settings['sparam'] : false;
switch ($stype){
    case 'tax':
	    $list       = st_hotel_alone_vc_list_taxonomy( $sparam );
        break;
    case 'tax_rental':
	    $list       = STRental::listTaxonomy();
        break;
}

$class      = isset( $settings['class'] ) ? $settings['class'] : '';
$w          = isset( $settings['w'] ) ? $settings['w'] : '';

if ( empty( $value ) ) {
	$value = isset( $settings['std'] ) ? $settings['std'] : '';
}

$arr_value = array();
if(!empty($value))
    $arr_value = explode(',', $value);

?>
<div class="my_param_block">
    <div class="edit_form_line st_checkbox_item">
        <input type="hidden" class="st_checkbox wpb_vc_param_value wpb-input <?php echo esc_attr($class); ?>" name="<?php echo $param_name; ?>"  value="<?php echo (!empty($value)? $value: ''); ?>" />
        <?php
		if ( ! empty( $list ) ) {
			foreach ( $list as $k => $v ) {
			    $check = '';
			    if(in_array($v, $arr_value))
			        $check = 'checked';
				?>
                <label>
                    <input type="checkbox" <?php echo $check; ?> name="custom_<?php echo esc_html( $param_name ) ?>"
                           value="<?php echo esc_html( $v ) ?>" class="item wpb-input">
					<?php echo esc_html( $k ) ?>
                </label>
				<?php
			}
		}
		?>
    </div>
</div>


