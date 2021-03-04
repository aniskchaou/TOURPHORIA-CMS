<?php extract(shortcode_atts(array(
    'list_service'          => '',
    'style'          => '',
  ), $attr));
$list_service = vc_param_group_parse_atts($list_service);
if($style==='style-2'){?>
    <div class="st-service-item">
        <ul class="row">
            <?php foreach ($list_service as $key => $service) {
            $st_link = vc_build_link($key['link']);
            if(isset($st_link) && !empty($st_link)){
                $st_link = $st_link["url"];
            } else {
                $st_link = "#";
            }
            $icon_image = wp_get_attachment_image_src($service['icon'],'');
            if(isset($service['name_service'])){
                $name_service = $service['name_service'];
            } else {
                $name_service = '';
            }
            if(isset($icon_image[0])){
                $icon_image = $icon_image[0];
            } else {
                $icon_image = '';
            }
             ?>
                <li class="col-md-3 col-xs-6">
                    <div class="padd-on">
                        <div class="icon text-center">
                            <img src="<?php echo esc_url($icon_image);?>" alt="">
                        </div>
                        <div class="content-text">
                            <h2 class="text-center"><?php echo esc_html($name_service);?></h2>
                        </div>
                    </div>
                </li>
            <?php }?>
        </ul>
    </div>
<?php } else {
?>
    <div class="item-table">
        <div class="owl-carousel st-discover-slider">
            <?php foreach ($list_service as $key => $service) {
            $st_link = vc_build_link($key['link']);
            if(isset($st_link) && !empty($st_link)){
                $st_link = $st_link["url"];
            } else {
                $st_link = "#";
            }
            $icon_image = wp_get_attachment_image_src($service['icon'],'');
            if(isset($icon_image[0])){
                $icon_image = $icon_image[0];
            } else {
                $icon_image = '';
            }
            if(isset($service['name_service'])){
                $name_service = $service['name_service'];
            } else {
                $name_service = '';
            }
            if(isset($service['content_service'])){
                $content_service = $service['content_service'];
            } else {
                $content_service = '';
            }
             ?>
                <div class="item-tb">
                    <div class="st-item">
                        <div class="padd-on">
                            <div class="icon text-center">
                                <img src="<?php echo esc_url($icon_image);?>" alt="">
                            </div>
                            <div class="content-text">
                                <h2 class="text-center"><?php echo esc_html($name_service);?></h2>
                                <div class="box__separator hidden-thumb">
                                </div>
                                <p class="text-center"><?php echo balanceTags($content_service);?></p>
                                <div class="button-color text-center">
                                    <a href="<?php echo esc_url($st_link);?>" title="<?php echo esc_attr($name_service);?>">
                                        <?php echo esc_html__('DISCOVER', ST_TEXTDOMAIN); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
<?php }?>