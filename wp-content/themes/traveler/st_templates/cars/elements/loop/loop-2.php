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


    $link=st_get_link_with_search(get_permalink(),array('pick-up','location_id_pick_up','drop-off','location_id_drop_off','drop-off-time','pick-up-time','drop-off-date','pick-up-date','st_google_location_pickup','st_google_location_dropoff'),$_GET);
    $info_price = STCars::get_info_price();
    $cars_price = $info_price['price'];
    $count_sale = $info_price['discount'];
    $price_origin = $info_price['price_origin'];
?>
<div <?php post_class('col-md-4 style_box')  ?> itemscope itemtype="http://schema.org/Product">
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <header class="thumb-header">
            <?php if(!empty($count_sale)){ ?>
                <?php STFeatured::get_sale($count_sale) ; ?>
            <?php } ?>
            <a href="<?php echo esc_url($link)?>">
                <?php
                    if(has_post_thumbnail() and get_the_post_thumbnail()){
                        the_post_thumbnail(array(800,600,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id(get_the_ID() ))));
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
            <?php
                if(!wp_is_mobile()) {
	                echo st()->load_template( '/cars/elements/attribute-grid' );
                }
            ?>
            <div>
                <?php if($price_origin != $cars_price){ ?>
                    <span class="text-small lh1em  onsale">
                                    <?php echo TravelHelper::format_money( $price_origin )?>
                                </span>
                    <i class="fa fa-long-arrow-right"></i>
                <?php } ?>
                <?php
                    if(!empty($cars_price)){
                        echo '<span class="text-darken mb0 text-color">'.TravelHelper::format_money($cars_price).'<small> /'.strtolower(STCars::get_price_unit('label')).'</small></span>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="gap"></div>
</div>
