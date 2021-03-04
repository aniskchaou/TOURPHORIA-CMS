<?php
$img = '';
if(has_post_thumbnail() and get_the_post_thumbnail()){
    $img_tmp = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array(360, 270) );
    $img = $img_tmp[0];
}else{
    $img = ST_TRAVELER_URI.'/img/no-image.png';
}
?>
<div class="div_item_map <?php echo 'div_map_item_'.get_the_ID() ?>">
    <?php
    $link = st_get_link_with_search(get_permalink(), array('start', 'end', 'room_num_search', 'adult_number','children_num'), $_GET);
    $thumb_obj=wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
    ?>
    <?php echo STFeatured::get_featured($hotel_id); ?>
    <div class="thumb item_map">
        <header class="thumb-header">
            <img src="<?php echo esc_url($img); ?>" alt="<?php echo TravelHelper::get_alt_image(get_post_thumbnail_id()); ?>" class="img-responsive">
        </header>
        <div class="thumb-caption">
            <?php
            $view_star_review = st()->get_option('view_star_review', 'review');
            if($view_star_review == 'review') :
                ?>
                <ul class="icon-group text-color">
                    <?php
                    $avg = STReview::get_avg_rate($hotel_id);
                    echo TravelHelper::rate_to_string($avg);
                    ?>
                </ul>
            <?php elseif($view_star_review == 'star'): ?>
                <ul class="icon-list icon-group booking-item-rating-stars text-color">
                    <?php
                    $star = STHotel::getStar($hotel_id);
                    echo  TravelHelper::rate_to_string($star);
                    ?>
                </ul>
            <?php endif; ?>
            <h5 class="thumb-title text-darken"> <?php the_title()?></h5>
            <p class="mb0 text-darken">
                <a class="text-darken" href="<?php echo esc_url($link)?>"><?php _e('in ', ST_TEXTDOMAIN) ?><?php  echo get_the_title($hotel_id)?></a>
            </p>
            <?php if ($address = get_post_meta($hotel_id, 'address', TRUE)): ?>
                <p class="mb0">
                    <small> <?php echo esc_html($address) ?></small>
                </p>
            <?php endif;?>
            <?php if(get_post_type($hotel_id) == 'st_hotel'): ?>
                <p class="mb0 text-darken item_price_map">
                    <span class="text-lg lh1em"><?php echo TravelHelper::format_money(STHotel::get_avg_price($hotel_id)) ?></span>
                    <small> <?php esc_html_e('avg/night','traveler')?></small>
                </p>
            <?php endif; ?>
            <?php if(get_post_type($hotel_id) == 'st_rental'): ?>
                <?php
                $is_sale=STRental::is_sale($hotel_id);
                $orgin_price=STRental::get_orgin_price($hotel_id);
                $price=STRental::get_price($hotel_id);
                $show_price = st()->get_option('show_price_free');
                ?>
                <?php
                $features=get_post_meta($hotel_id,'fetures',true);
                if(!empty($features)):?>
                    <?php
                    echo '<ul class="booking-item-features booking-item-features-rentals booking-item-features-sign clearfix mt5 mb5">';
                    foreach($features as $key=>$value):

                        $d=array('icon'=>'','title'=>'');
                        $value=wp_parse_args($value,$d);

                        echo '<li rel="tooltip" data-placement="top" title="" data-original-title="'.$value['title'].'"><i class="'.TravelHelper::handle_icon($value['icon']).'"></i>';
                        if($value['number']){
                            echo '<span class="booking-item-feature-sign">x '.$value['number'].'</span>';
                        }

                        echo '</li>';
                    endforeach;
                    echo "</ul>";
                    ?>
                <?php endif;?>

                <p class="mb0 text-darken item_price_map">
                    <?php
                    if($is_sale):

                        echo "<span class='booking-item-old-price'>".TravelHelper::format_money($orgin_price)."</span>";
                    endif;
                    ?>
                    <?php if($show_price == 'on' || $price): ?>
                        <span class="text-lg lh1em text-color"><?php echo TravelHelper::format_money($price) ?></span><small> /<?php esc_html_e('night','traveler')?></small>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
            <a class="btn btn-primary btn_book" href="<?php echo esc_url($link)?>"><?php _e("Book Now",ST_TEXTDOMAIN) ?></a>
            <button class="btn btn-default pull-right close_map" onclick="closeGmapThumbItem(this)" ><?php _e("Close",ST_TEXTDOMAIN) ?></button>
        </div>
    </div>
</div>