<?php wp_enqueue_script('magnific.js' ); ?>
<div class="div_item_map <?php echo 'div_map_item_'.get_the_ID() ?>">
    <?php
    $link = st_get_link_with_search(get_permalink(), array('start', 'end', 'room_num_search', 'adult_number','children_num'), $_GET);
    $thumb_obj=wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
    ?>
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb item_map">
        <header class="thumb-header">
            <div class="booking-item-img-wrap st-popup-gallery">
                <a href="<?php echo (!empty($thumb_obj[0]))?$thumb_obj[0]:'#' ?>" class="st-gp-item">
                     <?php 
                    if(has_post_thumbnail() and get_the_post_thumbnail()){
                        the_post_thumbnail(array(360, 270, 'bfi_thumb' => TRUE), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ;
                    }else {
                        echo st_get_default_image();
                    }
                        ?>
                </a>
                <?php
                $count = 0;
                $gallery = get_post_meta(get_the_ID(), 'gallery', TRUE);
                $gallery = explode(',', $gallery);
                if (!empty($gallery) and $gallery[0]) {
                    $count += count($gallery);
                }
                if (has_post_thumbnail()) {$count++;}
                if ($count) {
                    echo '<div class="booking-item-img-num"><i class="fa fa-picture-o"></i>';
                    echo esc_attr($count);
                    echo '</div>';
                }
                ?>
                <div class="hidden">
                    <?php if (!empty($gallery) and $gallery[0]) {
                        $count += count($gallery);
                        foreach ($gallery as $key => $value) {
                            $img_link = wp_get_attachment_image_src($value, array(800, 600, 'bfi_thumb' => TRUE));
                            if (isset($img_link[0]))
                                echo "<a class='st-gp-item' href='{$img_link[0]}'></a>";
                        }
                    } ?>
                </div>
                <?php echo st_get_avatar_in_list_service(get_the_ID(),35);?>
            </div>
        </header>
        <div class="thumb-caption">
            <?php
            $view_star_review = st()->get_option('view_star_review', 'review');
            if($view_star_review == 'review') :
                ?>
                <ul class="icon-group text-color">
                    <?php
                    $avg = STReview::get_avg_rate();
                    echo TravelHelper::rate_to_string($avg);
                    ?>
                </ul>
            <?php elseif($view_star_review == 'star'): ?>
                <ul class="icon-list icon-group booking-item-rating-stars text-color">
                    <?php
                    $star = STHotel::getStar();
                    echo  TravelHelper::rate_to_string($star);
                    ?>
                </ul>
            <?php endif; ?>
            <h5 class="thumb-title"><a class="text-darken" href="<?php echo esc_url($link)?>"><?php the_title()?></a></h5>
            <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
                <p class="mb0">
                    <small> <?php echo esc_html($address) ?></small>
                </p>
            <?php endif;?>
            <p class="mb0 text-darken item_price_map">
				<?php if (STHotel::is_show_min_price()) { ?>
					<small><?php printf(__("from %s/night", ST_TEXTDOMAIN),'<span class="text-lg lh1em">'.TravelHelper::format_money(STHotel::get_price()).'</span>') ?></small>
				<?php } else { ?>
					<small><?php printf(__("%s avg/night", ST_TEXTDOMAIN),'<span class="text-lg lh1em">'.TravelHelper::format_money(STHotel::get_price()).'</span>') ?></small>
				<?php } ?>

            </p>
            <a class="btn btn-primary btn_book" href="<?php echo esc_url($link)?>"><?php _e("Book Now",ST_TEXTDOMAIN) ?></a>
            <button class="btn btn-default pull-right close_map" onclick="closeGmapThumbItem(this)" ><?php _e("Close",ST_TEXTDOMAIN) ?></button>
        </div>
    </div>
</div>
