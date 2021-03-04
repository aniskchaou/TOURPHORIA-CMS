<?php
/**
 * Created by Shinetheme.
 * Developer: nasanji
 * Date: 8/29/2017
 * Version: 1.0
 */
extract($atts);

if(!empty($list_style_1)){
    $data = vc_param_group_parse_atts($list_style_1);
    ?>
    <div class="st-special-services style-1">
        <div class="special-services-carousel owl-carousel">
            <?php
            foreach($data as $key => $val){
            ?>
            <div class="item <?php echo (($key+1)%2 == 0)?'even-item':''; ?>">
                <div class="img-thumb">
                    <?php
                    if(!empty($val['image'])){
                        echo wp_get_attachment_image($val['image'], array(390,210), false);
                    }
                    ?>
                </div>
                <div class="caption">
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
                    ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
<?php
}

?>
