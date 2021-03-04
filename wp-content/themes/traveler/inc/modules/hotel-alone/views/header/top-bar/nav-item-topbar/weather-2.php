<div class="location-weather">
    <?php
    $temp = TravelHelper::get_location_temp($st_topbar_location);
    $temp_format = st()->get_option('st_weather_temp_unit', 'c');
    if ($temp) {
        if (!empty($temp)) {
            echo '<span class="icon">' . balanceTags($temp['icon']) . '</span>';
            ?>
            <p class="w-temp">
                    <span class="temp"><?php echo balanceTags($temp['temp']); ?>
                        <sup>o</sup><span><?php echo esc_html(esc_html(strtoupper($temp_format))) ?></span></span>
                <span class="temp-f">
                            <?php echo balanceTags($temp['temp_k']) ?> <sup>o</sup><span>F</span>
                        </span>
            </p>
            <p class="location"><?php echo esc_attr(get_the_title($st_topbar_location)); ?></p>
            <?php
        }
    }
    ?>
</div>
