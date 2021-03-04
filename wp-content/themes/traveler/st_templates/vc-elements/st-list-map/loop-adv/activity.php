<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity element loop 2
 *
 * Created by ShineTheme
 *
 */

$col = 12 / 3;
$link=st_get_link_with_search(get_permalink(),array('start','end','duration','people'),$_GET);
$thumb_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
?>
<div class="<?php echo 'div_map_item_'.get_the_ID() ?>" >
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <header class="thumb-header">
            <a href="<?php echo esc_url($link) ?>" class="hover-img">
                <?php
                if(has_post_thumbnail() and get_the_post_thumbnail()){
                    the_post_thumbnail(array(240, 120,'bfi_thumb'=>false), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))) );
                }else{
                    echo st_get_default_image();
                }
                ?>
                <h5 class="hover-title-center"><?php esc_html_e('Book Now','traveler')?></h5>
            </a>
            <?php echo st_get_avatar_in_list_service(get_the_ID(),35)?>
        </header>
        <div class="thumb-caption">
            <ul class="icon-group text-tiny text-color">
                <?php echo  TravelHelper::rate_to_string(STReview::get_avg_rate()); ?>
            </ul>
            <h5 class="thumb-title">
                <a href="<?php echo esc_url($link) ?>" class="text-darken">
                    <?php the_title(); ?>
                </a>
            </h5>
            <p class="mb0">
                <i class="fa fa-map-marker">&nbsp;</i>
                <small>
                    <?php $address = get_post_meta(get_the_ID(),'address',true); ?>
                    <?php
                    if(!empty($address)){
                        echo esc_html($address);
                    }
                    ?>
                </small>
            </p>
            <p class="mb0 text-darken item_price_map">
                <span class="text-lg lh1em text-color">
                      <?php echo STActivity::get_price_html(get_the_ID(),false,'<br>'); ?>
                   </span>
            </p>
        </div>
    </div>
    <div class="gap"></div>
</div>


