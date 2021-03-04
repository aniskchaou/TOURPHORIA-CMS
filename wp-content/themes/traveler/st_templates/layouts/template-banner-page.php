<?php
    $inner_style = '';
    if(is_single() or is_page()){
        $thumb_id = get_post_thumbnail_id(get_the_ID());
        if(!empty($thumb_id)){
            $img = wp_get_attachment_image_url($thumb_id, 'full');
            $inner_style = Assets::build_css("background-image: url(". $img .") !important;");
        }
    }

    if(is_category() or is_tag() or is_search()){
        $img = st()->get_option('header_blog_image', '');
        if(!empty($img))
            $inner_style = Assets::build_css("background-image: url(". $img .") !important;");
    }

    if(is_page_template('template-hotel-search.php') or is_page_template('template-tour-search.php') or is_page_template('template-activity-search.php')) {
        $enable_tree = st()->get_option('bc_show_location_tree', 'off');
        $location_id = STInput::get('location_id', '');
        $location_name = STInput::get('location_name', '');
        $post_type = 'st_hotel';
        if(is_page_template('template-tour-search.php')){
            $post_type = 'st_tours';
        }
        if(is_page_template('template-tour-activity.php')){
            $post_type = 'st_activity';
        }
        if ($enable_tree == 'on') {
            $lists = TravelHelper::getListFullNameLocation($post_type);
            $locations = TravelHelper::buildTreeHasSort($lists);
        } else {
            $locations = TravelHelper::getListFullNameLocation($post_type);
        }
    }
?>
<div class="banner" style="background-image: url(<?php echo  $img ;?>) !important;">
    <div class="container">
        <h1>
            <?php
            echo get_the_title();
            ?>
        </h1>
    </div>
</div>