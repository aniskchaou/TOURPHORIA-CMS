<?php
/**
 * Created by ShineTheme.
 * Developer: nasanji
 * Date: 9/7/2017
 * Version: 1.0
 */
extract($atts);
?>
<div class="st-hotel-info-element <?php echo esc_attr($extra_class)?>">
    <div class="logo">
        <?php echo wp_get_attachment_image($logo, array(0, 140), false)?>
    </div>
    <div class="info">
        <h4 class="name"><?php echo esc_attr($title); ?></h4>
        <p><span class="sub_title"><?php echo esc_attr($sub_title); ?></span> <span class="stars">
                <?php
                for($i = 0; $i < intval($star); $i++){
                    echo '<i class="fa fa-star"></i>';
                }
                ?>
            </span></p>
        <span class="hotline-booking"><?php echo esc_html__('Reservation Hotline:', ST_TEXTDOMAIN); ?> <span class="hotline"><?php echo esc_attr($hotline); ?></span></span>
        <p class="desc"><?php echo esc_attr($description)?></p>
    </div>
</div>
