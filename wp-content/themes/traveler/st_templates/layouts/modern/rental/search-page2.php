<?php
get_header();
wp_enqueue_script('filter-rental-js');
?>
    <div id="st-content-wrapper" class="search-result-page layout2 st-rental ">
        <?php
        echo st()->load_template('layouts/modern/rental/elements/banner');
        ?>
        <div class="full-map hidden-xs hidden-sm">
            <?php echo st()->load_template('layouts/modern/rental/elements/search-form'); ?>
        </div>
        <div class="st-hotel-result" id="sticky-halfmap">
            <div class="container">
                <?php
                echo st()->load_template('layouts/modern/rental/elements/top-filter/top-filter');
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
                echo st()->load_template('layouts/modern/rental/elements/content2'); ?>
            </div>
        </div>
        <div class="as">
		    <?php echo st()->load_template('layouts/modern/common/footer1'); ?>
        </div>
    </div>
<?php
echo st()->load_template('layouts/modern/rental/elements/popup/date');
echo st()->load_template('layouts/modern/rental/elements/popup/guest');
wp_footer(); ?>
</body>
</html>