<?php 
	$policy = get_post_meta(get_the_ID() , 'hotel_policy' , true);
	
	
?>
<div class='hotel_policy container-fluid'>
	
	<?php 
		if (!empty($policy) and is_array($policy)){
			foreach ($policy as $key => $value) {
				?>
				<div class='row'>
					<div class='col-lg-3'>
						<?php 
							echo esc_html($value['title']);
						?>
					</div>
					<div class='col-lg-9'>
						<?php 
							echo do_shortcode($value['policy_description']);
						?>
					</div>
				</div>
				<?php 
			}
		}
	?>
	
</div>