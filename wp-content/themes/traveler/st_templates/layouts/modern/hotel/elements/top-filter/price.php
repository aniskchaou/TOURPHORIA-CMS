<?php
$data_min_max = TravelerObject::get_min_max_price('st_hotel');

$max = ((float)$data_min_max['price_max'] > 0) ? (float)$data_min_max['price_max'] : 0;
$min = ((float)$data_min_max['price_min'] > 0) ? (float)$data_min_max['price_min'] : 0;

if (TravelHelper::get_default_currency('rate') != 0 and TravelHelper::get_default_currency('rate')) {
    $rate_change = TravelHelper::get_current_currency('rate') / TravelHelper::get_default_currency('rate');
    $max = round($rate_change * $max);
    if ((float)$max < 0) $max = 0;

    $min = round($rate_change * $min);
    if ((float)$min < 0) $min = 0;
}

$value_show = $min . ";" . $max; // default if error

if ($rate_change) {
    if (STInput::request('price_range')) {
        $price_range = explode(';', STInput::request('price_range'));

        $value_show = $price_range[0] . ";" . $price_range[1];
    } else {

        $value_show = $min . ";" . $max;
    }
}
?>
<li class="filter-price">
    <div class="form-extra-field dropdown">
        <button class="btn btn-link dropdown" type="button" id="dropdownMenuFilterPrice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $title; ?> <i class="fa fa-angle-down" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu range-slider" aria-labelledby="dropdownMenuFilterPrice">
            <input type="text" class="price_range" name="price_range" value="<?php echo $value_show; ?>" data-symbol="<?php echo TravelHelper::get_current_currency('symbol'); ?>" data-min="<?php echo esc_attr($min); ?>" data-max="<?php echo esc_attr($max); ?>" data-step="<?php echo st()->get_option('search_price_range_step',0); ?>"/>
            <button class="btn btn-link btn-apply-price-range"><?php echo __('Apply', ST_TEXTDOMAIN); ?></button>
        </div>
    </div>
</li>
