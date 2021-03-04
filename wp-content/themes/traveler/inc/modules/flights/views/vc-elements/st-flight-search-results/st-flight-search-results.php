<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/16/2017
 * Version: 1.0
 */
extract($atts);
?>
<div class="st-flight-search-result <?php echo esc_attr($extra_class); ?>">
    <div class="nav-drop booking-sort">
        <h5 class="booking-sort-title"><a href="#">Sort: Sort: Price (low to high)<i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a></h5>
        <ul class="nav-drop-menu">
            <li><a href="#">Price (high to low)</a>
            </li>
            <li><a href="#">Duration</a>
            </li>
            <li><a href="#">Stops</a>
            </li>
            <li><a href="#">Arrival</a>
            </li>
            <li><a href="#">Departure</a>
            </li>
        </ul>
    </div>
    <?php
    echo st_flight_load_view('flights/content-flights');
    ?>
</div>