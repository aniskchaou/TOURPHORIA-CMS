<?php
$post_data = get_post(get_the_ID(), ARRAY_A);
$to_user = $post_data['post_author'];
if(!empty($to_user) and $to_user != get_current_user_id()) {
    ?>
    <div class="st-inbox">
        <h4 class="title"><?php echo esc_html($title) ?></h4>
        <form class="st-form-inbox <?php echo esc_html($active) ?>" action="" method="post">
            <?php wp_nonce_field( 'user_setting', 'st_send_message' ); ?>
            <?php
            if(is_user_logged_in()) {
                ?>
                <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>" >
                <input type="hidden" name="to_user" value="<?php echo esc_attr($to_user); ?>" >
                <div class="inbox-group">
                    <div class="">
                        <div class="control">
                            <input type="text" name="inbox-title" class="form-control" placeholder="<?php echo esc_html__('Your title (*)',ST_TEXTDOMAIN)?>">
                        </div>
                    </div>
                    <div class="">
                        <div class="control">
                        <textarea name="inbox-message" class="form-control" placeholder="<?php echo esc_html__('Your message (*)', ST_TEXTDOMAIN) ?>"></textarea>
                        </div>
                    </div>
                    <button type="submit" value="1" class="btn btn-primary  mt10 st-inbox-send btn-loading"><?php echo esc_html__('Send Message', ST_TEXTDOMAIN); ?></button>
                </div>
                <div class="inbox-notice hide alert " data-success="<?php echo esc_html__('Message was sent successfully', ST_TEXTDOMAIN)?>" data-error="<?php echo esc_html__('Failed sending message!', ST_TEXTDOMAIN)?>">
                </div>
                <div class="text-right"><a class="detail-message hide" href="#" target="_blank"><?php echo esc_html__('Show details',ST_TEXTDOMAIN); ?></a></div>
                <?php
            }else{
                ?>
                <div class="">
                    <label class="inbox-message-login alert alert-warning"><?php echo esc_html__('Please login to send a message', ST_TEXTDOMAIN); ?></label>
                </div>
                <div class="inbox-login">
                    <?php
                    $login_url = get_the_permalink(st()->get_option('page_user_login'));
                    $current_url = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $login_url = add_query_arg(array('redirect_to' => esc_url($current_url)), $login_url);
                    ?>
                    <a class="btn btn-primary " href="<?php echo esc_url($login_url); ?>"><?php echo esc_html__('Login', ST_TEXTDOMAIN); ?></a>
                </div>
                <?php
            }
            ?>
        </form>
    </div>
<?php } ?>