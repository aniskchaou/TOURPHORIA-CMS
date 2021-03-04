<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars search form
 *
 * Created by ShineTheme
 *
 */
$cars=new STCars();
$fields=$cars->get_search_fields();
if(!isset($field_size)) $field_size='';
?>
<h3><?php st_the_language('search_for_cars') ?></h3>
<form method="get" action="<?php echo home_url( '/' ); ?>" class="main-search">
    <input type="hidden" name="post_type" value="st_cars">
    <input type="hidden" name="s" value="">
    <input type="hidden" name="layout" value="<?php echo STInput::get('layout') ?>">
    <input type="hidden" name="style" value="<?php echo STInput::get('style') ?>">
    <?php echo TravelHelper::get_input_multilingual_wpml() ?>
    <div class="row">
        <?php
        if(!empty($fields)){
            foreach($fields as $key=>$value){
                $name=$value['title'];
                $size=$value['layout_col_normal'];
                $size_class = " col-md-".$size." col-lg-".$size. " col-sm-12 col-xs-12 " ;
                ?>
                <div class="<?php echo esc_attr($size_class); ?>">
                    <?php echo st()->load_template('cars/elements/search/field-'.$value['field_atrribute'],false,array('data'=>$value)) ?>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <?php 
        $option = st()->get_option('car_allow_search_advance');
        $fields=st()->get_option('car_advance_search_fields');
        $st_direction = !empty($st_direction)? $st_direction :  "horizontal";
        if($option =='on' and !empty($fields)):?>
            <div class="search_advance">
                <div class="expand_search_box form-group form-group-<?php echo esc_attr($field_size);?>">
                    <span class="expand_search_box-more"> <i class="btn btn-primary fa fa-plus mr10"></i><?php echo __("Advanced Search",ST_TEXTDOMAIN) ; ?></span>
                    <span class="expand_search_box-less"> <i class="btn btn-primary fa fa-minus mr10"></i><?php echo __("Advanced Search",ST_TEXTDOMAIN) ; ?></span>
                </div>
                <div class="view_more_content_box">
                    <div class="<?php  if($st_direction=='horizontal') echo 'row';?>">
                        <?php 
                            if(!empty($fields)){                                 
                                foreach($fields as $key=>$value){
                                    $default=array(
                                        'placeholder'=>''
                                    );
                                    $value=wp_parse_args($value,$default);
                                    $name=$value['title'];
                                    $size='4';
                                    $size=$value['layout_col_normal'];
                                    
                                    if($st_direction!='horizontal'){
                                        $size='x';
                                    }
                                    $size_class = " col-md-".$size." col-lg-".$size. " col-sm-12 col-xs-12 " ;
                                    ?>
                                    <div class="<?php echo esc_attr($size_class); ?>">
                                        <?php echo st()->load_template('cars/elements/search/field-'.$value['field_atrribute'],false,array('data'=>$value,'field_size'=>$field_size,'st_direction'=>$st_direction,'location_name'=>'location_name','placeholder'=>$value['placeholder'])) ?>
                                    </div>
                                <?php
                                }                            
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php endif;?>
    <input type="submit" class="btn btn-primary btn-lg" value="<?php st_the_language('search_for_cars') ?>">
 <!--   <button class="btn btn-primary btn-lg" type="submit"><?php /*st_the_language('search_for_cars') */?></button>-->
</form>