<div class="map-view-popup">
    <div class="container view-map-inner">
        <?php echo st()->load_template('layouts/modern/hotel/elements/top-filter/top', 'filter', array('format' => 'popup')); ?>
        <div class="row page-half-map">
            <div class="col-lg-6 col-md-6 col-right-map col-md-push-6">
                <div class="map-popup-title hidden-lg hidden-md">
                    <?php echo __('Map', ST_TEXTDOMAIN); ?>
                    <span class="close-map-view-popup"><?php echo TravelHelper::getNewIcon('Ico_close', '#A0A9B2', '20px', '20px'); ?></span>
                </div>
                <div id="map-search-form" class="map-full-height" data-disablecontrol="true" data-showcustomcontrol="true" data-zoom="13"></div>
            </div>
            <div class="col-lg-6 col-md-6 col-left-map col-md-pull-6">
                <?php echo st()->load_template('layouts/modern/common/loader', 'content'); ?>
                <?php echo st()->load_template('layouts/modern/hotel/elements/toolbar', '', array('format' => 'popup')); ?>
                <div id="modern-search-result" class="modern-search-result-popup"></div>
                <div class="pagination moderm-pagination" id="moderm-pagination" data-layout="normal"></div>
            </div>
        </div>
    </div>
</div>