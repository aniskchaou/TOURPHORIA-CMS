<?php
if (!empty($arr_service)) {
    $active_tab = STInput::get('service', $arr_service[0]);
}
if (!empty($arr_service)) { ?>
    <ul class="nav nav-tabs" id="">
        <?php
        foreach ($arr_service as $k => $v) {
            if (STUser_f::_check_service_available_partner('st_'.$v, $current_user_upage->ID)) {
                $get = $_GET;
                $get['service'] = $v;
                unset($get['pages']);
                $author_link = esc_url(get_author_posts_url($current_user_upage->ID));
                $url = esc_url(add_query_arg($get, $author_link));
                ?>
                <li class="<?php echo $active_tab == $v ? 'active' : ''; ?>"><a
                        href="<?php echo $url; ?>"
                        aria-expanded="true"><?php
                        switch ($v) {
                            case "hotel":
                                echo __('Hotels', ST_TEXTDOMAIN);
                                break;
                            case "tours":
                                echo __('Tours', ST_TEXTDOMAIN);
                                break;
                            case "activity":
                                echo __('Activity', ST_TEXTDOMAIN);
                                break;
                            case "cars":
                                echo __('Car', ST_TEXTDOMAIN);
                                break;
                            case "rental":
                                echo __('Rental', ST_TEXTDOMAIN);
                                break;
                            case "flight":
                                echo __('Flight', ST_TEXTDOMAIN);
                                break;
                        }

                        ?></a></li>
                <?php
            }
        }
        ?>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in author-sv-list" id="tab-all">
            <?php
            $service = STInput::get('service', $arr_service[0]);
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $author = $current_user_upage->ID;
            $args = array(
                'post_type' => 'st_' . $service,
                'post_status' => 'publish',
                'author' => $author,
                'posts_per_page' => 6,
                'paged' => $paged
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) {
                switch ($service) {
                    case "hotel":
                        echo '<div class="search-result-page"><div class="st-hotel-result"><div class="row row-wrapper">';
                        break;
                    case "tours":
                        echo '<div class="search-result-page st-tours"><div class="st-hotel-result"><div class="row row-wrapper">';
                        break;
                    case "activity":
                        echo '<div class="search-result-page st-tours st-activity"><div class="st-hotel-result"><div class="row row-wrapper">';
                        break;
                    case "cars":
                        echo '<ul class="booking-list loop-cars style_list">';
                        break;
                    case "rental":
                        echo '<ul class="booking-list loop-rental style_list">';
                        break;
                    case "flight":
                        echo '<ul class="booking-list loop-rental style_list">';
                        break;
                }
                while ($query->have_posts()) {
                    $query->the_post();
                    switch ($service) {
                        case "hotel":
                            echo st()->load_template('layouts/modern/hotel/elements/loop/normal', 'grid');
                            break;
                        case "tours":
                            echo st()->load_template('layouts/modern/tour/elements/loop/grid');
                            break;
                        case "activity":
                            echo st()->load_template('layouts/modern/activity/elements/loop/grid');
                            break;
                        case "cars":
                            echo st()->load_template('cars/elements/loop/loop-1');
                            break;
                        case "rental":
                            echo st()->load_template('rental/loop', 'list', array('taxonomy' => ''));
                            break;
                        case "flight":
                            echo st()->load_template('user/loop/loop', 'flight-upage');
                            break;
                    }
                }
                echo "</div></div></div>";
            } else {
                echo '<h5>' . __('No data', ST_TEXTDOMAIN) . '</h5>';
            }
            wp_reset_postdata();
            ?>
            <br/>
            <div class="pull-left author-pag">
                <?php st_paging_nav(null, $query) ?>
            </div>
        </div>
    </div>

    <div class="st-review-new">
        <h5><?php echo __('Review', ST_TEXTDOMAIN); ?></h5>
        <?php
        echo st()->load_template('layouts/modern/page/elements/partner', 'review', array(
            'current_user_upage' => $current_user_upage,
            'arr_service' => $arr_service,
            'post_per_page_review' => 5
        ));
        ?>
    </div>

    <?php
} else {
    echo __('No partner services!', ST_TEXTDOMAIN);
}
?>