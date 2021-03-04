<?php
get_header();
wp_enqueue_script('filter-activity-js');
?>
    <div id="st-content-wrapper" class="search-result-page st-tours st-activity">
        <?php
        echo st()->load_template('layouts/modern/hotel/elements/banner');
        ?>
        <div class="container">
            <div class="st-hotel-result">
                <div class="row">
                    <?php echo st()->load_template('layouts/modern/activity/elements/sidebar'); ?>
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
                    echo st()->load_template('layouts/modern/activity/elements/content');
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
echo st()->load_template('layouts/modern/hotel/elements/popup/date');
echo st()->load_template('layouts/modern/hotel/elements/popup/guest');
get_footer();