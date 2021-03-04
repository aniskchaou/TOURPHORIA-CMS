<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity content
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script('filter-ajax-all-posttype.js');
extract($attr);
?>
<div class="ajax-filter-cover" data-style="<?php echo (isset($st_style) && $st_style != '') ? $st_style : '1' ; ?>" data-number="<?php echo (isset($st_number) && $st_number != '') ? $st_number : '3'; ?>" data-post-type="<?php echo esc_attr($data_post_type); ?>">
    <div class="ajax-filter-loading">
        <img src="<?php echo ST_TRAVELER_URI; ?>/img/loading-filter-ajax.gif"
             alt="<?php echo __('Loading all post type', ST_TEXTDOMAIN); ?>"/>
    </div>
    <div id="ajax-filter-content"></div>
</div>
