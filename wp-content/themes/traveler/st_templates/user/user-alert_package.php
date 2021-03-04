<?php 
  $user_link = st()->get_option('page_my_account_dashboard');
  $user_link = get_permalink( $user_link  );
?>
<div class="alert-user-package user-alert open">
  <div class="alert-header clearfix">
    <a href="#!" class="alert-close"><i class="fa fa-times"></i></a>
  </div>
  <div class="alert-content text-center">
    <img src="<?php echo get_template_directory_uri(); ?>/img/user/user-alert-package.jpg" alt="<?php echo TravelHelper::get_alt_image(); ?>" class="img-responsive">
    <h2 class="color-main mt30 text-center"><?php echo __('Partner Information', ST_TEXTDOMAIN) ?></h2>
    <p class="text-center"><?php echo __('Your member package is expired.', ST_TEXTDOMAIN) ?></p>
    <p class="text-center"><?php echo __('Please check it in', ST_TEXTDOMAIN) ?> <a href="<?php echo TravelHelper::get_user_dashboared_link( $user_link, 'setting') ?>"><?php echo __('Settings', ST_TEXTDOMAIN) ?></a> <?php echo __('or upgrade now!', ST_TEXTDOMAIN) ?></p>
    <?php 
      $admin_packages = STAdminPackages::get_inst();
    ?>
    <a href="<?php echo $admin_packages->register_member_page(); ?>" class="btn btn-primary mt20"><?php echo __('Upgrade Now', ST_TEXTDOMAIN) ?></a>
  </div>
</div>
<div class="alert-overlay open"></div>