<div class="row">
    <div class="col-md-6">
        <?php
        echo do_shortcode('[st_hotel_detail_search_room style=style_3]');
        ?>
    </div>

    <div class="col-md-6 left-contact">
        <?php
        $theme_option=st()->get_option('partner_show_contact_info');
        $metabox=get_post_meta(get_the_ID(),'show_agent_contact_info',true);
        $use_agent_info=FALSE;
        if($theme_option=='on') $use_agent_info=true;
        if($metabox=='user_agent_info') $use_agent_info=true;
        if($metabox=='user_item_info') $use_agent_info=FALSE;
        global $authordata;
        global $post;
        $user_id = false;
        if(!empty($post->post_author)){
            $user_id=$post->post_author;
        }
        if($use_agent_info){
            $email=get_the_author_meta('user_email',$user_id);
            $website=get_the_author_meta('user_url',$user_id);
            $phone=get_user_meta($user_id,'st_phone',true);
            $fax=get_user_meta($user_id,'st_fax',true);
        }else{
            $email=get_post_meta(get_the_ID(),'email',true);
            $website=get_post_meta(get_the_ID(),'website',true);
            $phone=get_post_meta(get_the_ID(),'phone',true);
            $fax=get_post_meta(get_the_ID(),'fax',true);
        }
        ?>
        <div class="row">

            <?php if(!empty($phone)){ ?>
                <div class="col-md-6">
                    <div class="contact">
                        <span class="icon"><i class="fa fa-phone"></i></span>
                        <div class="caption">
                            <p class="title"><?php esc_html_e("Phone",ST_TEXTDOMAIN) ?></p>
                            <h4 class="content"><?php echo esc_html($phone) ?></h4>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(!empty($fax)){ ?>
                <div class="col-md-6">
                    <div class="contact">
                        <span class="icon"><i class="fa fa-fax"></i></span>
                        <div class="caption">
                            <p class="title"><?php esc_html_e("Fax",ST_TEXTDOMAIN) ?></p>
                            <h4 class="content"><?php echo esc_html($fax) ?></h4>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(!empty($email)){ ?>
                <div class="col-md-6">
                    <div class="contact">
                        <span class="icon"><i class="fa fa-envelope"></i></span>
                        <div class="caption">
                            <p class="title"><?php esc_html_e("Email support",ST_TEXTDOMAIN) ?></p>
                            <h4 class="content"><?php echo esc_html($email) ?></h4>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(!empty($website)){ ?>
                <div class="col-md-12">
                    <div class="contact">
                        <span class="icon"><i class="fa fa-home"></i></span>
                        <div class="caption">
                            <p class="title"><?php esc_html_e("Hotel Website",ST_TEXTDOMAIN) ?></p>
                            <h4 class="content"><?php echo esc_html($website) ?></h4>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h3 class="avalable-title"><?php esc_html_e("AVAILABLE ROOMS",ST_TEXTDOMAIN) ?></h3>
        <div class="list-room-new">
            <?php
            echo do_shortcode('[st_hotel_detail_list_rooms]');
            ?>
        </div>
    </div>
</div>
