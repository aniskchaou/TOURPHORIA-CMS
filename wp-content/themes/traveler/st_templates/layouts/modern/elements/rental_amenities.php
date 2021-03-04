<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/29/2019
 * Time: 9:28 AM
 */

$terms = get_terms(array(
    'taxonomy' => 'rental_types',
    'hide_empty' => false,
    'number' => (int)$posts_per_page
));

if (!is_wp_error($terms)) {

    ?>
    <div class="st-rental-types row">
        <?php foreach ($terms as $term) {
            $icon = TravelHelper::handle_icon(get_tax_meta($term->term_id, 'st_icon', true));
            $icon_new = TravelHelper::handle_icon(get_tax_meta($term->term_id, 'st_icon_new', true));
            if (!$icon) $icon = "fa fa-cogs";
            $result_page = get_the_permalink(st_get_page_search_result('st_rental'));
            $result_page = add_query_arg([
                'taxonomy[rental_types]' => $term->term_id
            ], $result_page);
            ?>
            <div class=" col col-xs-6 col-sm-3 col-md-2">
                <div class="rental-type">
                    <a href="<?php echo esc_url($result_page) ?>">
                        <?php
                        if (!$icon_new) {
                            echo '<i class="' . $icon . '"></i>' . $term->name;
                        } else {
                            echo TravelHelper::getNewIcon($icon_new, '', '68px', '68px');
                        }
                        ?>
                        <h4 class="title"><?php echo esc_html($term->name); ?></h4>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
<?php }
?>
