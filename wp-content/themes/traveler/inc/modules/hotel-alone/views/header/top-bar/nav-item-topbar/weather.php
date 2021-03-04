<div class="location-weather">
    <?php
    $temp = TravelHelper::get_location_temp($st_topbar_location);
    $temp_format = st()->get_option('st_weather_temp_unit', 'c');
    if ($temp) {
        if (!empty($temp)) {
            echo '<span class="icon">' . balanceTags($temp['icon']) . '</span>';
            echo '<p class="w-temp"><span class="temp">' . balanceTags($temp['temp']) . '<sup>o</sup><span>' . esc_html(strtoupper($temp_format)) . '</span></span></p>';
        }
        ?>
        <p class="location"><?php echo esc_attr(get_the_title($st_topbar_location)); ?></p>
    <?php }
    ?>
</div>