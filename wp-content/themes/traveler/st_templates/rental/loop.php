<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Rental loop
 *
 * Created by ShineTheme
 *
 */
global $wp_query, $st_search_query;

if ($st_search_query) {
    $query = $st_search_query;
} else $query = $wp_query;

//echo $query->request;

if(!isset($style)) $style='1';
switch($style){
	case 1:
		$style='list';
		break;
	case 2:
		$style='grid';
		break;
}
if(empty($taxonomy)) $taxonomy=false;
if($style=='list') {
    if ($query->have_posts()) {
        echo '<ul class="booking-list loop-rental style_list">';
        while ($query->have_posts()) {
            $query->the_post();
            echo st()->load_template('rental/loop','list',array("taxonomy"=>$taxonomy));
        }
        echo "</ul>";
    }

}else{
    ?>
        <div class="row row-wrap st_fix_clear style_box">
            <?php
                while($query->have_posts()){
                    $query->the_post();
                    echo st()->load_template('rental/loop','grid',array("taxonomy"=>$taxonomy));
                }
            ?>
        </div>
    <?php
}