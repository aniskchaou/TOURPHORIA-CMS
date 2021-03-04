<?php
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

	global $post; 
	$post_id = $post->ID;
	if(!empty($post_id)):

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
	<input name="<?php echo esc_attr($field_name ); ?>" id="<?php echo esc_attr($field_name ); ?>" value="<?php echo esc_attr($field_value ); ?>" class="widefat option-tree-ui-input " type="text">
<?php 
	echo '</div>';
	echo '</div>';
	echo '</div>';
?>

<?php else: ?>
<div class="format-setting">
	<div class="description"><?php echo __('This field will be shown when saved this post', ST_TEXTDOMAIN); ?></div>
</div>
<?php endif; ?>	
