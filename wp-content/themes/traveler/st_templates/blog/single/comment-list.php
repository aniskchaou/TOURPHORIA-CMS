<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single comment list
 *
 * Created by ShineTheme
 *
 */

$GLOBALS['comment'] = $comment;
/* override default avatar size */
$args['avatar_size'] = 50;
if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
    <div class="comment-body">
        <?php st_the_language('pingback') ?> <?php comment_author_link(); ?> <?php edit_comment_link(st_get_language('edit'), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>' ); ?>
    </div>
<?php else :

    $comment_class='';

    empty( $args['has_children'] ) ? '' :$comment_class.= 'parent';

    ?>
<li id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment_class ); ?>>
    <div id="div-comment-<?php comment_ID(); ?>" class="article comment  clearfix" inline_comment="comment">
        <div class="comment-author">
            <?php if ( 0 != $args['avatar_size'] ) {
                $comment_id=    get_comment_ID();
                $user_id=get_comment($comment_id)->user_id;
                echo st_get_profile_avatar( $user_id, $args['avatar_size'] );
            } ?>
        </div><!-- .comment-avatar -->
        <div class="comment-inner">
            <span class="comment-author-name"><?php printf( __( '%s', ST_TEXTDOMAIN ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></span>
            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.','traveler') ?></p>
            <?php endif; ?>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            <span class="comment-time">

                <?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . st_get_language('_ago') ?>
             </span>
            <span class="comment-reply"><i class="fa fa-reply"></i>
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </span>
           <!-- <a class="comment-like" href="#"><i class="fa fa-heart"></i> 23</a>-->
            <p class="comment-like">
                <?php $review_obj=new STReview();
                if($review_obj->check_like(get_comment_ID())):
                    ?>
                    <a class="comment-like st-like-comment fa fa-heart" data-id="<?php comment_ID(); ?>" href="#"><i class=""></i> <?php echo get_comment_meta(get_comment_ID(),'_comment_like_count',true) ?></a>
                    <!-- <a data-id="<?php /*comment_ID(); */?>" class="st-like-review fa fa-thumbs-o-down box-icon-inline round" href="#"></a><b class="text-color"> <?php /*echo get_comment_meta($comment_id,'_comment_like_count',true) */?></b>
 -->
                <?php
                else:
                    ?>
                    <a class="comment-like st-like-comment fa fa-heart-o" data-id="<?php comment_ID(); ?>" href="#"><i class=""></i> <?php echo get_comment_meta(get_comment_ID(),'_comment_like_count',true) ?></a>
                    <!--<a data-id="<?php /*comment_ID(); */?>" class="st-like-review fa fa-thumbs-o-up box-icon-inline round" href="#"></a><b class="text-color"> <?php /*echo get_comment_meta($comment_id,'_comment_like_count',true) */?></b>-->
                <?php endif; ?>
            </p>

        </div><!-- comment-inner-->
    </div><!-- .comment-body -->
<?php
endif;