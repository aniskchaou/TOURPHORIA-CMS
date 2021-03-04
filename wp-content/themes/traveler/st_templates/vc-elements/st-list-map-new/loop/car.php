<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element loop 2
 *
 * Created by ShineTheme
 *
 */

wp_enqueue_script('magnific.js' );

$link=st_get_link_with_search(get_permalink(),array('pick-up','location_id_pick_up','drop-off','location_id_drop_off','drop-off-time','pick-up-time','drop-off-date','pick-up-date'),$_GET);

$info_price = STCars::get_info_price();
$price = $info_price['price'];
$count_sale = $info_price['discount'];
$price_origin = $info_price['price_origin'];
$thumb_obj=wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
?>
<div class="div_item_map <?php echo 'div_map_item_'.get_the_ID() ?>" >
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb item_map">
        <header class="thumb-header">
            <div class="booking-item-img-wrap st-popup-gallery">
                <a href="<?php echo (!empty($thumb_obj[0]))?$thumb_obj[0]:'#' ?>" class="st-gp-item">
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
            <h5 class="thumb-title">
                <a class="text-darken" href="<?php echo esc_attr($link)?>"><?php the_title() ?></a>
            </h5>
            <?php $category = get_the_terms(get_the_ID() ,'st_category_cars') ?>
            <?php
            $txt ='';
            if(!empty($category)){
                foreach($category as $k=>$v){
                    $txt .= $v->name.' ,';
                }
                $txt = substr($txt,0,-1);
            }
            ?>
            <small><?php echo esc_html($txt); ?></small>
            <ul class="booking-item-features booking-item-features-small booking-item-features-sign clearfix mt5">
                <?php
                $i=0;
                $limit = st()->get_option('car_equipment_info_limit',11);
                $taxonomy= get_object_taxonomies('st_cars','object');
                $taxonomy_info = get_post_meta(get_the_ID(),'cars_equipment_info',true);
                if(!empty($taxonomy) and is_array($taxonomy)){
                    foreach($taxonomy as $key => $value){
                        if($key != 'st_category_cars'){
                            if($key != 'st_cars_pickup_features') {
                                $data_term = get_the_terms(get_the_ID(), $key, true);
                                if(!empty($data_term) and is_array($data_term)){
                                    foreach($data_term as $k=>$v){
                                        // check taxonomy info
                                        $dk_check = false;
                                        if(is_array($taxonomy_info)){
                                            foreach($taxonomy_info as $k_info => $v_info){
                                                if(!empty($v_info['cars_equipment_taxonomy_id'])){
                                                    if( $v->term_id == $v_info['cars_equipment_taxonomy_id'] ){
                                                        $dk_check = true;
                                                        $data_info = $v_info['cars_equipment_taxonomy_info'];
                                                        $data_title_info="";
                                                        if(!empty($v_info['title']))
                                                            $data_title_info = $v_info['title'];
                                                    }
                                                }
                                            }
                                        }
                                        if($i<$limit){
                                            if($dk_check == true){
                                                echo  '<li title="" data-placement="top" rel="tooltip" data-original-title="'.$data_title_info.'">
                                                                        <i class="'.TravelHelper::handle_icon(get_tax_meta($v->term_id, 'st_icon',true)).'"></i>
                                                                        <span class="booking-item-feature-sign">'.$data_info.'</span>
                                                                    </li>';
                                            }else{
                                                /*echo '<li title="" data-placement="top" rel="tooltip" data-original-title="'.esc_html($v->name).'">
                                                                    <i class="'.TravelHelper::handle_icon(get_tax_meta($v->term_id, 'st_icon',true)).'"></i>
                                                              </li>';*/
                                            }
                                        }
                                        $i++;
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
            </ul>
            <div class="item_price_map cars">
                <?php if($price != $price_origin) { ?>
                    <span class="text-small lh1em  onsale">
                                    <?php echo TravelHelper::format_money( $price_origin ) ?>
                                </span>
                <?php } ?>
                <?php
                if(!empty($price)){
                    echo '<span class="text-darken mb0 text-color">'.TravelHelper::format_money($price).'<small> /'.strtolower(STCars::get_price_unit('label')).'</small></span>';
                }
                ?>
            </div>
            <a class="btn btn-primary btn_book" href="<?php echo esc_attr($link)?>"><?php _e("Book Now",ST_TEXTDOMAIN) ?></a>
            <button class="btn btn-default pull-right close_map" onclick="closeGmapThumbItem(this)" ><?php _e("Close",ST_TEXTDOMAIN) ?></button>
        </div>
    </div>
    <div class="gap"></div>
</div>

