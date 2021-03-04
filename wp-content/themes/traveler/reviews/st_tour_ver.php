<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Review list
 *
 * Created by ShineTheme
 *
 */

$comment=$GLOBALS['comment'];
global $st_max_len;
$cmt_num = get_comments_number();
if (!$cmt_num) return ;
/* override default avatar size */
$args['avatar_size'] = 70;
if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) :

    //Do not allow pingback

    ?>
<?php else :

    $comment_class='';

    empty( $args['has_children'] ) ? '' :$comment_class.= 'parent';

    if(!$comment->comment_approved){
        return;
        //$comment_class.=' need_aprove';
    }
    $comment_id=    get_comment_ID();

    $comment_class .='lh21';
    ?>
<?php
    $comment_text  =  apply_filters("st_tour_ver_reviews_carousel",get_comment_text($comment_id));
    if (strlen($comment_text)>=$st_max_len){
        $comment_text = substr($comment_text ,0,$st_max_len);
        $comment_text .= " ...";
    }
    endif;
?>
<div id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment_class ); ?>>
    <div class="row" style="position: relative">
        <div class="col-xs-12 pb15 content">
            <?php echo esc_attr($comment_text);?>
        </div>
        <div class="col-xs-12 author">
            <?php
            $user_id    = get_comment($comment_id)->user_id;
            $user_email = get_comment($comment_id)->comment_author_email;
            $comment_date = get_comment($comment_id)->comment_date_gmt;

            if (!$user_id) $user_id =1;
            $current_user = wp_get_current_user();
            $custom_avatar = st_get_profile_avatar($user_id ,22);
            if(!empty($custom_avatar)){
                echo st_get_profile_avatar($user_id ,22);
            }else{
                echo st_get_profile_avatar_by_email( $user_email,22);
            }
            $user_data = get_userdata($user_id)->data;
            
            echo " <strong class='main-color'>".$user_data->user_nicename."</strong> ";
            echo "<i>".sprintf(" since %s",date(TravelHelper::getDateFormat(),strtotime($comment_date)), ST_TEXTDOMAIN)."</i>";
            ?>
        </div>
    </div>
