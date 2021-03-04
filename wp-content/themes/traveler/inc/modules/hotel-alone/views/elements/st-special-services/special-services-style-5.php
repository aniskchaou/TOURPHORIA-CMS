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
    <div class="st-special-services style-5">
        <?php
        foreach($data as $key => $val){
        ?>
        <div class="item-service <?php echo (($key+1)%2 != 0)?'n-even-item':''; ?>">
            <div class="container">
                <div class="row">
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

                    </div>
                    <div class="caption">
                        <div class="cell">
                            <?php
                            if(!empty($val['title'])){
                                $s_link = !empty($val['link'])?$val['link']:'';
                                $link = vc_build_link($s_link);
                                if(!empty($link['url'])){
                                    echo '<h3 class="title"><a href="'.$link['url'].'" title="'.$link['title'].'" target="'.(!empty($link['target'])?$link['target']:'_self').'">'.$val['title'].'</a></h3>';
                                }else{
                                    echo '<h3 class="title">'.$val['title'].'</h3>';
                                }
                            }
                            if(!empty($val['desc'])){
                                echo '<p class="desc">'.do_shortcode($val['desc']).'</p>';
                            }
                            if(!empty($val['icon'])){
                                echo '<span class="icon"><i class="'.$val['icon'].'"></i></span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
<?php
}

?>
