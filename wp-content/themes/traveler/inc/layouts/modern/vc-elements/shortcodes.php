<?php
if (!function_exists('st_video_new')) {
    function st_video_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'label_video' => '',
            'link' => '',
            'background_image' => '',
        ], $attr);

        return st()->load_template('layouts/modern/elements/st_video', '', $attr);
    }

    st_reg_shortcode('st_video_new', 'st_video_new');
}

if (!function_exists('st_car_type_new')) {
    function st_car_type_new($attr, $content = false)
    {
        $attr = shortcode_atts([

        ], $attr);

        return st()->load_template('layouts/modern/elements/st_car_types', '', $attr);
    }

    st_reg_shortcode('st_car_type_new', 'st_car_type_new');
}
if (!function_exists('st_list_of_related_services_new')) {
    function st_list_of_related_services_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'title' => '',
            'service' => 'st_hotel',
            'ids' => '',
            'posts_per_page' => 4
        ], $attr);

        return st()->load_template('layouts/modern/elements/list_of_related_service', '', $attr);
    }

    st_reg_shortcode('st_list_of_related_services_new', 'st_list_of_related_services_new');
}


if (!function_exists('st_vc_faq_new')) {
    function st_vc_faq_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'title' => '',
            'list_faq' => array(),
        ], $attr);
        return st()->load_template('layouts/modern/elements/faq', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_faq_new', 'st_vc_faq_new');
}

if (!function_exists('st_vc_new_layout_element')) {
    function st_vc_new_layout_element($attr, $content = false)
    {
        return 'New element';
    }

    st_reg_shortcode('st_new_layout_element', 'st_vc_new_layout_element');
}

if (!function_exists('st_search_form_new')) {
    function st_search_form_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'form_type' => 'single',
            'service' => 'st_hotel',
            'heading' => '',
            'description' => '',
            'style' => 'normal',
            'images' => array(),
            'service_items' => array(),
            'heading_align' => 'center',
            'feature_item' => ''
        ], $attr);

        return st()->load_template('layouts/modern/elements/search_form', '', $attr);
    }

    st_reg_shortcode('st_search_form_new', 'st_search_form_new');
}

if (!function_exists('st_featured_item_new')) {
    function st_featured_item_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'icon' => '',
            'title' => '',
            'desc' => '',
            'style' => 'icon_left'
        ], $attr);

        return st()->load_template('layouts/modern/elements/featured_item', '', $attr);
    }

    st_reg_shortcode('st_featured_item_new', 'st_featured_item_new');
}

if (!function_exists('st_offer_item_new')) {
    function st_offer_item_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'background' => '',
            'title' => '',
            'sub_title' => '',
            'style' => 'icon',
            'featured_text' => '',
            'icon' => '',
            'link' => ''
        ], $attr);

        return st()->load_template('layouts/modern/elements/offer_item', '', $attr);
    }

    st_reg_shortcode('st_offer_item_new', 'st_offer_item_new');
}


if (!function_exists('st_list_of_services_new')) {
    function st_list_of_services_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'service' => 'st_hotel',
            'ids' => '',
            'posts_per_page' => 8
        ], $attr);

        return st()->load_template('layouts/modern/elements/list_of_service', '', $attr);
    }

    st_reg_shortcode('st_list_of_services_new', 'st_list_of_services_new');
}

if (!function_exists('st_rental_amenities')) {
    function st_rental_amenities($attr, $content = false)
    {
        $attr = shortcode_atts([
            'posts_per_page' => 6
        ], $attr);
        return st()->load_template('layouts/modern/elements/rental_amenities', '', $attr);
    }

    st_reg_shortcode('st_rental_amenities', 'st_rental_amenities');
}

if (!function_exists('st_list_of_multi_services_new')) {
    function st_list_of_multi_services_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'list_services' => array(),
            'posts_per_page' => 8,
            'heading' => ''
        ], $attr);

        return st()->load_template('layouts/modern/elements/list_of_multi_services', '', $attr);
    }

    st_reg_shortcode('st_list_of_multi_services_new', 'st_list_of_multi_services_new');
}

if (!function_exists('st_list_of_destinations_new')) {
    function st_list_of_destinations_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'service' => 'st_hotel',
            'ids' => '',
            'posts_per_page' => 8,
            'style' => 'normal'
        ], $attr);

        return st()->load_template('layouts/modern/elements/list_of_destination', '', $attr);
    }

    st_reg_shortcode('st_list_of_destinations_new', 'st_list_of_destinations_new');
}

