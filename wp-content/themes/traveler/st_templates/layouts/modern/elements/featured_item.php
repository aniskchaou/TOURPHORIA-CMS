<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 13-11-2018
     * Time: 3:15 PM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
    $class_pos = 'image-left';
    if($style == 'icon_top'){
        $class_pos = 'image-top';
    }
?>
<div class="st-featured-item <?php echo esc_attr($class_pos); ?>">
    <div class="image">
        <?php
            if ( !empty( $icon ) ) {
                echo '<img src="' . wp_get_attachment_image_url( $icon, 'full' ) . '" class="img-responsive">';
            }
        ?>
    </div>
    <div class="content">
        <h4 class="title"><?php echo esc_html( $title ); ?></h4>
        <div class="desc"><?php echo balanceTags( $desc ); ?></div>
    </div>
</div>
