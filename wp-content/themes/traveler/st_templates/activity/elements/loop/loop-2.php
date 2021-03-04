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
    $link = st_get_link_with_search(get_permalink(), array('start'), $_GET);
    $col = 12 / 3;
    $info_price = STActivity::get_info_price();
$dataWishList = STUser_f::get_icon_wishlist();
$st_show_number_activity_avai = st()->get_option('st_show_number_activity_avai', 'off');


if(empty($taxonomy)) $taxonomy=false;
?>
<div class="col-md-<?php echo esc_attr($col) ?> col-sm-6 col-xs-12 list_tour style_box has-matchHeight" itemscope itemtype="http://schema.org/TouristAttraction">
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <?php if(!empty( $info_price['discount'] ) and $info_price['discount']>0 and $info_price['price_new'] >0) { ?>
            <?php echo STFeatured::get_sale($info_price['discount']); ?>
        <?php } ?>
        <header class="thumb-header">
            <a href="<?php echo esc_url($link); ?>" class="hover-img">
                <?php
                    $img = get_the_post_thumbnail( get_the_ID() , array(260,190,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( get_the_ID() )))) ;
                    if(!empty($img)){
                        echo balanceTags($img);
                    }else{
                        echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(ST_TRAVELER_URI.'/img/no-image.png',array('width'=>800,'height'=>600)) .'">';
                    }
                ?>
                <h5 class="hover-title-center"><?php st_the_language('book_now')?></h5>
	            <?php if(is_user_logged_in()){ ?>
                <a class="add-item-to-wishlist" data-id="<?php echo get_the_ID(); ?>" data-post_type="<?php echo get_post_type(get_the_ID()); ?>" rel="tooltip" data-toggle="tooltip" data-placement="top" title="<?php echo balanceTags($dataWishList['original-title']) ?>">
		            <?php echo balanceTags($dataWishList['icon']); ?>
                    <i class="fa fa-spinner loading""></i>
                </a>
                <?php } ?>
            </a>
            <?php echo st_get_avatar_in_list_service(get_the_ID(),35)?>
        </header>
        <div class="thumb-caption">
            <ul class="icon-group text-tiny text-color">
                <?php echo  TravelHelper::rate_to_string(STReview::get_avg_rate()); ?>
            </ul>
            <h5 class="thumb-title">
                <a href="<?php echo esc_url($link); ?>" class="text-darken">
                    <?php the_title(); ?>
                </a>
            </h5>
            <p class="mb0">
                <small><i class="fa fa-map-marker"></i>
                    <?php $address = get_post_meta(get_the_ID(),'address',true); ?>
                    <?php
                        if(!empty($address)){
                            echo esc_html($address);
                        }
                    ?>
                </small>
            </p>
            <?php echo st()->load_template( 'activity/elements/attribute' , 'list' ,array("taxonomy"=>$taxonomy));?>
            <p class="mb0 text-darken">

                <span class="text-lg lh1em text-color">
                      <?php echo STActivity::get_price_html(get_the_ID(),false,'<br>'); ?>
                </span>
            </p>
	        <?php if(!empty(STInput::get('start')) && !empty(STInput::get('end')) && $st_show_number_activity_avai == 'on'){ ?>
		        <?php echo st()->load_template('activity/elements/seat-availability', null, array()); ?>
	        <?php } ?>
        </div>

    </div>
</div>

