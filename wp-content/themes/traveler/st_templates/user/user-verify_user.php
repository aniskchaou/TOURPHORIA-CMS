<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/20/2018
 * Time: 4:25 PM
 */
$user = wp_get_current_user();
$keys=st_get_user_verify_keys();
$admin_notes = get_user_meta(get_current_user_id(),'admin_verify_notes',true);
$keys_checks=[];
$total_check = false;
if(!empty($keys)){
    $total_check  = true;
    foreach ($keys as $key)
    {
        if(!$keys_checks[$key] = st_check_user_verify($key)) $total_check = false;
    }
}



?>
<div class="st-create">
    <h2><?php esc_html_e('Verifications',ST_TEXTDOMAIN) ?>
        <?php
        if(!$total_check) printf('<span class="verify-status none">%s</span>',esc_html__('Not verified',ST_TEXTDOMAIN));
        else printf('<span class="verify-status">%s</span>',esc_html__('Verified',ST_TEXTDOMAIN))
        ?>
    </h2>
</div>
<?php
if(!empty($_COOKIE['st_success'])){
    printf('<div class="alert alert-success">%s</div>',esc_html($_COOKIE['st_success']));
    unset($_COOKIE['st_success']);
}
if(!empty($_COOKIE['st_errors'])){
    printf('<div class="alert alert-danger">%s</div>',esc_html($_COOKIE['st_errors']));
    unset($_COOKIE['st_errors']);
}

