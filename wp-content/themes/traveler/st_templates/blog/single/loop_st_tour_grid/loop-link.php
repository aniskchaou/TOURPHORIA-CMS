<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single loop link
 *
 * Created by ShineTheme
 *
 */
$link=get_post_meta(get_the_ID(),'link',true);
?>

<a class="post-link st_tour_grid_link st_tour_ver_hover_white st_tour_ver_btn text-color-hover" href="<?php echo esc_url($link) ?>"><?php echo esc_url($link) ?></a>