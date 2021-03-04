<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 4/25/2017
 * Version: 1.0
 */
if($style == 'style-1'){
?>
<span class="left">
    <?php echo esc_attr($title); ?>
</span>
<span class="right">
    <?php echo do_shortcode($content); ?>
</span>
<?php }
if($style == 'style-2'){
    ?>
    <span class="icon"><i class="<?php echo esc_attr($icon)?>"></i></span>
    <div class="right">
        <h4 class="title"><?php echo esc_attr($title)?></h4>
        <span class="content"><?php echo do_shortcode($content)?></span>
    </div>
<?php
}
?>