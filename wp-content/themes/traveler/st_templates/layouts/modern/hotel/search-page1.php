<?php
get_header();
wp_enqueue_script('filter-hotel-js');
?>
    <div id="st-content-wrapper" class="search-result-page">
<?php
echo st()->load_template('layouts/modern/hotel/elements/banner');
$zoom_map = get_post_meta(get_the_ID(), 'rs_map_room', true);
if(empty($zoom_map)) $zoom_map = 13;
?>
    <div class="full-map">
        <?php echo st()->load_template('layouts/modern/common/loader', 'map'); ?>
        <div class="full-map-item">
            <div class="title-map-mobile hidden-lg hidden-md"><?php echo __('MAP', ST_TEXTDOMAIN); ?> <span class="close-map"><?php echo TravelHelper::getNewIcon('Ico_close', '#A0A9B2', '20px', '20px'); ?></span></div>
            <div id="map-search-form" style="width: 100%; height: 500px" class="full-map-form" data-disablecontrol="true" data-showcustomcontrol="true" data-zoom="<?php echo esc_attr($zoom_map); ?>" data-popup-position="right"></div>
        </div>
        <?php echo st()->load_template('layouts/modern/hotel/elements/search-form'); ?>
    </div>
    <div class="container">
        <div class="st-hotel-result style-full-map">
            <div class="row">
                <?php echo st()->load_template('layouts/modern/hotel/elements/sidebar'); ?>
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
                echo st()->load_template('layouts/modern/hotel/elements/content');
                ?>
            </div>
        </div>
    </div>
    </div>
<?php
    echo st()->load_template('layouts/modern/hotel/elements/popup/date');
    echo st()->load_template('layouts/modern/hotel/elements/popup/guest');
get_footer();