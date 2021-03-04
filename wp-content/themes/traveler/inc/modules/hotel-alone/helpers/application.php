<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/14/2017
 * Version: 1.0
 */
if(!function_exists('st_hotel_alone_load_view')) {
    function st_hotel_alone_load_view($slug, $name = false, $data = array())
    {
        if (is_array($data))
            extract($data);

        if ($name) {
            $slug = $slug . '-' . $name;
        }

        $template_dir = 'inc/modules/hotel-alone/views';

        $template = locate_template($template_dir . '/' . $slug . '.php');

        if (is_file($template)) {
            ob_start();

            include $template;

            $data = @ob_get_clean();

            return $data;
        }

        return false;
    }
}

if(!function_exists('st_hotel_alone_load_assets_dir')) {
    function st_hotel_alone_load_assets_dir()
    {
        return ST_TRAVELER_URI . '/inc/modules/hotel-alone/assets';
    }
}

if(!function_exists('st_hotel_alone_get_list_menu_register_for_optiontree')){
    function st_hotel_alone_get_list_menu_register_for_optiontree(){
        $nav_menu =  get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        $list = array();
        if(!empty($nav_menu)){
            foreach($nav_menu as $k=>$v){
                $list[]=array(
                    'value' => $v->slug,
                    'label' => $v->name,
                );
            }
        }
        return $list;
    }
}

if(!function_exists('st_hotel_alone_get_list_all_services')){
    function st_hotel_alone_get_list_all_services($post_type){
        query_posts( [ 'post_type' => $post_type, 'posts_per_page' => -1] );
        $list = array();
        while ( have_posts() ) {
            the_post();
            $list[]=array(
                'value' => get_the_ID(),
                'label' => get_the_title(),
            );
        }
        wp_reset_query();

        return $list;
    }
}

if(!function_exists('st_hotel_alone_get_search_fields_for_element')){
    function st_hotel_alone_get_search_fields_for_element(){
        $hotel_fields = array(
            'check_in' => esc_html__('Check In', ST_TEXTDOMAIN),
            'room_number' => esc_html__('Room Number',ST_TEXTDOMAIN),
            'adults' => esc_html__('Adult', ST_TEXTDOMAIN),
            'children' => esc_html__('Children', ST_TEXTDOMAIN),
        );
        return $hotel_fields;
    }
}

if (!function_exists('st_hotel_alone_option_tree_convert_array')) {

    function st_hotel_alone_option_tree_convert_array($old_array)
    {
        $new_array = array();
        if(is_array($old_array) && count($old_array) > 0) {
            foreach ($old_array as $key => $value) {
                $new_array[] = array(
                    'value' => $key,
                    'label' => $value,
                );
            }
        }
        return $new_array;
    }
}

