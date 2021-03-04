<?php
get_header();
wp_enqueue_script('filter-rental-js');
?>
    <div id="st-content-wrapper" class="search-result-page st-rental ">
        <?php
        echo st()->load_template('layouts/modern/rental/elements/banner');
        ?>
        <div class="container">
            <div class="st-hotel-result">
                <div class="row">
                    <?php echo st()->load_template('layouts/modern/rental/elements/sidebar', '', array('format' => 'popupmap')); ?>
                    <?php
                    $query           = array(
                        'post_type'      => 'st_rental' ,
                        'post_status'    => 'publish' ,
                        's'              => '' ,
                        'orderby' => 'post_modified',
                        'order'   => 'DESC',
                        'posts_per_page' => get_option('posts_per_page', 10)
                    );
                    global $wp_query , $st_search_query;
                    $rental = STRental::inst();
                    $rental->alter_search_query();
                    query_posts( $query );
                    $st_search_query = $wp_query;
                    $rental->remove_alter_search_query();
                    wp_reset_query();
                    echo st()->load_template('layouts/modern/rental/elements/content3');
                    echo st()->load_template('layouts/modern/rental/elements/popupmap');
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
echo st()->load_template('layouts/modern/rental/elements/popup/date');
echo st()->load_template('layouts/modern/rental/elements/popup/guest');
get_footer();