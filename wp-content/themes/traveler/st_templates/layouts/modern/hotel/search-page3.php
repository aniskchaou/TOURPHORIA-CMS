<?php
get_header();
wp_enqueue_script('filter-hotel-js');
?>
    <div id="st-content-wrapper" class="search-result-page">
        <?php
        echo st()->load_template('layouts/modern/hotel/elements/banner');
        ?>
        <div class="container">
            <div class="st-hotel-result">
                <div class="row">
                    <?php echo st()->load_template('layouts/modern/hotel/elements/sidebar', '', array('format' => 'popupmap')); ?>
                    <?php
                    $query           = array(
                        'post_type'      => 'st_hotel' ,
                        'post_status'    => 'publish' ,
                        's'              => '' ,
                        'orderby' => 'post_modified',
                        'order'   => 'DESC',
                    );
                    global $wp_query , $st_search_query;
                    $hotel = STHotel::inst();
                    $hotel->alter_search_query();
                    query_posts( $query );
                    $st_search_query = $wp_query;
                    $hotel->remove_alter_search_query();
                    wp_reset_query();
                    echo st()->load_template('layouts/modern/hotel/elements/content3');
                    echo st()->load_template('layouts/modern/hotel/elements/popupmap');
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
echo st()->load_template('layouts/modern/hotel/elements/popup/date');
echo st()->load_template('layouts/modern/hotel/elements/popup/guest');
get_footer();