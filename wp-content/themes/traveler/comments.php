<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Custom comment
 *
 * Created by ShineTheme
 *
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;

wp_enqueue_script('comment');
wp_enqueue_script('comment-reply');

?>
<div id="comments" class="comments-area">
    <h2><?php esc_html_e('Post Discussion','traveler')?></h2>
    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title">
            <?php
            printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', ST_TEXTDOMAIN ),
                number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );

            ?>
        </h3>
        <ol class="comment-list unstylelist">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 74,
                'callback'=>array('TravelHelper','comments_list')
            ) );
            ?>
        </ol><!-- .comment-list -->
        <?php
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text section-heading"><?php esc_html_e('Comment navigation','traveler')?></h1>
                <div class="nav-previous"><?php previous_comments_link( st_get_language('older_comments') ); ?></div>
                <div class="nav-next"><?php next_comments_link( st_get_language('newer_comments') ); ?></div>
            </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.','traveler') ?></p>
        <?php endif; ?>
    <?php endif; // have_comments() ?>
    <div id="review_form_wrapper">
        <div id="review_form">
            <?php
            $commenter = wp_get_current_commenter();
            $comment_form = array(
                'title_reply'          => have_comments() ? st_get_language('add_a_comment') : st_get_language('be_the_first_to_comment') . ' &ldquo;' . get_the_title() . '&rdquo;',
                'title_reply_to'       => st_get_language('leave_a_reply_to_s'),
                'comment_notes_before' => '',
                'fields'               => array(
                    'author' => '<div class="row">
							                <div class="form-group">
							                    <div class="col-md-6">' .
                        '<input id="author"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true"  class="form-control" placeholder="'.st_get_language('name').'" />
							                     </div>   ',
                    'email'  => '<div class="col-md-6">' .
                        '<input  placeholder="'.st_get_language('your_email_address').'"  class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div>
							                </div>
							                </div><!--End row-->',
                ),
                'label_submit'  => st_get_language('post_comment'),
                'logged_in_as'  => '',
                'comment_field' => '
                                        <div class="form-group">
                                                <textarea class="form-control" id="comment" name="comment" cols="40" rows="5" placeholder="'.st_get_language('message').'"></textarea>
                                        </div>
                                    ',
                'comment_notes_after'=>''
            );
            comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
            ?>
        </div>
    </div>
</div><!-- #comments -->
