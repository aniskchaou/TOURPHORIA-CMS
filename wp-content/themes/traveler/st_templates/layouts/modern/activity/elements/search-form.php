<?php
$class = 'col-lg-9';
?>
<div class="search-form-wrapper hidden-xs hidden-sm">
    <div class="container">
        <div class="row">
            <div class="<?php echo $class; ?>">
                <div class="search-form">
                    <div class="search-title hidden-lg hidden-md">
                        <?php echo __('Search Activities', ST_TEXTDOMAIN); ?>
                    </div>
                    <!--Address-->

                    <div class="row">
                        <form action="" class="form" method="get">
                        <div class="col-md-4 border-right">
                            <?php echo st()->load_template('layouts/modern/activity/elements/search/location', '', [ 'has_icon' => true ]); ?>
                        </div>
                        <div class="col-md-4 border-right">
                            <?php echo st()->load_template('layouts/modern/activity/elements/search/date', '', [ 'has_icon' => true ]); ?>
                        </div>
                        <div class="col-md-4">
                            <?php echo st()->load_template( 'layouts/modern/activity/elements/search/advanced', '' ) ?>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>