if (!function_exists('st_language_currency_new')) {
    function st_language_currency_new($attr, $content = false)
    {
        $attr = shortcode_atts([

        ], $attr);

        return st()->load_template('layouts/modern/elements/language_currency', '', $attr);
    }

    st_reg_shortcode('st_language_currency_new', 'st_language_currency_new');
}

if (!function_exists('st_contact_info_new')) {
    function st_contact_info_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'contact_bg' => '',
            'company_name' => '',
            'content' => $content
        ], $attr);

        return st()->load_template('layouts/modern/elements/contact_info', '', $attr);
    }

    st_reg_shortcode('st_contact_info_new', 'st_contact_info_new');
}

if (!function_exists('st_contact_map_new')) {
    function st_contact_map_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'lat' => '',
            'lng' => '',
        ], $attr);

        return st()->load_template('layouts/modern/elements/contact_map', '', $attr);
    }

    st_reg_shortcode('st_contact_map_new', 'st_contact_map_new');
}

if (!function_exists('st_about_us_statistic')) {
    function st_about_us_statistic($attr, $content = false)
    {
        return st()->load_template('layouts/modern/elements/aboutus', 'statistic', $attr);
    }

    st_reg_shortcode('st_about_us_statistic', 'st_about_us_statistic');
}

if (!function_exists('st_about_us_info_new')) {
    function st_about_us_info_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'image' => '',
            'name' => '',
            'position' => '',
            'more_info' => ''
        ], $attr);
        return st()->load_template('layouts/modern/elements/aboutus', 'info', array('attr' => $attr));
    }

    st_reg_shortcode('st_about_us_info_new', 'st_about_us_info_new');
}

if (!function_exists('st_about_us_gallery_new')) {
    function st_about_us_gallery_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'images' => '',
            'title' => '',
            'link' => ''
        ], $attr);
        return st()->load_template('layouts/modern/elements/aboutus', 'gallery', array('attr' => $attr));
    }

    st_reg_shortcode('st_about_us_gallery_new', 'st_about_us_gallery_new');
}

if (!function_exists('st_about_us_team_new')) {
    function st_about_us_team_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'title' => '',
            'list_team' => array(),
        ], $attr);
        return st()->load_template('layouts/modern/elements/aboutus', 'team', array('attr' => $attr));
    }

    st_reg_shortcode('st_about_us_team_new', 'st_about_us_team_new');
}

if (!function_exists('st_testimonial_new')) {
    function st_testimonial_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'title' => '',
            'list_team' => array(),
            'style_layout' => 'style-1'
        ], $attr);

        return st()->load_template('layouts/modern/elements/testimonial', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_testimonial_new', 'st_testimonial_new');
}

if (!function_exists('st_single_hotel_list_of_room_new')) {
    function st_single_hotel_list_of_room_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'type_of_page' => 'list_page',
            'layout' => 'list',
        ], $attr);
        return st()->load_template('layouts/modern/single_hotel/elements/list_of_rooms', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_single_hotel_list_of_room_new', 'st_single_hotel_list_of_room_new');
}

