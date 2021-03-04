<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User wishlist
 *
 * Created by ShineTheme
 *
 */
$current_paged = STInput::get('page_num')?STInput::get('page_num'):1;
$search = STInput::get('search')?STInput::get('search'):'';
$paged = $current_paged - 1;
$item = 10;
$res = ST_Inbox_Admin::inst()->get_list_messages(get_current_user_id(),$paged,$item, $search);
$list_message = $res['res'];
$count_item = $res['total'];
$current_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$current_link = remove_query_arg('page_num', $current_link);


if(!empty($list_message)){
    $max_page = (int)(((int)$count_item + ((int)$item - 1))/(int)$item);
    $user_link = get_permalink( st()->get_option( 'page_my_account_dashboard' ) );
    $url =  TravelHelper::get_user_dashboared_link($user_link, 'inbox');
    ?>
    <div class="st-inbox-body">
        <h4 class="title"><?php echo sprintf(_n('You have %s message', 'You have %s messages',$count_item,ST_TEXTDOMAIN), '<span class="count_message">'.$count_item.'</span>') ?></h4>
        <div class="inbox-list-message">
            <?php
            foreach($list_message as $key => $val){
                $post_type = get_post_type($val['post_id']);
                switch($post_type){
                    case 'st_hotel':
                        $icon_type='<i class="fa fa-building-o"></i>';
                        break;
                    case 'st_rental':
                        $icon_type='<i class="fa fa-home"></i>';
                        break;
                    case 'st_activity':
                        $icon_type='<i class="fa fa-bolt"></i>';
                        break;
                    case 'st_tours':
                        $icon_type='<i class="fa fa-bolt"></i>';
                        break;
                    case 'st_cars':
                        $icon_type='<i class="fa fa-car"></i>';
                        break;
                }
                $obj = get_post_type_object( $post_type );
                $user_name = ST_Inbox_Admin::inst()->get_user_by('id',$val['from_user'], 'user_nicename' );
                echo '<div class="message-item">';
                echo '<span class="booking-item-wishlist-title">'.$icon_type.' '.$obj->labels->singular_name.'</span>';
                echo '<a data-original-title="Remove" class="btn_remove_message btn-loading cursor fa fa-times" rel="tooltip" data-placement="top" data-message-id="'.$val['id'].'"></a>';
                echo '<div class="user-avatar">
                          '.get_avatar($val['from_user'],50).'
                          <span>'.esc_html($user_name).'</span>
                    </div>';
                echo '<div class="content"><div>';
                $new_mes = ST_Inbox_Admin::inst()->get_new_message_count($val['id']);
                $class = '';
                if($val['is_read'] == 0 && $val['is_parent'] == 0 && $val['from_user'] != get_current_user_id()) {
                    $class = 'new';
                    echo '<span class="inbox-new">' . esc_html__('New', ST_TEXTDOMAIN) . '</span>';
                }
                if ($val['from_user'] == get_current_user_id()) {
                    echo '<span class="inbox-send">' . esc_html__('Send', ST_TEXTDOMAIN) . '</span>';
                }
                if($new_mes > 0){
                    echo '<span class="inbox-new">' . $new_mes . '</span>';
                }
                $link_detail = add_query_arg(array('message_id' => $val['id']), $url);

                ?>
                <a href="<?php echo esc_url($link_detail); ?>" class="show-detail <?php echo esc_attr($class); ?>" data-id="<?php echo esc_attr($val['id']); ?>"><?php echo !empty($val['title']) ? wp_trim_words($val['title'], 20, '...') : __('View message details', ST_TEXTDOMAIN); ?></a>
                <span class="short-content">
                    <?php
                    $content = $val['content'];
                    $last_content = ST_Inbox_Admin::inst()->get_last_content_message($val['id']);
                    if(!empty($last_content)){
                        $content = $last_content['content'];
                    }
                    echo nl2br(stripslashes(wp_trim_words($content, 15, '...'))); ?>
                </span>
                <?php
                echo '</div>';
                $created_at = $val['created_at'];
                if(!empty($last_content)){
                    $created_at = $last_content['created_at'];
                }
                if(!empty($val['post_id'])){
                    echo '<span class="inbox-in">'.esc_html__('In: ',ST_TEXTDOMAIN).'</span>';
                    echo '<a class="inbox-post" target="_blank" href="'.get_the_permalink($val['post_id']).'">'.get_the_title($val['post_id']).'</a>';
                    echo ', <span class="inbox-time">'.sprintf(esc_html__('%s ago',ST_TEXTDOMAIN),human_time_diff($created_at,time())).'</span>';
                }else{
                    echo '<span class="inbox-time">'.sprintf(esc_html__('%s ago',ST_TEXTDOMAIN),human_time_diff($created_at,time())).'</span>';
                }
                echo '</div></div>';
            }
            ?>
        </div>
        <?php if($max_page > 1){ ?>
            <div class="inbox-navigation wb_row">
                <div class="navi-info">
                    <span><?php echo sprintf(_n('You have %s message', 'You have %s message',$count_item,ST_TEXTDOMAIN), $count_item)?>, <?php echo sprintf(esc_html__('showing %s - %s', ST_TEXTDOMAIN),(($paged*$item)+1),($max_page == $current_paged?$count_item:$current_paged*$item))?></span>
                </div>
                <ul class="navi">
                    <?php
                    if($current_paged > 1){
                        if($paged == 1){
                            $link = $current_link;
                        }else{
                            $link = add_query_arg(array('page_num' => $paged), $current_link);
                        }
                        ?>
                        <li><a href="<?php echo esc_url($link); ?>"><i class="fa fa-long-arrow-left"></i></a></li>
                        <?php
                    }
                    if($current_paged < $max_page){
                        $next_link = add_query_arg(array('page_num' => ($current_paged +1)), $current_link);
                        ?>
                        <li><a href="<?php echo esc_url($next_link); ?>"><i class="fa fa-long-arrow-right"></i></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        <?php } ?>
    </div>
    <?php
}else{
    ?>
    <div class="tab-inbox-no-message">
        <?php echo esc_html__('You have 0 message', ST_TEXTDOMAIN); ?>
    </div>
    <?php
}
?>
