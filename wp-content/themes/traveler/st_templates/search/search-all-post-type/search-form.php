<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity search form
 *
 * Created by ShineTheme
 *
 */
$fields=st()->get_option('all_post_type_search_fields');
?>
<h3><?php _e("Search",ST_TEXTDOMAIN) ?></h3>
<form role="search" method="get" class="search" action="<?php the_permalink(); ?>">
    <?php
        if(!get_option('permalink_structure'))
        {
            echo '<input type="hidden" name="page_id"  value="'.STInput::request('page_id').'">';
        }
    ?>
    <input type="hidden" name="layout" value="<?php echo STInput::get('layout') ?>">
    <input type="hidden" name="style" value="<?php echo STInput::get('style') ?>">
    <input type="hidden" name="search_all" value="true">
    <div class="row">
        <?php
        if(!empty($fields))
        {
            foreach($fields as $key=>$value)
            {
                $default=array(
                    'placeholder'=>''
                );
                $value=wp_parse_args($value,$default);
                $name=$value['field_search'];
                $size=$value['layout_col'];
                ?>
                <div class="col-md-<?php echo esc_attr($size);
                ?>">
                    <?php echo st()->load_template('search/search-all-post-type/field-search/field',$name,array('data'=>$value,'field_size'=>isset($field_size) ? $field_size : '','location_name'=>'location_name','placeholder'=>$value['placeholder'])) ?>
                </div>
            <?php
            }
        }?>
    </div>
    <button class="btn btn-primary btn-lg" type="submit"><?php _e("Search",ST_TEXTDOMAIN)?></button>
</form>
