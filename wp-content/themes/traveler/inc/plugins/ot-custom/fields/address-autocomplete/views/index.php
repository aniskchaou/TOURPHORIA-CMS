<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 1/20/15
 * Time: 3:23 PM
 */
$default = array(
    'field_desc'  => '',
    'field_name'  => '',
    'field_value' => '',
    'meta'        => '',
    'field_id'    => '',
    'type'        => ''
);

$args = wp_parse_args($args, $default);
extract($args);
/* verify a description */
$has_desc = $field_desc ? TRUE : FALSE;
echo '<div class="format-setting type-post_select_ajax ' . ($has_desc ? 'has-desc' : 'no-desc') . '">';
/* description */
echo $has_desc ? '<div class="description">' . htmlspecialchars_decode($field_desc) . '</div>' : '';
/* format setting inner wrapper */
echo '<div class="format-setting-inner">';
/* allow fields to be filtered */
echo '<div class="option-tree-ui-' . $type . '-input-wrap">';
?>
    <div class="bt_ot_address_wrap">
        <input value="<?php echo esc_html($field_value) ?>" type="text"
           placeholder="<?php _e('Address', ST_TEXTDOMAIN) ?>" id="bt_ot_address_autocomplete"  class="widefat bt_ot_address_autocomplete form-control"
           name="<?php echo esc_attr($field_name) ?>"/>
    </div>
<?php
echo '</div>';
echo '</div>';
echo '</div>';