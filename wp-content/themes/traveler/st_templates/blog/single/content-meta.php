<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single content meta
 *
 * Created by ShineTheme
 *
 */
?>
<h4 class="post-title"><a class="text-darken" href="<?php the_permalink()?>"><?php the_title()?></a></h4>
<ul class="post-meta">
    <li><i class="fa fa-calendar"></i><a href="<?php the_permalink()?>"><?php the_time(get_option('date_format').' '.get_option('time_format'))?></a>
    </li>
    <li><i class="fa fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author() ?></a>
    </li>
    <li><i class="fa fa-tags"></i><?php the_category(', '); ?>
    </li>
    <li><i class="fa fa-comments"></i><a href="<?php echo get_comments_link()?>"><?php  comments_number( st_get_language('0_comment'), st_get_language('1_comment'), st_get_language('s_comment'))?></a>
    </li>
</ul>