<div class="st-testimonial-new">
    <h3><?php echo $attr['title']; ?></h3>
    <?php
    $list_team = vc_param_group_parse_atts($attr['list_team']);
    if (!empty($list_team)) {
        echo '<div class="owl-carousel st-testimonial-slider ' . $attr['style_layout'] . ' ">';
        foreach ($list_team as $k => $v) {
            if ($attr['style_layout'] == 'style-1') {
                ?>
                <div class="item has-matchHeight">
                    <div class="author">
                        <?php $img = wp_get_attachment_image_url($v['avatar'], array(70, 70)); ?>
                        <img src="<?php echo $img; ?>" alt="User Avatar"/>
                        <div class="author-meta">
                            <h4><?php echo esc_attr($v['name']); ?></h4>
                            <div class="star">
                                <?php
                                $rating = $v['rating'];
                                if ($rating > 5)
                                    $rating = 5;
                                if ($rating < 0)
                                    $rating = 0;

                                for ($i = 1; $i <= $rating; $i++) {
                                    echo '<i class="fa fa-star"></i> ';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <p>
                        <?php echo esc_attr($v['content']); ?>
                    </p>
                </div>
                <?php
            } else {
                ?>
                <div class="item has-matchHeight">
                    <div class="author">
                        <?php $img = wp_get_attachment_image_url($v['avatar'], array(100, 100)); ?>
                        <img src="<?php echo $img; ?>" alt="User Avatar"/>
                    </div>
                    <p>
                        <?php echo esc_attr($v['content']); ?>
                    </p>
                    <div class="author-meta">
                        <h4><?php echo esc_attr($v['name']); ?></h4>
                    </div>
                </div>
                <?php
            }
        }
        echo '</div>';
    }
    ?>
</div>
