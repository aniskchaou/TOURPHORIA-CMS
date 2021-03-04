<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single loop quote
 *
 * Created by ShineTheme
 *
 */
?>
<a href="<?php echo get_permalink();?>">
    <blockquote class="bgr-main  st_tour_ver_btn st_tour_ver_hover_white text-color-hover">
        <span>
    <?php
        if (strlen(get_the_excerpt())>180) {
            echo substr(get_the_excerpt(),0,180)." [...]";
        }else {
            the_excerpt();
        }
    ?>
        </span>
    </blockquote>
</a>