<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/17/2019
 * Time: 11:41 AM
 */
$terms = get_terms([
    'taxonomy' => 'st_category_cars',
    'hide_empty' => false
]);

if (!is_wp_error($terms)) {
    $pagesearch = get_the_permalink(st_get_page_search_result('st_cars'));
    ?>
    <div class="st-car-types">
        <div class="row">
            <?php
            foreach ($terms as $term) {
                $_pagesearch = add_query_arg('taxonomy[st_category_cars]', $term->term_id, $pagesearch);
                $imageID = get_term_meta($term->term_id, 'featured_image', true);
                $imageUrl = wp_get_attachment_image_url($imageID, [540, 240]);
                ?>
                <div class="col-xs-6 col-sm-3">
                    <div class="st-car-type-item has-matchHeight">
                        <a href="<?php echo esc_url($_pagesearch) ?>">
                            <img src="<?php echo esc_url($imageUrl) ?>" alt="" class="img-responsive">
                        </a>
                        <h4 class="title"><a
                                    href="<?php echo esc_url($_pagesearch) ?>"><?php echo esc_html($term->name); ?></a>
                        </h4>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}
?>

