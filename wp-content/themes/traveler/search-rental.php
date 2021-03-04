<?php
    /**
     * @package WordPress
     * @subpackage Traveler
     * @since 1.0
     *
     * Search custom rental
     *
     * Created by ShineTheme
     *
     */
    if( !st_check_service_available( 'st_rental' ) ) {
        wp_redirect( home_url() );
        die;
    }
    global $wp_query, $st_search_query;
    $rental = STRental::inst();
    $rental->alter_search_query();
    query_posts(
        array(
            'post_type' => 'st_rental',
            's' => get_query_var( 's' ),
            'paged' => get_query_var( 'paged' )
        )
    );
    $st_search_query = $wp_query;
    $rental->remove_alter_search_query();
    global $wp_query;
    $current_page = get_query_var( 'paged' );
    $total_posts = $wp_query->found_posts;
    if( $total_posts == 0 && $current_page >= 2){
        global $wp_rewrite;
        $link = add_query_arg();
        if ($wp_rewrite->using_permalinks()){
            $link = preg_replace("/page\/(\d)\//", "page/1/", $link);
        }else{
            $link = add_query_arg('paged', 1);
        }
        wp_redirect( $link );
    }
    get_header();
    wp_enqueue_script( 'magnific.js' );
    $result_string = '';
    echo st()->load_template( 'search-loading' );
?>
<?php
    $layout = STInput::get( 'layout' );
    if( !$layout ) {
        $layout = st()->get_option( 'rental_search_layout' );
    }
    $layout_class = get_post_meta( $layout, 'layout_size', true );
    if( !$layout_class ) $layout_class = "container";
?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog">
        <?php echo st()->load_template( 'rental/search-form' ); ?>
    </div>
<?php
    if( get_post_meta( $layout, 'is_breadcrumb', true ) !== 'off' ) {
        get_template_part( 'breadcrumb' );
    }
?>
    <div class="mb20 <?php echo balanceTags( $layout_class ); ?>">
        <?php
            if( $layout and is_string( get_post_status( $layout ) ) ) {
                $content = STTemplate::get_vc_pagecontent( $layout );
                echo balanceTags( $content );
            } else {
                ?>
                <h3 class="booking-title"><?php echo balanceTags( $rental->get_result_string() ) ?>
                    <small><a class="popup-text" href="#search-dialog"
                              data-effect="mfp-zoom-out"><?php echo __( 'Change search', ST_TEXTDOMAIN ) ?></a>
                    </small>
                </h3>
                <div class="row">
                    <?php $sidebar_pos = apply_filters( 'st_rental_sidebar', 'no' );
                        if( $sidebar_pos == "left" ) {
                            get_sidebar( 'rental' );
                        }
                    ?>
                    <div
                        class="<?php echo apply_filters( 'st_rental_sidebar', 'no' ) == 'no' ? 'col-md-12' : 'col-md-9'; ?> col-sm-7 col-xs-12">
                        <?php echo st()->load_template( 'rental/search-elements/result' ) ?>
                    </div>
                    <?php
                        $sidebar_pos = apply_filters( 'st_rental_sidebar', 'no' );
                        if( $sidebar_pos == "right" ) {
                            get_sidebar( 'rental' );
                        }
                    ?>
                </div>
            <?php } ?>
    </div>
<?php
    get_footer();
?>