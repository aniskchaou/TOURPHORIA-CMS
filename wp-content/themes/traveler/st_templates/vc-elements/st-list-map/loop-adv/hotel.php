<div class=" <?php echo 'div_map_item_'.get_the_ID() ?>">
    <?php
    $thumb_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
    $link = st_get_link_with_search(get_permalink(), array('start', 'end', 'room_num_search', 'adult_number','children_num'), $_GET);
    ?>
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <?php if($discount_text=get_post_meta(get_the_ID(),'discount_text',true)){ ?>
            <?php STFeatured::get_sale($discount_text); ?>
        <?php }?>
        <header class="thumb-header">
            <a href="<?php echo esc_url($link) ?>" class="hover-img">
                <?php
                if(has_post_thumbnail() and get_the_post_thumbnail()){
                    the_post_thumbnail(array(360, 270,'bfi_thumb'=>false), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))) );
                }else{
                    echo st_get_default_image();
                }
                ?>
                <h5 class="hover-title-center"><?php esc_html_e('Book Now','traveler')?> </h5>
            </a>
            <?php
                echo st_get_avatar_in_list_service(get_the_ID(), 35);
            ?>
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
                    <small> <i class="fa fa-map-marker">&nbsp;</i> <?php echo esc_html($address) ?></small>
                </p>
            <?php endif;?>
            <p class="mb0 text-darken item_price_map">
				<?php if (STHotel::is_show_min_price()) { ?>
					<small><?php printf(__("from %s/night", ST_TEXTDOMAIN),'<span class="text-lg lh1em">'.TravelHelper::format_money(STHotel::get_price()).'</span>') ?></small>
				<?php } else { ?>
					<small><?php printf(__("%s avg/night", ST_TEXTDOMAIN),'<span class="text-lg lh1em">'.TravelHelper::format_money(STHotel::get_price()).'</span>') ?></small>
				<?php } ?>
            </p>
        </div>
    </div>
    <div class="gap"></div>
</div>
