<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Content search activity
 *
 * Created by ShineTheme
 *
 */
$fields=st()->get_option('all_post_type_search_fields');
?>
<h2 class='mb20'><?php echo esc_html($st_title_search) ?></h2>
<?php $id_page = st()->get_option('all_post_type_search_result_page');
if(!empty($id_page)){
    $link_action = get_the_permalink($id_page);
}else{
    $link_action = home_url( '/' );
}
?>
<form role="search" method="get" class="search" action="<?php echo esc_url($link_action) ?>">
    <input type="hidden" name="search_all" value="true">
    <?php if(empty($id_page)): ?>
    <input type="hidden" name="s" value="">
    <?php endif ?>
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
                if( $name == 'google_map_location' ){
                    $name = 'location';
                }
                $size=$value['layout_col'];
                if($st_direction=='vertical'){
                    $size='12';
                }
                $size_class = " col-md-".$size." col-lg-".$size. " col-sm-12 col-xs-12 " ;
                ?>
                <div class="<?php echo esc_attr($size_class); ?>"> 
                    <?php echo st()->load_template('search/search-all-post-type/field-search/field',$name,array('data'=>$value,'field_size'=>$field_size,'location_name'=>'location_name','placeholder'=>$value['placeholder'],'st_direction'=>$st_direction)) ?>
                </div>
            <?php
            }
        }?>
    </div>
    <button class="btn btn-primary btn-lg" type="submit"><?php _e("Search",ST_TEXTDOMAIN)?></button>
</form>
