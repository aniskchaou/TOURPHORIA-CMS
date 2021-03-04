<?php
/**
 * Created by ShineTheme.
 * Developer: sejuani37
 * Date: 8/14/2017
 * Version: 1.0
 */
extract($atts);
$st_link = vc_build_link($link);
?>
<div class="st-about style-2 light <?php echo esc_attr($extra_class); ?>">
    <?php if(!empty($icon)){ ?>
        <div class="icon">
            <i class="<?php echo esc_attr($icon); ?>"></i>
        </div>
    <?php } ?>
    <div class="caption">
        <h4 class="title">
            <?php
            if(!empty($st_link['url'])){
                ?>
                <a href="<?php echo esc_url($st_link['url'])?>" title="<?php echo esc_attr($st_link['title']); ?>" target="<?php echo ($st_link['target']?'_blank':'_self')?>"><?php echo do_shortcode($title); ?></a>
            <?php }else{
                echo do_shortcode($title);
            }?>
        </h4>
        <p class="short-desc"><?php echo do_shortcode($description); ?></p>
    </div>
</div>