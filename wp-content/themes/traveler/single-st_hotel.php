<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Single hotel
     *
     * Created by ShineTheme
     *
     */
    $new_layout = st()->get_option( 'st_theme_style', 'classic' );
    if ( $new_layout == 'modern' ) {
        get_header();
        $style = get_post_meta( get_the_ID(), 'hotel_layout_style', true );
        if ( !$style ) {
            $style = st()->get_option('hotel_single_layout_v2', '1');
        }
        echo st()->load_template( 'layouts/modern/hotel/single/single-style', $style );
        get_footer();

        return;
    }

    get_header();
    $detail_hotel_layout = apply_filters( 'st_hotel_detail_layout', st()->get_option( 'hotel_single_layout' ) );
    $menu_style          = st()->get_option( 'menu_style', "1" );
    if ( $menu_style != '3' ):
        if ( get_post_meta( $detail_hotel_layout, 'is_breadcrumb', true ) !== 'off' ) {
            get_template_part( 'breadcrumb' );
        }
    endif;

    $layout_class = get_post_meta( $detail_hotel_layout, 'layout_size', true );
    if ( !$layout_class ) $layout_class = "container";
?>

    <div itemscope itemtype="http://schema.org/Hotel">
        <div class="<?php echo balanceTags( $layout_class ); ?>">
            <div class="booking-item-details">
                <?php

                    if ( $detail_hotel_layout ) {
                        $content = STTemplate::get_vc_pagecontent( $detail_hotel_layout );
                        echo balanceTags( $content );
                    } else {
                        echo st()->load_template( 'hotel/single', 'default' );
                    }
                ?>
                <div class="gap"></div>
            </div>
        </div>
        <!--Review Rich Snippets-->
        <div itemprop="aggregateRating" class="hidden" itemscope itemtype="http://schema.org/AggregateRating">
            <div><?php _e( 'Book rating:', ST_TEXTDOMAIN ) ?>
                <?php printf( __( '%s out of %s with %s ratings', ST_TEXTDOMAIN ),
                        '<span itemprop="ratingValue">' . ( get_comments_number() > 0 ? ( round( STReview::get_avg_rate() ) > 0 ? round( STReview::get_avg_rate() ) : 5 ) : 5 ) . '</span>',
                        '<span itemprop="bestRating">5</span>',
                        '<span itemprop="ratingCount">' . ( get_comments_number() > 0 ? get_comments_number() : 1 ) . '</span>'
                    ); ?>
            </div>
        </div>
        <div itemprop="image" class="hidden" itemscope itemtype="http://schema.org/ImageObject">
            <?php
                $featured_img_url = st()->get_option( 'logo', get_template_directory_uri() . '/img/no-image.png' );
                if ( has_post_thumbnail( get_the_ID() ) ) {
                    $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                }
                echo '<img src="' . $featured_img_url . '" itemprop="url">';
            ?>
        </div>
        <!--End Review Rich Snippets-->
        <span class="hidden st_single_hotel"></span>
    </div>
<?php get_footer() ?>