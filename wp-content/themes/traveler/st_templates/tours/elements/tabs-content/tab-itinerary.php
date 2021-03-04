<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/1/2017
 * Version: 1.0
 */
$list_day  = get_post_meta(get_the_ID() , 'tours_program',true);
if(!empty($list_day)):
    ?>
    <div id="accordion_tours" class="panel-group st-tour-program">
        <?php
        $i=0;
        foreach($list_day as $k=>$v):
            $id=rand();
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="#collapse-<?php echo esc_html($id) ?>" data-parent="#accordion_tours" data-toggle="collapse" class="title_program">
                            <?php echo balanceTags($v['title']) ?>
                            <span class="program-day"><?php printf(esc_html__('Day %d',ST_TEXTDOMAIN),((int)$i+1))?></span>
                        </a>
                    </h4>
                </div>
                <div id="collapse-<?php echo esc_html($id) ?>" class="panel-collapse collapse <?php if($i==0)echo 'in'; ?>">
                    <div class="panel-body">
                        <?php echo nl2br($v['desc']) ?>
                    </div>
                </div>
            </div>
            <?php $i++; endforeach; ?>
    </div>
<?php endif; ?>
