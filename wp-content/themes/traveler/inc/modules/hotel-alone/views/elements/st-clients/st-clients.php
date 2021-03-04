<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 8/14/2017
 * Version: 1.0
 */
extract($atts);
$clients = vc_param_group_parse_atts($list_clients);
if(!empty($clients)){
?>
<div class="st-client owl-carousel <?php echo esc_attr($extra_class); ?>" data-item="<?php echo esc_attr($items); ?>">
    <?php
    foreach($clients as $val) {
        if (!empty($val['logo'])) {
            ?>
            <div class="item">
                <?php if(!empty($val['link'])){
                    $st_link = vc_build_link($val['link']);
                    echo '<a href="'.esc_url($st_link['url']).'" title="'.esc_attr($st_link['title']).'" target="'.($st_link['target']?'_blank':'_self').'">';
                    echo wp_get_attachment_image($val['logo'], array(75,0), false);
                    echo '</a>';
                }else{
                    echo wp_get_attachment_image($val['logo'], array(75,0), false);
                } ?>
            </div>
        <?php }
    }?>
</div>
<?php } ?>