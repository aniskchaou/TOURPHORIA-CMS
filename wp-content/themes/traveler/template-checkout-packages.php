<?php
/**
 *@since 1.3.1
 *@updated 1.3.1
 *    Template Name: Member Packages Checkout
 **/
$admin_packages = STAdminPackages::get_inst();
if( !$admin_packages->enabled_membership() ){
    wp_redirect( home_url( '/' ) );
    exit();
}
get_header();

$cls_package = STAdminPackages::get_inst();
$package = $cls_package->get_cart();
?>
<div class="gap"></div>
<?php if (!$package): ?>
    <div class="row">
        <div class="container">
            <div class="col-xs-12 col-sm-8">
                <div class="alert alert-danger">
                    <p><?php esc_html_e('Sorry! Your cart is currently empty.','traveler') ?></p>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4 col-md-push-8">
            <h4 class="mt20"><?php echo __('Your Member Package', ST_TEXTDOMAIN); ?></h4>
            <div class="package-cart mb20">
                <div class="cart-head">
                    <h4>
                        <?php echo esc_html( $package->package_name); ?>
                        <i class="fa fa-users pull-right"></i>
                    </h4>
                </div>
                <div class="cart-content">
                    <h5><?php echo __('Package Information', ST_TEXTDOMAIN); ?></h5>
                    <div class="item">
                        <span><?php echo __('Time Available', ST_TEXTDOMAIN); ?></span>
                        <span class="pull-right"><?php echo $cls_package->convert_item($package->package_time, true); ?></span>
                    </div>
                    <div class="item">
                        <span><?php echo __('Commission', ST_TEXTDOMAIN); ?></span>
                        <span class="pull-right"><?php echo (int) $package->package_commission. '%'; ?></span>
                    </div>
                    <div class="item">
                        <span><?php echo __('Items can upload', ST_TEXTDOMAIN) ?></span>
                        <span class="pull-right"><?php echo (int) $package->package_item_upload; ?></span>
                    </div>
                    <div class="item">
                        <span><?php echo __('Items can set featured', ST_TEXTDOMAIN) ?></span>
                        <span class="pull-right"><?php echo (int) $package->package_item_featured; ?></span>
                    </div>
                    <div class="item">
                        <span><?php echo __('Services', ST_TEXTDOMAIN) ?></span>
                        <span class="pull-right"><?php echo $cls_package->paser_list_services($package->package_services); ?></span>
                    </div>
                </div>
                <div class="cart-footer">
                    <span> <strong><?php echo __('PAY AMOUNT', ST_TEXTDOMAIN); ?></strong></span>
                    <span class="pull-right"><strong><?php echo TravelHelper::format_money((float)$package->package_price); ?></strong></span>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-8 col-md-pull-4">
            <div class="row row-wrap">
                <div class="col-md-12">
                    <div class="entry-content">
                        <?php
                            while (have_posts()) {
                                the_post();
                                the_content();
                            }
                        ?>
                    </div>
                    <form id="mpk-form" class="" method="post">
                        <?php echo st()->load_template('check_out/member_packages') ?>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
endif;
get_footer();