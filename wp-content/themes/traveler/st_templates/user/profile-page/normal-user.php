<?php if ( have_posts() ) : ?>
    <div class="container">
        <h1 class="page-title">
            <?php
            /*
             * Queue the first post, that way we know what author
             * we're dealing with (if that is the case).
             *
             * We reset this later so we can run the loop properly
             * with a call to rewind_posts().
             */
            the_post();

            printf( st_get_language('all_posts_by_s'), get_the_author() );
            ?>
        </h1>
        <?php if ( get_the_author_meta( 'description' ) ) : ?>
            <div class="author-description"><?php the_author_meta( 'description' ); ?></div>
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="row">
            <?php $sidebar_pos=apply_filters('st_blog_sidebar','right');
            if($sidebar_pos=="left"){
                get_sidebar('blog');
            }
            ?>
            <div class="<?php echo apply_filters('st_blog_sidebar','right')=='no'?'col-sm-12':'col-sm-9'; ?>">
                <?php
                rewind_posts();
                if(have_posts()):
                    while(have_posts())
                    {
                        the_post();
                        ?>
                        <article <?php post_class('post')?>>
                            <?php if(get_post_format()):?>
                                <header class="post-header">
                                    <?php echo st()->load_template('blog/single/loop/loop',get_post_format());?>
                                </header>
                            <?php endif;?>

                            <div class="post-inner">
                                <?php echo st()-> load_template('blog/single/content','meta');?>
                                <?php
                                the_excerpt();
                                wp_link_pages( );
                                the_tags(st_get_language('tags:'));
                                edit_post_link(st_get_language('edit_this_post'), '<p>', '</p>');
                                ?>
                            </div>
                        </article>
                        <?php
                    }
                    TravelHelper::paging();
                else:
                    get_template_part('content','none');
                endif;
                ?>
            </div>
            <?php $sidebar_pos=apply_filters('st_blog_sidebar','right');
            if($sidebar_pos=="right"){
                get_sidebar('blog');
            }
            ?>
        </div>
    </div>
<?php endif;?>