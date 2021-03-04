<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Content search cars
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('STCars')) return;
$cars=new STCars();
$fields=$cars->get_search_fields();  
if(!isset($field_size)) $field_size='';
$st_direction = !empty($st_direction)? $st_direction :  "horizontal";
?>

    <h2 class='mb20'><?php echo esc_html($st_title_search) ?></h2>
    <?php $id_page = st()->get_option('cars_search_result_page');
    if(!empty($id_page)){
        $link_action = get_the_permalink($id_page);
    }else{
        $link_action = home_url( '/' );
    }
    ?>
    <form method="get" action="<?php echo esc_url($link_action) ?>" class="main-search">
        <?php if(empty($id_page)): ?>
        <input type="hidden" name="post_type" value="st_cars">
        <input type="hidden" name="s" value="">
        <?php endif ?>
        <?php echo TravelHelper::get_input_multilingual_wpml() ?>
        <div class="row">
            <div class=''>
            <?php
            if(!empty($fields)){
                $is_row = 0 ; 
                foreach($fields as $key=>$value){
                    $default=array(
                        'placeholder'=>''
                    );
                    $value=wp_parse_args($value,$default);
                    $name=$value['title'];
                    
                    if( $value['field_atrribute'] == 'google_map_location' ){
                        $value['field_atrribute'] = 'location';
                    }
                    $size='4';
                    $size=$value['layout_col_normal'];

                    if($st_direction=='vertical'){
                        $size='12';
                    }
                    $size_class = " col-md-".$size." col-lg-".$size. " col-sm-12 col-xs-12 " ;
                    ?>
                    <div class="<?php echo esc_attr($size_class); ?>">
                        <?php echo st()->load_template('cars/elements/search/field-'.$value['field_atrribute'],false,array('data'=>$value,'field_size'=>$field_size,'st_direction'=>$st_direction,'location_name'=>'location_name','placeholder'=>$value['placeholder'],'st_direction'=>$st_direction)) ?>
                    </div>
                <?php
                    if ($is_row >=12 ) {echo "</div><div class=''>"; $is_row = 0 ; }
                }
            }
            ?>
            </div>
        </div>
        <?php 
        $option = st()->get_option('car_allow_search_advance');
        $fields=st()->get_option('car_advance_search_fields'); 
        if($option =='on' and !empty($fields)):?>
            <div class="search_advance">
                <div class="expand_search_box form-group form-group-<?php echo esc_attr($field_size);?>">
                    <span class="expand_search_box-more"> <i class="btn btn-primary fa fa-plus mr10"></i><?php echo __("Advanced Search",ST_TEXTDOMAIN) ; ?></span>
                    <span class="expand_search_box-less"> <i class="btn btn-primary fa fa-minus mr10"></i><?php echo __("Advanced Search",ST_TEXTDOMAIN) ; ?></span>
                </div>
                <div class="view_more_content_box">
                    <div class="row">
                        <?php 
                            if(!empty($fields)){                                 
                                foreach($fields as $key=>$value){
                                    $default=array(
                                        'placeholder'=>''
                                    );
                                    $value=wp_parse_args($value,$default);
                                    $name=$value['title'];
                                    if( $value['field_atrribute'] == 'google_map_location' ){
                                        $value['field_atrribute'] = 'location';
                                    }
                                    if( $name == 'google_map_location' ){
                                        $name = 'location';
                                    }
                                    $size='4';
                                    $size=$value['layout_col_normal'];

                                    if($st_direction=='vertical'){
                                        $size='12';
                                    }
                                    $size_class = " col-md-".$size." col-lg-".$size. " col-sm-12 col-xs-12 " ;
                                    ?>
                                    <div class="<?php echo esc_attr($size_class); ?>">
                                        <?php echo st()->load_template('cars/elements/search/field-'.$value['field_atrribute'],false,array('data'=>$value,'field_size'=>$field_size,'st_direction'=>$st_direction,'location_name'=>'location_name','placeholder'=>$value['placeholder'],'st_direction'=>$st_direction)) ?>
                                    </div>
                                <?php
                                }                            
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php endif;?>
        <button class="btn btn-primary btn-lg" type="submit"><?php st_the_language('search_for_cars') ?></button>
    </form>
