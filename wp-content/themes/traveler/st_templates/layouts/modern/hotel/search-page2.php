<?php
get_header();
wp_enqueue_script('filter-hotel-js');
?>
    <div id="st-content-wrapper" class="search-result-page layout2">
        <?php
        echo st()->load_template('layouts/modern/hotel/elements/banner');
        ?>
        <div class="full-map hidden-xs hidden-sm">
            <?php echo st()->load_template('layouts/modern/hotel/elements/search-form'); ?>
        </div>
        <div class="st-hotel-result" id="sticky-halfmap">
            <div class="container">
                <?php
                echo st()->load_template('layouts/modern/hotel/elements/top-filter/top-filter');
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
                echo st()->load_template('layouts/modern/hotel/elements/content2'); ?>
            </div>
        </div>
        <div class="as">
		    <?php echo st()->load_template('layouts/modern/common/footer1'); ?>
        </div>
    </div>
<?php
echo st()->load_template('layouts/modern/hotel/elements/popup/date');
echo st()->load_template('layouts/modern/hotel/elements/popup/guest');
wp_footer(); ?>
</body>
</html>