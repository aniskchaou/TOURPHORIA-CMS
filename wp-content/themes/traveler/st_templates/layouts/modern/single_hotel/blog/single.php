<?php get_header('hotel-activity');
$category_detail=get_the_category(get_the_ID());?>
    <div class="st-single-hotel-modern-page">
        <?php $banner_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        $img_banner = st()->get_option('header_blog_image', '');
        $class_bg = '';
        if($img_banner)
            $class_bg = Assets::build_css('background: #ccc url('.esc_url($img_banner).') center no-repeat');
        if(isset($is_room_alone))
            $is_room_alone = true;
        else
            $is_room_alone = false;
        ?>
        <div class="sts-banner <?php echo $class_bg; ?>">
            <h1 class="page-title sts-pf-font">
                <?php echo esc_html__("Blog", ST_TEXTDOMAIN);?>
            </h1>
        </div>
        <div class="container">
        	<div class="single-category-blog">
    			<?php 
    			foreach ($category_detail as $key => $cat) { ?>
    				<span class="category"><a href="<?php echo esc_url(get_category_link($cat->term_id));?>" title="<?php echo ($cat->name)?>"><?php echo ($cat->name)?></a></span>
    			<?php }
    			?>
    		</div>
        	<div class="row">
                <div class="col-md-12">
                     <?php
                        the_post_navigation( [
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'PRE', ST_TEXTDOMAIN ) . '</span> ' . '<img src="'.get_template_directory_uri().'/v2/images/assets/ico_pre.svg">',
                             'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'NEXT', ST_TEXTDOMAIN ) . '</span> ' . '<img src="'.get_template_directory_uri().'/v2/images/assets/ico_next.svg">',
                        ] );
                    ?>
                    <div class="st-title-single">
                        <h2 class="blog-header-title"><?php the_title();?></h2>
                    </div>
                </div>
        	</div>
            <?php if($banner_image) : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="st-feature-image">
                        <img src="<?php echo esc_url($banner_image)?>" alt="<?php echo get_the_title();?>">
                    </div>
                </div>
            </div>
            <?php endif;?>
            <div class="st-content-post">
                <?php
                while ( have_posts() ) {
                    the_post();
                    the_content();
                }
                
                ?>
                <div class="author-info">
                    <div class="media">
                        <div class="media-left">
                            <?php
                                $author_id = get_post_field( 'post_author', get_the_ID() );
                                $facebook_author = get_the_author_meta( 'facebook_author', $author_id );

                                $twitter_author = get_the_author_meta( 'twitter_author', $author_id );
                                $instagram_author = get_the_author_meta( 'instagram_author', $author_id );
                            ?>
                            <?php echo st_get_profile_avatar( $author_id, 100 ); ?>
                            
                        </div>
                        <div class="media-body">
                            <div class="title-body">
                                 <h4 class="media-heading"><?php echo TravelHelper::get_username( $author_id ); ?></h4>
                                <?php if(!empty($facebook_author) || !empty($twitter_author) || !empty($instagram_author)){
                                ?>
                                    <div class="st-social">
                                        <?php
                                        if(!empty($facebook_author)){ ?>
                                            <a href="<?php echo esc_url($facebook_author);?>" title="">
                                                <img src="<?php echo get_template_directory_uri().'/v2/images/assets/ico_facebook_footer.svg';?>" alt="">
                                            </a>
                                        <?php }
                                        ?>
                                        <?php
                                        if(!empty($twitter_author)){ ?>
                                            <a href="<?php echo esc_url($twitter_author);?>" title="">
                                                <img src="<?php echo get_template_directory_uri().'/v2/images/assets/ico_twitter_footer.svg';?>" alt="">
                                            </a>
                                        <?php }
                                        ?>
                                        <?php
                                        if(!empty($instagram_author)){ ?>
                                            <a href="<?php echo esc_url($instagram_author);?>" title="">
                                                <img src="<?php echo get_template_directory_uri().'/v2/images/assets/ico_instagram.svg';?>" alt="">
                                            </a>
                                        <?php }
                                        ?>
                                    </div>
                                <?php }?>
                            </div>
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
                                'callback'    => [ 'TravelHelper', 'comments_list_new_single_hotel' ]
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
                <?php wp_reset_query();
                 ?>
            </div>
            
        </div>
    </div>
    <div class="check_availability">
        <div class="container-fluid">
            <div class="row">
                <?php echo do_shortcode( '[st_single_hotel_check_availability_new]' );?>
            </div>
        </div>
    </div>
    
    
<?php get_footer('hotel-activity');?>