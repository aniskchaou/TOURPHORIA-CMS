<?php
$result_page = st_get_page_search_result('st_cars');
$class = '';
$id = 'id="sticky-nav"';
if (isset($in_tab)) {
    $class = 'in_tab';
    $id = '';
}

?>
<div class="search-form hotel-search-form-home hotel-search-form <?php echo $class; ?>" <?php echo $id; ?>>
    <form action="<?php echo esc_url(get_the_permalink($result_page)); ?>" class="form" method="get">
        <div class="row">
            <div class="col-md-4 border-right">
                <?php echo st()->load_template('layouts/modern/car/elements/search/location', '', ['has_icon' => true]) ?>
            </div>
            <div class="col-md-5 border-right">
                <?php echo st()->load_template('layouts/modern/car/elements/search/date', '', ['has_icon' => true]) ?>
            </div>
            <div class="col-md-3">
                <?php echo st()->load_template('layouts/modern/car/elements/search/advanced', '') ?>
            </div>
        </div>
    </form>
</div>
<?php
if (isset($feature_item) && !empty($feature_item)) {
    ?>
    <div class="st-feature-items row">
        <?php
        foreach ($feature_item as $item) {
            ?>
            <div class="col col-xs-12 col-sm-4">
                <div class="item">
                    <h4 class="title"><?php echo esc_html($item['heading']); ?></h4>
                    <div class="desc"><?php echo esc_html($item['description']); ?></div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
<?php } ?>
