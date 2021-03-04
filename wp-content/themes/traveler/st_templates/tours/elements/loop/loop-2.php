<?php
    /**
     * @package WordPress
     * @subpackage Traveler
     * @since 1.0
     *
     * Tours loop content 2
     *
     * Created by ShineTheme
     *
     */
    $col = 12 / 3;
    $info_price = STTour::get_info_price();
    global $post;
    $post_id = $post->ID;
    $st_show_number_avai = st()->get_option('st_show_number_avai', 'off');

    $dataWishList = STUser_f::get_icon_wishlist();

$url=st_get_link_with_search(get_permalink(),array('start','end','duration','people'),$_GET);
if(empty($taxonomy)) $taxonomy=false;
?>
<div class="col-md-<?php echo esc_attr($col) ?> col-sm-6 col-xs-12 style_box has-matchHeight" itemscope itemtype="http://schema.org/TouristAttraction">
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <?php if(!empty( $info_price['discount'] ) and $info_price['discount']>0 and $info_price['price_new'] >0) { ?>
            <?php echo STFeatured::get_sale($info_price['discount']); ?>
        <?php } ?>
        <header class="thumb-header">
            <a href="<?php echo esc_url($url) ?>" class="hover-img">
                <?php
                    $img = get_the_post_thumbnail( $post_id , array(260,190,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( $post_id )))) ;
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
            <?php echo st_get_avatar_in_list_service($post_id,35)?>
        </header>
        <div class="thumb-caption">
            <ul class="icon-group text-tiny text-color">
                <?php echo  TravelHelper::rate_to_string(STReview::get_avg_rate()); ?>
            </ul>
            <h5 class="thumb-title">
                <a href="<?php echo esc_url($url)?>" class="text-darken">
                    <?php the_title(); ?>
                </a>
            </h5>
            <?php if($address = get_post_meta($post_id,'address',true)) {?>
            <p class="mb0">
                <small><i class="fa fa-map-marker"></i> 
                    <?php
                        if(!empty($address)){
                            echo esc_html($address);
                        }
                    ?>
                </small>
            </p>
            <?php } ?>
            <p class="mb0">
                <small>
                    <?php $type_tour = get_post_meta($post_id,'type_tour',true); ?>
                    <?php if($type_tour == 'daily_tour'){
                        
                        $day = STTour::get_duration_unit();
                        if($day) {
                            ?>
                            <i class="fa fa-calendar"></i>
                            <?php echo esc_html($day) ?>
                            
                        <?php
                        }}else{ ?>
                        <?php
                        $check_in = get_post_meta($post_id , 'check_in' ,true);
                        $check_out = get_post_meta($post_id , 'check_out' ,true);
                        if(!empty($check_out) and !empty($check_out)):
                            ?>
                            <i class="fa fa-calendar"></i>
                            <?php
                            $format=TravelHelper::getDateFormat();
                            $date = date_i18n($format,strtotime($check_in)).' <i class="fa fa-long-arrow-right"></i> '.date_i18n($format,strtotime($check_out));
                            echo balanceTags($date);
                        endif;
                        ?>
                    <?php } ?>
                </small>
            </p>
            <?php
            if(!wp_is_mobile()){
            $is_st_show_number_user_book = st()->get_option('st_show_number_user_book','off');
            if($is_st_show_number_user_book == 'on'):
            ?>
            <p class="mb0 st_show_user_booked">
                <small>
                    <?php $info_book = STTour::get_count_book($post_id);?>
                    <i class="fa  fa-user"></i>
                        <span class="">
                            <?php
                                if($info_book > 1){
                                    echo sprintf( __( '%d users booked',ST_TEXTDOMAIN ), $info_book );
                                }else{
                                    echo sprintf( __( '%d user booked',ST_TEXTDOMAIN ), $info_book );
                                }
                            ?>
                        </span>
                </small>
            </p>
            <?php endif ?>
            <div class="text-darken">
                <?php echo st()->load_template( 'tours/elements/attribute' , 'list' ,array("taxonomy"=>$taxonomy));?>
            </div>
            <?php } ?>
            <p class="mb0 text-darken">
                <?php 

                echo STTour::get_price_html($post_id) ?>
            </p>
	        <?php if(!empty(STInput::get('start')) && !empty(STInput::get('end')) && $st_show_number_avai == 'on'){ ?>
		        <?php echo st()->load_template('tours/elements/seat-availability', null, array()); ?>
	        <?php } ?>
        </div>
    </div>
</div>

