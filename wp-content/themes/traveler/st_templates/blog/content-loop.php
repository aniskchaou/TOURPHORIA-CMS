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
<div class="col-xs-12">
<div <?php  post_class('article post') ?> >
    <?php if(get_post_format()):?>
        <header class="post-header">
            <?php echo st()->load_template('blog/single/loop/loop',get_post_format());?>
        </header>
    <?php elseif(has_post_thumbnail() and get_the_post_thumbnail() ):?>
        <header class="post-header">
            <?php echo st()->load_template('blog/single/loop/loop-image');?>
        </header>
    <?php endif;?>
<div class="post-inner">
    <?php echo st()-> load_template('blog/single/content','meta');?>
    <div class="post-desciption">
        <?php the_excerpt()?>
    </div>
    <a class="btn btn-small btn-primary" href="<?php the_permalink()?>"><?php esc_html_e('Read More','traveler')?></a>
</div>
</div>
</div>
