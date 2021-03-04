<?php
get_header();
wp_enqueue_script('filter-tour-js');
?>
    <div id="st-content-wrapper" class="search-result-page st-tours">
        <div id="tour-top-search"></div>
        <?php
        echo st()->load_template('layouts/modern/hotel/elements/banner');
        ?>
        <div class="search-form-top">
            <?php echo st()->load_template('layouts/modern/tour/elements/search-form'); ?>
        </div>
        <div class="container">
            <div class="st-hotel-result tour-top-search">
                    <?php
                    $query           = array(
                        'post_type'      => 'st_tours' ,
                        'post_status'    => 'publish' ,
                        's'              => '' ,
                        'orderby' => 'post_modified',
                        'order'   => 'DESC',
                    );
                    global $wp_query , $st_search_query;
                    $tour = STTour::get_instance();
                    $tour->alter_search_query();
                    query_posts( $query );
                    $st_search_query = $wp_query;
                    $tour->remove_alter_search_query();
                    wp_reset_query();
                    echo st()->load_template('layouts/modern/tour/elements/content2');
                    ?>
            </div>
        </div>
    </div>
<?php
echo st()->load_template('layouts/modern/hotel/elements/popup/date');
echo st()->load_template('layouts/modern/hotel/elements/popup/guest');
get_footer();