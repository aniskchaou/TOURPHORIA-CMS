<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars change search form
 *
 * Created by ShineTheme
 *
 */
$cars=new STCars();
$fields=$cars->get_search_fields_box();
?>
<h3><?php st_the_language('change_location_and_date') ?></h3>
<form method="get" action="" class="clearfix main-search">
    <?php
        if(STInput::get('sc') == 'inbox' && !empty(STInput::get('message_id'))){
	        echo '<input type="hidden" name="sc"  value="'.STInput::get('sc').'">';
	        echo '<input type="hidden" name="message_id"  value="'.STInput::get('message_id').'">';
        }
        if(!get_option('permalink_structure'))
        {
            echo '<input type="hidden" name="st_cars"  value="'.st_get_the_slug().'">';
        }
    ?>
    <?php echo TravelHelper::get_input_multilingual_wpml() ?>
    <div class="row">
        <?php
        if(!empty($fields)){
            foreach($fields as $key=>$value){
                $name=$value['title'];
                $size=$value['layout_col_box'];
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

    <input type="submit" class="btn btn-primary btn-lg" value="<?php st_the_language('change_location_and_date') ?>">
 <!--   <button class="btn btn-primary btn-lg" type="submit"><?php /*st_the_language('search_for_cars') */?></button>-->
</form>