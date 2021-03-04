<div class="row row-wrap">
<?php
$col = 12 / $st_col;
if ($st_type =='st_cars'){
    $location_text   = 'location_id_pick_up' ; 
}else{
    $location_text = 'location_id';
}
while(have_posts()){
    the_post();
?>
        <div class="col-md-<?php echo esc_attr($col); ?> col-sm-6 col-xs-12 loop-normal st_lazy_load">
            <div class="thumb">
                <?php
                $page_search = st_get_page_search_result($st_type);

                if(!empty($page_search) and get_post_type($page_search)=='page'){
                    $link = add_query_arg(array($location_text =>get_the_ID(), 'location_name' => get_the_title()),get_the_permalink($page_search));
                }else{
                    $link = add_query_arg(array(
                        's'=>'',
                        'post_type'=>$st_type,
                        $location_text => get_the_ID(),
                        'location_name' => get_the_title()
                    ),home_url('/'));
                }
                if($link_to == 'single'){
                    $link = get_the_permalink();
                }
                ?>
                <a class="hover-img" href="<?php echo esc_url($link) ?>">
                    <?php
                    /*$img = get_the_post_thumbnail( get_the_ID() , array(260,200,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id(  )))) ;
                    if(!empty($img)){
                        echo balanceTags($img);
                    }else{
                        echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(ST_TRAVELER_URI.'/img/no-image.png',array('width'=>800,'height'=>600)) .'">';
                    }*/
                    TravelHelper::getLazyLoadingImage(array(260,200,'bfi_thumb'=>true));
                    ?>
                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                        <?php
                        $img = get_post_meta(get_the_ID(),'logo',true);
                        if($st_show_logo == 'yes' && !empty($img)){
                            ?>
                            <div class="img-<?php echo esc_attr($st_logo_position) ?>">
                                <img title="logo" alt="logo" src="<?php echo balanceTags($img) ?>" width="32px" height="32px">
                            </div>
                        <?php } ?>
                        <div class="text-small img-left">
                            <h5><?php the_title() ?></h5>
                            <?php
                            if(!wp_is_mobile()) {
	                            $result        = STLocation::get_info_by_post_type( get_the_ID(), $st_type );
	                            $min_max_price = $result['min_max_price'];
	                            $min_price     = $min_max_price['price_min'];
	                            $offer         = $result['offers'];
	                            $review        = $result['reviews'];
	                            ?>
	                            <?php if ( ! empty( $review ) ) { ?>
                                    <p>
			                            <?php echo esc_html( $review ) ?>
			                            <?php if ( $review > 1 ) {
				                            _e( 'reviews', ST_TEXTDOMAIN );
			                            } else {
				                            _e( 'review', ST_TEXTDOMAIN );
			                            } ?>
                                    </p>
	                            <?php } ?>
	                            <?php if ( ! empty( $offer ) ) { ?>
                                    <p class="mb0">
			                            <?php
			                            if ( $offer > 1 ) {
				                            printf( __( '%d offers from %s', ST_TEXTDOMAIN ), $offer, TravelHelper::format_money( $min_price ) );
			                            } else {
				                            printf( __( '%d offer from %s', ST_TEXTDOMAIN ), $offer, TravelHelper::format_money( $min_price ) );
			                            }
			                            ?>
                                    </p>
		                            <?php
	                            }
                            }
                            ?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
<?php } ?>
</div>