<?php
/**
 * Created by ShineTheme.
 * Developer: sejuani37
 * Date: 8/15/2017
 * Version: 1.0
 */
?>
<div class="st-post-grid style-1">
    <div class="header-thumb">
        <?php
        if(has_post_thumbnail(get_the_ID())) {
            echo get_the_post_thumbnail(get_the_ID(), array(360, 226));
        }else{
            echo st_get_default_image();
        }
        ?>
    </div>
    <div class="caption-post">
        <span class="time">
            <a href="<?php echo esc_url(get_day_link(get_the_date('Y'), get_the_date('m'), get_the_date('d'))) ?>"><?php echo get_the_date(get_option('date_format')) ?></a>
        </span>
        <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p class="short-desc"><?php
            echo wp_trim_words(get_the_excerpt(get_the_ID()), 10, '');
            ?>
        </p>
        <div class="author">
            <?php
            echo get_avatar( get_the_author_meta( 'ID' ) , 40 );
            ?>
            <span class="name"><?php echo esc_html__('BY', ST_TEXTDOMAIN)?> &nbsp;<span class="main-color"><?php echo get_the_author_meta('user_login'); ?></span></span>
        </div>
    </div>
</div>
