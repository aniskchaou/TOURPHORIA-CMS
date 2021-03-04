<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Content search flight
 *
 * Created by ShineTheme
 *
 */

wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' );
wp_enqueue_script('st.flight');
$fields = st()->get_option('flight_search_fields', '');

$st_direction = !empty($st_direction)? $st_direction :  "horizontal";

if(!isset($field_size)) $field_size=''; 
?>
    <h2 class='mb20'><?php echo esc_html($st_title_search) ?></h2>
    <?php $link = st()->get_option('custom_flight_search_link', ''); ?>
    <form role="search" method="get" class="search main-search" action="<?php echo esc_url($link) ?>" target="_blank">
        
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
                    
                    $size = '4';
                    if($st_style_search=="style_1"){
                        $size=$value['layout_col'];
                    }else{
                        if(!empty($value['layout2_col']))
                        {
                            $size=$value['layout2_col'];
                        }
                    }

                    if( $st_direction=='vertical' ){
                        $size='12';
                    }
                    $size_class = " col-md-".$size." col-lg-".$size. " col-sm-12 col-xs-12 " ;
                    ?>
                    <div class="<?php echo esc_attr($size_class); ?>">
                        <?php echo st()->load_template('flight/elements/search/field_'.$name,false,array('data'=>$value,'field_size'=>$field_size,'location_from'=>'a1','location_to'=>'a2','placeholder'=>$value['placeholder'],'st_direction'=>$st_direction, 'is_required' => $value['is_required'])) ?>
                    </div>
                    <?php
                }
            }?>
        </div>

        <button class="btn btn-primary btn-lg" type="submit"><?php echo __('Search for Flight', ST_TEXTDOMAIN); ?></button>
    </form>
