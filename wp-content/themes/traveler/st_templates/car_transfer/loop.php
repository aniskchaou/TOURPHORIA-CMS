<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * transfer loop
 *
 * Created by ShineTheme
 *
 */

global  $st_search_query;

$style = '1';
if ($style == '1') { 
        echo '<ul class="booking-list loop-transfer style_list">';
         while($st_search_query->have_posts()): $st_search_query->the_post();
            echo st()->load_template('car_transfer/loop','list');
        endwhile;
        echo "</ul>";
} else {
    ?>
    <div class="row row-wrap loop-transfer loop_grid_transfer style_box">
        <?php
            while($st_search_query->have_posts()): $st_search_query->the_post();
                echo st()->load_template('car_transfer/loop','grid');
            endwhile;    
        ?>
    </div>
<?php
}