if (!function_exists('st_single_hotel_check_availability_new')) {
    function st_single_hotel_check_availability_new($attr, $content = false)
    {
        $attr = shortcode_atts([
            'title' => '',
        ], $attr);
        return st()->load_template('layouts/modern/single_hotel/elements/check_availability', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_single_hotel_check_availability_new', 'st_single_hotel_check_availability_new');
}

if (!function_exists('st_text_and_button_ft')) {
    function st_text_and_button_ft($attr, $content = null)
    {
        extract(shortcode_atts(array(
            'header_title' => '',
            'st_content_ht' => '',
            'text_button_ht' => '',
            'url_button_ht' => '',
            'style_layout' => '',
        ), $attr));
        if (isset($url_button_ht) && !empty($url_button_ht)) {
            $url_button_ht = $url_button_ht;
        } else {
            $url_button_ht = '#';
        }
        if (isset($style_layout) && !empty($style_layout)) {
            $style_layout = $style_layout;
        } else {
            $style_layout = 'style-1';
        }
        ob_start(); ?>
        <?php if ($style_layout === 'style-2') { ?>
        <div class="content-text <?php echo $style_layout; ?>">
            <div class="st-text-center">
                <h2 class="text-center"><?php echo esc_attr($header_title); ?></h2>
                <p class="text-center"><?php echo($st_content_ht) ?></p>
                <?php if (isset($text_button_ht) && !empty($text_button_ht)) { ?>
                    <div class="button-color text-center">
                        <a href="<?php echo esc_url($url_button_ht); ?>"
                           title=""><?php echo esc_attr($text_button_ht); ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <div class="content-text">
            <div class="st-text-center <?php echo $style_layout; ?>">
                <h2 class="text-center"><?php echo esc_attr($header_title); ?></h2>
                <div class="box__separator  hidden-thumb">
                </div>
                <p class="text-center"><?php echo($st_content_ht) ?></p>
                <?php if (isset($text_button_ht) && !empty($text_button_ht)) { ?>
                    <div class="button-color text-center">
                        <a href="<?php echo esc_url($url_button_ht); ?>"
                           title=""><?php echo esc_attr($text_button_ht); ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
        <?php return ob_get_clean();
    }

    st_reg_shortcode('st_text_and_button', 'st_text_and_button_ft');
}
if (!function_exists('st_title_line_ft')) {
    function st_title_line_ft($attr, $content)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/title-content', '', array('attr' => $attr, 'content' => $content));
    }

    st_reg_shortcode('st_title_line', 'st_title_line_ft');
}

if (!function_exists('st_box_item_ft')) {
    function st_box_item_ft($attr, $content = null)
    {
        extract(shortcode_atts(array(
            'box_title' => '',
            'box_content' => '',
        ), $attr));
        ob_start(); ?>
        <div class="col-md-3 col-xs-12 st-item-box">
            <div class="st-box">
                <div class="st-titlt-box">
                    <h3><?php echo $box_title; ?></h3>
                </div>
                <div class="st-c0ontent-box">
                    <?php echo htmlspecialchars_decode($box_content); ?>
                </div>
            </div>
        </div>
        <?php return ob_get_clean();
    }

    st_reg_shortcode('st_box_item_text', 'st_box_item_ft');
}

if (!function_exists('st_box_item_icon_ft')) {
    function st_box_item_icon_ft($attr, $content = null)
    {
        extract(shortcode_atts(array(
            'box_title' => '',
            'list_social' => '',
        ), $attr));
        $socials = vc_param_group_parse_atts($list_social);
        ob_start(); ?>
        <div class="col-md-3 col-xs-12 st-item-box">
            <div class="st-box">
                <div class="st-titlt-box">
                    <h3><?php echo $box_title; ?></h3>
                </div>
                <div class="st-c0ontent-box">
                    <ul class="st-social">
                        <?php if (!empty($socials) && is_array($socials)) {
                            foreach ($socials as $val) {
                                if (!empty($val['icon']) && !empty($val['link'])) {
                                    $st_link = vc_build_link($val['link']);
                                    echo '<li><a href="' . esc_url($st_link['url']) . '" title="' . esc_attr($st_link['title']) . '" target="' . ($st_link['target'] ? '_blank' : '_self') . '"><i class="' . $val['icon'] . '"></i></a></li>';
                                }
                            }
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php return ob_get_clean();
    }

    st_reg_shortcode('st_box_item_icon', 'st_box_item_icon_ft');
}

if (!function_exists('hotel_activity_list_room_ft')) {
    function hotel_activity_list_room_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/list-room-of-hotel', '', array('attr' => $attr));
    }

    st_reg_shortcode('hotel_activity_list_room', 'hotel_activity_list_room_ft');
}
if (!function_exists('st_room_item_ft')) {
    function st_room_item_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/room-item', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_room_item', 'st_room_item_ft');
}

if (!function_exists('st_service_icon_slider_ft')) {
    function st_service_icon_slider_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/item-service', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_service_icon_slider', 'st_service_icon_slider_ft');
}

if (!function_exists('iconimg_text_ft')) {
    function iconimg_text_ft($attr, $content = null)
    {
        extract(shortcode_atts(array(
            'image_icon' => '',
            'text_icon' => '',
            'style' => '',
        ), $attr));
        $icon_image = wp_get_attachment_image_src($image_icon, '');
        ob_start(); ?>
        <div class="title-insta">
            <div class="st-img-icon"><img src="<?php echo esc_url($icon_image[0]); ?>" alt=""></div>
            <p class="text"><?php echo esc_attr($text_icon); ?></p>
        </div>
        <?php return ob_get_clean();
    }

    st_reg_shortcode('iconimg_text', 'iconimg_text_ft');
}

if (!function_exists('st_instagram_ft')) {
    function st_instagram_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/instagram-api', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_instagram', 'st_instagram_ft');
}
if (!function_exists('st_filter_activity_ft')) {
    function st_filter_activity_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/filter-slider', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_filter_activity', 'st_filter_activity_ft');
}
if (!function_exists('st_slider_activity_ft')) {
    function st_slider_activity_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/slider-home', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_slider_activity', 'st_slider_activity_ft');
}

