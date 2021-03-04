<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/27/2019
 * Time: 11:57 AM
 */
$require_text = '';
if(isset($data['required']) && $data['required'])
    $require_text = '<span class="required">*</span>';

$col_item = 'col-lg-12';
if(isset($data['col_option']) && !empty($data['col_option']))
    $col_item = 'col-lg-' . $data['col_option'];

$seperate_class = '';
if(isset($data['seperate']) && $data['seperate'])
    $seperate_class = 'has-seperate';

$tax_name = isset($data['tax_name']) ? $data['tax_name'] : '';

$value_std = array();

if (!empty($post_id)) {
	if(!isset($list_val) || empty($list_val)) {
		$value_std = get_the_terms( $post_id, $tax_name );
		if ( ! is_wp_error( $value_std ) && ! empty( $value_std ) ) {
			foreach ( $value_std as $k => $v ) {
				$value_std[] = $v->term_id . ',' . $tax_name;
			}
		} else {
			$value_std = array();
		}
	}else{
	    $value_std = array($list_val);
    }
}

$name_input = esc_attr($data['name']);
if(isset($list)) {
    $name_input = esc_attr($data['name']) . '[]';
}

?>
<div class="form-group st-field-<?php echo esc_attr($data['type']) . ' ' . $seperate_class; ?>">
    <label for="<?php echo 'st-field-' . esc_attr($data['name']); ?>"><?php echo esc_html($data['label']) . ' ' . $require_text; ?></label>
    <div class="row">
        <?php
        if(!empty($data['options'])){
            foreach ($data['options'] as $k => $v){
                $checked = '';
                if(in_array($k, $value_std)){
                    $checked = 'checked';
                }
                ?>
                <div class="<?php echo esc_html($col_item) ?> checkbox-item">
                    <input id="st-checkbox-<?php echo esc_html($data['name'] . '-' . $k); ?>" type="checkbox"
                           value="<?php echo esc_html($k); ?>" name="<?php echo esc_html($name_input); ?>" <?php echo esc_html($checked); ?>/>
                    <label for="st-checkbox-<?php echo esc_html($data['name'] . '-' . $k); ?>"><?php echo esc_html($v); ?></label>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div class="st_field_msg"></div>
</div>