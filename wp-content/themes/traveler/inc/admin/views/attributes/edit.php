<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Admin attributes edit
 *
 * Created by ShineTheme
 *
 */

$name = $row['name'];
?>
<div class="wrap woocommerce">
    <div class="icon32 icon32-attributes" id="icon-woocommerce"><br/></div>
    <h2><?php _e( 'Edit Attribute', ST_TEXTDOMAIN ) ?></h2>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
            <tr class="form-field form-required">
                <th scope="row" valign="top">
                    <label for="attribute_label"><?php _e( 'Name', ST_TEXTDOMAIN ); ?></label>
                </th>
                <td>
                    <input name="attribute_label" id="attribute_label" type="text" value="<?php echo $name; ?>" />
                    <p class="description"><?php _e( 'Name for the attribute (shown on the front-end).', ST_TEXTDOMAIN ); ?></p>
                </td>
            </tr>
            <tr class="form-field form-required">
                <th scope="row" valign="top">
                    <label for="attribute_name"><?php _e( 'Slug', ST_TEXTDOMAIN ); ?></label>
                </th>
                <td>
                    <input name="attribute_name" id="attribute_name" type="text" readonly="readonly" value="<?php echo esc_attr( $row['tax'] ); ?>" maxlength="28" />
                    <p class="description"><?php _e( 'Unique slug/reference for the attribute; must be shorter than 28 characters.', ST_TEXTDOMAIN ); ?></p>
                </td>
            </tr>
            <tr class="form-field form-required" style="display: none !important;">
                <th scope="row" valign="top">
                    <label for="attribute_type"><?php _e( 'Hierarchy', ST_TEXTDOMAIN ); ?></label>
                </th>
                <td>
                    <select name="attribute_type" id="attribute_type">
                        <option <?php selected($row['hierarchical'],1)?> value="1"><?php _e( 'Yes', ST_TEXTDOMAIN ) ?></option>
                        <option <?php selected($row['hierarchical'],0)?> value="0"><?php _e( 'No', ST_TEXTDOMAIN ) ?></option>
                    </select>
                    <p class="description"><?php _e( 'Determines how you select attributes for products. Under admin panel -> products -> product data -> attributes -> values, <strong>Text</strong> allows manual entry whereas <strong>select</strong> allows pre-configured terms in a drop-down list.', ST_TEXTDOMAIN ); ?></p>
                </td>
            </tr>
            <tr class="form-field form-required">
                <th scope="row" valign="top">
                    <label for=""><?php _e( 'Post Types', ST_TEXTDOMAIN ); ?></label>
                </th>
                <td>
                    <?php
                    $checked=array();
                    $post_types=get_post_types(array('public'=>true),'objects');
                    if(isset($row['post_type']) and is_array($row['post_type']))
                    {
                        $checked=$row['post_type'];
                    }
                    ?>
                    <?php if(!empty($post_types))
                    {
                        foreach($post_types as $key=>$value)
                        {
                            ?>
                            <label >
                                <input <?php if(in_array($key,$checked)) echo "checked";  ?> name="attribute_post_type[]" type='checkbox' value="<?php echo esc_attr($key) ?>"/><?php echo esc_attr($value->labels->name) ?></label><br>
                        <?php
                        }

                    }?>
                </td>
            </tr>
            </tbody>
        </table>
        <p class="submit"><input type="submit" name="st_save_attribute" id="submit" class="button-primary" value="<?php _e( 'Update', ST_TEXTDOMAIN ); ?>"></p>
        <?php wp_nonce_field( 'st_save_attribute' ); ?>
    </form>
</div>