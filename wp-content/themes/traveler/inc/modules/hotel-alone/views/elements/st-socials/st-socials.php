<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 8/14/2017
 * Version: 1.0
 */
extract($atts);
?>
<div class="st-social-lists style-1 <?php echo esc_attr($align)?> <?php echo esc_attr($extra_class); ?>">
    <ul class="socials">
        <?php if($follow_us == 'yes'){ ?>
        <li class="follow">
            <?php echo esc_html__('Follow Us', ST_TEXTDOMAIN); ?>:
        </li>
        <?php }
        $socials = vc_param_group_parse_atts($list_social);
        if(!empty($socials) && is_array($socials)){
            foreach($socials as $val){
                if(!empty($val['icon']) && !empty($val['link'])){
                    $st_link = vc_build_link($val['link']);
                    echo '<li><a href="'.esc_url($st_link['url']).'" title="'.esc_attr($st_link['title']).'" target="'.($st_link['target']?'_blank':'_self').'"><i class="'.$val['icon'].'"></i></a></li>';
                }
            }
        }
        ?>
    </ul>
</div>