<?php
/**
 * Created by ShineTheme.
 * Developer: sejuani37
 * Date: 8/16/2017
 * Version: 1.0
 */
extract($atts);
?>
<div class="text-center <?php echo esc_attr($extra_class)?>">
    <?php if($show_time == 'yes'){ ?>
    <div class="st-time-now">
        <?php
        echo '<span>'.date('g:i',time()).'</span>'.date(' a',time());
        ?>
    </div>
    <?php }
    Hotel_Alone_Helper()->get_weather_html($location_id, 'style-1', true);
    ?>
</div>
