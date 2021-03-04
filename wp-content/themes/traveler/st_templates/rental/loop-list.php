<?php
wp_enqueue_script('magnific.js' );

$object= new STRental();
$custom_feild=$object->get_custom_fields();
$link=st_get_link_with_search(get_permalink(),array('start','end','room_num_search','adult_number','children_num'),$_GET);
$thumb_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

$check_in = '';
$check_out = '';

$orgin_price = 0;
$price = 0;

if(!isset($_REQUEST['start']) || empty( $_REQUEST['start'] )){
    $check_in = date('m/d/Y', strtotime("now"));
	$orgin_price = get_post_meta(get_the_ID(), 'price', true);
	if(empty($orgin_price))
	    $orgin_price = 0;
	$price = STPrice::getRentalSalePrice(get_the_ID());
}else{
    $check_in = TravelHelper::convertDateFormat(STInput::request('start'));
}

if(!isset($_REQUEST['end']) || empty( $_REQUEST['end'] )){
    $check_out = date('m/d/Y', strtotime("+1 day"));
}else{
    $check_out = TravelHelper::convertDateFormat(STInput::request('end'));
}

if(isset($_REQUEST['start']) && isset($_REQUEST['end'])){
	$orgin_price=STPrice::getRentalPriceOnlyCustomPrice(get_the_ID(), strtotime($check_in), strtotime($check_out));
	$price= STPrice::getSalePrice(get_the_ID(), strtotime($check_in), strtotime($check_out));
}

$numberday = STDate::dateDiff($check_in, $check_out);
if(!$taxonomy) $taxonomy=FALSE;
?>
<li <?php post_class('booking-item') ?> itemscope itemtype="http://schema.org/Product">
    <?php echo STFeatured::get_featured(); ?>
    <div class="row">
        <div class="col-md-3">
            <?php if(!wp_is_mobile()){ ?>
            <div class="booking-item-img-wrap st-popup-gallery">
                <a href="<?php echo esc_url($thumb_url)?>" class="st-gp-item">
                    <?php the_post_thumbnail(array(180, 135, 'bfi_thumb' => true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ?>
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
                <?php echo st_get_avatar_in_list_service(get_the_ID(),35)?>
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
            </div>
            <?php }else{ ?>
            <div class="booking-item-img-wrap">
                <a href="<?php echo esc_url($link); ?>">
			        <?php the_post_thumbnail(array(180, 135, 'bfi_thumb' => true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ?>
                </a>
            </div>
            <?php } ?>
        </div>
        <div class="col-md-6">

            <div class="booking-item-rating">
                <ul class="icon-group booking-item-rating-stars">
                    <?php
                    $avg = STReview::get_avg_rate();
                    echo TravelHelper::rate_to_string($avg);
                    ?>
                </ul>
                <?php if(!wp_is_mobile()){ ?>
                                <span
                                    class="booking-item-rating-number"><b><?php echo esc_html($avg) ?></b> <?php st_the_language('rental_of_5') ?></span>
                <small>
                    (<?php comments_number(__('no review',ST_TEXTDOMAIN), __('1 review',ST_TEXTDOMAIN),__('% reviews',ST_TEXTDOMAIN)); ?>)
                </small>
                <?php } ?>
            </div>
            <h5 class="booking-item-title"><a class="color-inherit" href="<?php echo esc_url($link) ?>"><?php the_title() ?></a></h5>
            <?php if ($address = get_post_meta(get_the_ID(), 'address', true)): ?>
                <p class="booking-item-address"><i class="fa fa-map-marker"></i> <?php echo esc_html($address) ?>
                </p>
            <?php endif; ?>

            <?php
            if(!wp_is_mobile()){
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

            <?php echo st()->load_template( 'rental/elements/attribute' , 'list' ,array("taxonomy"=>$taxonomy));?>
            <?php } ?>
        </div>
        <?php
        $is_sale=STRental::is_sale();
        $show_price = st()->get_option('show_price_free');
        ?>
        <div class="col-md-3">
            <span class="booking-item-price-from"><?php _e("Price",ST_TEXTDOMAIN) ?></span>
            <?php
            if($is_sale):

                echo "<span class='booking-item-old-price'>".TravelHelper::format_money($orgin_price)."</span>";
            endif;
            ?>
            <?php if($show_price == 'on' || $price) : ?>
                <span
                    class="booking-item-price"><?php echo TravelHelper::format_money($price) ?></span><span>/<?php printf(__(' %d night(s)', ST_TEXTDOMAIN), $numberday); ?></span><br>
            <?php endif; ?>
            <a href="<?php echo esc_url($link)?>" class="btn btn-primary btn_book "><?php st_the_language('rental_book_now') ?></a>
            <?php if($is_sale) { ?>
                <?php
                    $discount_rate = floatval(get_post_meta(get_the_ID(),'discount_rate',true));
                    if($discount_rate < 0) $discount_rate = 0;
                    if($discount_rate > 100) $discount_rate = 100;
                ?>
                <?php echo STFeatured::get_sale($discount_rate); ?>
            <?php } ?>
        </div>
    </div>
</li>