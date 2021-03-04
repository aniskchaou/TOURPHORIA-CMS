<?php

if (!function_exists('st_sc_custom_meta')) {
    function st_sc_custom_meta($attr, $content = false)
    {
        $data = shortcode_atts(
            array(
                'key' => ''
            ), $attr, 'st_custom_meta');
        extract($data);
        if (!empty($key)) {
            $data = get_post_meta(get_the_ID(), $key, true);
            return balanceTags($data);
        }

    }

    st_reg_shortcode('st_custom_meta', 'st_sc_custom_meta');
}
if (!function_exists('st_sc_admin_email')) {
    function st_sc_admin_email()
    {
        return '<a class="contact_admin_email" href="mailto:' . get_bloginfo('admin_email') . '" ><i class="fa fa-envelope-o"></i>  ' . get_bloginfo('admin_email') . "</a>";
    }

    st_reg_shortcode('admin_email', 'st_sc_admin_email');
}
if (!function_exists('st_sc_languages_select')) {
    function st_sc_languages_select()
    {
        return st()->load_template("menu/language_select", null, array('container' => "div", "class" => "top-user-area-lang nav-drop"));
    }

    st_reg_shortcode('languages_select', 'st_sc_languages_select');
}
if (!function_exists('st_sc_social')) {
    function st_sc_social($attr)
    {
        $data = shortcode_atts(
            array(
                'name' => '',
                'link' => ''
            ), $attr, 'social_link'
        );
        extract($data);
        if (!empty($name)) {
            switch ($name) {
                case 'facebook':
                    $icon = "fa fa-facebook";
                    break;
                case 'twitter':
                    $icon = "fa fa-twitter";
                    break;
                case 'youtube':
                    $icon = "fa fa-youtube-play";
                    break;
                default:
                    # code...
                    break;
            }
            return "<a class='top_bar_social' href='" . $link . "'><i class='" . $icon . "'></i></a>";
        }
    }

    st_reg_shortcode('social_link', 'st_sc_social');
}
if (!function_exists('st_sc_login_select')) {
    function st_sc_login_select()
    {
        return st()->load_template("menu/login_select", null, array('container' => "div"));
    }

    st_reg_shortcode('login_select', 'st_sc_login_select');
}
if (!function_exists('st_sc_currency_select')) {
    function st_sc_currency_select()
    {
        return st()->load_template("menu/currency_select", null, array('container' => "div"));
    }

    st_reg_shortcode('currency_select', 'st_sc_currency_select');
}



if (!function_exists('st_custom_menu')) {
    function st_custom_menu($arg, $content = null)
    {
        $data = shortcode_atts(array(
            'title' => "",
            'menu' => "",
        ), $arg, 'st_custom_menu');
        extract($data);

        $menu_obj = wp_get_nav_menu_object($menu);

        $html = '';

        if(!empty($menu_obj)) {
            $nav_menu_args = array(
                'fallback_cb' => '',
                'menu' => $menu_obj->term_id,
                'container' => 'div',
                'echo' => false,
                'container_class' => 'widget widget_nav_menu'
            );

            $html = wp_nav_menu($nav_menu_args);
        }
        return $html;
    }

    st_reg_shortcode('st_custom_menu', 'st_custom_menu');
}

if (!function_exists('st_cancellation')) {
    function st_cancellation($arg)
    {
        if (is_singular()) {
            $default = array(
                'title' => '',
                'font_size' => '3',
            );
            extract(wp_parse_args($arg, $default));


            $cancel_policy = get_post_meta(get_the_ID(), 'st_allow_cancel', true);
            $html = '<div class="st-cancel-data">';
            if ($cancel_policy == 'on'):
                if (empty($font_size)) $font_size = '3';
                if (!empty($title)) {
                    $html .= '<h'. esc_attr($font_size) .'>'. esc_html($title) .'</h'. esc_attr($font_size) .'>';
                }
                ?>
                <p>
                    <?php
                    $cancel_policy_day = get_post_meta(get_the_ID(), 'st_cancel_number_days', true);
                    $cancel_policy_amount = get_post_meta(get_the_ID(), 'st_cancel_percent', true);
                    $html .= sprintf(__('Cancellation within %s Day(s) before the date of arrival %s%s will be charged.', ST_TEXTDOMAIN), $cancel_policy_day, $cancel_policy_amount, '%');
                    ?>
                </p>
                <?php
            endif;
            $html .= '</div>';
            return $html;
        }
        return false;
    }
}
st_reg_shortcode('st_cancellation', 'st_cancellation');


if(!function_exists('st_shortcode_lists')){
    function st_shortcode_lists($atts, $content = false){
        return '<div class="st-list">'.wpb_js_remove_wpautop($content,true).'</div>';
    }
    st_reg_shortcode('st_lists', 'st_shortcode_lists');
}


if(!function_exists('st_vc_hotel_more_info')){
    function st_vc_hotel_more_info($atts, $content = false){
        $output = $extra_class = $title = $style = $icon = '';
        extract(shortcode_atts(array(
            'style' => 'style-1',
            'icon' => '',
            'title' => '',
            'extra_class' => ''
        ),$atts));
        $output .= '<div class="st-more-info '.$style.' '.$extra_class.'">';
        $output .= st()->load_template('hotel/elements/more-information',false, array(
            'icon' => $icon,
            'style' => $style,
            'title' => $title,
            'content' => wpb_js_remove_wpautop($content)
        ));
        $output .= '</div>';
        return $output;
    }
    st_reg_shortcode('st_hotel_more_info', 'st_vc_hotel_more_info');
}



