<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * hotel share
 *
 * Created by ShineTheme
 *
 */
$st_style_search="style_2";
$room=new STRoom();
$fields=$room->get_search_fields();
?>
<h3><?php _e("Search for Room",ST_TEXTDOMAIN)?></h3>
<form role="search" method="get" class="search main-search" action="<?php echo home_url( '/' ); ?>">
    <input type="hidden" name="s" value="">
    <input type="hidden" name="post_type" value="hotel_room">
    <input type="hidden" name="layout" value="<?php echo STInput::get('layout') ?>">
    <input type="hidden" name="style" value="<?php echo STInput::get('style') ?>">
    <?php echo TravelHelper::get_input_multilingual_wpml() ?>
    <div class="row">

        <?php
        if(!empty($fields))
        {
            foreach($fields as $key=>$value)
            {
                $name=$value['name'];
                $size='4';
                if($st_style_search=="style_1")
                {
                    $size=$value['layout_col'];
                }else
                {
                    if($value['layout2_col'])
                    {
                        $size=$value['layout2_col'];
                    }
                }

                ?>
                <div class="col-md-<?php echo esc_attr($size);
                ?>">
                    <?php echo st()->load_template('hotel-room/elements/search/field_'.$name,false,array('data'=>$value)) ?>
                </div>
            <?php
            }
        }?>

    </div>

    <?php
        $option = st()->get_option('hotel_room_allow_search_advance');
        $fields=$room->get_search_adv_fields();
        $st_direction = !empty($st_direction)? $st_direction :  "horizontal";
        $field_size = !empty($field_size) ? $field_size : "lg";
        if( $option =='on' and !empty($fields)):?>
        <!--Search Advande-->
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
                            $name=$value['name'];
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
                            ?>
                            <div class="col-md-<?php echo esc_attr($size);  ?>">
                                <?php echo st()->load_template('hotel-room/elements/search/field_'.$name,false,array('data'=>$value,'field_size'=>$field_size,'location_name'=>'location_name')) ?>
                            </div>
                        <?php
                        }
                    }?>

                </div>
            </div> 
        </div>
        <!--End search Advance-->
        <?php endif;?>

    <button class="btn btn-primary btn-lg" type="submit"><?php _e("Search for Room",ST_TEXTDOMAIN)?></button>
</form>
