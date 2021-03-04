<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 2/18/2019
 * Time: 1:56 PM
 */
$list_services = vc_param_group_parse_atts($list_services);
if(!empty($list_services)){
    ?>
    <div class="st-list-of-multi-services">
        <h2 class="title">
            <?php
            if(!empty($heading))
                echo $heading . ': ';
            ?>
            <div class="st-list-dropdown">
                <div class="header" data-value="<?php echo $list_services[0]['service'] ?>">
                    <span><?php echo $list_services[0]['name']; ?></span>
                    <?php if(count($list_services) > 1){ ?>
                    <i class="fa fa-angle-down"></i>
                    <?php } ?>
                </div>
                <?php if(count($list_services) > 1){ ?>
                <ul class="list">
                    <?php
                        $i = 0;
                        foreach ($list_services as $k => $v){
                            $class = '';
                            if($i == 0)
                                $class = 'active';
                            echo '<li data-value="'. $v['service'] .'" class="'. $class .'">'. $v['name'] .'</li>';
                            $i++;
                        }
                    ?>
                </ul>
                <?php } ?>
            </div>
        </h2>
        <div class="multi-service-wrapper">
            <?php
            foreach ($list_services as $k => $v){
                global $post;
                $old_post = $post;

                $args = [
                    'post_type'      => $v['service'],
                    'posts_per_page' => $posts_per_page,
                    'order'          => 'ASC',
                    'orderby'        => 'name',
                ];
                if ( isset($v['ids']) ) {
                    $args[ 'post__in' ] = explode( ',', $v['ids'] );
                }

                switch ($v['service']){
                    case 'st_hotel':
                        if(st_check_service_available('st_hotel')) {
                            echo '<div class="tab-content '. $v['service'] .'">';
                            $hotel = STHotel::inst();
                            $hotel->alter_search_query();
                            $query = new WP_Query($args);
                            $html = '<div class="search-result-page st-tours service-slider-wrapper"><div class="st-hotel-result services-grid"><div class="owl-carousel st-service-slider">';
                            while ($query->have_posts()):
                                $query->the_post();
                                $html .= st()->load_template('layouts/modern/hotel/loop/grid', '', array('slider' => true));
                            endwhile;
                            $hotel->remove_alter_search_query();
                            wp_reset_postdata();
                            $post = $old_post;
                            $html .= '</div></div></div>';
                            echo balanceTags($html);
                            echo '</div>';
                        }
                        break;
                    case 'st_tours':
                        if(st_check_service_available('st_tours')) {
                            echo '<div class="tab-content '. $v['service'] .'">';
                            $tour = STTour::get_instance();
                            $tour->alter_search_query();
                            $query = new WP_Query($args);
                            if ($query->have_posts()) {
                                echo '<div class="search-result-page st-tours service-slider-wrapper"><div class="st-hotel-result"><div class="owl-carousel st-service-slider">';
                                while ($query->have_posts()):
                                    $query->the_post();
                                    echo st()->load_template('layouts/modern/tour/elements/loop/grid', '', array('slider' => true));
                                endwhile;
                                echo '</div></div></div>';
                            }
                            $tour->remove_alter_search_query();
                            wp_reset_postdata();
                            $post = $old_post;
                            echo '</div>';
                        }
                        break;
                    case 'st_activity':
                        if(st_check_service_available('st_activity')) {
                            echo '<div class="tab-content '. $v['service'] .'">';
                            $activity = STActivity::inst();
                            $activity->alter_search_query();
                            $query = new WP_Query($args);
                            if ($query->have_posts()) {
                                echo '<div class="search-result-page st-tours service-slider-wrapper st_activity"><div class="st-hotel-result"><div class="owl-carousel st-service-slider">';
                                while ($query->have_posts()):
                                    $query->the_post();
                                    echo st()->load_template('layouts/modern/activity/elements/loop/grid', '', array('slider' => true));
                                endwhile;
                                echo '</div></div></div>';
                            }
                            $activity->remove_alter_search_query();
                            wp_reset_postdata();
                            $post = $old_post;
                            echo '</div>';
                        }
                        break;
                }
            }
            ?>
        </div>
    </div>
    <?php
}
