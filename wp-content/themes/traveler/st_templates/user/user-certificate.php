<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User create activity
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'user.js' );

$validator= STUser_f::$validator;

$data_st_certificates = get_user_meta($ID,'st_certificates',true);
?>
<div class="st-create">
    <h2><?php _e("Update Certificate",ST_TEXTDOMAIN) ?></h2>
</div>
<div class="msg">
    <?php echo STTemplate::message() ?>
    <?php echo STUser_f::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data" id="st_form_add_partner" class="register_form update_info_partner" >
    <?php wp_nonce_field( 'user_setting' , 'st_update_certificate' ); ?>
    <div class="data_field">
        <div class="row mt20">
            <div class="col-md-3">
                <div class="form-group  form-group-icon-left">
                    <label for="field-service"><?php _e("Select Your Service",ST_TEXTDOMAIN) ?></label>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group  form-group-icon-left">
                    <label for="field-certificate"><?php _e("Upload Certificate",ST_TEXTDOMAIN) ?></label>
                </div>
            </div>
        </div>
        <?php if (st_check_service_available('st_hotel')){?>
            <?php $check = $image = "";
            if(!empty($data_st_certificates['st_hotel'])){
                $check = 'on';
                
                $image = $data_st_certificates['st_hotel']['image'];
            }
            if( isset($_POST['st_service_st_hotel']) ){
                $check = $_POST['st_service_st_hotel'];
            }
            ?>
            <div class="row mt20 div_st_hotel <?php if($check == "on") echo "show" ?>">
                <div class="col-md-3">
                    <div class="checkbox checkbox-stroke">
                        <label><input class="i-check st_register_service" type="checkbox"  value="on" name="st_service_st_hotel" <?php if($check == "on") echo "checked" ?> /><?php _e("Hotel",ST_TEXTDOMAIN) ?></label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input type="file" name="st_certificates_st_hotel" data-type="st_hotel"  class="st_certificates" value="<?php if( isset($_FILES['st_certificates_st_hotel']) ) echo $_FILES['st_certificates_st_hotel']['name']; ?>">
                        </span>
                    </span>
                        <input type="text" class="form-control data_lable st_certificates_st_hotel_url" value="<?php echo esc_url($image) ?>" readonly="">
                        <input type="hidden" class="form-control st_certificates_st_hotel_url" value="<?php echo esc_url($image) ?>" name="st_certificates_st_hotel_url" >
                    </div>
                    <i><?php _e("Image format : jpg, png, gif . Image size 800x600 and max file size 2MB",ST_TEXTDOMAIN) ?></i>
                </div>
                <div class="col-md-2 data_image_certificates">

                    <?php if($image !=""){ ?>
                        <img alt="<?php echo TravelHelper::get_alt_image(); ?>"  class="thumbnail" src="<?php echo esc_html($image) ?>">
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php if (st_check_service_available('st_rental')){?>
            <?php $check = $image = "";
            if(!empty($data_st_certificates['st_rental'])){
                $check = 'on';
                
                $image = $data_st_certificates['st_rental']['image'];
            }
            if( isset($_POST['st_service_st_rental']) ){
                $check = $_POST['st_service_st_rental'];
            }
            ?>
            <div class="row mt20 div_st_rental <?php if($check == "on") echo "show" ?>">
                <div class="col-md-3">
                    <div class="checkbox checkbox-stroke">
                        <label><input class="i-check st_register_service" type="checkbox"  value="on" name="st_service_st_rental" <?php if($check == "on") echo "checked" ?> /><?php _e("Rental",ST_TEXTDOMAIN) ?></label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input type="file" name="st_certificates_st_rental" data-type="st_rental" class="st_certificates">
                        </span>
                    </span>
                        <input type="text" class="form-control data_lable st_certificates_st_rental_url" value="<?php echo esc_url($image) ?>" readonly="">
                        <input type="hidden" class="form-control st_certificates_st_rental_url" value="<?php echo esc_url($image) ?>" name="st_certificates_st_rental_url" >
                    </div>
                    <i><?php _e("Image format : jpg, png, gif . Image size 800x600 and max file size 2MB",ST_TEXTDOMAIN) ?></i>
                </div>
                <div class="col-md-2 data_image_certificates">
                    <?php if($image !=""){ ?>
                        <img alt="<?php echo TravelHelper::get_alt_image(); ?>"  class="thumbnail" src="<?php echo esc_html($image) ?>">
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php if (st_check_service_available('st_cars')){?>
            <?php $check = $image = "";
            if(!empty($data_st_certificates['st_cars'])){
                $check = 'on';
                
                $image = $data_st_certificates['st_cars']['image'];
            }
            if( isset($_POST['st_service_st_cars']) ){
                $check = $_POST['st_service_st_cars'];
            }
            ?>
            <div class="row mt20 div_st_cars <?php if($check == "on") echo "show" ?>">
                <div class="col-md-3">
                    <div class="checkbox checkbox-stroke">
                        <label><input class="i-check st_register_service" type="checkbox" value="on" name="st_service_st_cars" <?php if($check == "on") echo "checked" ?> /><?php _e("Car",ST_TEXTDOMAIN) ?></label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input type="file" name="st_certificates_st_cars" data-type="st_cars" class="st_certificates">
                        </span>
                    </span>
                        <input type="text" class="form-control data_lable st_certificates_st_cars_url" value="<?php echo esc_url($image) ?>" readonly="">
                        <input type="hidden" class="form-control st_certificates_st_cars_url" value="<?php echo esc_url($image) ?>" name="st_certificates_st_cars_url" >
                    </div>
                    <i><?php _e("Image format : jpg, png, gif . Image size 800x600 and max file size 2MB",ST_TEXTDOMAIN) ?></i>
                </div>
                <div class="col-md-2 data_image_certificates">
                    <?php if($image !=""){ ?>
                        <img alt="<?php echo TravelHelper::get_alt_image(); ?>"  class="thumbnail" src="<?php echo esc_html($image) ?>">
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php if (st_check_service_available('st_tours')){?>
            <?php $check = $image = "";
            if(!empty($data_st_certificates['st_tours'])){
                $check = 'on';
                
                $image = $data_st_certificates['st_tours']['image'];
            }
            if( isset($_POST['st_service_st_tours']) ){
                $check = $_POST['st_service_st_tours'];
            }
            ?>
            <div class="row mt20 div_st_tours <?php if($check == "on") echo "show" ?>">
                <div class="col-md-3">
                    <div class="checkbox checkbox-stroke">
                        <label><input class="i-check st_register_service" type="checkbox"  value="on" name="st_service_st_tours" <?php if($check == "on") echo "checked" ?> /><?php _e("Tour",ST_TEXTDOMAIN) ?></label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input type="file" name="st_certificates_st_tours" data-type="st_tours" class="st_certificates">
                        </span>
                    </span>
                        <input type="text" class="form-control data_lable st_certificates_st_tours_url" value="<?php echo esc_url($image) ?>" readonly="">
                        <input type="hidden" class="form-control st_certificates_st_tours_url" value="<?php echo esc_url($image) ?>" name="st_certificates_st_tours_url" >
                    </div>
                    <i><?php _e("Image format : jpg, png, gif . Image size 800x600 and max file size 2MB",ST_TEXTDOMAIN) ?></i>
                </div>
                <div class="col-md-2 data_image_certificates">
                    <?php if($image !=""){ ?>
                        <img alt="<?php echo TravelHelper::get_alt_image(); ?>"  class="thumbnail" src="<?php echo esc_html($image) ?>">
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php if (st_check_service_available('st_activity')){?>
            <?php $check = $image = "";
            if(!empty($data_st_certificates['st_activity'])){
                $check = 'on';
                
                $image = $data_st_certificates['st_activity']['image'];
            }
            if( isset($_POST['st_service_st_activity']) ){
                $check = $_POST['st_service_st_activity'];
            }
            ?>
            <div class="row mt20 div_st_activity <?php if($check == "on") echo "show" ?>">
                <div class="col-md-3">
                    <div class="checkbox checkbox-stroke">
                        <label><input class="i-check st_register_service" type="checkbox"  value="on" name="st_service_st_activity" <?php if($check == "on") echo "checked" ?> /><?php _e("Activity",ST_TEXTDOMAIN) ?></label>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input type="file" name="st_certificates_st_activity" data-type="st_activity" class="st_certificates">
                        </span>
                    </span>
                        <input type="text" class="form-control data_lable st_certificates_st_activity_url" value="<?php echo esc_url($image) ?>" readonly="">
                        <input type="hidden" class="form-control st_certificates_st_activity_url" value="<?php echo esc_url($image) ?>" name="st_certificates_st_activity_url" >
                    </div>
                    <i><?php _e("Image format : jpg, png, gif . Image size 800x600 and max file size 2MB",ST_TEXTDOMAIN) ?></i>
                </div>
                <div class="col-md-2 data_image_certificates">
                    <?php if($image !=""){ ?>
                        <img alt="<?php echo TravelHelper::get_alt_image(); ?>"  class="thumbnail" src="<?php echo esc_html($image) ?>">
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="text-center div_btn_submit">
        <input name="btn_st_update_certificate" id="btn_st_update_certificate" type="submit" disabled class="btn btn-primary btn-lg" value="<?php _e("UPDATE",ST_TEXTDOMAIN) ?>">
    </div>

</form>