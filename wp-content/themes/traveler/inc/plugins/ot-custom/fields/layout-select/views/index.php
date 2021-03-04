<?php
extract( $args );
if ( ! isset( $field_post_type ) ) {
	$field_post_type = 'st_hotel';
}
$data_layout = st_get_layout( $field_post_type );
$has_desc    = $field_desc ? true : false;
echo '<div class="format-setting type-post_select_ajax ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
echo '<div class="format-setting-inner">';
echo '<div class="option-tree-ui-' . $type . '-input-wrap">';
?>
    <div class="bt_ot_address_wrap">
		<?php if ( ! empty( $data_layout ) ): ?>
            <select name="<?php echo $field_name; ?>">
				<?php
				foreach ( $data_layout as $k => $v ) {
					$selected = '';
					if ( $v['value'] == $field_value ) {
						$selected = 'selected';
					}
					echo '<option value="' . $v['value'] . '"  ' . $selected . '>' . $v['label'] . '</option>';
				}
				?>
            </select>
		<?php endif; ?>
    </div>
<?php
echo '</div>';
echo '</div>';
echo '</div>';