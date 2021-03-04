<?php
/**
 *@since 1.3.1
 *@updated 1.3.1
 *    Template Name: Member Checkout Success New
 **/
$token = STInput::get('order_token_code','');
$status = STInput::get('status');

$admin_packages = STAdminPackages::get_inst();
$cls_packages = STPackages::get_inst();
$cls_packages->update_order($token, $status);
$get_order_by_token = $cls_packages->get_order_by_token($token);
if( !$get_order_by_token || !$admin_packages->enabled_membership() ){
    wp_redirect( home_url( '/' ) );
    exit();
}
get_header('member');
?>
<div id="st-content-wrapper" class="search-result-page package-page-st">
    <?php echo st()->load_template('layouts/template-banner-page'); ?>
    <div class="breadcrumb">
        <?php st_breadcrumbs_new(); ?>
    </div>
    <div class="gap"></div>
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-8">
                <div class="st-notice-success">
                    <?php 
                        if( $get_order_by_token->status === 'completed' || $get_order_by_token->status === 'incomplete' ): 
                    ?>
                    <div class="icon-success">
                        <img src="<?php echo get_template_directory_uri().'/v2/images/ico_success.svg';?>" alt="">
                    </div>
                    <div class="title-admin">
                        <p class="st-admin-success"><?php $userdata = get_userdata( $get_order_by_token->partner );echo$userdata->user_login; echo ', ';?> <span><?php echo __('your payment was successful!' , ST_TEXTDOMAIN );?></span></p>
                        <p class="st-text">
                            <?php echo __('Booking details has been sent to: ' , ST_TEXTDOMAIN );
                            $partner_info = unserialize($get_order_by_token->partner_info);
                            echo $partner_info['email'];  ?>   
                        </p>
                    </div>
                    <?php elseif( $get_order_by_token->status === 'canceled' ): ?>
                        <div class="icon-success">
                            <img src="<?php echo get_template_directory_uri().'/v2/images/ico_success.svg';?>" alt="">
                        </div>
                        <div class="title-admin">
                            <p class="st-admin-success"><?php $userdata = get_userdata( $get_order_by_token->partner );echo$userdata->user_login; echo ', ';  echo __('Your payment was not successful!' , ST_TEXTDOMAIN );?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sidebar-order">
                    <ul class="st-list-sider-info">
                        <li>
                            <p><strong><?php echo __('Booking Number: ',ST_TEXTDOMAIN);?></strong><span><?php echo esc_html($get_order_by_token->id); ?></span></p>
                        </li>
                        <li>
                            <p><strong><?php echo __('Booking Date: ',ST_TEXTDOMAIN);?></strong><span><?php echo date('Y/m/d', $get_order_by_token->created); ?></span></p>
                        </li>
                        <li>
                            <p><strong><?php echo __('Payment Method: ',ST_TEXTDOMAIN);?></strong><span><?php echo $cls_packages->convert_payment($get_order_by_token->gateway); ?></span></p>
                        </li>
                        <li>
                            <p><strong><?php echo __('Status: ',ST_TEXTDOMAIN);?></strong>
                                <?php
                                    $status  = esc_attr($get_order_by_token->status);
                                    if( $status == 'incomplete'){
                                        echo '<span class="order-status warning">'. $status . '</span>';
                                    }elseif($status == 'completed'){
                                        echo '<span class="order-status success">'. $status . '</span>';
                                    }elseif($status == 'cancelled'){
                                        echo '<span class="order-status danger">'. $status . '</span>';
                                    } ?>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 60px;">
        <div class="row">
            <div class="col-md-8">
                <div class="st-title-yourinfor">
                    <div class="title">
                        <h2><?php echo __('Your Information',ST_TEXTDOMAIN);?></h2>
                    </div>
                    <div class="st-table-infor">
                        <?php 
                        $partner_info = $get_order_by_token->partner_info;
                        if( !empty($partner_info) ):
                            $partner_info = unserialize($partner_info);?>
                        <table cellpadding="0" cellspacing="0" width="100%" border="0px" class="mb30 tb_cart_customer">
                            <tbody>
                                <tr>
                                    <td align="left" width="50%">
                                        <strong><?php echo __('First name' , ST_TEXTDOMAIN) ;  ?></strong></td>
                                    <td align="left" class="text-left">
                                        <?php echo esc_attr($partner_info['firstname'] ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" width="50%">
                                        <strong><?php echo __('Last name' , ST_TEXTDOMAIN) ;  ?></strong></td>
                                    <td align="left" class="text-left">
                                        <?php echo esc_attr($partner_info['lastname'] ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" width="50%">
                                        <strong><?php echo __('Email' , ST_TEXTDOMAIN) ;  ?></strong></td>
                                    <td align="left" class="text-left">
                                        <?php echo esc_attr($partner_info['email'] ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" width="50%">
                                        <strong><?php echo __('Phone' , ST_TEXTDOMAIN) ;  ?></strong></td>
                                    <td align="left" class="text-left">
                                        <?php echo esc_attr($partner_info['phone'] ); ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php endif; ?>
                        <?php 
                        if (is_user_logged_in()):
                            $page_user = st()->get_option('page_my_account_dashboard');
                            if ($link = get_permalink($page_user)):
                                $link=esc_url(add_query_arg(array('sc'=>'setting'),$link));?>
                                <div class="text-center mg20">
                                    <a href="<?php echo esc_url($link)?>" class="btn btn-primary">
                                        <i class="fa fa-book"></i> 
                                        <?php echo __('Partner Infomation' , ST_TEXTDOMAIN) ;  ?>
                                    </a>
                                </div>
                            <?php endif;
                        endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                
                <div class="st-title-yourinfor st-sidebar-package"> 
                    <h2><?php echo __('Your Item',ST_TEXTDOMAIN);?></h2>
                </div>
                <div class="sidebar-you-item">
                    <div class="infor-your-item">
                        <p><strong><?php echo __('Package:' , ST_TEXTDOMAIN ) ;  ?></strong> <span class="color-main uppercase"><?php echo $get_order_by_token->package_name; ?></span></p>
                        <p><strong><?php echo __('Time Available:' , ST_TEXTDOMAIN ) ;  ?></strong> <?php echo $admin_packages->convert_item($get_order_by_token->package_time, true); ?></p>
                        <p><strong><?php echo __('Commission:', ST_TEXTDOMAIN) ?></strong> <?php echo $get_order_by_token->package_commission . '%'; ?></p>
                        <p><strong><?php echo __('No. Items can upload:', ST_TEXTDOMAIN) ?></strong> <?php echo $get_order_by_token->package_item_upload; ?></p>
                        <p><strong><?php echo __('No. Items can set featured:', ST_TEXTDOMAIN) ?></strong> <?php echo $get_order_by_token->package_item_featured; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer('member');