if(!empty($admin_notes) and is_array($admin_notes) and !$total_check)
{
    echo '<div class="alert alert-info">';
    printf('<strong>%s</strong>',esc_html__('Admin Notification:',ST_TEXTDOMAIN));
    echo '<ul>';
    foreach ($keys_checks as $key=>$status)
    {
        if(empty($admin_notes[$key])) continue;
        printf('<li>%s</li>',$admin_notes[$key]);
    }
    echo '</ul>';
    echo '</div>';
}
?>
<form action="" class="st-js-validate" onsubmit="return false" method="post">
    <input type="hidden" name="sc" value="verify_user">
    <?php wp_nonce_field('st_user_submit_verify','st_user_verify_nonce') ?>
    <div class="row">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group form-group-icon-left">
                        <label class="st-form-group-title"><?php esc_html_e('E-mail',ST_TEXTDOMAIN) ?>
                            <?php if(!empty($keys_checks['email'])) echo('<span class="check-notify"><i class="fa fa-check"></i></span>');else echo('<span class="check-notify none"><i class="fa fa-check"></i></span>');?>
                        </label>
                        <i class="fa fa-envelope input-icon"></i>
                        <input data-rules="required,email" <?php if(!empty($keys_checks['email'])) echo 'disable';  ?> name="_user_email" class="form-control" value="<?php echo esc_attr($user->user_email) ?>" type="text">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-group-icon-left">
                        <label class="st-form-group-title"><?php esc_html_e('Phone Number',ST_TEXTDOMAIN) ?>
                            <?php if(!empty($keys_checks['phone'])) echo('<span class="check-notify"><i class="fa fa-check"></i></span>');else echo('<span class="check-notify none"><i class="fa fa-check"></i></span>');?>
                        </label>
                        <i class="fa fa-phone input-icon"></i>
                        <input data-rules="required" <?php if(!empty($keys_checks['phone'])) echo 'disable';  ?> name="_st_phone" class="form-control" value="<?php echo esc_attr(get_user_meta($user->ID,'st_phone',true)) ?>" type="text">
                    </div>
                </div>
                <div class="col-sm-12 <?php if(!empty($keys_checks['passport'])) echo 'verified'; ?>">
                    <label class="st-form-group-title"><?php esc_html_e('Personal identity card or passport',ST_TEXTDOMAIN) ?>
                        <?php if(!empty($keys_checks['passport'])) echo('<span class="check-notify"><i class="fa fa-check"></i></span>');else echo('<span class="check-notify none"><i class="fa fa-check"></i></span>');?>
                    </label>
                    <div class="st-form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label><?php esc_html_e('Name on card',ST_TEXTDOMAIN) ?></label>
                                    <input data-rules="required" <?php if(!empty($keys_checks['passport'])) echo 'disable';  ?> name="_passport_name" class="form-control" value="<?php echo esc_attr(get_user_meta($user->ID,'passport_name',true)) ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><?php esc_html_e('ID Card',ST_TEXTDOMAIN) ?></label>
                                    <input data-rules="required" <?php if(!empty($keys_checks['passport'])) echo 'disable';  ?> name="_passport_id" class="form-control" value="<?php echo esc_attr(get_user_meta($user->ID,'passport_id',true)) ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><?php esc_html_e('Birthday on Card',ST_TEXTDOMAIN) ?></label>
                                    <input data-rules="required" <?php if(!empty($keys_checks['passport'])) echo 'disable';  ?> readonly name="_passport_birthday" class="form-control has-datepicker" value="<?php echo esc_attr(get_user_meta($user->ID,'passport_birthday',true)) ?>" type="text">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label><?php esc_html_e('Photos',ST_TEXTDOMAIN) ?></label>

                                    <div class="passport-photo lists-photo">
                                        <?php $_passport_photos = get_user_meta($user->ID,'passport_photos',true);
                                        $_passport_photos = explode(',',$_passport_photos);
                                        if(!empty($_passport_photos))
                                        {
                                            foreach ($_passport_photos as $photo)
                                            {
                                                if(empty($photo)) continue;
                                                printf('<div class="passport-photo-item" data-url="%s"><span class="icon-remove"><i class="fa fa-minus-circle"></i></span><img src="%s"></div>',$photo,$photo);
                                            }
                                        }
                                        ?>
                                    </div>
                                    <?php if(empty($keys_checks['passport'])){  ?>
                                        <input data-rules="required" type="hidden" name="_passport_photos" value="<?php echo esc_attr(get_user_meta($user->ID,'passport_photos',true)) ?>">
                                        <p><span class="btn btn-primary verify_photo_btn">
                                                <span class="on-loading"><?php esc_html_e('Uploading...',ST_TEXTDOMAIN) ?></span>
                                                <span class="non-loading"><?php esc_html_e('Select Images',ST_TEXTDOMAIN) ?></span>
                                                <input type="file" multiple class="verify_photo_inputs"></span></p>
                                        <p><i><?php esc_html_e('Maximum 5 images',ST_TEXTDOMAIN) ?></i></p>
                                        <p class="upload-notes"></p>
                                        <p class="note-on-error"><?php esc_html_e('Please select image',ST_TEXTDOMAIN) ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 <?php if(!empty($keys_checks['passport'])) echo 'verified'; ?>">
                        <label class="st-form-group-title"><?php esc_html_e('Travel Certificate',ST_TEXTDOMAIN) ?>
                            <?php if(!empty($keys_checks['travel_certificate'])) echo('<span class="check-notify"><i class="fa fa-check"></i></span>');else echo('<span class="check-notify none"><i class="fa fa-check"></i></span>');?>
                        </label>
                        <div class="st-form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><?php esc_html_e('Company name',ST_TEXTDOMAIN) ?></label>
                                        <input data-rules="required" <?php if(!empty($keys_checks['travel_certificate'])) echo 'disable';  ?> name="_business_c_name" class="form-control" value="<?php echo esc_attr(get_user_meta($user->ID,'business_c_name',true)) ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><?php esc_html_e('Email',ST_TEXTDOMAIN) ?></label>
                                        <input data-rules="required,email" <?php if(!empty($keys_checks['travel_certificate'])) echo 'disable';  ?> name="_business_c_email" class="form-control" value="<?php echo esc_attr(get_user_meta($user->ID,'business_c_email',true)) ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><?php esc_html_e('Company address',ST_TEXTDOMAIN) ?></label>
                                        <input data-rules="required" <?php if(!empty($keys_checks['travel_certificate'])) echo 'disable';  ?> name="_business_c_address" class="form-control" value="<?php echo esc_attr(get_user_meta($user->ID,'business_c_address',true)) ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><?php esc_html_e('Phone Number',ST_TEXTDOMAIN) ?></label>
                                        <input data-rules="required" <?php if(!empty($keys_checks['travel_certificate'])) echo 'disable';  ?> name="_business_c_phone" class="form-control" value="<?php echo esc_attr(get_user_meta($user->ID,'business_c_phone',true)) ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <h3 class="representative-title"><?php esc_html_e('Representative',ST_TEXTDOMAIN) ?></h3>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><?php esc_html_e('Fullname',ST_TEXTDOMAIN) ?></label>
                                        <input data-rules="required" <?php if(!empty($keys_checks['travel_certificate'])) echo 'disable';  ?> name="_business_r_name" class="form-control" value="<?php echo esc_attr(get_user_meta($user->ID,'business_r_name',true)) ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><?php esc_html_e('Position',ST_TEXTDOMAIN) ?></label>
                                        <input data-rules="required" <?php if(!empty($keys_checks['travel_certificate'])) echo 'disable';  ?> name="_business_r_position" class="form-control" value="<?php echo esc_attr(get_user_meta($user->ID,'business_r_position',true)) ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><?php esc_html_e('Personal Indentity/passport',ST_TEXTDOMAIN) ?></label>
                                        <input data-rules="required" <?php if(!empty($keys_checks['travel_certificate'])) echo 'disable';  ?> name="_business_r_passport_id" class="form-control" value="<?php echo esc_attr(get_user_meta($user->ID,'business_r_passport_id',true)) ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label><?php esc_html_e('Issue date',ST_TEXTDOMAIN) ?></label>
                                        <input data-rules="required" <?php if(!empty($keys_checks['travel_certificate'])) echo 'disable';  ?> readonly name="_business_r_issue_date" class="form-control has-datepicker" value="<?php echo esc_attr(get_user_meta($user->ID,'business_r_issue_date',true)) ?>" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><?php esc_html_e('Photos',ST_TEXTDOMAIN) ?></label>

                                        <div class="passport-photo lists-photo">
                                            <?php $_passport_photos = get_user_meta($user->ID,'business_photos',true);
                                            $_passport_photos = explode(',',$_passport_photos);
                                            if(!empty($_passport_photos))
                                            {
                                                foreach ($_passport_photos as $photo)
                                                {
                                                    if(empty($photo)) continue;
                                                    printf('<div class="passport-photo-item" data-url="%s"><span class="icon-remove"><i class="fa fa-minus-circle"></i></span><img src="%s"></div>',$photo,$photo);
                                                }
                                            }
                                            ?>
                                        </div>
                                        <?php if(empty($keys_checks['travel_certificate'])){  ?>
                                            <input data-rules="required" type="hidden" name="_business_photos" value="<?php echo esc_attr(get_user_meta($user->ID,'business_photos',true)) ?>">
                                            <p><span class="btn btn-primary verify_photo_btn">
                                                <span class="on-loading"><?php esc_html_e('Uploading...',ST_TEXTDOMAIN) ?></span>
                                                <span class="non-loading"><?php esc_html_e('Select Images',ST_TEXTDOMAIN) ?></span>
                                                <input type="file" multiple class="verify_photo_inputs"></span></p>
                                            <p><i><?php esc_html_e('Maximum 5 images',ST_TEXTDOMAIN) ?></i></p>
                                            <p class="upload-notes"></p>
                                            <p class="note-on-error"><?php esc_html_e('Please select image',ST_TEXTDOMAIN) ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="st-form-group-title"><?php esc_html_e('Social',ST_TEXTDOMAIN) ?>
                            <?php if(!empty($keys_checks['social'])) echo(' <span class="check-notify"><i class="fa fa-check"></i></span>');else echo('<span class="check-notify none"><i class="fa fa-check"></i></span>');?>
                        </label>
                        <p class="connected <?php if(!get_user_meta($user->ID,'social_facebook_uid',true)) echo 'hidden'; ?>"><strong><?php esc_html_e('Facebook: Connected',ST_TEXTDOMAIN) ?> (<span><?php echo  get_user_meta($user->ID,'social_facebook_name',true)  ?></span>)</strong></p>
                        <?php if(empty($keys_checks['social'])) { ?>
                            <input type="hidden" name="_social_facebook_uid" class="input_id" value="<?php echo get_user_meta($user->ID,'social_facebook_uid',true) ?>">
                            <input type="hidden" name="_social_facebook_name" class="input_name" value="<?php echo get_user_meta($user->ID,'social_facebook_name',true) ?>">
                            <span class="btn btn-connect-facebook "><i class="fa fa-facebook"></i> <?php esc_html_e('Connect With Facebook',ST_TEXTDOMAIN) ?></span>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-md mt30 "><?php esc_html_e('Submit',ST_TEXTDOMAIN) ?></button>
</form>
