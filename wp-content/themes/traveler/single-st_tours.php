<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Single tours
     *
     * Created by ShineTheme
     *
     */
    $new_layout = st()->get_option( 'st_theme_style', 'classic' );
    if ( $new_layout == 'modern' ) {
        get_header();
        $style = get_post_meta( get_the_ID(), 'st_custom_layout_new', true );
        if ( !$style ) {
            $style = st()->get_option('tours_layout_v2', 1);
        }
        echo st()->load_template( 'layouts/modern/tour/single/single', $style );
        get_footer();

        return;
    }
    get_header();

    $detail_tour_layout = apply_filters( 'st_tours_detail_layout', st()->get_option( 'tours_layout' ) );
    /*if(get_post_meta($detail_tour_layout , 'is_breadcrumb' , true) !=='off'){
        get_template_part('breadcrumb');
    }*/
    $layout_class = get_post_meta( $detail_tour_layout, 'layout_size', true );
    if ( !$layout_class ) $layout_class = "container";

?>
    <div itemscope itemtype="http://schema.org/TouristAttraction">
        <div class="<?php echo balanceTags( $layout_class ); ?>">
            <div class="booking-item-details no-border-top">
                <?php
                    if ( $detail_tour_layout ) {
                        echo STTemplate::get_vc_pagecontent( $detail_tour_layout );
                    } else {
                        //Default Layout
                        echo st()->load_template( 'tours/single', 'default' );
                    }
                ?>
            </div><!-- End .booking-item-details-->
        </div>
        <!--Review Rich Snippets-->
        <div itemprop="aggregateRating" class="hidden" itemscope itemtype="http://schema.org/AggregateRating">
            <div><?php _e( 'Book rating:', ST_TEXTDOMAIN ) ?>
                <?php printf( __( '%s out of %s with %s ratings', ST_TEXTDOMAIN ),
                        '<span itemprop="ratingValue">' . ( get_comments_number() > 0 ? ( STReview::get_avg_rate() > 0 ? STReview::get_avg_rate() : 5 ) : 5 ) . '</span>',
                        '<span itemprop="bestRating">5</span>',
                        '<span itemprop="ratingCount">' . ( get_comments_number() > 0 ? get_comments_number() : 1 ) . '</span>'
                    ); ?>
            </div>
        </div>
        <!--End Review Rich Snippets-->
    </div>
    <span class="hidden st_single_tour"></span>
<?php get_footer() ?>