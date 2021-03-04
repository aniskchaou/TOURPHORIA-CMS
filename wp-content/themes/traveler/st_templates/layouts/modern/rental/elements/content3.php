<?php
$style = get_post_meta(get_the_ID(), 'rs_style', true);
if (empty($style))
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
<div class="col-lg-9 col-md-9">
    <?php echo st()->load_template('layouts/modern/rental/elements/toolbar', '', array('style' => $style, 'format' => $format, 'layout' => 3)); ?>
    <div id="modern-search-result" class="modern-search-result" data-layout="3">
        <?php echo st()->load_template('layouts/modern/common/loader', 'content'); ?>
        <?php
        if($style == 'grid'){
          echo '<div class="row row-wrapper">';
        }else{
            echo '<div class="list-style">';
        }
        ?>
        <?php
        if($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                if($style == 'grid'){
                    echo '<div class="col-lg-4 col-md-6 col-xs-6 ">';
                }
                echo st()->load_template('layouts/modern/rental/elements/loop/normal', $style);
                if($style == 'grid') {
                    echo '</div>';
                }
            }
        }else{
            echo $style == 'grid' ? '<div class="col-xs-12">' : '<div class="col-xs-12">';
            echo st()->load_template('layouts/modern/rental/elements/none');
            echo $style == 'grid' ? '</div>' : '</div>';
        }
        wp_reset_query();
        ?>
        </div>
    </div>

    <div class="pagination moderm-pagination" id="moderm-pagination" data-layout="normal">
        <?php echo TravelHelper::paging(false, false); ?>
        <span class="count-string">
            <?php
            if (!empty($st_search_query)) {
                $query = $st_search_query;
            }
            if ($query->found_posts):
                $page = get_query_var('paged');
                $posts_per_page = st()->get_option( 'rental_posts_per_page', 12 );
                if (!$page) $page = 1;
                $last = $posts_per_page * ($page);
                if ($last > $query->found_posts) $last = $query->found_posts;
                echo sprintf(__('%d - %d of %d %s', ST_TEXTDOMAIN), $posts_per_page * ($page - 1) + 1, $last, $query->found_posts, ($query->found_posts == 1 ? __('Rental', ST_TEXTDOMAIN) : __('Rentals', ST_TEXTDOMAIN)));
            endif;
            ?>
        </span>
    </div>
</div>