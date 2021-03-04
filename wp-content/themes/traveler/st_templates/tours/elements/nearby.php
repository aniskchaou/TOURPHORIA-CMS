<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours nearby
 *
 * Created by ShineTheme
 *
 */

$tour= STTour::get_instance();
if($style == 'style-2'){
    $nearby_posts = $tour->get_near_by(get_the_ID(), 20, 3);
    if($nearby_posts and !empty($nearby_posts)) {
        global $post;
        echo '<div class="list_tours"><div class="row row-wrap">';
        foreach($nearby_posts as $key=>$post)
        {
            setup_postdata($post);
            $info_price = STTour::get_info_price();
            ?>
            <div class="col-md-4 style_box col-sm-6 col-xs-12 st_fix_3_col st_lazy_load">
                <div class="tour-item-1">
                    <div class="thumb-header">
                        <?php echo STFeatured::get_featured(); ?>
                        <a href="<?php echo get_the_permalink(); ?>">
                            <?php
                                //the_post_thumbnail(array(420,300), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))))
                                TravelHelper::getLazyLoadingImage(array(420,300));
                            ?>
                        </a>
                        <?php if(!empty( $info_price[ 'discount' ] ) and $info_price[ 'discount' ] > 0 and $info_price[ 'price_new' ] > 0) { ?>
                            <?php echo STFeatured::get_sale( $info_price[ 'discount' ] ); ?>
                        <?php } ?>
                    </div>
                    <div class="caption-content ">
                        <h4 class="location"><?php echo TravelHelper::locationHtml(get_the_ID()); ?></h4>
                        <h3 class="title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title()?></a></h3>
                        <?php if(!wp_is_mobile()){ ?>
                        <p class="description"><?php echo wp_trim_words(get_the_excerpt(get_the_ID()), 14, ' [...]'); ?></p>
                        <?php } ?>
                        <p class=""></p>
                        <span class="price">
                            <?php echo STTour::get_price_html( false , false , '-' ); ?>
                        </span>
                        <?php
                        $count_review = STReview::count_comment(get_the_ID());
                        if($count_review > 0){
                        ?>
                        <div class="review">
                            <ul class="review-stars">
                                <?php
                                $avg = STReview::get_avg_rate();
                                echo TravelHelper::rate_to_string($avg);
                                ?>
                            </ul>
	                        <?php if(!wp_is_mobile()){ ?>
                            <span class="count">
                                <?php echo sprintf(_n(esc_html__('%d review', ST_TEXTDOMAIN),esc_html__('%d reviews', ST_TEXTDOMAIN),$count_review), $count_review); ?>
                            </span>
                            <?php } ?>
                        </div>
                            <?php } ?>
	                    <?php if(!wp_is_mobile()){ ?>
                        <a class="btn btn-primary btn-normal book-now" href="<?php echo get_the_permalink(); ?>"><?php echo esc_html__('Book Now', ST_TEXTDOMAIN); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?php
        }
        echo '</div></div>';
        wp_reset_query();
        wp_reset_postdata();
    }
}else{
	$nearby_posts=$tour->get_near_by();
    if($nearby_posts and !empty($nearby_posts))
    {
        if(empty($font_size)) $font_size='3';
        if(!empty($title)){
            ?>
            <h<?php echo esc_attr($font_size) ?>>
                <?php echo esc_html($title); ?>
                <span class="title_bol"><?php echo the_title(); ?></span>
            </h<?php echo esc_attr($font_size) ?>>
            <?php
        }

        global $post;
        echo "<ul class='booking-list'>";
        foreach($nearby_posts as $key=>$post)
        {
            setup_postdata($post);
            $info_price = STTour::get_info_price();
            ?>
            <li <?php post_class('item-nearby')?>>
                <?php echo STFeatured::get_featured(); ?>
                <div class="booking-item booking-item-small st_lazy_load">
                    <div class="row">
                        <div class="col-xs-4">
                            <a href="<?php the_permalink()?>">
                                <?php TravelHelper::getLazyLoadingImage(array(100,100)); ?>
                            </a>
                        </div>
                        <div class="col-xs-4">
                            <h5 class="booking-item-title"><a href="<?php the_permalink()?>"><?php the_title()?></a> </h5>
                            <ul class="icon-group booking-item-rating-stars">
                                <?php
                                $avg = STReview::get_avg_rate();
                                echo TravelHelper::rate_to_string($avg);
                                ?>
                            </ul>
                        </div>
                        <div class="col-xs-4">
                            <?php if(!empty( $info_price[ 'price_new' ] ) and $info_price[ 'price_new' ] > 0) { ?>
                                <span class="booking-item-price-from"><?php st_the_language( 'tour_from' ) ?></span>
                            <?php } ?>
                            <span class="booking-item-price list_tour_4">
                           <?php echo STTour::get_price_html( false , false , '-' ); ?>
                        </span>
                            <?php if(!empty( $info_price[ 'discount' ] ) and $info_price[ 'discount' ] > 0 and $info_price[ 'price_new' ] > 0) { ?>
                                <?php echo STFeatured::get_sale( $info_price[ 'discount' ] ); ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </li>


            <?php
        }
        echo "</ul>";
        wp_reset_query();
        wp_reset_postdata();
    }
}
