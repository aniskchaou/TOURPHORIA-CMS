<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Content search hotel
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('STCarTransfer')) return false;
$transfer=new STCarTransfer();
$fields=$transfer->get_search_fields();
$st_direction = !empty($st_direction)? $st_direction :  "horizontal";
if(!isset($field_size)) $field_size=''; 
?>
    <h2 class='mb20'><?php echo esc_html($st_title_search) ?></h2>
    <?php $id_page = st()->get_option('car_transfer_search_page');
          if(!empty($id_page)){
              $link_action = get_the_permalink($id_page);
          }else{
              $link_action = home_url( '/' );
          }
    ?>
    <form role="search" method="get" class="search main-search" action="<?php echo esc_url($link_action) ?>">
        <?php if(empty($id_page)): ?>   
        <input type="hidden" name="post_type" value="st_hotel">
        <input type="hidden" name="s" value="">
        <?php endif ?>
        <?php if(STInput::get('layout')):?>
        <input type="hidden" name="layout" value="<?php echo STInput::get('layout') ?>">
        <?php endif;?>
        <?php echo TravelHelper::get_input_multilingual_wpml() ?>
        <div class="row">
            <?php
            if(!empty($fields))
            {
                foreach($fields as $key=>$value)
                {
                    $default=array(
                        'placeholder'=>''
                    );
                    $value = wp_parse_args($value,$default);
                    $name = $value['name'];
                    if( $name == 'google_map_location' ){
                        $name = 'location';
                    }
                    $size = '4';
                        if($st_style_search=="style_1")
                    {
                        $size=$value['layout_col'];
                    }else
                    {
                        if(!empty($value['layout2_col']))
                        {
                            $size=$value['layout2_col'];
                        }
                    }

                    if($st_direction=='vertical'){
                        $size='12';
                    }
                    $size_class = " col-md-".$size." col-lg-".$size. " col-sm-12 col-xs-12 " ;
                    ?>
                    <div class="<?php echo esc_attr($size_class); ?>">
                        <?php echo st()->load_template('car_transfer/elements/search/field-'.$name,false,array('data'=>$value,'field_size'=>$field_size,'location_name'=>'location_name','placeholder'=>$value['placeholder'],'st_direction'=>$st_direction)) ?>
                    </div>
                    <?php
                }
            }?>
        </div>
        <button class="btn btn-primary btn-lg" type="submit"><?php echo __('Search', ST_TEXTDOMAIN); ?></button>
    </form>
