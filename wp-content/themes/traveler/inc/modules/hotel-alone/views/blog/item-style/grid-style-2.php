<?php
/**
 * Created by ShineTheme.
 * Developer: sejuani37
 * Date: 8/15/2017
 * Version: 1.0
 */
?>
<div class="st-post-grid style-2 <?php echo ($index%2 == 0?'even-item':'')?>">
    <div class="header-thumb">
        <?php
            if(has_post_thumbnail() and get_the_post_thumbnail()){
                echo get_the_post_thumbnail(get_the_ID(), array(476, 575));
            }else{
                echo st_get_default_image();
            }
        ?>
        <span class="time text-center">
            <span class="day"><?php echo get_the_date('d')?></span><br><?php echo get_the_date('F')?>
        </span>
    </div>
    <div class="caption-post">
        <div class="st-categories">
            <?php the_category(', '); ?>
        </div>
        <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p class="short-desc"><?php
            echo wp_trim_words(get_the_excerpt(get_the_ID()), 14, '');
            ?>
        </p>
        <div class="author">
            <?php
            echo get_avatar( get_the_author_meta( 'ID' ) , 40 );
            ?>
            <span class="name"><?php echo esc_html__('BY', ST_TEXTDOMAIN)?> &nbsp;<span class="main-color"><?php echo get_the_author_meta('user_login'); ?></span></span>
        </div>
        <a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html__('Read more', ST_TEXTDOMAIN)?> <i class="fa fa-long-arrow-right"></i></a>
    </div>
</div>