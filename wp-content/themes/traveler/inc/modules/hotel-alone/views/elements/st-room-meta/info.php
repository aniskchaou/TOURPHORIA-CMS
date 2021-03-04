<?php extract($atts) ?>
<div class="helios-meta-info">
    <div class="title">
        <?php echo esc_html($title) ?>
    </div>
    <div class="info">
        <?php
        $data_meta = get_post_meta(get_the_ID(),$meta,true);
        if(!empty($data_meta)){
            ?>
            <?php echo esc_html($data_meta) ?>
        <?php } ?>
    </div>
</div>