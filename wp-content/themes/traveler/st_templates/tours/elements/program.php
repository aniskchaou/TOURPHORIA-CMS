<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours program
 *
 * Created by ShineTheme
 *
 */
$list_day  = get_post_meta(get_the_ID() , 'tours_program',true);
if(!empty($list_day)):
    ?>
    <div id="accordion_tours" class="panel-group">
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