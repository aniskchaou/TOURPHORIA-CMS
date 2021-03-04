<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Helper check out field
 *
 * Created by ShineTheme
 *
 */

if(!function_exists('st_checkout_fieldtype_text'))
{
    function st_checkout_fieldtype_text($field_name,$field)
    {
        $default=array(
            'label'=>'',
            'placeholder'=>'',
            'class'=>array(
                'form-control'
            ),
            'type'=>'text',
            'size'=>6,
            'icon'=>'',
            'validate'=>''
        );

        $field=wp_parse_args($field,$default);
        extract($field);

        if(!$placeholder) $placeholder=$label;

        $required=false;
        if(strpos($validate,'required')!==FALSE)
        {
            $class[]='required';
            $required='<span class="require">*</span>';
        }

        if($icon)
        {
            $icon="<i class='".st_handle_icon_class($icon)." input-icon'></i>";
        }


        ob_start();
        ?>
        <div class="col-sm-<?php echo esc_attr($size) ?>">

            <div class="form-group <?php if($icon){ echo 'form-group-icon-left';} ?>">                
                <label for="field-<?php echo esc_attr($field_name) ?>"><?php echo balanceTags($label) ?> <?php echo balanceTags($required) ?> </label>
                <?php echo balanceTags($icon)?>
                <input class="<?php echo implode(' ',$class) ?>" id="field-<?php echo esc_attr($field_name) ?>" value="<?php echo esc_attr($value) ?>" name="<?php echo esc_attr($field_name) ?>" placeholder="<?php echo esc_attr($placeholder) ?>" type="text">
            </div>

        </div>
        <?php

         $html=@ob_get_clean();

        return $html;
    }
}


if(!function_exists('st_checkout_fieldtype_textarea'))
{
    function st_checkout_fieldtype_textarea($field_name,$field)
    {
        $default=array(
            'label'=>'',
            'placeholder'=>'',
            'class'=>array(
                'form-control'
            ),
            'type'=>'text',
            'size'=>6,
            'icon'=>'',
            'validate'=>'',
            'attrs'=>array()
        );

        $field=wp_parse_args($field,$default);
        extract($field);

        if(!$placeholder) $placeholder=$label;

        $required=false;
        if(strpos($validate,'required')!==FALSE)
        {
            $class[]='required';
            $required='<span class="require">*</span>';
        }

        if($icon)
        {
            $icon="<i class='".st_handle_icon_class($icon)." input-icon'></i>";
        }


        $attrs_str=false;

        if(is_array($attrs) and !empty($attrs))
        {
            foreach($attrs as $key=>$value2){
                $attrs_str.=" $key='".esc_attr($value2)."'";
            }
        }

        ob_start();
        ?>
        <div class="col-sm-<?php echo esc_attr($size) ?>">

            <div class="form-group <?php if($icon){ echo 'form-group-icon-left';} ?>">
                
                <label for="field-<?php echo esc_attr($field_name) ?>"><?php echo balanceTags($label) ?> <?php echo balanceTags($required) ?> </label>
                <?php echo balanceTags($icon)?>

                <textarea <?php echo ($attrs_str)?> class="<?php echo implode(' ',$class) ?>" id="field-<?php echo esc_attr($field_name) ?>"  name="<?php echo esc_attr($field_name) ?>" placeholder="<?php echo esc_attr($placeholder) ?>"><?php echo ($value)?></textarea>
            </div>

        </div>
        <?php

        $html=@ob_get_clean();

        return $html;
    }
}

if(!function_exists('st_checkout_fieldtype_checkbox'))
{
    function st_checkout_fieldtype_checkbox($field_name,$field)
    {
        $default=array(
            'label'=>'',
            'placeholder'=>'',
            'class'=>array(
                'form-control'
            ),
            'type'=>'text',
            'size'=>6,
            'icon'=>'',
            'validate'=>''
        );

        $field=wp_parse_args($field,$default);
        extract($field);

        if(!$placeholder) $placeholder=$label;

        $required=false;
        if(in_array('required',$class))
        {
            $required='<span class="require">*</span>';
        }

        ob_start();
        ?>
        <div class="col-sm-<?php echo esc_attr($size) ?>">
            <div class="checkbox">
                <label>
                    <input class="i-check" value="1" name="<?php echo esc_attr($field_name) ?>" type="checkbox" <?php if($value){echo 'checked';} ?> /><?php echo balanceTags($label)?>
                </label>
            </div>

        </div>
        <?php

        $html=@ob_get_clean();

        return $html;
    }
}

if(!function_exists('st_checkout_fieldtype_label'))
{
	function st_checkout_fieldtype_label($field_name,$field)
	{
		$default=array(
			'label'=>'',
		);
		$field=wp_parse_args($field,$default);
		extract($field);
		ob_start();
		?>
        <div class="col-sm-12">
            <h4 class="st-field-label"><?php echo $field['label']; ?></h4>
        </div>
		<?php

		$html=@ob_get_clean();

		return $html;
	}
}
