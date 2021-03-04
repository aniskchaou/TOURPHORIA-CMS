<?php
    /**
     * @package WordPress
     * @subpackage Traveler
     * @since 1.0
     *
     * Tours field duration
     *
     * Created by ShineTheme
     * @update 1.2.0
     */
    wp_enqueue_script( 'typeahead.js' );
    wp_enqueue_script( 'handlebars-v2.0.0.js' );
	return;
    
    $default=array(
        'title'=>'',
        'is_required'=>'on',
    );

    if(isset($data)){
        extract(wp_parse_args($data,$default));
    }else{
        extract($default);
    }
    if($is_required == 'on'){
        $is_required = 'required';
    }
?>
<div class="form-group form-group-lg form-group-icon-left">
    
    <label for="field-tour-duration"><?php echo esc_html($title)?></label>
    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
    <input id="field-tour-duration" name="duration" <?php echo esc_attr($is_required) ?> value="<?php echo STInput::get('duration') ?>" class="typeahead_location form-control <?php echo esc_attr($is_required) ?>" placeholder="<?php st_the_language('tour_duration')?>" type="text" />
</div>