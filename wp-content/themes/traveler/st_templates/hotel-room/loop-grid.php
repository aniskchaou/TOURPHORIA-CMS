<?php
$link = st_get_link_with_search(get_permalink(), array('start', 'end', 'room_num_search', 'adult_number'), $_GET);
$thumb_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));

$check_in = '';
$check_out = '';
if(!isset($_REQUEST['start']) || empty($_REQUEST['start'])){
    $check_in = date('m/d/Y', strtotime("now"));
}else{
    $check_in = TravelHelper::convertDateFormat(STInput::request('start'));
}

if(!isset($_REQUEST['end']) || empty($_REQUEST['end'])){
    $check_out = date('m/d/Y', strtotime("+1 day"));
}else{
    $check_out = TravelHelper::convertDateFormat(STInput::request('end'));
}
$numberday = STDate::dateDiff($check_in, $check_out);
?>

<?php $data_price = STPrice::getPriceRoom(); ?>

<div class="col-md-4"  itemscope itemtype="http://schema.org/Hotel">
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <?php if($data_price['discount'] > 0){ ?>
            <?php if(!empty($data_price['discount'])){ ?>
                <?php STFeatured::get_sale($data_price['discount']) ; ?>
            <?php } ?>
        <?php }?>
        <header class="thumb-header">
            <?php
            $external = STRoom::get_external_url_new();
            if($external)$link = $external;
            ?>
            <a class="hover-img" href="<?php echo esc_url($link)?>">

                <?php if (has_post_thumbnail() and get_the_post_thumbnail()) {
                    the_post_thumbnail(array(360, 270), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( get_the_ID() ))));
                }else {echo st_get_default_image();} ?>
                <h5 class="hover-title-center"><?php st_the_language('book_now')?> </h5>
            </a>
        </header>
        <div class="thumb-caption">
            <h5 class="thumb-title"><a class="text-darken"
                                       href="<?php echo esc_url($link)?>"><?php the_title()?></a></h5>
            <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
                <p class="mb0">
                    <small><i class="fa fa-map-marker"></i> <?php echo esc_html($address) ?></small>
                </p>
            <?php endif;?>
            <div class="text-darken">
            </div>
            <p class="mb0 text-darken">
                <small> <?php _e("Price from", ST_TEXTDOMAIN) ?> </small>
                <?php if($data_price['discount'] > 0){ ?>
                    <span class="text-sm onsale mr10 text-white"> <?php echo TravelHelper::format_money($data_price['price_origine']) ?> </span>
                <?php }?>
                <span class="text-lg lh1em"><?php echo TravelHelper::format_money($data_price['price_sale']) ?></span>
            </p>
        </div>
    </div>
</div>