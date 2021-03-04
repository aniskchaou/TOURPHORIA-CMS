<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * hotel booking form
 *
 * Created by ShineTheme
 *
 */


$checkout_fields = STCart::get_checkout_fields();

?>
<div class="clearfix">

    <div class="row">
        <?php
        if(!empty($checkout_fields))
        {
            foreach($checkout_fields as $key=>$value){
                echo STCart::get_checkout_field_html($key,$value);
            }
        }

        ?>

    </div>
</div>

<?php do_action('st_after_checkout_fields',get_post_type(get_the_ID()))?>
