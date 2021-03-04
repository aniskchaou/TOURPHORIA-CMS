<?php 
wp_enqueue_script('magnific.js' );

$object= new STRental();
$custom_feild=$object->get_custom_fields();
$link=st_get_link_with_search(get_permalink(),array('start','end','room_num_search','adult_number'),$_GET);
$thumb_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
?>
<li <?php post_class('booking-item') ?>>
    <?php echo STFeatured::get_featured(); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="booking-item-img-wrap st-popup-gallery">
                    <a href="<?php echo esc_url($thumb_url)?>" class="st-gp-item">
                        <?php 
                        if(has_post_thumbnail() and get_the_post_thumbnail()){
                                the_post_thumbnail(array(800, 400, 'bfi_thumb' => TRUE), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ;
                            }else {
                                echo st_get_default_image();
                            }
                            
                        ?>
                    </a>
                    <?php
                    $count = 0;
                    $gallery = get_post_meta(get_the_ID(), 'gallery', true);
                    $gallery = explode(',', $gallery);
                    if (!empty($gallery) and $gallery[0]) {
                        $count += count($gallery);
                    }
                    if(has_post_thumbnail() and get_the_post_thumbnail()){
                        $count++;
                    }
                    if ($count) {
                        echo '<div class="booking-item-img-num"><i class="fa fa-picture-o"></i>';
                        echo esc_attr($count);
                        echo '</div>';
                    }
                    ?>
                    <div class="hidden">
                        <?php if (!empty($gallery) and $gallery[0]) {
                            $count += count($gallery);
                            foreach($gallery as $key=>$value)
                            {
                                $img_link=wp_get_attachment_image_src($value,array(800,600,'bfi_thumb'=>true));
                                if(isset($img_link[0]))
                                    echo "<a class='st-gp-item' href='{$img_link[0]}'></a>";
                            }

                        }?>
                    </div>
                    <?php echo st_get_avatar_in_list_service(get_the_ID(),35); ?>
                </div>
            </div>
            <div class="col-md-6">

                <div class="booking-item-rating">
                    <ul class="icon-group booking-item-rating-stars">
                        <?php
                        $avg = STReview::get_avg_rate();
                        echo TravelHelper::rate_to_string($avg);
                        ?>
                    </ul>
                    <span
                        class="booking-item-rating-number"><b><?php echo esc_html($avg) ?></b> <?php esc_html_e('of 5','traveler') ?></span>
                    <small>
                        (<?php comments_number(__('no review',ST_TEXTDOMAIN), __('1 review',ST_TEXTDOMAIN),__('% reviews',ST_TEXTDOMAIN)); ?>)
                    </small>
                </div>
                <h5 class="booking-item-title"><a class="color-inherit" href="<?php echo esc_url($link) ?>"><?php the_title() ?></a></h5>
                <?php if ($address = get_post_meta(get_the_ID(), 'address', true)): ?>
                    <p class="booking-item-address"><i class="fa fa-map-marker"></i> <?php echo esc_html($address) ?>
                    </p>
                <?php endif; ?>

                <?php

                if(!empty($custom_feild) and is_array($custom_feild)):?>
                    <?php
                    echo '<ul class="booking-item-features booking-item-features-rentals booking-item-features-sign clearfix mt5 mb5">';
                    foreach($custom_feild as $key=>$value):
                        if($value['show_in_list']=='on'):
                            echo '<li rel="tooltip" data-placement="top" title="" data-original-title="'.$value['title'].'"><i class="'.TravelHelper::handle_icon($value['icon']).'"></i>';
                            $field_name=isset($value['field_name'])?$value['field_name']:'pro_'.sanitize_key($value['title']);
                            $meta=get_post_meta(get_the_ID(),$field_name,true);
                            if($meta){
                                echo '<span class="booking-item-feature-sign">x '.$meta.'</span>';
                            }
                        endif;

                        echo '</li>';
                    endforeach;
                    echo "</ul>";
                    ?>
                <?php endif;?>

            </div>
            <?php
            $is_sale=STRental::is_sale();
            $orgin_price=STRental::get_orgin_price();
            $price=STRental::get_price();
            $show_price = st()->get_option('show_price_free');
            ?>
            <div class="col-md-3">
                <span class="booking-item-price-from"><?php _e("From",ST_TEXTDOMAIN) ?></span>
                 <?php
                 if($is_sale):

                     echo "<span class='booking-item-old-price'>".TravelHelper::format_money($orgin_price)."</span>";
                 endif;
                 ?>
                 <?php if($show_price == 'on' || $price) : ?>
                 <span class="booking-item-price m0"><?php echo TravelHelper::format_money($price) ?></span>
                 <span>/<?php esc_html_e('night','traveler')?></span><br>
                 <?php endif; ?>
                 <a href="<?php echo esc_url($link)?>" class="btn btn-primary btn_book "><?php esc_html_e('Book Now','traveler') ?></a>
            </div>
        </div>
</li>