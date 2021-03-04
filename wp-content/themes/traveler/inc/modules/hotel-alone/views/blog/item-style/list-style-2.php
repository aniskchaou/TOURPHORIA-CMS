<div <?php post_class('st-post-list style-2') ?>>
    <div class="blog-item-meta-date text-center">
        <span><?php echo get_the_date(get_option('date_format')); ?></span>
    </div>
    <h2 class="blog-item-title text-center">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <div class="blog-item-meta-category text-center">
        <?php the_category(' '); ?>
    </div>
    <div class="blog-media">
        <?php echo st_hotel_alone_load_view('blog/blog-content/format/format',get_post_format()) ?>
    </div>
    <div class="blog-item-meta-desc">
        <?php the_excerpt(); ?>
    </div>
    <div class="blog-item-meta-footer">
        <div class="blog-item-link">
            <a href="<?php the_permalink(); ?>" class="btn-bg-black btn-size-0"><?php esc_html_e('CONTINUE READING',ST_TEXTDOMAIN);?> <i class="fa fa-long-arrow-right"></i></a>
        </div>
        <div class="blog-item-meta">
            <?php
            if(is_sticky(get_the_ID())){
                echo '<span class="sticky"><i class="fa fa-thumb-tack"></i> '.esc_html__('Sticky', ST_TEXTDOMAIN).'</span>';
                echo '<span class="separator"></span>';
            }
                echo st_hotel_alone_load_view('blog/social-share');
                echo '<span class="separator"></span>';
            ?>
            <span><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                    <?php esc_html_e("By",ST_TEXTDOMAIN) ?>
                    <span class="text-up"> <?php echo get_the_author(); ?> </span>
                </a>
            </span>
            <span class="separator"></span>
            <span class="text-up">
                <a href="<?php echo esc_url( get_comments_link() ); ?>">
                    <?php echo get_comments_number(); ?>
                    <?php echo _n('Comment', 'Comments', get_comments_number(), ST_TEXTDOMAIN ); ?>
                </a>
            </span>
        </div>
    </div>
</div>