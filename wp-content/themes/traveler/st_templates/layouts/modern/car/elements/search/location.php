<?php
$enable_tree = st()->get_option('bc_show_location_tree', 'off');

$location_id = STInput::request('location_id_pick_up', '');
if (!empty($location_id)) {
    $location_name = get_the_title($location_id);
} else {
    $location_name = '';
}

$location_id_dropoff = STInput::request('location_id_drop_off', '');
if (!empty($location_id_dropoff)) {
    $location_name_dropoff = get_the_title($location_id_dropoff);
} else {
    $location_name_dropoff = '';
}

if ($enable_tree == 'on') {
    $lists = TravelHelper::getListFullNameLocation('st_cars');
    $locations = TravelHelper::buildTreeHasSort($lists);
} else {
    $locations = TravelHelper::getListFullNameLocation('st_cars');
}
$has_icon = (isset($has_icon)) ? $has_icon : false;
?>
<div class="form-group form-extra-field dropdown clearfix field-detination field-destination-car <?php if ($has_icon) echo 'has-icon' ?>">
    <?php
    if ($has_icon) {
        echo TravelHelper::getNewIcon('ico_maps_search_box');
    }
    ?>
    <div class="date-wrapper destination-pickup">
        <div class="dropdown" data-toggle="dropdown" id="dropdown-pickup">
            <label><?php echo __('Pick-up From', ST_TEXTDOMAIN); ?></label>
            <div class="render">
            <span class="destination">
                <?php
                if (empty($location_name) && $locations) {
                    $location_tmp = $locations;
                    $location_tmp = (object)array_shift($location_tmp);
                    $location_name = $location_tmp->fullname;
                    $location_id = $location_tmp->ID;
                    echo $location_name;
                } else {
                    echo $location_name;
                }
                ?>
            </span>
            </div>
            <input type="hidden" class="location_name" name="pick-up"
                   value="<?php if ($location_id) echo esc_attr(get_the_title($location_id)); ?>"/>
            <input type="hidden" class="location_id" name="location_id_pick_up"
                   value="<?php echo esc_attr($location_id); ?>"/>
        </div>
        <ul class="dropdown-menu" aria-labelledby="dropdown-pickup">
            <?php
            if ($enable_tree == 'on') {
                New_Layout_Helper::buildTreeOptionLocation($locations, $location_id);
            } else {
                if (is_array($locations) && count($locations)):
                    foreach ($locations as $key => $value):
                        ?>
                        <li class="item" data-value="<?php echo $value->ID; ?>">
                            <?php echo TravelHelper::getNewIcon('ico_maps_search_box', '', '16px', '16px'); ?>
                            <span><?php echo $value->fullname; ?></span></li>
                    <?php
                    endforeach;
                endif;
            }
            ?>
        </ul>
    </div>
    <div class="date-wrapper destination-dropoff">
        <div class="dropdown" data-toggle="dropdown" id="dropdown-dropoff">
            <label><?php echo __('Drop-off To', ST_TEXTDOMAIN); ?></label>
            <div class="render">
            <span class="destination">
                <?php
                if (empty($location_name_dropoff) && $locations) {
                    $location_tmp = $locations;
                    $location_tmp = (object)array_shift($location_tmp);
                    $location_name_dropoff = $location_tmp->fullname;
                    $location_id_dropoff = $location_tmp->ID;
                    echo $location_name_dropoff;
                } else {
                    echo $location_name_dropoff;
                }
                ?>
            </span>
            </div>
            <input type="hidden" class="location_name" name="drop-off"
                   value="<?php if ($location_name_dropoff) echo esc_attr(get_the_title($location_id_dropoff)); ?>"/>
            <input type="hidden" class="location_id" name="location_id_drop_off"
                   value="<?php echo esc_attr($location_id_dropoff); ?>"/>
        </div>
        <ul class="dropdown-menu" aria-labelledby="dropdown-dropoff">
            <?php
            if ($enable_tree == 'on') {
                New_Layout_Helper::buildTreeOptionLocation($locations, $location_id_dropoff);
            } else {
                if (is_array($locations) && count($locations)):
                    foreach ($locations as $key => $value):
                        ?>
                        <li class="item" data-value="<?php echo $value->ID; ?>">
                            <?php echo TravelHelper::getNewIcon('ico_maps_search_box', '', '16px', '16px'); ?>
                            <span><?php echo $value->fullname; ?></span></li>
                    <?php
                    endforeach;
                endif;
            }
            ?>
        </ul>
    </div>
</div>