<?php
wp_enqueue_script('magnific.js' );

extract( $data );
$id_user = get_post_field( 'post_author' , get_the_ID() );

$user_data = new WP_User( $id_user );

$page_my_account_dashboard = st()->get_option('page_my_account_dashboard');
$url_user_info = add_query_arg(array('sc'=>"details-owner","user_id"=>$id_user),get_the_permalink($page_my_account_dashboard))
?>
<div class='st_info_owner'>
    <div class='title text-center'><h4><?php echo esc_html( $title ) ?></h4></div>
    <div class='avatar'>
        <div class="user-profile-avatar text-center">
            <a href="<?php echo esc_url($url_user_info) ?>">
                <?php if($show_avatar == "true"){ ?>
                    <?php echo st_get_profile_avatar( $id_user , 300 ); ?>
                <?php } ?>
                <h5><?php echo esc_html( $user_data->display_name ) ?></h5>
            </a>
            <?php if($show_member_since == "true"){ ?>
                <p><?php echo st_get_language( 'user_member_since' ) . mysql2date( ' M Y' , $user_data->data->user_registered ); ?></p>
            <?php } ?>
        </div>
    </div>
    <?php if($show_social == "true"){ ?>
        <div class='social'>
            <ul class="list list-horizontal list-space text-center">
                <li>
                    <a class="fa fa-envelope box-icon-normal round box-icon-border popup-text"
                       href="#st-info-owner-dialog" data-effect="mfp-zoom-out"></a>
                </li>
                <?php
                $data = get_user_meta($id_user , 'st_social',true);
                if(!empty($data)){
                    foreach($data as $k=>$v){
                    ?>
                        <li>
                            <a class="fa <?php echo esc_attr($v['icon']) ?> box-icon-normal round box-icon-border" href="<?php echo esc_url($v['link']) ?>"></a>
                        </li>
                <?php } }  ?>
            </ul>
        </div>
    <?php } ?>
    <?php if($show_short_info == 'true') { ?>
        <div class='info'>
            <?php echo get_user_meta($id_user , 'st_desc' , true) ?>
        </div>
    <?php } ?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="st-info-owner-dialog">
        <div class="">
            <div class=" mb20">
                <?php echo get_user_meta($id_user,'st_contact_info',true) ?>
            </div>
            <h2><?php _e("Contact",ST_TEXTDOMAIN) ?></h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php _e("Name",ST_TEXTDOMAIN) ?> *</label>
                        <span class="">
                            <input type="text" id="name" class="form-control name" size="40" name="name">
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php _e("E-mail",ST_TEXTDOMAIN) ?> *</label>
                        <span class="">
                            <input type="text"  id="email" class="form-control email" size="40" name="email">
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><?php _e("Message",ST_TEXTDOMAIN) ?> *</label>
                <span class="">
                    <textarea id="message" class="form-control message" rows="3" cols="40" name="message"></textarea>
                </span>
            </div>
            <input type="hidden"  id="user_id" class="form-control user_id" size="40" name="user_id" value="<?php echo esc_html($id_user) ?>">
            <p>
                <input type="submit" class="btn btn-primary btn_partner_send_email_user" value="<?php _e("Send Message",ST_TEXTDOMAIN) ?>">
                <img alt="<?php echo TravelHelper::get_alt_image(); ?>" class="ajax_loader" src="<?php echo admin_url('/images/wpspin_light.gif') ?>" style="display: none;">

            </p>
            <div class="msg"></div>
        </div>
    </div>
</div>