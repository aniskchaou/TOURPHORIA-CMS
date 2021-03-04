<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('tour-modern-page'); ?>>
<header id="header" class="">
    <div class="container">
        <?php
        $enable_topbar = st()->get_option('enable_topbar', 'on');
        if ($enable_topbar == 'on') {
            ?>
            <div id="topbar">
                <?php
                $sort_topbar_menu = st()->get_option('tour_modern_topbar_menu', false);
                if ($sort_topbar_menu) {
                    ?>
                    <div class="left-panel">
                        <ul class="topbar-items">
                            <?php
                            foreach ($sort_topbar_menu as $key => $val) {
                                if (!empty($val['topbar_item']) && $val['topbar_position'] == 'left') {
                                    if ($val['topbar_item'] == 'link') {
                                        echo '<li class="topbar-item"><a href="' . esc_url($val['topbar_custom_link']) . '">';
                                        $icon = $val['topbar_custom_link_icon'];
                                        if (!empty($icon)) {
                                            echo '<img class="topbar-icon" class="img-responsive" src="' . esc_attr($icon) . '">';
                                        }
                                        echo esc_html($val['topbar_custom_link_title']);
                                        echo '</a></li>';
                                    } else {
                                        if ($val['topbar_item'] == 'login') {
                                            echo st()->load_template('layouts/modern/common/header/topbar-items/login', '');
                                        }
                                        if ($val['topbar_item'] == 'currency') {
                                            echo st()->load_template('layouts/modern/common/header/topbar-items/currency', '');
                                        }
                                        if ($val['topbar_item'] == 'language') {
                                            echo st()->load_template('layouts/modern/common/header/topbar-items/language', '');
                                        }
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php }
                ?>
                <?php
                $sort_topbar_menu = st()->get_option('tour_modern_topbar_menu', false);
                if ($sort_topbar_menu) {
                    ?>
                    <div class="right-panel">
                        <ul class="topbar-items">
                            <?php
                            foreach ($sort_topbar_menu as $key => $val) {
                                if (!empty($val['topbar_item']) && $val['topbar_position'] == 'right') {
                                    if ($val['topbar_item'] == 'link') {
                                        echo '<li class="topbar-item"><a class="topbar-item" href="' . esc_url($val['topbar_custom_link']) . '">';
                                        $icon = $val['topbar_custom_link_icon'];
                                        if (!empty($icon)) {
                                            echo '<img class="topbar-icon" class="img-responsive" src="' . esc_attr($icon) . '">';
                                        }
                                        echo esc_html($val['topbar_custom_link_title']);
                                        echo '</a></li>';
                                    } else {
                                        $icon = $val['topbar_custom_link_icon'];
                                        if (!empty($icon)) {
                                            echo '<img class="topbar-icon" class="img-responsive" src="' . esc_attr($icon) . '">';
                                        }
                                        if ($val['topbar_item'] == 'login') {
                                            echo st()->load_template('layouts/modern/common/header/topbar-items/login', '');
                                        }
                                        if ($val['topbar_item'] == 'currency') {
                                            echo st()->load_template('layouts/modern/common/header/topbar-items/currency', '');
                                        }
                                        if ($val['topbar_item'] == 'language') {
                                            echo st()->load_template('layouts/modern/common/header/topbar-items/language', '');
                                        }
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        <?php }
        ?>
        <div id="nav-menu">
            <div class="left-panel">
                <a href="<?php echo home_url('/'); ?>" id="logo">
                    <?php
                    $logo_light = st()->get_option('logo_new');
                    if (!empty($logo_light) && isset($logo_light)) {
                        ?>
                        <img src="<?php echo esc_url($logo_light) ?>" alt="<?php esc_html_e("logo", ST_TEXTDOMAIN) ?>"/>
                    <?php } else { ?>
                        <?php bloginfo('name') ?>
                    <?php } ?>
                </a>
                <nav id="st-main-menu">
                    <a href="" class="back-menu"><i class="fa fa-angle-left"></i></a>
                    <?php
                    if (has_nav_menu('primary')) {
                        $mega_menu = st()->get_option('allow_megamenu', 'off');
                        if ($mega_menu == 'on') {
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                "container" => "",
                                'items_wrap' => '<ul id="main-menu" class="%2$s main-menu">%3$s</ul>',
                                'depth' => 10,
                                'walker' => new ST_Mega_Menu_Walker_New(),
                            ));
                        } else {
                            wp_nav_menu([
                                'theme_location' => 'primary',
                                "container" => "",
                                'items_wrap' => '<ul id="main-menu" class="%2$s main-menu">%3$s</ul>',
                                'walker' => new st_menu_walker_new(),
                            ]);
                        }
                    }
                    ?>
                </nav>
            </div>
            <div class="right-panel">
                <ul class="st-list">
                    <?php echo st()->load_template('layouts/modern/common/header/topbar-items/search', ''); ?>
                    <?php
                    $st_is_woocommerce_checkout = apply_filters('st_is_woocommerce_checkout', false);
                    $menu_style = st()->get_option('menu_style_modern', "");
                    $color_cart = '';
                    $stroke_cart = false;
                    if ($menu_style == '2') {
                        $color_cart = '#fff';
                        $stroke_cart = true;
                    }
                    if ($st_is_woocommerce_checkout and function_exists('WC')) {
                        $cart_url = wc_get_cart_url();
                        $cart_total_item = (int)WC()->cart->get_cart_contents_count();
                        $cart_total_amount = WC()->cart->get_cart_subtotal();
                        ?>
                        <li class="dropdown dropdown-minicart">
                            <div id="d-minicart" class="mini-cart" data-toggle="dropdown" aria-haspopup="true"
                                 aria-expanded="false">
                                <?php if ($cart_total_item > 0) { ?>
                                    <div class="cart-caret"><?php echo esc_html($cart_total_item) ?></div>
                                <?php } ?>
                                <img src="<?php echo get_template_directory_uri() . '/v2/images/svg/cart_tour.svg'; ?>"
                                     alt="<?php echo TravelHelper::get_alt_image() ?>">
                            </div>
                            <ul class="dropdown-menu" aria-labelledby="d-minicart">
                                <li class="heading">
                                    <h4 class="st-heading-section"><?php echo esc_html__('Your Cart', ST_TEXTDOMAIN) ?></h4>
                                </li>
                                <?php
                                $items = WC()->cart->get_cart();
                                if (!empty($items)):
                                    foreach ($items as $item => $values):
                                        $_product = wc_get_product($values['data']->get_id());
                                        $post_id = (int)get_post_meta($_product->get_id(), '_st_booking_id', true);

                                        $post_title = $_product->get_title();
                                        if (get_post_type($post_id) == 'st_hotel') {
                                            $room_id = (int)get_post_meta($_product->get_id(), 'room_id', true);
                                            $post_title = get_the_title($room_id);
                                        }
                                        $quantity = (int)$values['quantity'];
                                        $price = (float)$values['line_total'];
                                        $tax = (float)$values['line_tax'];
                                        $price = $price + $tax;
                                        ?>
                                        <li class="cart-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <?php
                                                    if (has_post_thumbnail($post_id)) {
                                                        echo get_the_post_thumbnail($post_id, 'thumbnail', array('class' => 'img-responsive media-object', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($post_id))));
                                                    }
                                                    ?>
                                                </div>
                                                <div class="media-body">
                                                    <?php
                                                    if (get_post_type($post_id) == 'st_hotel '):
                                                        $room_id = (int)get_post_meta($_product->ID, 'room_id', true);
                                                        ?>
                                                        <h4 class="media-heading"><a class="st-link c-main"
                                                                                     href="<?php echo get_the_permalink($room_id) ?>"><?php echo $post_title; ?></a>
                                                        </h4>
                                                    <?php else: ?>
                                                        <h4 class="media-heading"><a class="st-link c-main"
                                                                                     href="<?php echo get_the_permalink($post_id) ?>"><?php echo $post_title; ?></a>
                                                        </h4>
                                                    <?php endif; ?>
                                                    <div class="price-wrapper"><?php echo __('Price', ST_TEXTDOMAIN) ?>:
                                                        <span class="price"><?php echo TravelHelper::format_money($price); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                    <li class="cart-total">
                                        <div class="sub-total"><?php echo __('Subtotal', ST_TEXTDOMAIN) ?> <span
                                                    class="price"><?php echo $cart_total_amount; ?></span>
                                        </div>
                                        <a href="<?php echo add_query_arg(['action' => 'st-remove-cart', 'security' => wp_create_nonce('st-security')]); ?>"
                                           class="btn btn-danger btn-full upper">
                                            <?php echo __('Remove Cart', ST_TEXTDOMAIN) ?>
                                        </a>
                                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('checkout'))) ?>"
                                           class="btn btn-green btn-full upper mt10"><?php echo __('Check Out', ST_TEXTDOMAIN) ?></a>
                                    </li>
                                <?php
                                else:
                                    ?>
                                    <div class="col-lg-12 cart-text-empty text-warning"><?php echo __('Your cart is empty', ST_TEXTDOMAIN); ?></div>
                                <?php
                                endif;
                                ?>
                            </ul>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="dropdown dropdown-minicart">
                            <?php
                            $check_out_url = (int)st()->get_option('page_checkout', '');
                            $check_out_url = get_permalink($check_out_url);
                            $cart_total_item = (int)STCart::count();
                            $cart_total_amount = (float)(STCart::check_cart()) ? STPrice::getTotal() : 0;
                            $post_id_global = 0;
                            ?>
                            <div id="d-minicart" class="mini-cart" data-toggle="dropdown" aria-haspopup="true"
                                 aria-expanded="false">
                                <?php if ($cart_total_item > 0) { ?>
                                    <div class="cart-caret"><?php echo esc_html($cart_total_item) ?></div>
                                <?php } ?>
                                <img src="<?php echo get_template_directory_uri() . '/v2/images/svg/cart_tour.svg'; ?>"
                                     alt="<?php echo TravelHelper::get_alt_image() ?>">
                            </div>
                            <ul class="dropdown-menu" aria-labelledby="d-minicart">
                                <li class="heading">
                                    <h4 class="st-heading-section"><?php echo esc_html__('Your Cart', ST_TEXTDOMAIN) ?></h4>
                                </li>
                                <?php
                                if (STCart::check_cart()):
                                    $items = STCart::get_carts();

                                    foreach ($items as $post_id => $value):
                                        $post_id_global = $post_id;
                                        $post_title = get_the_title($post_id);
                                        if (get_post_type($post_id) == 'st_hotel') {
                                            $room_id = (int)$value['data']['room_id'];
                                            $post_title = get_the_title($room_id);
                                        }
                                        $quantity = (int)count($items);
                                        $price = (float)STPrice::getTotal();
                                        ?>
                                        <li class="cart-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <?php
                                                    if (has_post_thumbnail($post_id)) {
                                                        echo get_the_post_thumbnail($post_id, [70, 70], ['class' => 'media-object', 'alt' => TravelHelper::get_alt_image()]);
                                                    }
                                                    ?>
                                                </div>
                                                <div class="media-body">
                                                    <?php
                                                    if (get_post_type($post_id) == 'st_hotel'):
                                                        $room_id = (int)$value['data']['room_id'];
                                                        ?>
                                                        <h4 class="media-heading"><a class="st-link c-main"
                                                                                     href="<?php echo get_the_permalink($room_id) ?>"><?php echo $post_title; ?></a>
                                                        </h4>
                                                    <?php else: ?>
                                                        <h4 class="media-heading"><a class="st-link c-main"
                                                                                     href="<?php echo get_the_permalink($post_id) ?>"><?php echo $post_title; ?></a>
                                                        </h4>
                                                    <?php endif; ?>
                                                    <div class="price-wrapper"><?php echo __('Price', ST_TEXTDOMAIN) ?>:
                                                        <span class="price"><?php echo TravelHelper::format_money($price); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?php echo add_query_arg(['action' => 'st-remove-cart', 'security' => wp_create_nonce('st-security')]); ?>"
                                               class="cart-delete-item"><i class="fa">
                                                    <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <g id="Menu" stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd"
                                                           stroke-linecap="round" stroke-linejoin="round">
                                                            <g id="Menu-Mega"
                                                               transform="translate(-1355.000000, -383.000000)"
                                                               stroke="#A0A9B2">
                                                                <g id="cart"
                                                                   transform="translate(1120.000000, 130.000000)">
                                                                    <g id="hotel"
                                                                       transform="translate(0.000000, 198.000000)">
                                                                        <g id="Group"
                                                                           transform="translate(236.000000, 56.000000)">
                                                                            <g id="bin-1">
                                                                                <path d="M0,2 L14,2" id="Shape"></path>
                                                                                <path d="M8.5,0 L5.5,0 C4.94771525,0 4.5,0.44771525 4.5,1 L4.5,2 L9.5,2 L9.5,1 C9.5,0.44771525 9.05228475,0 8.5,0 Z"
                                                                                      id="Shape"></path>
                                                                                <path d="M5.5,10.5 L5.5,5.5"
                                                                                      id="Shape"></path>
                                                                                <path d="M8.5,10.5 L8.5,5.5"
                                                                                      id="Shape"></path>
                                                                                <path d="M11.5766667,13.0826667 C11.5336578,13.6011549 11.100269,14.0000465 10.58,14 L3.42066667,14 C2.9003977,14.0000465 2.4670089,13.6011549 2.424,13.0826667 L1.5,2 L12.5,2 L11.5766667,13.0826667 Z"
                                                                                      id="Shape"></path>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </i></a>
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                    <li class="cart-total">
                                        <div class="sub-total"><?php echo __('Subtotal', ST_TEXTDOMAIN) ?> <span
                                                    class="price"><?php echo TravelHelper::format_money($cart_total_amount); ?></span>
                                        </div>
                                        <a href="<?php echo esc_url($check_out_url) ?>"
                                           class="btn btn-green btn-full upper"><?php echo __('Check Out', ST_TEXTDOMAIN) ?></a>
                                    </li>
                                <?php
                                else:
                                    ?>
                                    <div class="col-lg-12 cart-text-empty text-warning"><?php echo __('Your cart is empty', ST_TEXTDOMAIN); ?></div>
                                <?php
                                endif;
                                ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</header>