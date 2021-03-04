<?php
/**
* @since 1.0.9
**/
?>

<div id="col-container " class="container-upload-font clear">
	<h2 class="title">All font of <b>"<?php echo esc_html( $fontname); ?>"</b></h2>
	<?php
		if(is_array($listfont) && count($listfont[$fontname])) :
			foreach($listfont[$fontname]['icon_list'] as  $val):
	?>	
		<div class="st-cont-item">
			<i class="<?php echo esc_html($val); ?>"><?php echo esc_html($val); ?></i>
		</div>
	<?php endforeach; endif; ?>
</div>
<br class="clear">
<a href="<?php echo admin_url('/admin.php?page=st-upload-custom-fonticon'); ?>"><?php echo esc_html__('Back to Upload fonticon', ST_TEXTDOMAIN) ?></a>
