<?php
extract($data_);
if(empty($st_cars_of_row) || intval($st_cars_of_row) == 0)
  $st_cars_of_row = 1;
$col = 12 / $st_cars_of_row;


$info_price = STCars::get_info_price();
$price = $info_price['price'];
$count_sale = $info_price['discount'];
$price_origin = $info_price['price_origin'];
?>
<?php $category = get_the_terms(get_the_ID() ,'st_category_cars') ?>
<div class="col-md-<?php echo esc_attr($col); ?> col-sm-6 st_fix_<?php echo esc_attr($st_cars_of_row); ?>_col style_box st_lazy_load">
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <header class="thumb-header">
            <?php if(!empty($count_sale)){ ?>
                <?php STFeatured::get_sale($count_sale) ; ?>
            <?php } ?>
            <?php $over_flow = ''; if ( !empty($current_page) and $current_page !="location"){$over_flow  = 'style="overflow: initial";'; }?>
            <a href="<?php the_permalink() ?>" class="hover-img"  <?php echo esc_html($over_flow) ; ?>>
                <?php
                /*if(has_post_thumbnail() and get_the_post_thumbnail()){
                    the_post_thumbnail(array(240,120), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id(  ))));
                }else{
                    echo st_get_default_image();
                }*/
                TravelHelper::getLazyLoadingImage(array(240,120));
                ?>
            </a>
            <?php
            echo st_get_avatar_in_list_service(get_the_ID(),35);
            ?>
        </header>
        <div class="thumb-caption">
            <h5 class="thumb-title">
                <a class="text-darken" href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
            <small>
               <?php
               $txt ='';
                   if(!is_wp_error($category) and !empty($category) and is_array($category))
                   {
                       foreach($category as $k=>$v){
                           $txt .= $v->name.' ,';
                       }
                       $txt = substr($txt,0,-1);
                       echo esc_html($txt);
                   }

               ?>
            </small>
            <?php
                if(!wp_is_mobile()) {
	                echo st()->load_template( 'cars/elements/attribute-grid' );
                }
            ?>
            <div>
                <?php if($price_origin != $price){ ?>
                    <span class="text-small lh1em  onsale">
                                    <?php echo TravelHelper::format_money( $price_origin )?>
                                </span>
                    <i class="fa fa-long-arrow-right"></i>
                <?php } ?>
                <?php
                if(!empty($price)){
                    echo '<span class="text-darken mb0 text-color">'.TravelHelper::format_money($price).'<small> /'.STCars::get_price_unit('label').'</small></span>';
                }
                ?>
            </div>
        </div>
    </div>
  </div>
<?php
