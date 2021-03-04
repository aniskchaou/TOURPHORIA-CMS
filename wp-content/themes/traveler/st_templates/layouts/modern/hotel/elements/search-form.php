<div class="search-form-wrapper hidden-xs hidden-sm">
    <div class="container">
        <div class="search-form hotel-service">
            <div class="search-title hidden-lg hidden-md">
                <?php echo __('Search Hotels', ST_TEXTDOMAIN); ?>
            </div>
            <!--Address-->

            <div class="row">
                <form action="" class="form" method="get">
                <div class="col-md-3 border-right">
                    <?php echo st()->load_template('layouts/modern/hotel/elements/search/location', '', [ 'has_icon' => true ]); ?>
                </div>
                <div class="col-md-3 border-right">
                    <?php echo st()->load_template('layouts/modern/hotel/elements/search/date', '', [ 'has_icon' => true ]); ?>
                </div>
                <div class="col-md-3 border-right">
                    <?php echo st()->load_template('layouts/modern/hotel/elements/search/guest', '', [ 'has_icon' => true ]); ?>
                </div>
                <div class="col-md-3">
	                <?php echo st()->load_template( 'layouts/modern/hotel/elements/search/advanced', '' ) ?>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>