if (!function_exists('st_gallery_hotel_single_ft')) {
    function st_gallery_hotel_single_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/gallery-hotel', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_gallery_hotel_single', 'st_gallery_hotel_single_ft');
}

if (!function_exists('st_hotel_tab_ft')) {
    function st_hotel_tab_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/tab-menu-hotel', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_hotel_tab', 'st_hotel_tab_ft');
}
if (!function_exists('st_testimonial_single_ft')) {
    function st_testimonial_single_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/testimonial', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_testimonial_single', 'st_testimonial_single_ft');
}

if (!function_exists('st_scroll_single_ft')) {
    function st_scroll_single_ft($attr, $content = null)
    {
        extract(shortcode_atts(array(
            'icon_scroll' => '',
        ), $attr));
        $icon_image = wp_get_attachment_image_src($icon_scroll, '');
        ob_start(); ?>
        <button class="icon-images-scroll">
            <img src="<?php echo esc_url($icon_image[0]); ?>" alt="">
        </button>
        <?php return ob_get_clean();
    }

    st_reg_shortcode('st_scroll_single', 'st_scroll_single_ft');
}
if (!function_exists('st_single_map_ft')) {
    function st_single_map_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/map', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_single_map', 'st_single_map_ft');
}
if (!function_exists('st_timeline_ft')) {
    function st_timeline_ft($attr, $content)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/timeline', '', array('attr' => $attr, 'content' => $content));
    }

    st_reg_shortcode('st_timeline', 'st_timeline_ft');
}
if (!function_exists('st_single_hotel_slider_ft')) {
    function st_single_hotel_slider_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/slider', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_single_hotel_slider', 'st_single_hotel_slider_ft');
}
if (!function_exists('st_single_hotel_team_ft')) {
    function st_single_hotel_team_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/team', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_single_hotel_team', 'st_single_hotel_team_ft');
}
if (!function_exists('st_single_hotel_gallery_ft')) {
    function st_single_hotel_gallery_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/poup-gallery', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_single_hotel_gallery', 'st_single_hotel_gallery_ft');
}
if (!function_exists('st_video_popup_ft')) {
    function st_video_popup_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/poup-video', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_video_popup', 'st_video_popup_ft');
}
if (!function_exists('hotel_activity_blog_ft')) {
    function hotel_activity_blog_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/single_hotel/elements/blog-single', '', array('attr' => $attr));
    }

    st_reg_shortcode('hotel_activity_blog', 'hotel_activity_blog_ft');
}
if (!function_exists('st_half_slider_ft')) {
    function st_half_slider_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/elements/st_half_slider', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_half_slider', 'st_half_slider_ft');
}

if (!function_exists('st_single_hotel_table_ft')) {
    function st_single_hotel_table_ft($attr, $content = null)
    {
        return st()->load_template('layouts/modern/hotel/elements/table_membership', '', array('attr' => $attr));
    }

    st_reg_shortcode('st_single_hotel_table', 'st_single_hotel_table_ft');
}



if (!function_exists('st_load_post_by_cat')) {
    add_action( 'wp_ajax_nopriv_st_load_post_by_cat', 'st_load_post_by_cat' );
    add_action( 'wp_ajax_st_load_post_by_cat', 'st_load_post_by_cat' );
    function st_load_post_by_cat(){
        $posts_per_page = STInput::request('posts_per_page');
        $st_paged          = STInput::request('paged') + 1;
        $order          = STInput::request('order');
        $order_by       = STInput::request('order_by');
        $select_category      = STInput::request('tax_query');
        $index      = STInput::request('index');
        $check_all      = STInput::request('check_all');

        $argsx = array(
            'post_type' => 'post',
            'orderby' => $order_by,
            'order' => $order,
            'posts_per_page' => (int)$posts_per_page,
            'paged' => $st_paged,
        );
        if (!empty($select_category)) {
            $st_list_cat = explode(",", $select_category);
            if($check_all==='true'){
                $st_list_cat = $st_list_cat;
            } else {
                $st_list_cat = $select_category;
            }
            $argsx['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $st_list_cat,
            );
        }
        $return = array(
            'status' => 0
        );
        $return['paged'] = $st_paged ;
        $return['html'] = "" ;
        $st_pride_query = new WP_Query($argsx);
        $count_item =  $st_pride_query->post_count; 
        
        while($st_pride_query->have_posts()) {
            $st_pride_query->the_post();
            $return['html'] .= st()->load_template('layouts/modern/single_hotel/blog/ajax-tab',false, array('index' => $index));
            $index = intval($index) + 1;
        }
        $return['status'] = $count_item;
        $return['index'] = $index ;
        
        wp_reset_postdata();
        wp_send_json($return);
        die();
    }
}
