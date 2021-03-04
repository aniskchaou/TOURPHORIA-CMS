<?php
$style = 'grid';

global $wp_query, $st_search_query;
if ($st_search_query) {
    $query = $st_search_query;
} else $query = $wp_query;

if(empty($format))
    $format = '';

if(empty($layout))
    $layout = '';
?>
    <div class="toolbar">
        <ul class="toolbar-action-mobile hidden-lg hidden-md">
            <li><a href="#" class="btn btn-primary btn-date"><?php echo __('Date', ST_TEXTDOMAIN); ?></a></li>
            <li><a href="#" class="btn btn-primary btn-sort"><?php echo __('Sort', ST_TEXTDOMAIN); ?></a></li>
            <li><a href="#" class="btn btn-primary btn-filter"><?php echo __('Filter', ST_TEXTDOMAIN); ?></a></li>
        </ul>
        <div class="dropdown-menu sort-menu sort-menu-mobile">
            <div class="sort-title">
                <h3><?php echo __('SORT BY', ST_TEXTDOMAIN); ?> <span class="hidden-lg hidden-md close-filter"><?php echo TravelHelper::getNewIcon('Ico_close', '#A0A9B2', '20px', '20px'); ?></span></h3>
            </div>
            <div class="sort-item st-icheck">
                <div class="st-icheck-item"><label> <?php echo __('New activity', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_m_<?php echo $format; ?>" data-value="new" checked/><span class="checkmark"></span></label></div>
            </div>
            <div class="sort-item st-icheck">
                <span class="title"><?php echo __('Price', ST_TEXTDOMAIN); ?></span>
                <div class="st-icheck-item"><label> <?php echo __('Low to Hight', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_m_<?php echo $format; ?>"  data-value="price_asc"/><span class="checkmark"></span></label></div>
                <div class="st-icheck-item"><label> <?php echo __('Hight to Low', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_m_<?php echo $format; ?>"  data-value="price_desc"/><span class="checkmark"></span></label></div>
            </div>
            <div class="sort-item st-icheck">
                <span class="title"><?php echo __('Name', ST_TEXTDOMAIN); ?></span>
                <div class="st-icheck-item"><label> <?php echo __('a - z', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_m_<?php echo $format; ?>"  data-value="name_a_z"/><span class="checkmark"></span></label></div>
                <div class="st-icheck-item"><label> <?php echo __('z - a', ST_TEXTDOMAIN); ?><input class="service_order" type="radio" name="service_order_m_<?php echo $format; ?>"  data-value="name_z_a"/><span class="checkmark"></span></label></div>
            </div>
        </div>
        <h3 class="search-string modern-result-string" id="modern-result-string"><?php echo balanceTags(STActivity::inst()->get_result_string()); ?> <div id="btn-clear-filter" class="btn-clear-filter" style="display: none"><?php echo __('Clear filter', ST_TEXTDOMAIN); ?></div> </h3>
    </div>
<?php
echo st()->load_template('layouts/modern/activity/elements/top-filter/top-filter');
?>
    <div id="modern-search-result" class="modern-search-result">
        <?php echo st()->load_template('layouts/modern/common/loader', 'content'); ?>
        <?php
        if($style == 'grid'){
          echo '<div class="row row-wrapper">';
        }else{
            echo '<div class="style-list">';
        }
        ?>
        <?php
        if($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                echo st()->load_template('layouts/modern/activity/elements/loop/' . $style, '', array('top_search' => true));
            }
        }else{
            echo $style == 'grid' ? '<div class="col-xs-12">' : '';
            echo st()->load_template('layouts/modern/activity/elements/loop/none');
            echo $style == 'grid' ? '</div>' : '';
        }
        wp_reset_query();
        ?>
        </div>
    </div>

    <div class="pagination moderm-pagination" id="moderm-pagination" data-layout="normal">
        <?php TravelHelper::paging(false, false); ?>
        <span class="count-string">
            <?php
            if (!empty($st_search_query)) {
                $query = $st_search_query;
            }
            if ($query->found_posts):
                $page = get_query_var('paged');
                $posts_per_page = st()->get_option( 'activity_posts_per_page', 12 );
                if (!$page) $page = 1;
                $last = $posts_per_page * ($page);
                if ($last > $query->found_posts) $last = $query->found_posts;
                echo sprintf(__('%d - %d of %d %s', ST_TEXTDOMAIN), $posts_per_page * ($page - 1) + 1, $last, $query->found_posts, ($query->found_posts == 1 ? 'Activity' : 'Activities'));
            endif;
            ?>
        </span>
    </div>