if (!function_exists('st_hotel_alone_get_vc_pagecontent')) {
    function st_hotel_alone_get_vc_pagecontent($page_id = false)
    {
        if ($page_id) {
            $page = get_post($page_id);

            if ($page) {
                $content = apply_filters('the_content', $page->post_content);

                $content = str_replace(']]>', ']]&gt;', $content);


                $shortcodes_custom_css = get_post_meta($page_id, '_wpb_shortcodes_custom_css', true);

                Hotel_Alone_Helper()->add_css($shortcodes_custom_css);

                wp_reset_postdata();

                return $content;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

if(!function_exists('st_hotel_alone_get_type_services_data')) {
    function st_hotel_alone_get_type_services_data($post_type = 'st_hotel')
    {
        $argv = array(
            'posts_per_page' => -1,
            'post_type' => $post_type,
            'orderby' => 'title',
            'order' => 'ASC'
        );
        $posts = get_posts($argv);
        $result = array();
        if(!empty($posts)){
            foreach ($posts as $post) {
                $result[] = array(
                    'value' => $post->ID,
                    'label' => $post->post_title,
                );
            }
        }
        return $result;
    }
}

if (!function_exists('st_hotel_alone_vc_list_taxonomy')) {
    function st_hotel_alone_vc_list_taxonomy($taxonomy)
    {
        $list = array('All' => '');
        if (!isset($taxonomy) || empty($taxonomy)) $taxonomy = 'category';
        $tags = get_terms(  array('taxonomy' => $taxonomy,'hide_empty' => true) );
        if(!is_wp_error($tags) && !empty($tags)) {
            foreach ($tags as $tag) {
                $list[$tag->name] = $tag->slug;
            }
        }
        return $list;
    }
}

if (!function_exists('hotel_alone_get_order_list')) {
    function hotel_alone_get_order_list($current = false, $extra = array(), $return = 'array')
    {
        $default = array(
            'none' => esc_html__('None', ST_TEXTDOMAIN),
            'ID' => esc_html__('Post ID', ST_TEXTDOMAIN),
            'author' => esc_html__('Author', ST_TEXTDOMAIN),
            'title' => esc_html__('Post Title', ST_TEXTDOMAIN),
            'name' => esc_html__('Post Name', ST_TEXTDOMAIN),
            'date' => esc_html__('Post Date', ST_TEXTDOMAIN),
            'modified' => esc_html__('Last Modified Date', ST_TEXTDOMAIN),
            'parent' => esc_html__('Post Parent', ST_TEXTDOMAIN),
            'rand' => esc_html__('Random', ST_TEXTDOMAIN),
            'comment_count' => esc_html__('Comment Count', ST_TEXTDOMAIN),
        );

        if (!empty($extra) and is_array($extra)) {
            $default = array_merge($default, $extra);
        }

        if ($return == "array") {
            return $default;
        } elseif ($return == 'option') {
            $html = '';
            if (!empty($default)) {
                foreach ($default as $key => $value) {
                    $selected = selected($key, $current, false);
                    $html .= "<option {$selected} value='{$key}'>{$value}</option>";
                }
            }
            return $html;
        }
        return $default;
    }
}

if (!function_exists('hotel_alone_vc_convert_array')) {

    function hotel_alone_vc_convert_array($old_array)
    {
        $new_array = array();
        if(is_array($old_array) && count($old_array) > 0) {
            foreach ($old_array as $key => $value) {
                $new_array[$value] = $key;
            }
        }
        return $new_array;
    }
}

if (!function_exists('hotel_alone_paging_nav')) {
    function hotel_alone_paging_nav()
    {
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }

        $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $pagenum_link = html_entity_decode(get_pagenum_link());
        $query_args = array();
        $url_parts = explode('?', $pagenum_link);

        if (isset($url_parts[1])) {
            wp_parse_str($url_parts[1], $query_args);
        }

        $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
        $pagenum_link = trailingslashit($pagenum_link) . '%_%';

        $format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

        // Set up paginated links.
        $links = paginate_links(array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $GLOBALS['wp_query']->max_num_pages,
            'current'  => $paged,
            'mid_size' => 1,
            'add_args' => $query_args,
            'prev_text' => '<i class="fa fa-caret-left"></i>',
            'next_text' => '<i class="fa fa-caret-right"></i>',
            'type' => 'list',
        ));


        if ($links) : ?>
            <div class="helios-pagination text-center" >
                <?php echo do_shortcode($links); ?>
            </div><!-- .pagination -->
        <?php endif;
    }
}

if(!function_exists('hotel_alone_is_ajax'))
{
    function hotel_alone_is_ajax()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        return false;
    }
}

if (!function_exists('hotel_alone_get_sidebar')) {
    function hotel_alone_get_sidebar()
    {
        $default = array(
            'position' => 'right',
            'id' => 'blog-sidebar'
        );

        return apply_filters('hotel_alone_get_sidebar', $default);
    }
}

if (!function_exists('hotel_alone_remove_w3c')) {
    function hotel_alone_remove_w3c($embed_code)
    {
        $embed_code = str_replace('webkitallowfullscreen', '', $embed_code);
        $embed_code = str_replace('mozallowfullscreen', '', $embed_code);
        $embed_code = str_replace('frameborder="0"', '', $embed_code);
        $embed_code = str_replace('frameborder="no"', '', $embed_code);
        $embed_code = str_replace('scrolling="no"', '', $embed_code);
        $embed_code = str_replace('&', '&amp;', $embed_code);
        return $embed_code;
    }
}
if(!function_exists('hotel_alone_display_breadcrumbs')) {
    function hotel_alone_display_breadcrumbs($echo = false)
    {
        ob_start();
        $delimiter = '&nbsp;&frasl;&nbsp;';
        $name = esc_html__('Home', 'heliospress');
        $currentBefore = '<span class="current">';
        $currentAfter = '</span>';
        if (!is_home() && !is_front_page() || is_paged()) {
            global $post;
            echo '<a href="' . esc_url(home_url('/')) . '">' . $name . '</a> ' . $delimiter . ' ';
            if (is_tax()) {
                $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                echo do_shortcode($currentBefore . $term->name . $currentAfter);
            } elseif (is_category()) {
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
                echo do_shortcode($currentBefore . '');
                single_cat_title();
                echo '' . $currentAfter;
            } elseif (is_day()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
                echo do_shortcode($currentBefore . get_the_time('d') . $currentAfter);
            } elseif (is_month()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo do_shortcode($currentBefore . get_the_time('F') . $currentAfter);
            } elseif (is_year()) {
                echo do_shortcode($currentBefore . get_the_time('Y') . $currentAfter);
            } elseif (is_single()) {
                $postType = get_post_type();
                if ($postType == 'post') {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                }
                echo do_shortcode($currentBefore);
                the_title();
                echo do_shortcode($currentAfter);
            } elseif (is_page() && !$post->post_parent) {
                echo do_shortcode($currentBefore);
                the_title();
                echo do_shortcode($currentAfter);
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb) echo do_shortcode($crumb . ' ' . $delimiter . ' ');
                echo do_shortcode($currentBefore);
                the_title();
                echo do_shortcode($currentAfter);
            } elseif (is_search()) {
                echo do_shortcode($currentBefore) . esc_html__('Search Results for:', 'heliospress') . ' &quot;' . get_search_query() . '&quot;' . $currentAfter;
            } elseif (is_tag()) {
                echo do_shortcode($currentBefore) . esc_html__('Post Tagged with:', 'heliospress') . ' &quot;';
                single_tag_title();
                echo '&quot;' . $currentAfter;
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo do_shortcode($currentBefore) . esc_html__('Author Archive', 'heliospress') . $currentAfter;
            } elseif (is_404()) {
                echo do_shortcode($currentBefore) . esc_html__('Page Not Found', 'heliospress') . $currentAfter;
            }
            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
                echo ' ' . $delimiter . ' ' . esc_html__('Page', 'heliospress') . ' ' . get_query_var('paged');
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
            }
        }
        $bc = ob_get_contents();
        ob_clean();
        if($echo){
            echo do_shortcode($bc);
        }else{
            return $bc;
        }
    }
}

