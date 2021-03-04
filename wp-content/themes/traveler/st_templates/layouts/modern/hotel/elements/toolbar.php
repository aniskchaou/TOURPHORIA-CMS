<?php
if(!isset($format))
    $format = '';
if(!isset($layout))
	$layout = '';
if(!isset($service_text)){
    $service_text = __('New hotel', ST_TEXTDOMAIN);
}
if(!isset($post_type)){
    $post_type = 'st_hotel';
}

$name_asc = 'name_asc';
$name_desc = 'name_desc';
if(in_array($post_type, array('st_tours', 'st_activity'))){
    $name_asc = 'name_a_z';
    $name_desc = 'name_z_a';
}

?>
<div class="toolbar <?php echo $layout == '3' ? 'layout3' : ''; ?>">
    <ul class="toolbar-action hidden-xs">
        <li>
            <div class="form-extra-field dropdown <?php echo $format == 'popup' ? 'popup-sort' : ''; ?>">
                <button class="btn btn-link dropdown" type="button" id="dropdownMenuSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo __('Sort', ST_TEXTDOMAIN); ?> <i class="fa fa-angle-down arrow"></i>
                </button>
                <div class="dropdown-menu sort-menu" aria-labelledby="dropdownMenuSort">
                    <div class="sort-title">
                        <h3><?php echo __('SORT BY', ST_TEXTDOMAIN); ?> <span class="hidden-lg hidden-md hidden-sm close-filter"><i class="fa fa-times" aria-hidden="true"></i></span></h3>
                    </div>
                    <div class="sort-item st-icheck">
                        <div class="st-icheck-item"><label> <?php echo $service_text; ?><input class="service_order" type="radio" name="service_order_<?php echo $format; ?>" data-value="new" checked/><span class="checkmark"></span></label></div>
                    </div>
                    <div class="sort-item st-icheck">
                        <span class="title"><?php echo __('Price', ST_TEXTDOMAIN); ?></span>
                        <div class="st-icheck-item"><label> <?php echo __('Low to Hight', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_<?php echo $format; ?>"  data-value="price_asc"/><span class="checkmark"></span></label></div>
                        <div class="st-icheck-item"><label> <?php echo __('Hight to Low', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_<?php echo $format; ?>"  data-value="price_desc"/><span class="checkmark"></span></label></div>
                    </div>
                    <div class="sort-item st-icheck">
                        <span class="title"><?php echo __('Name', ST_TEXTDOMAIN); ?></span>
                        <div class="st-icheck-item"><label> <?php echo __('a - z', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_<?php echo $format; ?>"  data-value="<?php echo $name_asc; ?>"/><span class="checkmark"></span></label></div>
                        <div class="st-icheck-item"><label> <?php echo __('z - a', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_<?php echo $format; ?>"  data-value="<?php echo $name_desc; ?>"/><span class="checkmark"></span></label></div>
                    </div>
                </div>
            </div>
        </li>
        <?php if($format != 'popup' and !isset($top_search)){ ?>
        <li class="layout">
            <span class="layout-item <?php echo $style == 'list' ? 'active' : ''; ?>" data-value="list">
                <!--<i class="fa fa-list" aria-hidden="true"></i>-->
                <span class="icon-active"><?php echo TravelHelper::getNewIcon('ico_list-active', '#A0A9B2'); ?></span>
                <span class="icon-normal"><?php echo TravelHelper::getNewIcon('ico_list', '#A0A9B2'); ?></span>
            </span>
            <span class="layout-item <?php echo $style == 'grid' ? 'active' : ''; ?>" data-value="grid">
                <!--<i class="fa fa-th" aria-hidden="true"></i>-->
                <span class="icon-active"><?php echo TravelHelper::getNewIcon('ico_grid_active', '#A0A9B2'); ?></span>
                <span class="icon-normal"><?php echo TravelHelper::getNewIcon('ico_grid', '#A0A9B2'); ?></span>
            </span>
        </li>
        <?php } ?>
    </ul>
    <div class="dropdown-menu sort-menu sort-menu-mobile">
        <div class="sort-title">
            <h3><?php echo __('SORT BY', ST_TEXTDOMAIN); ?> <span class="hidden-lg hidden-md close-filter"><?php echo TravelHelper::getNewIcon('Ico_close', '#A0A9B2', '20px', '20px'); ?></span></h3>
        </div>
        <div class="sort-item st-icheck">
            <div class="st-icheck-item"><label> <?php echo $service_text; ?><input class="service_order" type="radio" name="service_order_m_<?php echo $format; ?>" data-value="new" checked/><span class="checkmark"></span></label></div>
        </div>
        <div class="sort-item st-icheck">
            <span class="title"><?php echo __('Price', ST_TEXTDOMAIN); ?></span>
            <div class="st-icheck-item"><label> <?php echo __('Low to Hight', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_m_<?php echo $format; ?>"  data-value="price_asc"/><span class="checkmark"></span></label></div>
            <div class="st-icheck-item"><label> <?php echo __('Hight to Low', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_m_<?php echo $format; ?>"  data-value="price_desc"/><span class="checkmark"></span></label></div>
        </div>
        <div class="sort-item st-icheck">
            <span class="title"><?php echo __('Name', ST_TEXTDOMAIN); ?></span>
            <div class="st-icheck-item"><label> <?php echo __('a - z', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_m_<?php echo $format; ?>"  data-value="<?php echo $name_asc; ?>"/><span class="checkmark"></span></label></div>
            <div class="st-icheck-item"><label> <?php echo __('z - a', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_m_<?php echo $format; ?>"  data-value="<?php echo $name_desc; ?>"/><span class="checkmark"></span></label></div>
        </div>
    </div>
    <ul class="toolbar-action-mobile hidden-lg hidden-md">
        <li><a href="#" class="btn btn-primary btn-date"><?php echo __('Date', ST_TEXTDOMAIN); ?></a></li>
        <?php if($post_type == 'st_hotel'){ ?>
            <li><a href="#" class="btn btn-primary btn-guest"><?php echo __('Guest', ST_TEXTDOMAIN); ?></a></li>
        <?php } ?>

        <?php
        if($post_type == 'st_hotel') {
            if ($layout == '3') {
                ?>
                <li><a href="#" class="btn btn-primary map-view"><?php echo __('Map', ST_TEXTDOMAIN); ?></a></li>
                <?php
            } else {
                ?>
                <li><a href="#"
                       class="btn btn-primary <?php echo $format == 'popup' ? 'map-view' : 'btn-map'; ?>"><?php echo __('Map', ST_TEXTDOMAIN); ?></a>
                </li>
                <?php
            }
        }
        ?>
        <li><a href="#" class="btn btn-primary btn-sort"><?php echo __('Sort', ST_TEXTDOMAIN); ?></a></li>
        <li><a href="#" class="btn btn-primary btn-filter"><?php echo __('Filter', ST_TEXTDOMAIN); ?></a></li>
    </ul>
    <?php
    $result_string = '';
    switch ($post_type){
        case 'st_hotel':
            $result_string = balanceTags(STHotel::inst()->get_result_string());
            break;
        case 'st_tours':
            $result_string = balanceTags(STTour::get_instance()->get_result_string());
            break;
        case 'st_activity':
            $result_string = balanceTags(STActivity::inst()->get_result_string());
            break;
        case 'st_cars':
            $result_string = balanceTags(STCars::get_instance()->get_result_string());
            break;
        default:
            $result_string = balanceTags(STHotel::inst()->get_result_string());
            break;
    }
    ?>
    <h3 class="search-string modern-result-string" id="modern-result-string"><?php echo $result_string; ?> <div id="btn-clear-filter" class="btn-clear-filter" style="display: none"><?php echo __('Clear filter', ST_TEXTDOMAIN); ?></div> </h3>
</div>