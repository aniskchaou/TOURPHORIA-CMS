<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * hotel loop
 *
 * Created by ShineTheme
 *
 */
global $wp_query, $st_search_query;

if ($st_search_query) {
    $query = $st_search_query;
} else $query = $wp_query;

if (!isset($style)) $style = 'list';
if ($style == '1') {
    if ($query->have_posts()) {
        echo '<ul class="booking-list loop-hotel style_list">';
        while ($query->have_posts()) {
            $query->the_post();
            echo st()->load_template('hotel/loop','list',array("taxonomy"=>$taxonomy));
        }
        echo "</ul>";
    }
} else {
    ?>
    <div class="row row-wrap loop_hotel loop_grid_hotel style_box">
        <?php
        while ($query->have_posts()) {
            $query->the_post();
            echo st()->load_template('hotel/loop','grid',array("taxonomy"=>$taxonomy));
        }
        ?>
    </div>
<?php
}