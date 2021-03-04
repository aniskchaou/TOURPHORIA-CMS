<?php
$style = get_post_meta(get_the_ID(), 'rs_style_rental', true);
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
    <?php echo st()->load_template('layouts/modern/rental/elements/toolbar', '', array('style' => $style, 'format' => $format, 'layout' => $layout)); ?>
    <div id="modern-search-result" class="modern-search-result" data-layout="1">
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
                    echo '<div class="col-lg-4 col-md-6 col-xs-6">';
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
                $posts_per_page = get_option('posts_per_page', 10);
                if (!$page) $page = 1;
                $last = (int)$posts_per_page * (int)($page);
                if ($last > $query->found_posts) $last = $query->found_posts;
                echo sprintf(__('%d - %d of %d %s', ST_TEXTDOMAIN), (int)$posts_per_page * ($page - 1) + 1, $last, $query->found_posts, ($query->found_posts == 1 ? 'Rental' : 'Rentals'));
            endif;
            ?>
        </span>
    </div>
</div>