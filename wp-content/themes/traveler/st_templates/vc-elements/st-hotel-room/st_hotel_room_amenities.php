<div class="room-facility">
	<h3 class="booking-item-title"><?php echo esc_attr($args['title']); ?></h3>
	<div class='row room-facility-amenities'>
		 
	<?php 
			$choose_taxonomies = STHotel::listTaxonomy(); 
			if(is_array($choose_taxonomies) && count($choose_taxonomies)):
				foreach($choose_taxonomies as $key=>$terms):
					$tax = get_taxonomy($terms);
					$term = get_the_terms(get_the_ID(), $terms);
					if(is_array($term) && count($term)):
		?>
	
		 
			 
				<div class="col-xs-12">  		
				<div class='amenities_inner'>			 
					<?php 
						if($term):
							foreach($term as $key => $val):
					?>
					<?php if (function_exists('get_tax_meta') and $icon = get_tax_meta($val->term_id, 'st_icon')): ?>
					<div class="col-xs-12 col-sm-6 sub-item">						
						<span>							
                            <i rel="tooltip" data-placement="top" title="" data-original-title="<?php echo esc_html( $val->name) ; ?>" class="<?php echo TravelHelper::handle_icon($icon) ?> mr10"></i>
                        	<?php 
                        		echo esc_html( $val->name) ; 
                    		?> 
                    	</span>
					</div>
					<?php  endif; ?>
					<?php if (($key+1)%2==0) echo "</div><div class='amenities_inner'>"; ?>
					<?php endforeach; endif;?> 
				</div>
				</div>  
			<?php endif; endforeach; endif; ?>
		 
	</div>
</div>
