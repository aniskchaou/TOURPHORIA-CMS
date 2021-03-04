<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 3/6/15
 * Time: 3:16 PM
 */
$link=get_template_directory_uri().'/';
?>
<div class="demo_changer" id="demo_changer">
    <div class="demo-icon setting">
        <i class="fa-spin fa fa-cog"></i>
        <span class="hover"><span>Quick Options</span></span>
    </div>
    <a href="http://shinetheme.com/documentation/traveler/" class="demo-icon doc" target="_blank">
        <i class="fa fa-book"></i>
        <span class="hover"><span>Documentation</span></span>
    </a>
    <a href="https://www.youtube.com/watch?v=hghfObbp-v0&list=PLKwVkOFkT-MYozhDeR8PKarhL7To_9npN" class="demo-icon video" target="_blank">
        <i class="fa fa-video-camera"></i>
        <span class="hover"><span>Video Tutorials</span></span>
    </a>
    <a href="https://themeforest.net/item/traveler-traveltourbooking-wordpress-theme/10822683" class="demo-icon buy" target="_blank">
        <i class="fa fa-download"></i>
        <span class="hover"><span>Purchase Now</span></span>
    </a>
    <div class="form_holder">
        <div class="purchase">
            <a class="demo-buy-now" href="https://themeforest.net/item/traveler-traveltourbooking-wordpress-theme/10822683" target="_blank">Purchase Now</a>
        </div>
        <div class="line"></div>
        <p class="title">Color Scheme</p>
        <div class="predefined_styles" id="styleswitch_area">
            <a class="styleswitch" href="#" style="background:#ED8323;"></a>
            <a class="styleswitch" href="#" data-src="bright-turquoise" style="background:#0EBCF2;"></a>
            <a class="styleswitch" href="#" data-src="turkish-rose" style="background:#B66672;"></a>
            <a class="styleswitch" href="#" data-src="salem" style="background:#12A641;"></a>
            <a class="styleswitch" href="#" data-src="hippie-blue" style="background:#4F96B6;"></a>
            <a class="styleswitch" href="#" data-src="mandy" style="background:#E45E66;"></a>
            <a class="styleswitch" href="#" data-src="green-smoke" style="background:#96AA66;"></a>
            <a class="styleswitch" href="#" data-src="horizon" style="background:#5B84AA;"></a>
            <a class="styleswitch" href="#" data-src="cerise" style="background:#CA2AC6;"></a>
            <a class="styleswitch" href="#" data-src="brick-red" style="background:#cf315a;"></a>
            <a class="styleswitch" href="#" data-src="de-york" style="background:#74C683;"></a>
            <a class="styleswitch" href="#" data-src="shamrock" style="background:#30BBB1;"></a>
            <a class="styleswitch" href="#" data-src="studio" style="background:#7646B8;"></a>
            <a class="styleswitch" href="#" data-src="leather" style="background:#966650;"></a>
            <a class="styleswitch" href="#" data-src="denim" style="background:#3366cc;"></a>
            <a class="styleswitch" href="#" data-src="scarlet" style="background:#FF1D13;"></a>
        </div>
        <div class="line"></div>
        <p class="title">Homepages Demo</p>
        <div class="home_demo">
            <div class="demo-row">
            <?php
            $arr = array(
                array(
                    'title' => 'TravelPayouts API',
                    'img' => get_template_directory_uri().'/demo/img/home/travelpayout.jpg',
                    'link' => 'http://travelerwp.com/travelpayouts-whitelabel/',
                    'new' => 1
                ),
                array(
                    'title' => 'List Hotels - Full Map',
                    'img' => get_template_directory_uri().'/demo/img/home/hotel-full-map.jpg',
                    'link' => 'http://travelerwp.com/hotel-full-map/',
                    'new' => 1
                ),
                array(
                    'title' => 'List Cars - Full Map',
                    'img' => get_template_directory_uri().'/demo/img/home/cars-full-map.jpg',
                    'link' => 'http://travelerwp.com/cars-full-map/',
                    'new' => 1
                ),
                array(
                    'title' => 'List Rentals - Full Map',
                    'img' => get_template_directory_uri().'/demo/img/home/rental-full-map.jpg',
                    'link' => 'http://travelerwp.com/rental-full-map/',
                    'new' => 1
                ),
                array(
                    'title' => 'List Tours - Full Map',
                    'img' => get_template_directory_uri().'/demo/img/home/tour-full-map.jpg',
                    'link' => 'http://travelerwp.com/tours-full-map/',
                    'new' => 1
                ),
                array(
                    'title' => 'List Activities - Full Map',
                    'img' => get_template_directory_uri().'/demo/img/home/activity-full-map.jpg',
                    'link' => 'http://travelerwp.com/activity-full-map/',
                    'new' => 1
                ),
                array(
                    'title' => 'Default Layout',
                    'img' => get_template_directory_uri().'/demo/img/home/default-home.jpg',
                    'link' => 'http://travelerwp.com/?page_id=289'
                ),
                array(
                    'title' => 'Video Background',
                    'img' => get_template_directory_uri().'/demo/img/home/video-background.jpg',
                    'link' => 'http://travelerwp.com/?page_id=309'
                ),
                array(
                    'title' => 'Word Rotator',
                    'img' => get_template_directory_uri().'/demo/img/home/word-rotator.jpg',
                    'link' => 'http://travelerwp.com/?page_id=453'
                ),
                array(
                    'title' => 'Hero Slider Width Weather Widget',
                    'img' => get_template_directory_uri().'/demo/img/home/weather-slider.jpg',
                    'link' => 'http://travelerwp.com/?page_id=310'
                ),
                array(
                    'title' => 'Blured Slider + Weather Widget',
                    'img' => get_template_directory_uri().'/demo/img/home/search-on-slider.jpg',
                    'link' => 'http://travelerwp.com/?page_id=333'
                ),
                array(
                    'title' => 'Grid Images',
                    'img' => get_template_directory_uri().'/demo/img/home/grid-images.jpg',
                    'link' => 'http://travelerwp.com/?page_id=416'
                ),
                array(
                    'title' => 'Testimonials Rotator',
                    'img' => get_template_directory_uri().'/demo/img/home/testimonial-rotator.jpg',
                    'link' => 'http://travelerwp.com/?page_id=389'
                ),
                array(
                    'title' => 'Hero Slider',
                    'img' => get_template_directory_uri().'/demo/img/home/hero-slider.jpg',
                    'link' => 'http://travelerwp.com/?page_id=426'
                ),
                array(
                    'title' => 'Location List',
                    'img' => get_template_directory_uri().'/demo/img/home/location-list.jpg',
                    'link' => 'http://travelerwp.com/home-location-list/'
                ),
                array(
                    'title' => 'Coming soon',
                    'img' => get_template_directory_uri().'/demo/img/home/coming.jpg',
                    'link' => '#'
                ),
            );

            foreach($arr as $key => $val){
                ?>
                <div class="item">
                    <a href="<?php echo esc_url($val['link']); ?>">
                        <img width="400" height="256" src="<?php echo esc_url($val['img']); ?>" alt="<?php echo esc_attr($val['title']); ?>">
                        <span class="name"><?php echo esc_html($val['title']); ?></span>
                    </a>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
    </div>
</div>