<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Admin profile
 *
 * Created by ShineTheme
 *
 */


if(!isset($user)) return;
?>
<h3><?php echo __('Extra profile information',ST_TEXTDOMAIN) ?></h3>

<table class="form-table">
    <?php if(isset($extra_fields) and !empty($extra_fields)):
        foreach($extra_fields as $key=>$value)
        {
            ?>
            <tr>
                <th><label for="twitter"><?php echo balanceTags($value['label']) ?></label></th>
                <td>
                    <input type="text" name="<?php echo esc_attr($key) ?>" id="<?php echo esc_attr($key) ?>" value="<?php echo  esc_attr( get_the_author_meta( $key, $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php echo balanceTags($value['desc']) ?></span>
                </td>
            </tr>
            <?php
        }

    endif;
    ?>

</table>