<?php
get_header();
wp_enqueue_script('filter-car-js');
?>
    <div id="st-content-wrapper" class="search-result-page st-tours">
        <?php
        echo st()->load_template('layouts/modern/hotel/elements/banner');
        ?>
        <div class="container">
            <div class="st-hotel-result">
                <div class="row">
                    <?php echo st()->load_template('layouts/modern/car/elements/sidebar'); ?>
                    <?php
                    $query           = array(
                        'post_type'      => 'st_cars' ,
                        'post_status'    => 'publish' ,
                        's'              => '' ,
                        'orderby' => 'post_modified',
                        'order'   => 'DESC',
                    );
                    global $wp_query , $st_search_query;
                    $car = STCars::get_instance();
                    $car->alter_search_query();
                    query_posts( $query );
                    $st_search_query = $wp_query;
                    $car->remove_alter_search_query();
                    wp_reset_query();
                    echo st()->load_template('layouts/modern/car/elements/content');
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
echo st()->load_template('layouts/modern/car/elements/popup/date');
get_footer();