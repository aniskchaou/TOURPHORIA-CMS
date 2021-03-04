<?php
/**
 * Created by ShineTheme.
 * Developer: nasanji
 * Date: 8/24/2017
 * Version: 1.0
 */

extract($atts);
if(!empty($sig_image) && !empty($name)){
    $img = wp_get_attachment_image_src($sig_image, array(135, 78), true);
?>
<div class="st-signature <?php echo esc_attr($extra_class); ?> <?php echo esc_attr($align)?>">
    <div class="signature">
        <img src="<?php echo esc_url($img[0])?>" alt="signature" />
    </div>
    <div class="name-pos">
        <span class="name"><?php echo esc_attr($name); ?></span>
        <?php if(!empty($position)){
            echo ' - ';
            ?>
            <span class="position"><?php echo esc_attr($position); ?></span>
        <?php } ?>
    </div>
</div>
<?php } ?>