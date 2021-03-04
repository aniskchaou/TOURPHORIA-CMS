<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User create location
 *
 * Created by ShineTheme
 *
 */
?>
<div class="st-create">
    <h2><?php _e("Create Location",ST_TEXTDOMAIN) ?></h2>
</div>
<div class="msg">
    <?php echo STUser_f::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <?php wp_nonce_field('user_setting','st_insert_post_location'); ?>
    <div class="form-group form-group-icon-left">
        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
        <label><?php _e("Title",ST_TEXTDOMAIN) ?></label>
        <input id="title" name="st_title" type="text" placeholder="<?php _e("Title",ST_TEXTDOMAIN) ?>" class="form-control">
        <div class="st_msg console_msg_title"></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label><?php _e("Content",ST_TEXTDOMAIN) ?></label>
        <?php wp_editor('','st_content'); ?>
    </div>
    <div class="form-group form-group-icon-left">
        <label><?php _e("Description",ST_TEXTDOMAIN) ?></label>
        <textarea id="desc" name="st_desc" class="form-control"></textarea>
        <div class="st_msg console_msg_desc"></div>
    </div>
    <h4><?php _e("Location Detail",ST_TEXTDOMAIN) ?></h4>
    <div class="row">
        <?php $list_location = TravelerObject::get_list_location();?>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Parent",ST_TEXTDOMAIN) ?></label>
                <select name="post_parent" id="post_parent" class="form-control">
                    <option value="0"><?php _e("-- Select --", ST_TEXTDOMAIN) ?></option>
                    <?php if(!empty($list_location) and is_array($list_location)): ?>
                        <?php foreach($list_location as $k=>$v): ?>
                            <option value="<?php echo esc_html($v['id']) ?>">
                                <?php echo esc_html($v['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Set as Featured",ST_TEXTDOMAIN) ?></label>
                <select name="is_featured" id="is_featured" class="form-control">
                    <option value="on"><?php _e("Yes", ST_TEXTDOMAIN) ?></option>
                    <option value="off"><?php _e("No", ST_TEXTDOMAIN) ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Zip Code", ST_TEXTDOMAIN) ?></label>
                <input id="zipcode" name="zipcode" type="text"  class="form-control">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-rocket input-icon input-icon-hightlight"></i>
                <label><?php _e("Latitude", ST_TEXTDOMAIN) ?></label>
                <input id="map_lat" name="map_lat" type="text"  class="form-control">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-rocket input-icon input-icon-hightlight"></i>
                <label><?php _e("Longitude", ST_TEXTDOMAIN) ?></label>
                <input id="map_lng" name="map_lng" type="text"  class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label><?php _e("Logo",ST_TEXTDOMAIN) ?></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="logo"  type="file" >
                        </span>
                    </span>
                    <input type="text" readonly="" value="" class="form-control data_lable">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label><?php _e("Featured Image",ST_TEXTDOMAIN) ?></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="featured-image"  type="file" >
                        </span>
                    </span>
                    <input type="text" readonly="" value="" class="form-control data_lable">
                </div>
            </div>
        </div>
    </div>

    <input  type="button" id="btn_check_insert_post_type_location"  class="btn btn-primary" value="<?php _e("Create",ST_TEXTDOMAIN) ?>">
    <input name="btn_insert_post_type_location" id="btn_insert_post_type_location" type="submit"  class="btn btn-primary hidden" hidden="" value="SUBMIT">
</form>
