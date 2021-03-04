<?php $is_custom_price = get_post_meta(get_the_ID() , 'is_custom_price' , true); ?>
<?php $price_origin = get_post_meta(get_the_ID() , 'cars_price' , true); ?>
<?php
$unit   = st()->get_option( 'cars_price_unit' , 'day' );
if($unit == "distance" ){
    return;
}

?>
<?php if($is_custom_price == 'price_by_number'): ?>
    <?php $price_by_number_of_day_hour = get_post_meta(get_the_ID() , 'price_by_number_of_day_hour' , true);
    if(!empty($price_by_number_of_day_hour)):
    ?>
        <h3 class="mt30 mb30"><?php echo __('Discount Information', ST_TEXTDOMAIN) ?></h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th><?php _e("#",ST_TEXTDOMAIN) ?></th>
                    <th><?php _e("Title",ST_TEXTDOMAIN) ?></th>
                    <th style="width: 120px;"><?php _e("Number ",ST_TEXTDOMAIN) ?><?php echo '('.STCars::get_price_unit('label').')' ?></th>
                    <th><?php _e("Price",ST_TEXTDOMAIN) ?></th>
                </tr>
                <?php foreach($price_by_number_of_day_hour as $k=>$v): ?>
                <tr>
                    <td><?php echo esc_html($k+1) ?></td>
                    <td><?php echo esc_html($v['title']) ?></td>
                    <td><?php echo esc_html($v['number_start']) ?> - <?php echo esc_html($v['number_end']) ?></td>
                    <td><?php echo esc_html(TravelHelper::format_money($price_origin)) ?>
                        <i class="fa fa-arrow-right" style="padding: 3px "></i>
                        <?php echo esc_html(TravelHelper::format_money($v['price'])) ?></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
    <?php endif ?>
<?php endif ?>
<?php if($is_custom_price == 'price_by_date'): ?>
    <?php $data_price = STAdmin::st_get_all_price(get_the_ID());
    $format = TravelHelper::getDateFormat();
    if(!empty($data_price)):
        ?>
        <h3 class="mt30 mb30"><?php echo __('Discount Information', ST_TEXTDOMAIN) ?></h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th><?php _e("#",ST_TEXTDOMAIN) ?></th>
                    <th><?php _e("Date Start",ST_TEXTDOMAIN) ?></th>
                    <th><?php _e("Date End",ST_TEXTDOMAIN) ?></th>
                    <th><?php _e("Price",ST_TEXTDOMAIN) ?></th>
                </tr>
                <?php foreach($data_price as $k=>$v):?>
                    <tr>
                        <td><?php echo esc_html($k+1) ?></td>
                        <td><?php echo esc_html(date_i18n($format,strtotime($v->start_date))) ?></td>
                        <td><?php echo esc_html(date_i18n($format,strtotime($v->end_date))) ?></td>
                        <td><?php echo esc_html(TravelHelper::format_money($price_origin)) ?>
                            <i class="fa fa-arrow-right" style="padding: 3px "></i>
                            <?php echo esc_html(TravelHelper::format_money($v->price)) ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    <?php endif ?>
<?php endif ?>