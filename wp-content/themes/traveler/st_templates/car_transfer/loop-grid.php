<?php
$post_id = $transfer->post_id;

$post  = get_post($post_id);
setup_postdata($post );

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

?>
<div class="col-md-4">
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb"> 
        <?php if($discount_text=get_post_meta(get_the_ID(),'discount_text',true)){ ?>
            <?php if(!empty($count_sale)){ ?>
                <?php STFeatured::get_sale($count_sale) ; ?>
            <?php } ?>
        <?php }?>
        <header class="thumb-header">
            <a class="hover-img" href="<?php echo esc_url($link)?>">

                <?php if (has_post_thumbnail() and get_the_post_thumbnail()) {
                    the_post_thumbnail(array(360, 270), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( get_the_ID() ))));
                }else {echo st_get_default_image();} ?>
                <h5 class="hover-title-center"><?php st_the_language('book_now')?> </h5>
            </a>
            <?php
                echo st_get_avatar_in_list_service(get_the_ID(), 35);
            ?>
        </header>
        <div class="thumb-caption">
            
            <h5 class="thumb-title"><a class="text-darken"
                                       href="<?php echo esc_url($link)?>"><?php the_title()?></a></h5>
            <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
                <p class="mb0">
                    <small><i class="fa fa-map-marker"></i> <?php echo esc_html($address) ?></small>
                </p>
            <?php endif;?>
            <p class="mb0 text-darken">
               
            </p>
        </div>
    </div>
</div>