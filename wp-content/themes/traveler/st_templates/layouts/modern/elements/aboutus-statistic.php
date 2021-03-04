<?php
if(!empty($list_statistic)){
    $list_statistic = vc_param_group_parse_atts($list_statistic);

    if(!empty($list_statistic)){
        echo '<div class="st-list-statistic"><div class="row">';
        foreach ($list_statistic as $k => $v){
            ?>
            <div class="col-md-3 col-sm-6">
                <div class="item-wrapper">
                    <div class="item">
                        <div class="front">
                            <div class="inner">
                                <h4><?php echo $v['main_text']; ?></h4>
                                <p class="sub-text"><?php echo $v['sub_text']; ?></p>
                            </div>
                        </div>
                        <div class="end">
                            <p class="desc"><?php echo $v['desc']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        echo '</div></div>';
    }
}