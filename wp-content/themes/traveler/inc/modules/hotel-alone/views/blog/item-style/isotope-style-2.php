<?php
/**
 * Created by ShineTheme.
 * Developer: sejuani37
 * Date: 8/15/2017
 * Version: 1.0
 */

$post_cat_lists = get_the_terms(get_the_ID(), 'category');
$cat_slug = '';
if (is_array($post_cat_lists) && !empty($post_cat_lists)) {
    foreach ($post_cat_lists as $cat) {
        $cat_slug .= ' ' . $cat->slug;
    }
}
?>
<div class="grid-item col-md-12 st-post-isotope style-2 <?php echo ($index%2 == 0?'even-item':'')?> <?php echo esc_attr($cat_slug)?>">
    <div class="blog-media">
        <?php echo st_hotel_alone_load_view('blog/blog-content/format/format',get_post_format()) ?>
    </div>
    <div class="blog-meta">
        <div class="table-cell text-center">
            <div class="meta-date">
                <span><?php echo get_the_date(get_option('date_format')); ?></span>
            </div>
            <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="blog-item-meta-category text-center">
                <?php the_category(' '); ?>
            </div>

            <div class="desc">
                <?php echo wp_trim_words(get_the_excerpt(get_the_ID()),60,' ...')?>
            </div>
            <div class="meta-footer">
                <div class="link">
                    <a href="<?php the_permalink(); ?>" class="btn-bg-black btn-size-0"><?php esc_html_e('CONTINUE READING',ST_TEXTDOMAIN);?></a>
                </div>
                <div class="in-line">

                    <?php echo st_hotel_alone_load_view('blog/social-share') ?>
                    <span class="separator"></span>
                    <span class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                            <?php esc_html_e("By",ST_TEXTDOMAIN) ?>
                            <span class="text-up"> <?php echo get_the_author(); ?> </span>
                        </a>
                     </span>
                    <span class="separator"></span>
                    <span class="comment-c">
                        <a href="<?php echo esc_url( get_comments_link() ); ?>">
                            <?php echo get_comments_number(); ?>
                            <?php echo _n('Comment', 'Comments', get_comments_number(), ST_TEXTDOMAIN ); ?>
                        </a>
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>