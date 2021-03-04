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
wp_enqueue_script('gmapv3');
wp_enqueue_script('magnific.js' );

$user_id = STInput::request('user_id');
if(empty($user_id)) return;
$user_data = new WP_User( $user_id );
$class_bg = "";
$image_banner = get_user_meta($user_id , 'st_banner_image',true);
$post_thumbnail_id = wp_get_attachment_image_src($image_banner, 'full');
if(!empty($post_thumbnail_id)){
    $url_banner = array_shift($post_thumbnail_id);
    $class_bg = Assets::build_css("background-image: url(".$url_banner.") !important; height:300px ;position: relative;");
}
$class_color_icon = Assets::build_css("background-color: #fff !important;; color: #000 !important; border-color: #fff !important;",'');
$class_color_icon2 = Assets::build_css("background-color: #000 !important;; color: #fff !important; border-color: #000 !important;",':hover');

?>
<?php if(!empty($image_banner)){ ?>
    <div class="st bg-holder vc_custom_1432204162421 bg-parallax <?php echo esc_attr($class_bg) ?>">
        <div class="bg-mask"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="st_user_partner">
                        <ul class="list list-horizontal list-space text-center">
                            <li>
                                <a class="fa fa-envelope box-icon-normal round box-icon-border <?php echo esc_attr($class_color_icon." ".$class_color_icon2) ?>" href="#contact_me" data-effect="mfp-zoom-out"></a>
                            </li>
                            <?php
                            $data = get_user_meta($user_id , 'st_social',true);
                            if(!empty($data)){
                                foreach($data as $k=>$v){
                                    ?>
                                    <li>
                                        <a class="fa <?php echo esc_attr($v['icon']) ?> box-icon-normal round box-icon-border <?php echo esc_attr($class_color_icon." ".$class_color_icon2) ?>" href="<?php echo esc_url($v['link']) ?>"></a>
                                    </li>
                                <?php } }  ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="single_partner">
    <div class="head_partner">
        <div class="container">
            <div class="row">
                <div class="col-md-2 st_avatar_owner">
                    <div class="st_info_owner">
                        <div class="user-profile-avatar text-center">
                            <?php echo st_get_profile_avatar($user_id, 320); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="name">
                        <span><?php echo esc_html($user_data->display_name) ?></span>
                        <span class="permission"><i>- <?php _e("partner",ST_TEXTDOMAIN) ?> -</i></span>
                    </div>
                    <?php $certificate = get_user_meta($user_id , 'st_certificates',true); ?>
                    <?php if (!empty($certificate)) { ?>
                    <div class="member_info st-popup-gallery">
                        <div class="hidden">
                            <?php
                            $tmp = array_shift($certificate);
                            $tmp = $tmp['image'];
                                foreach ($certificate as $key => $value) {
                                    $img_link = $value['image'];
                                    if (isset($img_link))
                                        echo "<a class='st-gp-item' href='{$img_link}'></a>";
                                }
                            ?>
                        </div>
                        <span><?php _e("Certificates: Yes",ST_TEXTDOMAIN) ?> ( <a href="<?php echo esc_url($tmp) ?>" class="st-gp-item"> <?php _e("View License/Certificate",ST_TEXTDOMAIN) ?> </a>)</span>
                    </div>
                    <?php } ?>
                    <div class="member_info">
                        <span><?php _e("Approved by:",ST_TEXTDOMAIN) ?> <?php _e("Administrator",ST_TEXTDOMAIN) ?></span>
                    </div>
                    <div class="member_info">
                        <p><?php  echo st_get_language('user_member_since') .": ". date_i18n(' M Y', strtotime($user_data->data->user_registered)); ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="member_info_2 member_info">
                        <strong><?php _e("Email:",ST_TEXTDOMAIN) ?></strong> <span class="text-color"><?php echo esc_attr($user_data->user_email) ?></span>
                    </div>
                    <div class="member_info">
                        <strong><?php _e("Phone:",ST_TEXTDOMAIN) ?></strong> <span class="text-color"><?php echo get_user_meta($user_id,'st_phone',true) ?></span>
                    </div>
                    <div class="member_info">
                        <strong><?php _e("Address:")?></strong> <?php echo get_user_meta($user_id,'st_address',true) ?>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <a class="btn btn-primary" href="#contact_me" ><?php _e("Contact Me",ST_TEXTDOMAIN) ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="list_service_partner mt60">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h2 class="mb20"><?php _e("Listing",ST_TEXTDOMAIN) ?></h2>
                <?php
                $data_service = STUser_f::_get_service_available();
                ?>
                <div class="search-tabs search-tabs-bg   no-boder-search ">


                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <?php
                            if(!empty($data_service)){
                                foreach($data_service as $k=>$v) {
                                    if(STUser_f::_check_service_available_partner( $v , $user_id )) {
                                        $obj = get_post_type_object( $v );
                                        $name = $obj->labels->singular_name;
                                        ?>
                                        <li class="<?php if($k == 0)echo "active"; ?>"><a href="#tab-<?php echo esc_html( $v ) ?>" data-toggle="tab"><?php _e("My",ST_TEXTDOMAIN) ?> <?php echo esc_html( $name ) ?></a></li>
                                    <?php
                                    }
                                }
                            }
                            ?>
                        </ul>
                        <div class="tab-content mt40 " style="border: 1px solid #e6e6e6;">
                            <?php
                            if(!empty($data_service)){
                                foreach($data_service as $k=>$v){
                                    if(STUser_f::_check_service_available_partner( $v )) {
                                        $data_html = STUser_f::_get_list_item_service_available($v,$user_id,1);
                                    ?>
                                        <div class="tab-pane fade <?php if($k == 0)echo "in active"; ?>" id="tab-<?php echo esc_html($v) ?>">
                                            <?php
                                            if(!empty($data_html['data'])){
                                                echo '<ul class="booking-list loop-cars style_list   data_single_partner">';
                                                echo $data_html['data'];
                                                echo '</ul>';
                                                echo '<div class="paging_single_partner">';
                                                echo $data_html['paging'];
                                                echo '</div>';
                                            }else{
                                                echo '<h5 style="margin: 0px;">'.__("No Data",ST_TEXTDOMAIN).'</h5>';
                                            } ?>



                                          </div>

                                    <?php } ?>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="single_partner_contact mt30">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h2 id="contact_me"><?php _e("Contact Me",ST_TEXTDOMAIN) ?></h2>
                <div class="mt30 info_contact">
                    <div class="info_map" style="height: 300px"
                         data-lat="<?php echo get_user_meta($user_id , 'map_lat' , true ) ?>"
                         data-lng="<?php echo get_user_meta($user_id , 'map_lng' , true ) ?>"
                         data-zoom="<?php echo get_user_meta($user_id , 'map_zoom' , true ) ?>"
                         data-icon="<?php echo get_template_directory_uri().'/img/my_location.png'; ?>"
                        >

                    </div>
                    <div class="mt20 mb20">
                        <?php echo get_user_meta($user_id,'st_contact_info',true) ?>
                    </div>
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
                    <input type="hidden"  id="user_id" class="form-control user_id" size="40" name="user_id" value="<?php echo esc_html($user_id) ?>">
                    <p>
                        <input type="submit" class="btn btn-primary btn_partner_send_email_user" value="<?php _e("Send Message",ST_TEXTDOMAIN) ?>">
                        <img alt="<?php echo TravelHelper::get_alt_image(); ?>" class="ajax_loader" src="<?php echo admin_url('/images/wpspin_light.gif') ?>" style="display: none;">

                    </p>
                    <div class="msg"></div>
                </div>
            </div>
        </div>
    </div>
</div>