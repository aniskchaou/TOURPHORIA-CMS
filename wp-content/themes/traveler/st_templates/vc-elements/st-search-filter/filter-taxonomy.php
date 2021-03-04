<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.1.3
 *
 * Filter Taxonomy
 *
 * Created by ShineTheme
 *
 */
if(empty( $taxonomy )) return;

$key   = $taxonomy;

echo '<div>';
TravelHelper::list_tree_tax_search( $taxonomy, 0, -1, $post_type);
echo '</div>';