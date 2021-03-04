<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Reviews
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

$potype = get_post_type(get_the_ID());
$item_id=get_the_ID();
$obj = get_post_type_object( $potype );
$name = $obj->labels->singular_name;

wp_enqueue_script('comment');
wp_enqueue_script('comment-reply');
wp_enqueue_script('st-reviews-form');
?>
<div id="comments" class="comments-area">


    <?php    // get list comment
    $number=(int)STReview::count_all_comment($item_id);
    if ( $number) : ?>

        <ul class="booking-item-reviews list">
            <?php
            wp_list_comments( array(
                'style'       => 'ul',
                'short_ping'  => true,
                'avatar_size' => 74,
                'callback'=>array('TravelHelper','reviewlist'),
                'per_page'=>get_option('comments_per_page')
            ) );
            ?>
        </ul>
        <!-- .comment-list -->
        <div class="gap gap-small"></div>
        <div class="row wrap">
            <div class="col-md-5">
                <p ><small><?php

                        if($number>1){
                            $name = $obj->labels->name;
                            printf(st_get_language('s_reviews'),$number);
                        }else{
                            printf(st_get_language('s_review'),$number);
                            $name = $obj->labels->singular_name;
                        }
                        if($name == 'Hotels'){
                            $name = $obj->labels->singular_name;
                        }

                        echo ' '.st_get_language('on_this').' '.$name.' &nbsp;&nbsp; '.st_get_language('showing')
                        ?>


                        <?php
                        $limit=get_option('comments_per_page');
                        $page = get_query_var('cpage');
                        if ( !$page )
                            $page = 1;

                        $page--;

                        $to=($page+1)*$limit;

                        if(STReview::count_all_comment($item_id)<$to)
                        {
                            $to=STReview::count_all_comment($item_id);
                        }
                        printf(st_get_language('d_to_d'),($limit*$page)+1,$to)?></small>
                </p>
            </div>
            <div class="col-md-7">

                <?php
                // Are there comments to navigate through?
                if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                    TravelHelper::comments_paging();
                    ?>

                <?php endif; // Check for comment navigation ?>

            </div>
        </div>

    <?php endif; // end get list comment
    if(!$number)
    {
        ?>
        <div class="alert alert-warning"><?php _e('There is no review',ST_TEXTDOMAIN) ?></div>
        <?php
    }
    ?>


    <div class="gap gap-small"></div>


    <?php
    $commenter = wp_get_current_commenter();

    $comment_form = array(
        'title_reply'          => st_get_language('write_a_review'),
        'title_reply_to'       => st_get_language('leave_a_reply_to').__( ' %s', ST_TEXTDOMAIN ),
        'comment_notes_before' => '',
        'fields'               => array(
            'author' => '<div class="row">

                                        <div class="col-md-6"><div class="form-group">' .
                '
                <label for="author">'.__('Name*',ST_TEXTDOMAIN).'</label>
                <input id="author"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true"  class="form-control"  />
                                         </div></div>   ',
            'email'  => '<div class="col-md-6"><div class="form-group">' .

                '

                <label for="email">'.__('Your email address *',ST_TEXTDOMAIN).'</label>
                <input   class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div>
                                    </div>
                                    </div><!--End row-->',
        ),
        'label_submit'  => st_get_language('leave_a_review'),
        'logged_in_as'  => '',
        'comment_field' => '',
        'comment_notes_after'=>''
    );

    $comment_form['comment_field'] = '
                                        <input name="comment_type" value="st_reviews" type="hidden">
                                        <div class="form-group">
                                            <label>'.st_get_language('your_rating').'</label>
                                            <ul class="icon-list add_rating icon-group booking-item-rating-stars">
                                                    <li class=""><i class="fa fa-star-o text-color"></i>
                                                    </li>
                                                    <li class=""><i class="fa fa-star-o text-color"></i>
                                                    </li>
                                                    <li class=""><i class="fa fa-star-o text-color"></i>
                                                    </li>
                                                    <li class=""><i class="fa fa-star-o text-color"></i>
                                                    </li>
                                                    <li class=""><i class="fa fa-star-o text-color"></i>
                                                    </li>
                                            </ul>
                                            <input name="comment_rate" class="comment_rate" type="hidden">
                                        </div>';

    $comment_form['comment_field'].='<div class="form-group">
                                    <label for="label_comment_title">'.st_get_language('review_title').'</label>
                                    <input class="form-control" type="text" name="comment_title" id="label_comment_title">
                                </div>';

    $comment_form['comment_field'].='<div class="form-group">
                                    <label for="comment">'.st_get_language('review_text').'</label>
                                    <textarea name="comment" id="comment" class="form-control" rows="6"></textarea>
                                </div>

                                ';

    /* comment message for user and guest */

    $comment_form_arg= apply_filters(get_post_type($item_id).'_wp_review_form_args',$comment_form, $item_id );
    $review_check = STReview::review_check($item_id) ;
    switch ($review_check) {
        case "true":
            echo '<div class="box bg-gray">';
            comment_form( $comment_form_arg );
            echo "</div>";
            break;
        case "must_login":
            echo '<div class="box bg-gray">';
            $enable_popup_login = st()->get_option('enable_popup_login','off');
            $page_login = st()->get_option('page_user_login');
            $login_modal = '';
            $page_login = esc_url(get_the_permalink($page_login));
            if($enable_popup_login == 'on'){
                $login_modal = 'data-toggle="modal" data-target="#login_popup"';
                $page_login = 'javascript:void(0)';
            }
            echo sprintf( st_get_language('you_must').'<a '. $login_modal .' href="'.$page_login.'">'.__('log in ',ST_TEXTDOMAIN).'</a>'.st_get_language('to_write_review'),get_permalink(st()->get_option('user_login_page')));
            echo '</div>';
            break;
        case "need_open":
            echo '<div class="box bg-gray">';
            echo sprintf(__("Review is disabled from administrator" , ST_TEXTDOMAIN));
            echo '</div>';
            break;
        case "need_booked":
            echo '<div class="box bg-gray">';
            //echo sprintf(st_get_language('you_must') . " ".__("book before write review" , ST_TEXTDOMAIN));
            _e('You must make a booking before writing a review',ST_TEXTDOMAIN);
            echo '</div>';
            break;
        case "wait_check_out_date":
            echo '<div class="box bg-gray">';
            //echo sprintf(st_get_language('you_must') . " ".__("experience of this tour to write review" , ST_TEXTDOMAIN));
            global $wp_post_types;
            $obj = $wp_post_types[get_post_type(get_the_ID())];
            $name = $obj->labels->singular_name;
            _e('You must experience of this ' ,ST_TEXTDOMAIN)._e($name). _e(' to write review',ST_TEXTDOMAIN);
            echo '</div>';
            break;
        case "reviewed":
            echo '<div class="box bg-gray">';
            echo st_get_language('you_have_been_post_a_review').' '.$name;
            echo '</div>';
            break;
    }
    ?>

</div><!-- #comments -->