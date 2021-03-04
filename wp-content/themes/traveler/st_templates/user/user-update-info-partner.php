<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User create cars
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'user.js' );

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$validator= STUser_f::$validator;

?>
<div class="st-create">
    <h2 class="pull-left"><?php _e("Update info partner",ST_TEXTDOMAIN) ?></h2>
</div>
<div class="msg">
    <?php echo STTemplate::message() ?>
    <?php echo STUser_f::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data" id="st_form_add_partner" class="register_form update_info_partner">
    <?php wp_nonce_field( 'user_setting' , 'st_update_info_partner' ); ?>
    <?php
    if(!empty($_REQUEST['status'])){
        if($_REQUEST['status'] == 'success'){
            echo '<div class="alert alert-'.$_REQUEST['status'].'">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">'.st_get_language('user_update_successfully').'</p>
                      </div>';
        }
        if($_REQUEST['status'] == 'danger'){
            echo '<div class="alert alert-'.$_REQUEST['status'].'">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">'.__("Update not successfully",ST_TEXTDOMAIN).'</p>
                      </div>';
        }
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="st_info_owner">
                <div class="user-profile-avatar text-center">
                    <?php echo st_get_profile_avatar($current_user->ID, 300); ?>
                    <p><?php echo st_get_language('user_member_since') . mysql2date(' M Y', $current_user->data->user_registered); ?></p>
                </div>
            </div>
            <div class="form-group form-group-icon-left">
                <label for="id_avatar_user_setting"><?php st_the_language('user_avatar') ?></label>
                <?php
                $id_img = get_user_meta($user_id , 'st_avatar' , true);
                $url_avatar = "";
                $post_thumbnail_id = wp_get_attachment_image_src($id_img, 'full');
                if(!empty($post_thumbnail_id)){
                    $url_avatar = array_shift($post_thumbnail_id);
                }
                ?>
                <div class="input-group" style="float: left; margin-right: 15px; width: 90%;">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="st_avatar"  type="file" >
                        </span>
                    </span>
                    <input type="text" readonly="" value="<?php echo esc_url($url_avatar); ?>" class="form-control data_lable">
                </div>
                <input id="id_avatar_user_setting" name="id_avatar" type="hidden" value="<?php echo esc_attr($id_img) ?>">
                <?php
                echo '<div class="">
                                <input name="st_delete_avatar" type="button"  class="btn btn-danger  btn_del_avatar" value="'.st_get_language('user_delete').'">
                          </div>
                          ';
                ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <label for="st_display_name"><?php _e("Display Name") ?></label><i class="fa fa-user input-icon"></i>
                <input name="st_display_name" class="form-control" value="<?php echo esc_attr($current_user->display_name) ?>" type="text" />
                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_display_name'),'danger') ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label for="st_name"><?php _e("User Name") ?></label><i class="fa fa-user input-icon"></i>
                <input name="st_name" readonly class="form-control" value="<?php echo esc_attr($current_user->user_nicename) ?>" type="text" />
                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_name'),'danger') ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label for="st_email"><?php st_the_language('user_mail') ?></label><i class="fa fa-envelope input-icon"></i>
                <input name="st_email" readonly class="form-control" value="<?php echo esc_attr($current_user->user_email) ?>" type="text" />
                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_email'),'danger') ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label for="st_phone"><?php st_the_language('user_phone_number') ?></label><i class="fa fa-phone input-icon"></i>
                <input name="st_phone" class="form-control" value="<?php echo get_user_meta($current_user->ID , 'st_phone' , true) ?>" type="text" />
                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_phone'),'danger') ?></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label for="st_address"><?php _e("Address",ST_TEXTDOMAIN) ?></label><i class="fa fa-cogs input-icon"></i>
                <input name="st_address" class="form-control" value="<?php echo get_user_meta($current_user->ID , 'st_address' , true) ?>" type="text" />
                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_address'),'danger') ?></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="desc" class="head_bol"><?php _e("Description",ST_TEXTDOMAIN) ?>:</label>
                <textarea id="desc" rows="6" name="st_desc" class="form-control"><?php echo get_user_meta($current_user->ID , 'st_desc' , true) ?></textarea>
                <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_desc'),'danger') ?></div>
            </div>
        </div>
    </div>

    <div class="tabbable tabs_partner">
        <ul class="nav nav-tabs" id="">
            <li class="active"><a href="#tab-contact" data-toggle="tab"><?php _e("Contact Options",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-social" data-toggle="tab"><?php _e("Social Options",ST_TEXTDOMAIN) ?></a></li>
            <li><a href="#tab-styling" data-toggle="tab"><?php _e("Styling Options",ST_TEXTDOMAIN) ?></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-contact">
                <div class="row">
                    <div class="col-md-12 partner_map">
                        <?php
                        if(class_exists('BTCustomOT')){
                            BTCustomOT::load_fields();
                            ot_type_bt_gmap_html();
                        }
                        ?>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="st_contact_info" class="head_bol"><?php _e("Contact Info",ST_TEXTDOMAIN) ?>:</label>
                            <textarea name="st_contact_info" class="form-control" rows="3" id="st_contact_info"><?php echo STInput::request('st_contact_info',get_user_meta($current_user->ID , 'st_contact_info' , true)) ?></textarea>
                            <div class="st_msg"><?php echo STUser_f::get_msg_html($validator->error('st_contact_info'),'danger') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-social">
                <div class="row">
                    <div class="col-md-12">
                        <div id="data_add_social">
                            <?php $data_social = get_user_meta($user_id  ,'st_social',true); ?>
                                <?php
                                if(!empty($data_social)){
                                    foreach($data_social as $k=>$v ){?>
                                        <div class="item">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="st_add_social_icon"><?php _e("Icon",ST_TEXTDOMAIN) ?></label>
                                                    <input id="" name="st_add_social_icon[icon][]" type="text" class="form-control" value="<?php echo esc_attr($v['icon']) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="st_add_social_link"><?php _e("Link",ST_TEXTDOMAIN) ?></label>
                                                    <input id="" name="st_add_social_icon[link][]" type="text" class="form-control" value="<?php echo esc_attr($v['link']) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group form-group-icon-left left">
                                                    <div class="btn btn-danger btn_del_program" style="margin-top: 27px">
                                                        X
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                                ?>

                        </div>
                    </div>
                    <div class="col-md-12 div_btn_add_custom">
                        <div class="form-group form-group-icon-left">
                            <button id="btn_add_social" type="button" class="btn btn-info btn-sm"><?php _e("Add New",ST_TEXTDOMAIN) ?></button><br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-styling">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-icon-left">
                            <label class="head_bol"><?php _e("Banner Image",ST_TEXTDOMAIN) ?>:</label>
                            <?php
                            $id_img = get_user_meta($user_id , 'st_banner_image' , true);
                            $url_avatar = "";
                            $post_thumbnail_id = wp_get_attachment_image_src($id_img, 'full');
                            if(!empty($post_thumbnail_id)){
                                $url_avatar = array_shift($post_thumbnail_id);
                            }
                            ?>
                            <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                    <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="st_banner_image"  type="file" >
                                </span>
                            </span>
                                <input type="text" readonly="" value="<?php echo esc_url($url_avatar); ?>" class="form-control data_lable">
                            </div>
                            <input id="id_banner_image" name="id_banner_image" type="hidden" value="<?php echo esc_attr($id_img) ?>">
                            <?php
                            if(!empty($url_avatar)){
                                echo '<div class="user-profile-avatar user_seting st_edit">
                                        <div><img style="height:auto" width="300" height="300" class="avatar avatar-300 photo img-thumbnail" src="'.$url_avatar.'" alt="'.TravelHelper::get_alt_image().'"></div>
                                        <input name="" type="button"   class="btn btn-danger  btn_featured_image" value="'.st_get_language('user_delete').'">
                                      </div>';
                            }
                            ?>
                            <i><?php _e("Image format : jpg, png, gif . We recommend size 800x600",ST_TEXTDOMAIN) ?></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center div_btn_submit">
        <input type="submit" id="btn_update_user_partner" name="btn_update_user_partner" class="btn btn-primary btn-lg" value="<?php _e("Save Settings",ST_TEXTDOMAIN) ?>">
    </div>
</form>

<div id="html_add_social" style="display: none">
    <div class="item">
        <div class="col-md-4">
            <div class="form-group">
                <label for="st_add_social_icon"><?php _e("Icon",ST_TEXTDOMAIN) ?></label>
                <input id="" name="st_add_social_icon[icon][]" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                <label for="st_add_social_link"><?php _e("Link",ST_TEXTDOMAIN) ?></label>
                <input id="" name="st_add_social_icon[link][]" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group form-group-icon-left left">
                <div class="btn btn-danger btn_del_program" style="margin-top: 27px">
                    X
                </div>
            </div>
        </div>
    </div>
</div>
