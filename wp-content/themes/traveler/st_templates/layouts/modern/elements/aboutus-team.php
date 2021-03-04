<div class="st-aboutus-team">
    <h3><?php echo $attr['title']; ?></h3>
    <?php
    $list_team = vc_param_group_parse_atts($attr['list_team']);
    if(!empty($list_team)){
        echo '<div class="row">';
        foreach ($list_team as $k => $v){
            echo '<div class="col-md-3 col-sm-6 item">';
            ?>
            <div class="thumb">
                <img src="<?php echo wp_get_attachment_image_url($v['photo'], 'full') ?>" class="img-responsive" />
                <?php
                $social = vc_param_group_parse_atts($v['list_social']);
                if(!empty($social)){
                    ?>
                    <div class="social">
                        <?php
                        echo '<ul>';
                        foreach ($social as $kk => $vv){
                            $link_social = vc_build_link($vv['link']);

                            ?>
                                <li><a href="<?php echo $link_social['url']; ?>"><i class="<?php echo $vv['icon']; ?>"></i></a></li>
                            <?php
                        }
                        echo '</ul>';
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <p class="name"><?php echo esc_html($v['name']); ?></p>
            <p class="pos"><?php echo esc_html($v['position']); ?></p>
            <?php
            echo '</div>';
        }
        echo '</div>';
    }
    ?>
</div>
