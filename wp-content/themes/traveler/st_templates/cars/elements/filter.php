<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element filter
 *
 * Created by ShineTheme
 *
 */
if(!isset($instance)) $instance=array();
$default=array(
    'title'=>st_get_language('car_filter_by').':',
    'st_search_fields'=>''
);

extract(wp_parse_args($instance,$default));

$all_fields=json_decode($st_search_fields);

?>
<aside class="booking-filters text-white cars-filters">
    <h3><?php st_the_language('car_filter_by')?>:</h3>
    <ul class="list booking-filters-list">
        <?php foreach($all_fields as $k=>$v): ?>
            <?php if($v->field == 'taxonomy'){ ?>
                <li>
                    <h5 class="booking-filters-title"><?php echo apply_filters('widget_title',$v->title) ?></h5>
                    <?php
                    TravelHelper::list_tree_tax_search( $v->taxonomy, 0, -1, 'st_cars');
                     ?>
                </li>
            <?php }; ?>
            <?php if($v->field == 'price'){ ?>
                <li>
                    <h5 class="booking-filters-title"><?php st_the_language('car_price') ?></h5>
                    <?php  echo st()->load_template('cars/filter_price'); ?>
                </li>
            <?php }; ?>
        <?php endforeach; ?>
    </ul>
</aside>