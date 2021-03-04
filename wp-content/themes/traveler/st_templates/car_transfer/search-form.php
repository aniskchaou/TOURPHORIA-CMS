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
$transfer=new STCarTransfer();
$fields = $transfer->get_search_fields();
?>
<h3><?php echo __('Search for Car Transfer', ST_TEXTDOMAIN); ?></h3>
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
                $name=$value['name'];
                $size=$value['layout_col'];
                ?>
                <div class="col-md-<?php echo esc_attr($size);
                ?>">
                    <?php echo st()->load_template('car_transfer/elements/search/field',$name,array('data'=>$value,'location_name'=>'location_name')) ?>
                </div>
            <?php
            }
        }?>
    </div>
    
    <button class="btn btn-primary btn-lg" type="submit"><?php echo __('Search for Car Transfer', ST_TEXTDOMAIN); ?></button>
</form>
