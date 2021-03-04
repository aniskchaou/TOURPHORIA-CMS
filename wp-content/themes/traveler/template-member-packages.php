<?php
/**
 * Template Name: Member Packages
 *@since 1.3.1
 **/
$admin_packages = STAdminPackages::get_inst();
$user_id = get_current_user_id();
$can_upgrade = $admin_packages->can_upgrade($user_id);

if ((!$can_upgrade) && (!$admin_packages->user_can_register_package($user_id) || !$admin_packages->enabled_membership())) {
    wp_redirect( home_url( '/' ) );
    exit();
}

get_header();
while (have_posts()): the_post();
    ?>
	<div class="container mt30">
		<div class="row">
			<div class="col-xs-12">
				<?php echo STTemplate::message(); ?>
			</div>
			<div class="col-xs-12">
				<h3><?php the_title();?></h3>
				<div class="mt20"><?php the_content();?></div>
			</div>
		</div>
		<div class="row mt50">
			<div class="col-xs-12">
				<div class="packages-heading">
					<i class="fa fa-users"></i>
                    <h4 class="membership-title">
                        <?php echo esc_html('membership', ST_TEXTDOMAIN); ?>
                        <span><?php echo esc_html('Package', ST_TEXTDOMAIN); ?></span>
                    </h4>
				</div>
				<div class="clearfix mb50">
					<?php 
						//=== Get list of packages
						$cls_packages = STAdminPackages::get_inst();
						$packages = $cls_packages->get_packages('', '1');
						$order = $admin_packages->get_order_by_partner($user_id);
						if($order){
							$packages = $admin_packages->can_upgrade($user_id);
						}
						if( !empty($packages)):
							foreach( $packages as $key => $val):
					?>
					<div class="package-item">
						<div class="package-head">
							<h2 class="text-center"><?php echo esc_html( $val->package_name ); ?></h2>
							<div class="des text-center f13"><?php echo esc_html($val->package_subname ); ?></div>
						</div>
						<div class="package-content">
							<div class="price">
								<span class="pre"><?php echo TravelHelper::format_money((float)$val->package_price); ?></span>
							</div>
							<div class="list-featured">
								<div class ="featured-item"><i class="fa fa-check"></i><strong><?php echo $cls_packages->convert_item($val->package_time, true); ?></strong></div>
								<div class ="featured-item"><i class="fa fa-check"></i><strong><?php echo (float) $val->package_commission . '%'; ?></strong> <?php echo __('Commission', ST_TEXTDOMAIN); ?></div>
								<div class="featured-item"><i class="fa fa-check"></i><strong><?php echo $cls_packages->convert_item($val->package_item_upload); ?></strong> <?php echo __('can upload', ST_TEXTDOMAIN) ?></div>
								<div class="featured-item"><i class="fa fa-check"></i><strong><?php echo $cls_packages->convert_item($val->package_item_featured); ?></strong> <?php echo __('can set featured', ST_TEXTDOMAIN) ?></div>
                                <div class="featured-item"><i class="fa fa-check"></i><strong><?php echo __('Service: ', ST_TEXTDOMAIN); ?></strong>
                                    <?php echo $cls_packages->paser_list_services($val->package_services); ?>
                                </div>
							</div>
							<div class="package-des">
								<?php echo balancetags( $val->package_description ); ?>
								<div class="clearfix">
									<form action="" method="post">
									<input type ="hidden" name="package" value="<?php echo esc_attr( $val->id ); ?>">
									<input type ="hidden" name="package_encrypt" value="<?php echo TravelHelper::st_encrypt($val->id); ?>">
										<input type="submit" name="add_cart_package" value="<?php echo __('Select', ST_TEXTDOMAIN); ?>" class="btn btn-default select-package">
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php endwhile;
get_footer();?>


