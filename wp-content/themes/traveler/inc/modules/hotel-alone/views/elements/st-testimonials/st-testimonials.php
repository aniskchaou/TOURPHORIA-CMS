<?php
/**
 * Created by ShineTheme.
 * Developer: nasanji
 * Date: 8/14/2017
 * Version: 1.0
 */

extract($atts);
$list_data = vc_param_group_parse_atts($lists);
if(!empty($list_data) && is_array($list_data)){
    if($style == 'style-1') {
        ?>
        <div class="st-testimonials owl-carousel style-1 <?php echo esc_attr($v_style); ?> <?php echo esc_attr($extra_class); ?>"
             data-dots="<?php echo esc_attr($show_pagi) ?>" data-nav="<?php echo esc_attr($show_nav); ?>">
            <?php
            foreach ($list_data as $val) {
                ?>
                <div class="item text-center">
                    <?php if (!empty($val['avatar'])) { ?>
                        <div class="test-avatar">
                            <?php
                            echo wp_get_attachment_image($val['avatar'], array(150, 150), false);
                            ?>
                        </div>
                    <?php } ?>
                    <p class="content-message">
                        <?php
                        $content = $val['content_review'];
                        $content = str_replace('{','[',$content);
                        $content = str_replace('}',']',$content);
                        echo do_shortcode($content) ?>
                    </p>
                    <?php if (!empty($val['stars'])) {
                        echo '<span class="rating">';
                        for ($i = 0; $i < intval($val['stars']); $i++) {
                            echo '<i class="fa fa-star"></i>';
                        }
                        echo '</span>';
                    } ?>
                    <p class="name-position">
                        <span class="name"><?php echo esc_attr($val['name']); ?></span>
                        <?php
                        if (!empty($val['position'])) {
                            ?>
                            - <span class="position"><?php echo esc_attr($val['position']); ?></span>
                        <?php } ?>
                    </p>
                </div>
                <?php
            } ?>
        </div>
        <?php
    }else{
        ?>
        <div class="st-testimonials owl-carousel style-2 <?php echo esc_attr($extra_class); ?>" data-dots="<?php echo esc_attr($show_pagi) ?>" data-nav="<?php echo esc_attr($show_nav); ?>">
        <?php
        foreach ($list_data as $val) {
            ?>
            <div class="item text-center">
                <p class="content-message">
                    <?php echo do_shortcode($val['content_review']) ?>
                </p>
                <div class="name-avatar">
                    <?php if (!empty($val['avatar'])) { ?>
                        <div class="test-avatar">
                            <?php
                            echo wp_get_attachment_image($val['avatar'], array(42, 42), false);
                            ?>
                        </div>
                    <?php } ?>
                    <div class="name-position">
                        <span class="name"><?php echo esc_attr($val['name']); ?></span>
                        <?php
                        if (!empty($val['position'])) {
                            ?>
                            - <span class="position"><?php echo esc_attr($val['position']); ?></span>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <?php } ?>
        </div>
<?php
    }
} ?>