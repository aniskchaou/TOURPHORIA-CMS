<?php
if(empty($message_id)){
    exit();
}
$message_data = ST_Inbox_Admin::inst()->get_message($message_id);
if(!empty($message_data)){
    $user_link = get_permalink( st()->get_option( 'page_my_account_dashboard' ) );
    $url =  TravelHelper::get_user_dashboared_link($user_link, 'inbox');
    ?>
    <div class="st-inbox-body-detail" id="wb-partner-message-detail">
        <a class="btn btn-default back-all-list" href="<?php echo esc_url($url); ?>"><i class="fa fa-arrow-circle-left "> <?php echo esc_html__('All messages',ST_TEXTDOMAIN); ?></i></a>
        <?php if(!empty($message_data['title'])){ ?>
        <h4 class="message-title"><?php echo esc_attr($message_data['title']); ?></h4>
        <?php }?>
        <?php
        if(!empty($message_data['post_id'])){
            echo '<p class="class-in"> <span class="post_name">'.esc_html__('In: ',ST_TEXTDOMAIN).'<a target="_blank" href="'.esc_url(get_permalink($message_data['post_id'])).'">'.get_the_title($message_data['post_id']).'</a></span></p>';
        }
        if($message_data['to_user'] == get_current_user_id()){
            $class = "to";
            $to_user = $message_data['from_user'];
        }else{
            $to_user = $message_data['to_user'];
            $class = "from";
        }
        $message_list = ST_Inbox_Admin::inst()->get_child_messages($message_id);
        $last_message_id = $message_id;
        ?>
        <?php if(!empty($message_data['content']) || !empty($message_list)){ ?>
        <div class="message-box">
            <?php if(!empty($message_data['content'])){ ?>
            <div class="message-item <?php echo esc_attr($class)." message-".$message_id ?>">
                <div class="user-avatar">
                    <?php
                    echo get_avatar($message_data['from_user'],50);
                    $user = ST_Inbox_Admin::inst()->get_user_by('id',$message_data['from_user'], 'user_nicename' );
                    echo '<span class="username">'.esc_attr($user).'</span>';
                    ?>
                </div>
                <div class="message-item-content">
                    <span><?php echo ST_Inbox_Admin::inst()->find_link(nl2br(stripslashes($message_data['content']))); ?></span>
                    <span><?php printf(esc_html__('%s ago',ST_TEXTDOMAIN),human_time_diff($message_data['created_at'],time())) ?></span>
                </div>
            </div>
            <?php }?>
            <?php
            if(!empty($message_list) and is_array($message_list)){
                foreach($message_list as $key => $val){
                    if($val['to_user'] == get_current_user_id()){
                        $class = "to";
                    }else{
                        $class = "from";
                    }
                    ?>
                    <div class="message-item <?php echo esc_attr($class)." message-".$val['id'] ?>">
                        <div class="user-avatar">
                            <?php
                            echo get_avatar($val['from_user'],50);
                            $user = ST_Inbox_Admin::inst()->get_user_by('id',$val['from_user'], 'user_nicename' );
                            echo '<span class="username">'.esc_attr($user).'</span>';
                            ?>
                        </div>
                        <div class="message-item-content">
                            <span><?php echo ST_Inbox_Admin::inst()->find_link(nl2br(stripslashes($val['content']))); ?></span>
                            <span><?php printf(esc_html__('%s ago',ST_TEXTDOMAIN),human_time_diff($val['created_at'],time())) ?></span>
                        </div>
                    </div>
                    <?php
                    $last_message_id = $val['id'];
                }
            }
            ?>
        </div>
        <?php }?>
        <input type="hidden" class="st_last_message_id"
               value="<?php echo esc_html($last_message_id) ?>"
               data-message_id="<?php echo esc_attr($message_id); ?>"
               data-post_id="<?php echo esc_attr($message_data['post_id']); ?>"
               data-user_id="<?php echo esc_attr($to_user); ?>">
        <div class="inbox-form-reply">
            <form action="" method="post" class="form-reply">
                <input type="hidden" name="message_id" value="<?php echo esc_attr($message_id); ?>">
                <input type="hidden" name="to_user" value="<?php echo esc_attr($to_user); ?>">
                <input type="hidden" name="post_id" value="<?php echo esc_attr($message_data['post_id']); ?>">
                <div class="form-group">
                    <textarea class="form-control" name="reply-content" placeholder="<?php echo esc_html__('Message',ST_TEXTDOMAIN)?>"></textarea>
                </div>
                <div class="button">
                    <button class="btn btn-primary inbox-reply-btn submit-button btn-loading" type="submit"><i class="fa fa-send"></i></button>
                </div>
            </form>
        </div>
    </div>
<?php }else{ ?>
<div class="alert alert-warning">
    <strong><?php esc_html_e("Warning!",ST_TEXTDOMAIN) ?></strong> <?php esc_html_e("Message ID does not exist!",ST_TEXTDOMAIN) ?>
</div>
<?php } ?>
