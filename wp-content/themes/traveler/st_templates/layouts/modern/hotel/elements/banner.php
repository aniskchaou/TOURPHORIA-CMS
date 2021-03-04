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
<div class="banner <?php echo $inner_style; ?>">
    <div class="container">
        <h1>
            <?php
            if(is_archive()){
                the_archive_title('', '');
            }elseif (is_search()){
                echo sprintf(__('Search results : "%s"', ST_TEXTDOMAIN), STInput::get('s', ''));
            }else{
                echo get_the_title();
            }
            ?>
            <?php  ?>
        </h1>
        <?php if(is_page_template('template-hotel-search.php') or is_page_template('template-tour-search.php')  or is_page_template('template-activity-search.php')) { ?>
        <form action="<?php echo get_the_permalink(); ?>" name="get" class="hidden-lg hidden-md">
            <div class="search-form-mobile">
                <div class="form-group">
                    <div class="dropdown">
                        <div class="icon-field">
                            <?php echo TravelHelper::getNewIcon('ico_maps_search_box', 'gray', '20px', '20px', true); ?>
                        </div>
                        <input type="hidden" name="location_id" class="form-control" value="<?php echo esc_attr($location_id); ?>"/>
                        <input type="text" name="location_name" class="form-control" readonly placeholder="<?php echo __('Where are you going?', ST_TEXTDOMAIN); ?>" id="dropdown-mobile-destination" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  value="<?php echo esc_attr($location_name); ?>"/>
                        <ul class="dropdown-menu" aria-labelledby="dropdown-mobile-destination">
	                        <?php
	                        if ( $enable_tree == 'on' ) {
		                        New_Layout_Helper::buildTreeOptionLocation( $locations, $location_id );
	                        } else {
		                        if ( is_array( $locations ) && count( $locations ) ):
			                        foreach ( $locations as $key => $value ):
				                        ?>
                                        <li class="item" data-value="<?php echo $value->ID; ?>">
                                            <?php echo TravelHelper::getNewIcon('ico_maps_search_box', 'gray', '16px', '16px', true); ?>
                                            <span><?php echo $value->fullname; ?></span></li>
				                        <?php
			                        endforeach;
		                        endif;
	                        }
	                        ?>
                        </ul>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo TravelHelper::getNewIcon('ico_search_header', '#ffffff', '25px', '25px', true); ?></button>
                </div>
            </div>
        </form>
        <?php } ?>
    </div>
</div>