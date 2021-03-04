<?php
$filters = get_post_meta(get_the_ID(), 'rs_filter', true);
if(!isset($format))
    $format = '';
?>
<div class="col-lg-3 col-md-3 sidebar-filter">
    <?php if($format == 'popupmap'){ ?>
        <div class="sidebar-item sidebar-search-form hidden-xs hidden-sm">
            <div class="search-form-wrapper sidebar-inner">
                <div class="search-form">
                    <div class="search-title">
                        <?php echo __('Search Hotels', ST_TEXTDOMAIN); ?> <span class="hidden-lg hidden-md hidden-sm close-filter"><i class="fa fa-times" aria-hidden="true"></i></span>
                    </div>
                    <!--Address-->
                    <div class="row">
                        <form action="<?php echo get_the_permalink(); ?>" class="form" method="get">
                            <div class="col-md-12">
                                <?php echo st()->load_template('layouts/modern/hotel/elements/search/location', '', ['has_icon' => true]); ?>
                            </div>
                            <div class="col-md-12">
                                <?php echo st()->load_template('layouts/modern/hotel/elements/search/date', '', ['has_icon' => true]); ?>
                            </div>
                            <div class="col-md-12">
                                <?php echo st()->load_template('layouts/modern/hotel/elements/search/guest', '', ['has_icon' => true]); ?>
                            </div>
                            <div class="col-md-12">
                                <?php echo st()->load_template('layouts/modern/hotel/elements/search/advanced', '', ['position' => 'sidebar']); ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-item map-view-wrapper hidden-xs hidden-sm">
            <div class="map-view">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <?php echo __('MAPS VIEW', ST_TEXTDOMAIN); ?>
            </div>
        </div>
    <?php } ?>
    <h3 class="sidebar-title"><?php echo __('FILTER BY', ST_TEXTDOMAIN); ?> <span class="hidden-lg hidden-md close-filter"><?php echo TravelHelper::getNewIcon('Ico_close', '#A0A9B2', '20px', '20px'); ?></span></h3>

    <?php
        if(!empty($filters)){
            foreach ($filters as $k => $v){
                echo st()->load_template('layouts/modern/hotel/elements/sidebar/' . $v['rs_filter_type'], '', array('title' => $v['title'], 'taxonomy' => $v['rs_filter_type_taxonomy']));
            }
        }
    ?>
</div>