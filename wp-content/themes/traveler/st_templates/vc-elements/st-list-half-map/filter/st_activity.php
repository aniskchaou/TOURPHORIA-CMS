<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.1.5
 *
 * Hotel search Map
 *
 * Created by ShineTheme
 *
 */
if(!class_exists( 'STActivity' ))
    return false;
$class  = STActivity::inst();
$fields = $class->get_search_fields();
if (empty($st_direction) )$st_direction = 'horizontal';
if(!isset( $field_size ))
    $field_size = 'md';
?>

<form id="hotel_search_half_map" method="get" class="search main-search filter_search_map" action="<?php echo home_url() ?>">
    <h2><?php echo esc_html( $title ) ?></h2>
    <input type="hidden" name="post_type" value="st_activity">
    <input type="hidden" name="action" value="st_search_list_half_map">
    <input type="hidden" name="zoom" value="<?php echo esc_html( $zoom ) ?>">
    <input type="hidden" name="style_map" value="<?php echo esc_html( $style_map ) ?>">
    <input type="hidden" name="number" value="<?php echo esc_html( $number ) ?>">
    <input type="hidden" name="is_search_map" value="true">
    <?php echo TravelHelper::get_input_multilingual_wpml() ?>
    <div class="row">
        <?php echo balanceTags($form_search) ?>
    </div>
    <?php if(!empty($form_search_advance)):?>
        <!--Search Advande-->
        <div class="search_advance">
            <div class="expand_search_box form-group-<?php echo esc_attr($field_size);?>">
                <span class="expand_search_box-more"> <i class="btn btn-primary fa fa-plus mr10"></i><?php echo __("Advanced Search",ST_TEXTDOMAIN) ; ?></span>
                <span class="expand_search_box-less"> <i class="btn btn-primary fa fa-minus mr10"></i><?php echo __("Advanced Search",ST_TEXTDOMAIN) ; ?></span>
            </div>
            <div class="view_more_content_box">
                <div class="<?php  if(!empty($st_direction) and $st_direction=='horizontal') echo 'row';?>">
                    <?php echo balanceTags($form_search_advance);?>
                </div>
            </div>
        </div>
        <!--End search Advance-->
    <?php endif;?>
    <button class="btn btn-primary btn_search btn-lg" data-title="<?php esc_html_e('Search for Activity','traveler') ?>"
            type="submit"><?php esc_html_e('Search for Activity','traveler') ?></button>
</form>
