<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single loop audio
 *
 * Created by ShineTheme
 *
 */
$media_url=get_post_meta(get_the_ID(),'media',true);

if($media_url){
    echo "<div class='media-responsive st_tour_grid'>";
    echo st_fix_iframe_w3c(wp_oembed_get($media_url));
    echo "</div>";
}