<?php extract(shortcode_atts(array(
    'st_images_icon'         => '',
    'sale_member'         => '',
    'id_package'         => '',
    'list_support'         => '',
  ), $attr));
$image_src = wp_get_attachment_image_src($st_images_icon,'full');
$support = vc_param_group_parse_atts($list_support);
$cls_packages = STAdminPackages::get_inst();
$packages = $cls_packages->get_packages_by_id($id_package);
if(isset($packages) && !empty($packages)){
	foreach ($packages as $key => $pack) {
		if(isset($pack->package_name)){
			$package_name =  $pack->package_name;
		} else{
			$package_name =  "";
		}
		if(isset($pack->package_name)){
			$package_price =  $pack->package_price;
		} else{
			$package_price =  0;
		}

		if(isset($pack->package_time)){
			$package_time =  $pack->package_time;
		} else{
			$package_time =  0;
		}
		$cls_packages = STAdminPackages::get_inst();
	}?>
	<div class="item-member-ship">
		<div class="item-st">
			<div class="icon-table">
				<?php
					if(isset($image_src) && !empty($image_src)){ ?>
						<img src="<?php echo esc_url($image_src[0]);?>" alt="">
					<?php }
				?>
			</div>
			<div class="title">
				<?php echo $package_name;?>
			</div>
			<div class="price">
				<span class="price">
					<span class="sign">$</span>
					<span class="currency"><?php echo esc_attr($package_price);?></span>
				</span>
			</div>
			<div class="time-packpage">
				<p><?php echo __("per ", ST_TEXTDOMAIN);?> <?php echo $cls_packages->convert_item($package_time, true); ?><?php echo __(" day", ST_TEXTDOMAIN);?></p>
			</div>
			<div class="pricingContent">
				<ul>
					<?php foreach($support as $sp){
						if(isset($sp["check"]) && !empty($sp["check"])){
							$icon = get_template_directory_uri().'/v2/images/ico_check.svg';
						} else{
							$icon = get_template_directory_uri().'/v2/images/ico_uncheck.svg';
						}
						?>
					<li><span><img src="<?php echo $icon;?>" alt=""></span><?php echo $sp["title_items"]?></li>
					<?php }?>
				</ul>
			</div>
			<div class="button-get">
				<div class="clearfix">
					<form action="" method="post">
						<input type ="hidden" name="package_new" value="<?php echo esc_attr( $pack->id ); ?>">
						<input type ="hidden" name="iconpackage_new" value="<?php echo esc_url($icon);?>">
						<input type ="hidden" name="package_encrypt_new" value="<?php echo TravelHelper::st_encrypt($pack->id); ?>">
						<input type="submit" name="add_cart_package_new" value="<?php echo __('GET STARTED', ST_TEXTDOMAIN); ?>" class="btn btn-get add_cart_package_new">
					</form>
				</div>
			</div>
		</div>
	</div>

<?php }
?>
