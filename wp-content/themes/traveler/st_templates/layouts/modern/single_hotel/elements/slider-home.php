<?php
extract(shortcode_atts(array(
    'list_slider' => '',
    'speed_slider' => '',
    'style_gallery' => 'style1',
    'text_animation' => 'text-normal'
), $attr));
if (isset($speed_slider) && !empty($speed_slider)) {
    $speed_slider = $speed_slider;
} else {
    $speed_slider = 3000;
}

$all_slider = vc_param_group_parse_atts($list_slider);
$num_slider = count($all_slider);
if (!empty($all_slider) && is_array($all_slider)) {
    if ($style_gallery == 'style1') {
        ?>
        <section id="slider-activity" class="main-slider">
            <div class="search-form-wrapper slider">
                <div class="container-fluid">
                    <div class="row">
                        <div id="carousel-example-generic" class="carousel slide">
                            <!-- Indicators -->
                            <ol class="carousel-indicators carousel-indicators-numbers">
                                <?php for ($num = 0; $num < $num_slider; $num++) { ?>
                                    <li data-target="#carousel-example-generic"
                                        data-slide-to="<?php echo $num; ?>" <?php if ($num == 0) { ?> class="active" <?php } ?>></li>
                                <?php } ?>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <?php foreach ($all_slider as $key => $val) {
                                    if (isset($val['link'])) {
                                        $st_link = vc_build_link($val['link']);
                                    } else {
                                        $st_link = "";
                                    }

                                    $slider_image = wp_get_attachment_image_src($val['image'], ''); ?>
                                    <div class="item <?php if ($key == 0) { ?>active<?php } ?>">
                                        <img src="<?php echo esc_url($slider_image[0]); ?>"
                                             alt="<?php echo esc_attr($val['title_slider']); ?>">
                                        <div class="search-form-text">
                                            <div class="container">
                                                <h1 class="st-heading"><?php echo esc_attr($val['title_slider']); ?></h1>
                                                <div class="sub-heading"><?php echo esc_attr($val['content_slider']); ?></div>
                                                <?php if (!empty($st_link)) { ?>
                                                    <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-color-danger"
                                                       href="<?php echo esc_url($st_link); ?>"
                                                       title="<?php echo esc_attr($val['title_slider']); ?>"><?php echo esc_html__('LEARN MORE', ST_TEXTDOMAIN); ?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="promotion__overlay"></div>
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Controls -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('.carousel').carousel({
                    interval: <?php echo $speed_slider;?>
                });
            });
        </script>
    <?php } else {
        wp_enqueue_style('sts-hai-slider');
        ?>
        <div class="vinhome-slider-wrapper sts-vinhome-slider" data-style="full-screen" data-interval="<?php echo $speed_slider; ?>">
            <!--text-hoz-->
            <!--text-rotate-->
            <!--text-up-->
            <div class="vinhome-slider <?php echo $text_animation; ?>">
                <?php
                foreach ($all_slider as $key => $val) {
                    if (isset($val['link'])) {
                        $st_link = vc_build_link($val['link']);
                    } else {
                        $st_link = "";
                    }
                    $slider_image = wp_get_attachment_image_src($val['image'], '');
                    ?>
                    <div class="item">
                        <div class="outer"
                             style="background-image: url('<?php echo esc_url($slider_image[0]); ?>');"></div>
                        <div class="inner">
                            <div class="img"
                                 style="background-image: url('<?php echo esc_url($slider_image[0]); ?>');"></div>
                        </div>
                        <div class="search-form-text">
                            <div class="container">
                                <h2 class="st-heading vinhome-text"><?php echo esc_attr($val['title_slider']); ?></h2>
                                <div class="sub-heading vinhome-text"><?php echo esc_attr($val['content_slider']); ?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }
} ?>