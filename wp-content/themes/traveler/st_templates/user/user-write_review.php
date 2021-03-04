<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User write review
 *
 * Created by ShineTheme
 * @update 1.1.1
 */
wp_enqueue_script('comment');
wp_enqueue_script('comment-reply');
wp_enqueue_script('st-reviews-form');

$item_id=STInput::get('item_id');
$comment_post_id=apply_filters('st_real_comment_post_id',$item_id);
$title=get_the_title($item_id);

?>
<div class="st-create" id="write_review_<?php echo esc_attr($item_id); ?>">
    <h3><?php printf(st_get_language('user_write_review_for'),$title) ?></h3>
</div>


    <form action="" method="post" enctype="multipart/form-data"  id="st_user_comments" class="comment-form">
        <input name="item_id" value="<?php echo STInput::get('item_id')?>" type="hidden">
        <?php wp_nonce_field('st_user_settings','st_user_write_review')?>
        <?php
        $comment_form = array(
            'title_reply'          => st_get_language('write_a_review'),
            'title_reply_to'       => st_get_language('leave_a_reply_to_s'),
            'comment_notes_before' => '',
            'fields'               => array(
                'author' => '<div class="row">
							                <div class="form-group">
							                    <div class="col-md-6">' .
                    '<input id="author"  name="author" type="text" value="" size="30" aria-required="true"  class="form-control" placeholder="'.st_get_language('name').'" />
							                     </div>   ',
                'email'  => '<div class="col-md-6">' .
                    '<input  placeholder="'.st_get_language('your_email_address').'"  class="form-control" id="email" name="email" type="text" value="" size="30" aria-required="true" /></div>
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
                    <li class=""><i class="fa fa-star-o"></i>
                    </li>
                    <li class=""><i class="fa fa-star-o"></i>
                    </li>
                    <li class=""><i class="fa fa-star-o"></i>
                    </li>
                    <li class=""><i class="fa fa-star-o"></i>
                    </li>
                    <li class=""><i class="fa fa-star-o"></i>
                    </li>
                </ul>
                <input name="comment_rate" class="comment_rate" type="hidden">
            </div>';

        $comment_form['comment_field'].='<div class="form-group">
                <label>'.st_get_language('review_title').'</label>
                <input class="form-control" type="text" name="comment_title">
            </div>';

        $comment_form['comment_field'].='<div class="form-group">
                <label>'.st_get_language('review_text').'</label>
                <textarea name="comment" id="comment" class="form-control" rows="6"></textarea>
            </div>
           ';

        /* st update review without not login */
        $comment_form_arg= apply_filters(get_post_type($item_id).'_wp_review_form_args',$comment_form, $item_id );
        $review_check = STReview::review_check($item_id) ;
        switch ($review_check) {
          case "true":
                echo '<div class="box bg-gray">';
                comment_form( $comment_form_arg ,  $item_id );
                echo "</div>";
              break;
          case "must_login":
                echo '<div class="box bg-gray">';   
                $login_link = get_the_permalink(st()->get_option('page_user_login'));
                echo sprintf( st_get_language('you_must').'<a href="'.$login_link.'">'.__('log in ',ST_TEXTDOMAIN).'</a>'.st_get_language('to_write_review'),get_permalink(st()->get_option('user_login_page')));
                echo '</div>';
              break;
          case "need_open":
                echo '<div class="box bg-gray">';                           
                echo sprintf(__("Review is disabled from administrator" , ST_TEXTDOMAIN));
                echo '</div>';
              break;
          case "need_booked":
                echo '<div class="box bg-gray">';                           
                echo sprintf(st_get_language('you_must') . " ".__("book before write review" , ST_TEXTDOMAIN));
                echo '</div>';
              break;
          case "wait_check_out_date":
                echo '<div class="box bg-gray">';                           
                echo sprintf(st_get_language('you_must') . " ".__("experience of this tour to write review" , ST_TEXTDOMAIN));
                echo '</div>';
              break;
          case "reviewed":
                echo '<div class="box bg-gray">';
                echo st_get_language('you_have_been_post_a_review').' '.$name;
                echo '</div>';
              break;
      } 
         
        ?>
    </form>
