<?php
$logo_light = st()->get_option('hotel_alone_logo');
$custom_logo = get_post_meta(get_the_ID(),'custom_logo',true);
if($custom_logo == 'on'){
    $logo_light = get_post_meta(get_the_ID(),'logo_light',true);
}
$st_menu_color = '#000';
$class_color[] = Hotel_Alone_Helper::inst()->build_css('color:' . $st_menu_color . ' !important', ' > li > a ');
$menu = st()->get_option('st_hotel_alone_menu_location', 'no-menu');
if (isset($menu)) {
    if ($menu != 'no-menu' && is_nav_menu($menu)) {
        ?>
        <div class="content">
            <div class="logo">
                <a href="<?php echo esc_url(home_url('/')) ?>">
                    <?php
                    if (!empty($logo_light)) {
                        ?>
                        <img src="<?php echo esc_url($logo_light) ?>" alt="<?php esc_html_e("logo", ST_TEXTDOMAIN) ?>"/>
                    <?php } else { ?>
                        <h1><?php esc_html_e('Traveler', ST_TEXTDOMAIN) ?></h1>
                    <?php } ?>
                </a>
            </div>
            <div class="content-menu">
                <div class="menu-right">
                    <?php
                    if (!empty($menu)) {
                        if ($menu != 'no-menu' && is_nav_menu($menu)) {
                            $args = array(
                                'menu' => $menu,
                                'menu_class' => 'st_menu menu nav navbar-nav ' . implode(" ", $class_color),
                                'walker' => new Helios_Menu_Walker,
                            );
                            wp_nav_menu($args);
                        }
                    } ?>
                </div>
            </div>
        </div>
    <?php }
} ?>