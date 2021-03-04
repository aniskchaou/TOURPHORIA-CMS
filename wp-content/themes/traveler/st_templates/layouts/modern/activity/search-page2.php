<?php
get_header();
wp_enqueue_script('filter-activity-js');
?>
    <div id="st-content-wrapper" class="search-result-page st-tours st-activity">
        <div id="tour-top-search"></div>
        <?php
        echo st()->load_template('layouts/modern/hotel/elements/banner');
        ?>
        <div class="search-form-top">
            <?php echo st()->load_template('layouts/modern/activity/elements/search-form'); ?>
        </div>
        <div class="container">
            <div class="st-hotel-result tour-top-search">
                    <?php
                    $query           = array(
                        'post_type'      => 'st_activity' ,
                        'post_status'    => 'publish' ,
                        's'              => '' ,
                        'orderby' => 'post_modified',
                        'order'   => 'DESC',
                    );
                    global $wp_query , $st_search_query;
                    $activity = STActivity::inst();
                    $activity->alter_search_query();
                    query_posts( $query );
                    $st_search_query = $wp_query;
                    $activity->remove_alter_search_query();
                    wp_reset_query();
                    echo st()->load_template('layouts/modern/activity/elements/content2');
                    ?>
            </div>
        </div>
    </div>
<?php
echo st()->load_template('layouts/modern/hotel/elements/popup/date');
echo st()->load_template('layouts/modern/hotel/elements/popup/guest');
get_footer();