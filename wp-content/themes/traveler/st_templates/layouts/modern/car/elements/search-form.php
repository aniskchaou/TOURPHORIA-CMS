<div class="search-form-wrapper st-search-form-st_rental-inner hidden-xs hidden-sm">
    <div class="container">
        <div class="search-form hotel-service">
            <div class="search-title hidden-lg hidden-md">
                <?php echo __('Search Cars', ST_TEXTDOMAIN); ?>
            </div>
            <div class="row">
                <form action="" class="form" method="get">
                <div class="col-md-4 border-right">
                    <?php echo st()->load_template('layouts/modern/car/elements/search/location', '', [ 'has_icon' => true ]); ?>
                </div>
                <div class="col-md-5 border-right">
                    <?php echo st()->load_template('layouts/modern/car/elements/search/date', '', [ 'has_icon' => true ]); ?>
                </div>
                <div class="col-md-3">
	                <?php echo st()->load_template( 'layouts/modern/car/elements/search/advanced', '' ) ?>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>