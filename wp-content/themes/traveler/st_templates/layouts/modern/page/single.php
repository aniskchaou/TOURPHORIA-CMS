<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 30-11-2018
     * Time: 9:24 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
    while ( have_posts() ): the_post();
        ?>
        <div id="st-content-wrapper">
            <?php
                $blog_image = st()->get_option( 'header_blog_image' );
                if ( !empty( $blog_image ) ) {
                    ?>
                    <div class="blog-header" style="background-image: url(<?php echo $blog_image; ?>)">
                        <div class="container">
                            <h2 class="blog-header-title"><?php echo esc_html__( 'Blog', ST_TEXTDOMAIN ) ?></h2>
                        </div>
                    </div>
                <?php } ?>
            <?php st_breadcrumbs_new() ?>
            <div class=" st-blog ">
                <div class="container">
                    <div class="blog-content content">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="article">
                                    <div class="header">
                                        <header class="post-header">
                                            <?php
                                                $format = get_post_format();
                                                if ( !$format ) {
                                                    $format = 'image';
                                                }
                                                echo st()->load_template( 'layouts/modern/blog/single/loop/loop', $format );
                                            ?>
                                        </header>
                                        <?php echo st()->load_template( 'layouts/modern/blog/content', 'cate' ); ?>
                                    </div>
                                    <h2 class="title"><?php the_title() ?></h2>
                                    <div class="post-info">
                                <span class="date">
                                    <?php echo get_the_date(); ?>
                                </span>
                                        <span class="count-comment">
                                    <?php comments_number( __( '0 comment', ST_TEXTDOMAIN ), __( '1 comment', ST_TEXTDOMAIN ), __( '% comments', ST_TEXTDOMAIN ) ); ?>
                                </span>
                                    </div>
                                    <div class="post-content"><?php the_content() ?></div>
                                    <div class="st-flex space-between">
                                        <div class="tags">
                                            <?php
                                                $tags = get_the_tags();
                                                if ( $tags ) {
                                                    foreach ( $tags as $tag ) {
                                                        ?>
                                                        <a href="<?php echo get_tag_link( $tag->ID ) ?>"
                                                           class="tag-item"><?php echo $tag->name ?></a>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <div class="share">
                                            <?php echo __( 'Share', ST_TEXTDOMAIN ); ?>
                                            <a class="facebook share-item"
                                               href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>&amp;title=<?php the_title() ?>"
                                               target="_blank" rel="noopener" original-title="Facebook"><i
                                                        class="fa fa-facebook fa-lg"></i></a>
                                            <a class="twitter share-item"
                                               href="https://twitter.com/share?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>"
                                               target="_blank" rel="noopener" original-title="Twitter"><i
                                                        class="fa fa-twitter fa-lg"></i></a>
                                        </div>
                                    </div>
                                    <div class="author-info">
                                        <div class="media">
                                            <div class="media-left">
                                                <?php
                                                    $author_id = get_post_field( 'post_author', get_the_ID() );
                                                ?>
                                                <?php echo st_get_profile_avatar( $author_id, 100 ) ?>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><?php echo TravelHelper::get_username( $author_id ); ?></h4>
                                                <?php
                                                    $user_des = get_user_meta( $author_id, 'description', true );
                                                    if ( $user_des ) {
                                                        ?>
                                                        <div class="desc"><?php echo balanceTags( $user_des ); ?></div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pagination clearfix">
                                        <?php
                                            the_post_navigation( [
                                                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', ST_TEXTDOMAIN ) . '</span> ' . '<i class="fa fa-angle-right"></i>',
                                                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . '<i class="fa fa-angle-left"></i>' . __( 'Previous', ST_TEXTDOMAIN ) . '</span> ',
                                            ] );
                                        ?>
                                    </div>
                                    <div id="comment-wrapper">
                                        <h2 class="title"><?php comments_number( __( 'Comment (0)', ST_TEXTDOMAIN ), __( 'Comment (1)', ST_TEXTDOMAIN ), __( 'Comments (%)', ST_TEXTDOMAIN ) ); ?></h2>
                                        <ol class="comment-list">
                                            <?php
                                                $comment_per_page = (int)get_option( 'comments_per_page', 10 );
                                                $paged            = ( get_query_var( 'cpage' ) ) ? get_query_var( 'cpage' ) : 1;

                                                $offset         = ( $paged - 1 ) * $comment_per_page;
                                                $args           = [
                                                    'number'  => $comment_per_page,
                                                    'offset'  => $offset,
                                                    'post_id' => get_the_ID(),
                                                    'status' => ['approve']
                                                ];
                                                $comments_query = new WP_Comment_Query;
                                                $comments       = $comments_query->query( $args );

                                                wp_list_comments( [
                                                    'style'       => 'ol',
                                                    'short_ping'  => true,
                                                    'avatar_size' => 50,
                                                    'page'        => $paged,
                                                    'per_page'    => $comment_per_page,
                                                    'callback'    => [ 'TravelHelper', 'comments_list_new' ]
                                                ], $comments );
                                            ?>
                                        </ol>
                                        <?php
                                            if ( comments_open( ) ) {
                                                wp_enqueue_script( 'comment-reply' )
                                                ?>
                                                <div id="write-comment">
                                                    <?php
                                                        TravelHelper::comment_form_post();
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <!--Sidebar-->
                                <aside class='sidebar-right'>
                                    <?php dynamic_sidebar( apply_filters( 'st_blog_sidebar_id', 'blog-sidebar' ) ); ?>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
