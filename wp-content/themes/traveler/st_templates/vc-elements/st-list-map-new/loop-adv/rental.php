<?php
$link=st_get_link_with_search(get_permalink(),array('start','end','room_num_search','adult_number', 'child_num'),$_GET);
$thumb_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
?>
<div class="<?php echo 'div_map_item_'.get_the_ID() ?>" >
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <header class="thumb-header">
            <a class="hover-img" href="<?php echo esc_url($link)?>">
                <?php the_post_thumbnail(array(360, 270, 'bfi_thumb' => true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ?>
                <h5 class="hover-title-center"><?php esc_html_e('Book Now','traveler')?> </h5>
            </a>
            <?php echo st_get_avatar_in_list_service(get_the_ID(),35);?>
        </header>
        <div class="thumb-caption">
            <ul class="icon-group text-tiny text-color">
                <?php
                $avg = STReview::get_avg_rate();
                echo TravelHelper::rate_to_string($avg);
                ?>
            </ul>
            <h5 class="thumb-title"><a class="text-darken" href="<?php echo esc_url(get_permalink())?>"><?php the_title()?></a></h5>
            <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>

                <p class="mb0">
                    <i class="fa fa-map-marker">&nbsp;</i> <small> <?php echo esc_html($address) ?></small>
                </p>
            <?php endif;?>
            <?php
            $is_sale=STRental::is_sale();
            $orgin_price=STRental::get_orgin_price();
            $price=STRental::get_price();
            $show_price = st()->get_option('show_price_free');
            ?>
            <?php
            $features=get_post_meta(get_the_ID(),'fetures',true);
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
        </div>
    </div>
    <div class="gap"></div>
</div>
