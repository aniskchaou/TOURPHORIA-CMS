<?php
return;
$class_hide = Helios_Assets::inst()->build_css('display: none');
if(is_user_logged_in()){
    $current_user = wp_get_current_user();
    $user_email = $current_user->user_email;
    $my_account = $checkout_page =  '#';
    $number_cart = 0;
    if(class_exists('WPBooking_System')){
        $my_account = get_permalink( wpbooking_get_option('myaccount-page'));
        $checkout_page = get_permalink( wpbooking_get_option('checkout_page'));
        $checkout = WPBooking_Checkout_Controller::inst();
        $cart = $checkout->get_cart();
        if(!empty($cart)){
            $number_cart = 1;
        }
    }
    $name = $current_user->first_name." ".$current_user->last_name;
    if(empty($current_user->first_name) and empty($current_user->last_name)) $name = $current_user->display_name;
    $url_logout = wp_logout_url();
    ?>
    <li class="item-menu-mobile <?php echo esc_html($class_hide) ?>">
        <a href="#"><?php esc_html_e("My Account",'heliospress') ?></a>
        <ul class="dl-submenu">
            <li><a href="<?php echo esc_url($my_account) ?>"><i class="fa fa-user"></i> <?php echo esc_html($name) ?></a> </li>
            <li><a href="<?php echo esc_url($my_account.'/tab/edit_profile/') ?>"><i class="fa fa-cog"></i> <?php esc_html_e("Account settings",'heliospress') ?></a></li>
            <li><a href="<?php echo esc_html($checkout_page) ?>"><i class="fa fa-shopping-cart"></i> <?php esc_html_e("You cart",'heliospress') ?> <span class="text-color"> (<?php echo esc_html($number_cart) ?>)</span></a></li>
            <li><a href="<?php echo esc_html($url_logout) ?>"><i class="fa fa-power-off"></i> <?php esc_html_e("Log out",'heliospress') ?></a></li>
        </ul>
    </li>
<?php }else{
    $login_page = $register_page =  "#";
    if(class_exists('WPBooking_System')){
        $login_page = WPBooking_User::inst()->get_login_url();
        $register_page = WPBooking_User::inst()->get_login_url();
    }
    ?>
    <li class="item-menu-mobile <?php echo esc_html($class_hide) ?>">
        <a href="#"><?php esc_html_e("My Account",'heliospress') ?></a>
        <ul class="dl-submenu">
            <li>
                <a href="<?php echo esc_url($login_page) ?>">
                    <?php esc_html_e("Login",'heliospress') ?>
                </a>
            </li>
            <?php if(function_exists('wpbooking_is_any_register') and wpbooking_is_any_register()){ ?>
                <li>
                    <a href="<?php echo esc_url($register_page) ?>"><?php esc_html_e("Sing up for free",'heliospress') ?></a>
                </li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>
