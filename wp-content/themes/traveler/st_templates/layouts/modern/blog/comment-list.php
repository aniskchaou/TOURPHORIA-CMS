<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Single comment list
     *
     * Created by ShineTheme
     *
     */

    $GLOBALS[ 'comment' ]  = $comment;
    $comment_id            = $comment->comment_ID;
    $user_id               = $comment->user_id;
    $args[ 'avatar_size' ] = 50;
    if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
        <div class="comment-body">
            <?php st_the_language( 'pingback' ) ?><?php comment_author_link(); ?><?php edit_comment_link( st_get_language( 'edit' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>' ); ?>
        </div>
    <?php else :
        $comment_class = '';
        empty( $args[ 'has_children' ] ) ? '' : $comment_class .= 'parent';
        ?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment_class ); ?>>
        <div id="div-comment-<?php comment_ID(); ?>" class="article comment  clearfix" inline_comment="comment">
            <div class="comment-item-head">
                <div class="media">
                    <div class="media-left">
                        <?php echo st_get_profile_avatar( $user_id, $args[ 'avatar_size' ] ); ?>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo TravelHelper::get_username( $user_id ); ?></h4>
                        <div class="date"><?php echo get_comment_date( TravelHelper::getDateFormat(), $comment_id ) ?></div>
                    </div>
                </div>
            </div>
            <div class="comment-item-body">
                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', ST_TEXTDOMAIN ) ?></p>
                <?php endif; ?>
                <div class="comment-content">
                    <?php comment_text(); ?>
                </div>
                <span class="comment-reply">
                    <?php comment_reply_link( array_merge( $args, [ 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ] ) ); ?>
            </span>
            </div>
        </div>
    <?php
    endif;