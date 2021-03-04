<?php
$result_page = st()->get_option('activity_search_result_page');
$class = 'col-lg-9';
$id = 'id="sticky-nav"';
if(isset($in_tab)) {
    $class = 'col-lg-12';
    $id = '';
}
?>
<div class="row">
    <div class="<?php echo $class; ?> tour-search-form-home">
        <div class="search-form" <?php echo $id; ?>>
            <form action="<?php echo esc_url(get_the_permalink($result_page)); ?>" class="form" method="get">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <?php echo st()->load_template('layouts/modern/activity/elements/search/location', '', ['has_icon' => true]); ?>
                    </div>
                    <div class="<?php echo isset($in_tab) ? 'col-md-5' : 'col-md-4' ?> border-right">
                        <?php echo st()->load_template('layouts/modern/activity/elements/search/date', '', ['has_icon' => true]); ?>
                    </div>
                    <div class="<?php echo isset($in_tab) ? 'col-md-3' : 'col-md-4' ?>">
                        <?php echo st()->load_template('layouts/modern/activity/elements/search/advanced', '') ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
