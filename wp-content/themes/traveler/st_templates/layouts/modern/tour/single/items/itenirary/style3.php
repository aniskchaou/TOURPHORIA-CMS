<?php
$tour_programs = get_post_meta(get_the_ID(), 'tours_program', true);
if (!empty($tour_programs)) {
    foreach ($tour_programs as $k => $v) {
        ?>
        <div class="item active">
            <?php
                if(!empty($v['image'])){
                    echo '<div class="icon">';
                    echo '<img src="'. $v['image'] .'" alt="' . __('Itenirary', ST_TEXTDOMAIN) .'" />';
                    echo '</div>';
                }
            ?>
            <h5><?php echo esc_html($v['title']); ?></h5>
            <div class="body">
                <?php echo balanceTags(nl2br($v['desc'])); ?>
            </div>
        </div>
        <?php
    }
}