if(!function_exists('hotel_alone_pagination_room')){
    function hotel_alone_pagination_room($c_wp_query=false){
        global $wp_query;
        if(!empty($c_wp_query)){
            $wp_query = $c_wp_query;
        }
        if ( $wp_query->max_num_pages < 2 ) {
            return;
        }
        $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $max = $wp_query->found_posts;
        $posts_per_page = $wp_query->query['posts_per_page'];
        $number = ceil($max / $posts_per_page);
        $html = ' <div class="wpbooking-pagination paged_room">';
        if($paged > 1){
            $html.= ' <a class="page-numbers" data-page="'.($paged-1).'">'.__('Previous',ST_TEXTDOMAIN).'</a> ';
        }
        for($i=1 ; $i<= $number  ; $i++){
            if($i == $paged){
                $html.= ' <span class="page-numbers current" data-page="'.$i.'">'.$i.'</span> ';
            }else{
                $html.= ' <a class="page-numbers" data-page="'.$i.'">'.$i.'</a> ';
            }
        }
        if($paged < $i-1){
            $html.= ' <a class="page-numbers" data-page="'.($paged+1).'">'.__( 'Next', ST_TEXTDOMAIN ).'</a>';
        }
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('hotel_alone_list_taxonomy')) {
    function hotel_alone_list_taxonomy()
    {
        $terms = get_object_taxonomies('hotel_room', 'objects');
        $listTaxonomy = [];
        if (!is_wp_error($terms) and !empty($terms))
            foreach ($terms as $key => $val) {
                $listTaxonomy[$val->labels->name] = $key;
            }

        return $listTaxonomy;
    }
}