<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Loop content blog
 *
 * Created by ShineTheme
 *
 */

?>
<div <?php  post_class('article post') ?> >
    <div class="header">
        <?php if(get_post_format()):?>
            <header class="post-header">
                <?php echo st()->load_template('layouts/modern/blog/single/loop/loop',get_post_format());?>
            </header>
        <?php elseif(has_post_thumbnail() and get_the_post_thumbnail() ):?>
            <header class="post-header">
                <?php echo st()->load_template('layouts/modern/blog/content', 'image');?>
            </header>
        <?php endif;?>
        <?php echo st()->load_template('layouts/modern/blog/content', 'cate');?>
    </div>
    <div class="post-inner">
        <h4 class="post-title"><a class="text-darken" href="<?php the_permalink()?>"><?php the_title()?></a></h4>
        <?php echo st()-> load_template('layouts/modern/blog/content','meta');?>
        <div class="post-desciption">
            <?php the_excerpt()?>
        </div>
        <a class="btn-readmore" href="<?php the_permalink()?>"><?php esc_html_e('Read More',ST_TEXTDOMAIN)?></a>
    </div>
</div>