<?php extract(shortcode_atts(array(
    'timeline_title'  => '',
    'image_timeline'         => '',
    'style_layout'    => '',
  ), $attr));
	$image_timeline = wp_get_attachment_image_src($image_timeline,array('500','500'));
	if(isset($style_layout) && !empty($style_layout)){
		$style_layout = $style_layout;
	} else {
		$style_layout = 'left';
	}
if($style_layout === 'center'){?>
	<div class="st-timeline">
		<div class="title-timeline">
			<h3>
				<?php echo esc_attr($timeline_title);?>
			</h3>
			<p class="text-center"><button class="icon-time-line"></button></p>
		</div>
		<div class="st-content-time-line <?php echo esc_attr($style_layout);?>">
			<div class="content-time col-6 item-option-center"></div>
			<div class="st-option-text col-md-12 col-sm-12 col-xs-12">
				<div class="height-equal">
					<div class="st-string">
						<?php echo $content;?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } else { ?>
<div class="st-timeline">
	<div class="title-timeline">
		<h3>
			<?php echo esc_attr($timeline_title);?>
		</h3>
		<p class="text-center"><button class="icon-time-line"></button></p>
	</div>
	<div class="st-content-time-line <?php echo esc_attr($style_layout);?>">
		<div class="img-time col-6 item-option">
			<div class="img">
				<img src="<?php echo esc_url($image_timeline[0]);?>" alt="timeline">
			</div>
			
		</div>
		<div class="content-time col-6 item-option">
			<div class="height-equal">
				<div class="st-string">
					<?php echo $content;?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }?>