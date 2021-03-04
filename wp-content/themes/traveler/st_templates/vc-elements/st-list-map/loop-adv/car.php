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


$link=st_get_link_with_search(get_permalink(),array('pick-up','location_id_pick_up','drop-off','location_id_drop_off','drop-off-time','pick-up-time','drop-off-date','pick-up-date'),$_GET);

$info_price = STCars::get_info_price();

$price = $info_price['price'];
$count_sale = $info_price['discount'];
$price_origin = $info_price['price_origin'];
?>
<?php
$thumb_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
?>
<div class="" >
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <header class="thumb-header">
            <?php if(!empty($count_sale)){ ?>
                <?php STFeatured::get_sale($count_sale); ?>
            <?php } ?>
            <a href="<?php echo esc_url($link) ?>" class="hover-img">
                <?php
                if(has_post_thumbnail() and get_the_post_thumbnail()){
                    the_post_thumbnail(array(240, 120,'bfi_thumb'=>false), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))) );
                }else{
                    echo st_get_default_image();
                }
                ?>
            </a>
            <?php
            echo st_get_avatar_in_list_service(get_the_ID(),35);
            ?>
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
        </div>
    </div>
    <div class="gap"></div>
</div>

