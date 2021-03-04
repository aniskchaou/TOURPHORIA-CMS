<?php
$filters = get_post_meta(get_the_ID(), 'rs_filter', true);
if(!isset($format))
    $format = '';
?>
<div class="top-filter">
    <ul>
        <li><h3 class="title"><?php echo __('FILTER BY', ST_TEXTDOMAIN); ?></h3> <span class="hidden-lg hidden-md close-filter"><?php echo TravelHelper::getNewIcon('Ico_close', '#A0A9B2', '20px', '20px'); ?></span></li>
        <?php
        if(!empty($filters)){
            foreach ($filters as $k => $v){
                echo st()->load_template('layouts/modern/hotel/elements/top-filter/' . $v['rs_filter_type'], '', array('title' => $v['title'], 'taxonomy' => $v['rs_filter_type_taxonomy']));
            }
        }
        ?>
    </ul>
    <?php if($format != 'popup'){ ?>
    <div class="show-map">
        <span><?php echo __('Maps', ST_TEXTDOMAIN); ?></span>
        <label class="switch">
            <input type="checkbox" id="btn-show-map" checked>
            <span class="slider round"></span>
        </label>
    </div>

    <div class="show-map show-map-on-mobile hidden-lg hidden-md hidden-xs">
        <span><?php echo __('Maps', ST_TEXTDOMAIN); ?></span>
        <label class="switch">
            <input type="checkbox" id="btn-show-map-mobile" />
            <span class="slider round"></span>
        </label>
    </div>
    <?php }else{ ?>
        <span class="close-map-view-popup"><?php echo TravelHelper::getNewIcon('Ico_close', '#A0A9B2', '20px', '20px'); ?></span>
    <?php } ?>
</div>