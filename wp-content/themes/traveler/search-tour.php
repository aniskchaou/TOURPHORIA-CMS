<?php
    /**
     * @package WordPress
     * @subpackage Traveler
     * @since 1.0
     *
     * Search custom tours
     *
     * Created by ShineTheme
     *
     */
    if( !st_check_service_available( 'st_tours' ) ) {
        wp_redirect( home_url() );
        die;
    }
    global $wp_query, $st_search_query;
    st()->tour->alter_search_query();
    $query = new WP_Query(
        array(
            'post_type' => 'st_tours',
            's' => get_query_var( 's' ),
            'paged' => get_query_var( 'paged' )
        )
    );
    $st_search_query = $query;
    st()->tour->remove_alter_search_query();
    global $wp_query;
    $current_page = get_query_var( 'paged' );
    $total_posts = $wp_query->found_posts;
    if( $total_posts == 0 && $current_page >= 2 ) {
        global $wp_rewrite;
        $link = add_query_arg();
        if( $wp_rewrite->using_permalinks() ) {
            $link = preg_replace( "/page\/(\d)\//", "page/1/", $link );
        } else {
            $link = add_query_arg( 'paged', 1 );
        }
        wp_redirect( $link );
    }
    get_header();
    wp_enqueue_script( 'magnific.js' );
    $result_string = '';
    echo st()->load_template( 'search-loading' );
?>
<?php
    $layout = st()->get_option( 'tours_search_layout' );
    if( !empty( $_REQUEST[ 'layout_id' ] ) ) {
        $layout = $_REQUEST[ 'layout_id' ];
    }
    $layout_class = get_post_meta( $layout, 'layout_size', true );
    if( !$layout_class ) $layout_class = "container";
?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog">
        <?php echo st()->load_template( 'tours/search-form' ); ?>
    </div>

<?php
    if( get_post_meta( $layout, 'is_breadcrumb', true ) !== 'off' ) {
        get_template_part( 'breadcrumb' );
    }
?>
    <div class=" <?php echo balanceTags( $layout_class ); ?>">

        <?php
            if( $layout and is_string( get_post_status( $layout ) ) ) {
                echo STTemplate::get_vc_pagecontent( $layout );
            } else { ?>
                <h3 class="booking-title"><?php echo balanceTags( st()->tour->get_result_string() ) ?>
                    <small><a class="popup-text" href="#search-dialog"
                              data-effect="mfp-zoom-out"><?php echo __( 'Change search', ST_TEXTDOMAIN ) ?></a></small>
                </h3>
                <div class="row">
                    <?php $sidebar_pos = apply_filters( 'st_tours_sidebar', 'left' );
                        if( $sidebar_pos == "left" ) {
                            get_sidebar( 'tour' );
                        }
                    ?>
                    <div
                        class="<?php echo apply_filters( 'st_tours_sidebar', 'left' ) == 'no' ? 'col-md-12' : 'col-md-9'; ?> col-sm-7 col-xs-12">
                        <?php echo st()->load_template( 'tours/content-tours' ) ?>
                    </div>
                    <?php
                        $sidebar_pos = apply_filters( 'st_tours_sidebar', 'left' );
                        if( $sidebar_pos == "right" ) {
                            get_sidebar( 'tour' );
                        }
                    ?>
                </div>
            <?php }
        ?>
    </div>
<?php
    get_footer();
?>