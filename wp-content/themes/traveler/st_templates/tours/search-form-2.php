<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours search form
 *
 * Created by ShineTheme
 *
 */
$tours=new STTour();
$fields=$tours->get_search_fields();
?>
<h3><?php st_the_language('search_for_tour') ?></h3>
<form role="search" method="get" class="search main-search" action="<?php the_permalink() ?>">
    <?php
        if(!get_option('permalink_structure'))
        {
            echo '<input type="hidden" name="page_id"  value="'.STInput::request('page_id').'">';
        }
    ?>
    <input type="hidden" name="layout" value="<?php echo STInput::get('layout') ?>">
    <input type="hidden" name="style" value="<?php echo STInput::get('style') ?>">
    <?php echo TravelHelper::get_input_multilingual_wpml() ?>

    <div class="row">
        <?php
        if(!empty($fields))
        {
            foreach($fields as $key=>$value)
            {
                $name=$value['tours_field_search'];
                $size=$value['layout_col'];

                ?>
                <div class="col-md-<?php echo esc_attr($size);
                ?>">
                    <?php echo st()->load_template('tours/elements/search/field',$name,array('data'=>$value,'location_name'=>'location_name')) ?>
                </div>
            <?php
            }
        }?>
    </div>
    <?php
    $option = st()->get_option('tour_allow_search_advance');
    $fields=st()->get_option('tour_advance_search_fields');
    $st_direction = !empty($st_direction) ? $st_direction : "horizontal";
    $field_size = !empty($field_size) ? $field_size : "lg";
    if($option =='on' and !empty($fields)):?>
        <div class="search_advance">
            <div class="expand_search_box form-group form-group-<?php echo esc_attr($field_size);?>">
                <span class="expand_search_box-more"> <i class="btn btn-primary fa fa-plus mr10"></i><?php echo __("Advanced Search",ST_TEXTDOMAIN) ; ?></span>
                <span class="expand_search_box-less"> <i class="btn btn-primary fa fa-minus mr10"></i><?php echo __("Advanced Search",ST_TEXTDOMAIN) ; ?></span>
            </div>
            <div class="view_more_content_box">
                <div class="<?php  if($st_direction=='horizontal') echo 'row';?>">
                    <?php
                    if(!empty($fields))
                    {
                        foreach($fields as $key=>$value)
                        {
                            $default=array(
                                'placeholder'=>''
                            );
                            $value=wp_parse_args($value,$default);
                            $name=$value['tours_field_search'];
                            $size='4';
                            if(!empty($st_style_search) and $st_style_search=="style_1")
                            {
                                $size=$value['layout_col'];
                            }else
                            {
                                if($value['layout2_col'])
                                {
                                    $size=$value['layout2_col'];
                                }
                            }
                            if(!empty($st_direction) and $st_direction!='horizontal'){
                                $size='x';
                            }
                            $size_class = " col-md-".$size." col-lg-".$size. " col-sm-12 col-xs-12 " ;
                            ?>
                            <div class="<?php echo esc_attr($size_class); ?>">

                                <?php echo st()->load_template('tours/elements/search/field',$name,array('data'=>$value,'field_size'=>$field_size,'location_name'=>'location_name','placeholder'=>$value['placeholder'])) ?>
                            </div>
                        <?php
                        }
                    }?>
                </div>
            </div>
        </div>
    <?php endif;  ?>
    <button class="btn btn-primary btn-lg" type="submit"><?php st_the_language('search_for_tour') ?></button>
</form>
