<?php extract(shortcode_atts(array(
    'st_item_tab'          => '',
  ), $attr));
?>
<?php
	extract(shortcode_atts(array(
	    'st_item_tab'          => '',
	 ), $attr));
	$list_tab = vc_param_group_parse_atts($st_item_tab);
?>
<div class="menutab">
	<div class="contaner">
		<div class="row">
			<div class="col-md-12">
				<div class="tabbable-panel">
                    <div class="tabbable-line">
	                   	<ul class="nav nav-tabs ">
	                   		<?php foreach ($list_tab as $key => $st_tab) {
	                   			$slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $st_tab["st_name_tab"]))))), '-'));
	                   			?>
	                   			<li <?php if($key==0){?>class="active"<?php }?>>
			                        <a href="#<?php echo esc_attr($slug);?>" data-toggle="tab">
									<?php echo $st_tab["st_name_tab"];?> </a>
			                    </li>
	                   		<?php }?>
		                </ul>
		                <div class="tab-content">
		                	<?php foreach ($list_tab as $keyx => $st_tab) {
		                		$slug = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $st_tab["st_name_tab"]))))), '-'));
		                		$content_tab = vc_param_group_parse_atts($st_tab['st_item_content_tab']);
		                		?>
		                	<div class="tab-pane <?php if($keyx==0){?>active<?php }?>" id="<?php echo esc_attr($slug);?>">
		                		<div class="row">
		                			<?php foreach ($content_tab as $kk => $ct){ 
		                				$img_st = wp_get_attachment_image_src($ct['st_image'],'');
		                				$st_image = isset($img_st) ? $img_st : "";
		                				$title_st = isset($ct['st_title']) ? $ct['st_title'] : "";
		                				$st_content = isset($ct['st_content']) ? $ct['st_content'] : "";
		                				$st_price = isset($ct['st_price']) ? $ct['st_price'] : "";

		                				?>
		                			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                				<div class="st-item-menu-box">
		                					<div class="image">
                                                <img src="<?php echo esc_url($st_image[0]);?>" alt="<?php echo esc_attr($title_st);?>" title="<?php echo esc_attr($title_st);?>" class="img-fluid">
                                            </div>
                                            <div class="caption">
                                            	<h4><?php echo esc_attr($title_st);?></h4>
                                            	<span><?php echo esc_attr($st_content);?></span>
                                            	<div class="price"><?php echo esc_attr($st_price);?></div>
                                            </div>
		                				</div>
		                			</div>
		                			<?php }?>
		                		</div>
		                	</div>
		                	<?php }?>
		                </div>
		            </div>
				</div> 
			</div>
		</div>
	</div>
</div>	