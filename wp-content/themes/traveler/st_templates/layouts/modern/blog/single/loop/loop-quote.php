<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single loop quote
 *
 * Created by ShineTheme
 *
 */
if( $excerpt = get_the_excerpt() ){
?>
    <blockquote><?php the_excerpt()?></blockquote>
<?php } ?>
