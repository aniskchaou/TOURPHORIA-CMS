<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
    <script type="text/javascript">
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>
</head>
<body <?php body_class('hotel-single'); ?>>
<?php
$enable_preload = st()->get_option('search_enable_preload', 'on');
$st_menu_color = st()->get_option('st_hotel_alone_menu_color','#ffffff');
$st_menu_bottom_line = st()->get_option('st_menu_bottom_line','off');
if($st_menu_bottom_line == 'on') $st_menu_bottom_line = 'show_buttom_line';
$class_color[] = Hotel_Alone_Helper::inst()->build_css('color:'.$st_menu_color.' !important',' > li > a ');
$class_color[] = $st_menu_bottom_line;
if ($enable_preload == 'on' && !TravelHelper::is_service_search()) {
    echo st()->load_template('search-loading');
}
$logo_light = st()->get_option('hotel_alone_logo');
 $st_contact_number = st()->get_option('st_hotel_activity_topbar_contact_number');

$redirect_to_your_book = "";
$page_book_your = st()->get_option( 'st_hotel_alone_room_search_page' );
if ( $page_book_your ) {
    $redirect_to_your_book = get_permalink( $page_book_your );
}
 $menu = st()->get_option('st_hotel_alone_menu_location', 'no-menu');
?>
<header id="header" class="">
    <div class="header-content top-bar-no" data-offset="0">
        <div class="background-scroll"></div>
        <div class="control-left">
            <div class="content-menu hide_scroll">
                <div class="option-item">
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')) ?>">
                            <?php
                            if(!empty($logo_light) && isset($logo_light)){
                                ?>
                                <img src="<?php echo esc_url($logo_light) ?>" alt="<?php esc_html_e("logo",ST_TEXTDOMAIN) ?>" />
                            <?php }else{ ?>
                                <h3 style="padding: 8px 0px;"><?php bloginfo('name') ?></h3>
                            <?php } ?>
                        </a>
                    </div>
                </div>
                <div class="menu-left">
                    <?php
                   
                    if ( !empty($menu) ) {
                        // $args = array(
                        //     'menu' => $menu,
                        //     'menu_class'      => 'st_menu menu nav navbar-nav '.implode(" ",$class_color),
                        //     'walker'          => new Helios_Menu_Walker,
                        // );
                        $args = array(
                            'menu' => $menu,
                            'menu_class'      => 'nav et_disable_top_tier '.implode(" ",$class_color),
                            // 'walker'          => new Helios_Menu_Walker,
                        );
                        wp_nav_menu($args);
                    }?>
                   
                </div>
            </div>
        </div>
        <div class="control-right">
            <div class="option-item">
                <div class="option-mid">
                   <div class="location-phone">
                       <span class="icon">
                            <img src="<?php echo get_template_directory_uri()."/v2/images/assets/phone-dial.svg";?>" alt="<?php esc_html_e("logo",ST_TEXTDOMAIN) ?>" />
                        </span>
                        <a href="" title="">
                            <span class="number-phone">
                                <?php if(!empty($st_contact_number) && isset($st_contact_number)){
                                    echo esc_attr($st_contact_number);
                                }else{?>
                                   1800 5678
                               <?php }?>
                            </span>
                        </a>
                   </div>
                </div>
            </div>
            <?php if ( function_exists( 'icl_get_languages' ) ) {
                    $langs = icl_get_languages( 'skip_missing=0' );
                } else {
                    $langs = [];
                }
                if ( !empty( $langs ) ) {
            ?>
            <div class="option-item padding-0 st-check-lang">
                <div class="option-mid">
                    <div class="dropdown">
                        <ul class="st-list">
                            <?php  echo st()->load_template( 'layouts/modern/common/header/topbar-items/language', '' , array('show_code' => true));?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php }?>
            
            <div class="option-item">
                <div class="option-mid book-your-tay">
                   <a title="" class="btn btn-white sts-popup" href="#sts-search-popup" data-effect="mfp-zoom-in"><?php echo esc_html__('BOOK YOUR STAY',ST_TEXTDOMAIN);?></a>
                </div>
            </div>
        </div>
    </div>
</header><!-- /header -->
<div class="header-mobile">
    <div class="helios-navbar-header">
        <div class="control-left">
            <a href="#" class="toggle-menu"><?php echo TravelHelper::getNewIcon('Ico_off_menu'); ?></a>
            <div class="header-left">
                <a href="<?php echo home_url( '/' ) ?>" class="logo">
                <?php
                    $logo = st()->get_option('logo_mobile');
                    if(empty($logo)){
                        $logo = st()->get_option('hotel_alone_logo');
                    }
                    if(!empty($logo)){
                        ?>
                        <img class="logo" src="<?php echo esc_url($logo) ?>" alt="<?php echo get_bloginfo( 'description' ); ?>" />
                    <?php }else{ ?>
                        <h1><?php esc_html_e('Traveler',ST_TEXTDOMAIN) ?></h1>
                    <?php } ?>
                </a>
                <nav id="st-main-menu">
                    <div class="st-menu-ccv">
                        <a href="" class="back-menu"><i class="fa fa-angle-left"></i></a>
                        <?php
                        if(!empty($menu)){
                             wp_nav_menu(array(
                                'menu' => $menu,
                                "container" => "",
                                'items_wrap' => '<ul id="main-menu" class="%2$s main-menu">%3$s</ul>',
                                'depth' => 10,
                                'walker' => new Single_Nav_Mainmenu(),
                            ));
                        }
                        ?>
                    </div>
                    
                </nav>
                
            </div>
            <div class="dropdown">
                <ul class="st-list">
                    <?php  echo st()->load_template( 'layouts/modern/common/header/topbar-items/language-single', '' , array('show_code' => true));?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="white-popup mfp-with-anim mfp-hide sts-popup-search-form" id="sts-search-popup">
    <?php
    $attr = array(
        'title' => __('BOOK YOUR STAY', ST_TEXTDOMAIN)
    );
    echo st()->load_template('layouts/modern/single_hotel/elements/check_availability', '', array('attr' => $attr));
    ?>
</div>