<?php
/**
 * Created by ShineTheme.
 * Developer: nasanji
 * Date: 8/25/2017
 * Version: 1.0
 */

$cat_all_list=get_terms('category');
?>
<div class="isotope-filter text-center">
    <ul class="text-center">
        <li><a href="javascript:;" class="active filter" data-filter="all" ><?php esc_html_e('All',ST_TEXTDOMAIN); ?></a></li>
        <?php if (is_array($cat_all_list) && !empty($cat_all_list)) {?>
            <?php if(is_array($list_cat)&& count($list_cat)>0){ ?>
                <?php foreach($list_cat as $key => $value){
                    if ($value != '') {
                        $cat = get_term_by('slug', $value, 'category');
                        ?>
                        <li><a href="javascript:void(0)" class="filter" data-filter="<?php echo ($value == '') ? 'all' : '.' . $value ?>" title=""><?php echo (isset($cat)) ? $cat->name : esc_html__('All', ST_TEXTDOMAIN) ?></a></li>
                        <?php
                    }
                }
            }
        } ?>
    </ul>
</div>
