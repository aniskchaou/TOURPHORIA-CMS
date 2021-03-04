<?php
/**
 * Created by ShineTheme.
 * Developer: sejuani37
 * Date: 8/15/2017
 * Version: 1.0
 */
?>

<div class="st-post-list style-1">
    <div class="create-time">
        <span class="day"><?php echo get_the_date('d')?></span><span class="month"><?php echo get_the_date('F')?></span>
    </div>
    <div class="caption">
        <h3 class="title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="meta">
            <span class="author">
                <?php echo get_the_author_meta('user_login'); ?>
            </span> /
            <span class="cate"><?php the_category(', '); ?></span>
        </div>
    </div>
</div>