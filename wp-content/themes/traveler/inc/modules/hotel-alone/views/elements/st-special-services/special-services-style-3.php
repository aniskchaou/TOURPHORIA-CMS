<?php
/**
 * Created by Shinetheme.
 * Developer: nasanji
 * Date: 8/29/2017
 * Version: 1.0
 */
extract($atts);

if(!empty($list_style_2)){
    $data = vc_param_group_parse_atts($list_style_2);
    ?>
    <div class="st-special-services style-3">
        <?php
        foreach($data as $key => $val){
        ?>
        <div class="item-service col-2 <?php echo (($key+1)%4 == 0 || (($key+2)%4 == 0))?'even-item':''; ?> <?php echo (($key+1)%2 == 0)?'even-item-2':''; ?>">
            <?php
            $bg = '';
            if(!empty($val['image'])){
                $img = wp_get_attachment_image_src($val['image'], array(475, 760), false);
                if(!empty($img[0])){
                    $bg = Hotel_Alone_Helper::inst()->build_css('background: #777 url('.$img[0].')');
                }
            }
            ?>
            <div class="img-thumb <?php echo esc_attr($bg); ?>">
                <?php
                if(!empty($val['icon'])){
                    echo '<span class="icon"><i class="'.$val['icon'].'"></i></span>';
                }
                ?>
            </div>
            <div class="caption">
                <div class="cell">
                    <?php
                    if(!empty($val['title'])){
                        echo '<h3 class="title">'.$val['title'].'</h3>';
                    }
                    if(!empty($val['desc'])){
                        echo '<p class="desc">'.do_shortcode($val['desc']).'</p>';
                    }
                    $s_link = !empty($val['link'])?$val['link']:'';
                    $link = vc_build_link($s_link);
                    if(!empty($link['url'])){
                        echo '<a href="'.$link['url'].'" title="'.$link['title'].'" target="'.(!empty($link['target'])?$link['target']:'_self').'">'.esc_html__('View More', ST_TEXTDOMAIN).'  <i class="fa fa-long-arrow-right"></i></a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
<?php
}

?>
