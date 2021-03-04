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
    case 'list_tax_id':
        $list = st_get_list_taxonomy_id($sparam);
        break;
    case 'list_tax':
	    $list = st_list_taxonomy( $sparam);
	    $txt  = __( '--Select--' , ST_TEXTDOMAIN );
	    unset( $list[ $txt ] );
        break;
    case 'list_terms':
	    $list = array();
	    $terms = get_terms( $sparam, array(
		    'hide_empty' => true,
	    ) );
	    if(!empty($terms)){
		    foreach( $terms as $key => $val){
			    $list[$val->name] = $val->term_id;
		    }
        }
        break;
    case 'list_location_terms':
	    $list = array();
	    $list_terms = STLocation::get_location_terms();
	    if(!empty($list_terms) and is_array($list_terms)) {
		    foreach ($list_terms as $kk => $vv) {
			    $list[$vv->name] = $vv->taxonomy."/".$vv->term_id;
		    }
	    }
	    break;
    case 'get_option':
	    $list_data = st()->get_option($sparam);
	    $list = array(esc_html__('All') => 'all');
	    if(!empty($list_data)){
		    foreach($list_data as $kk => $vv){
                $list[$vv['title']] = $vv['tab_name'];
		    }
	    }
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
        <input type="hidden" class="st_checkbox wpb_vc_param_value wpb-input <?php echo esc_attr($class); ?>" name="<?php echo esc_attr($param_name); ?>"  value="<?php echo (!empty($value)? $value: ''); ?>" />
        <?php
		if ( ! empty( $list ) ) {
			foreach ( $list as $k => $v ) {
			    $check = '';
			    if(in_array($v, $arr_value))
			        $check = 'checked';
				?>
                <label>
                    <input type="checkbox" <?php echo esc_attr($check); ?> name="custom_<?php echo esc_html( $param_name ) ?>"
                           value="<?php echo esc_html( $v ) ?>" class="item wpb-input">
					<?php echo esc_html( $k ) ?>
                </label>
				<?php
			}
		}
		?>
    </div>
</div>


