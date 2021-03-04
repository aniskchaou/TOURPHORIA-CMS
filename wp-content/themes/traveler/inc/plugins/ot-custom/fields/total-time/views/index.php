
<?php

$default = array(
'field_desc'  => '',
'field_name'  => '',
'field_value' => '',
'meta'        => '',
'field_id'    => '',
'type'        => ''
);

$args = wp_parse_args($args, $default);
extract($args);
$hour = 0;
$minute = 0;
if(!empty($field_value['hour'])){
    $hour = $field_value['hour'];
}

if(!empty($field_value['minute'])){
    $minute = $field_value['minute'];
}
/* verify a description */
$has_desc = $field_desc ? TRUE : FALSE;
echo '<div class="format-setting type-post_select_ajax ' . ($has_desc ? 'has-desc' : 'no-desc') . '">';
    /* description */
    echo $has_desc ? '<div class="description">' . htmlspecialchars_decode($field_desc) . '</div>' : '';
    /* format setting inner wrapper */
    echo '<div class="format-setting-inner">';
        /* allow fields to be filtered */
        echo '<div class="option-tree-ui-' . $type . '-input-wrap">';
            ?>
            <table>
                <tr>
                    <td><?php echo esc_html__('Hour(s)', ST_TEXTDOMAIN); ?></td>
                    <td><?php echo esc_html__('Minute(s)', ST_TEXTDOMAIN); ?></td>
                </tr>
                <tr>
                    <td><select name="<?php echo esc_attr($field_name)?>[hour]" class="option-tree-ui-select">
                            <?php
                            for($i = 0; $i <= 48; $i++){
                                echo '<option '.selected($hour, $i, false).' value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select></td>
                    <td><select name="<?php echo esc_attr($field_name)?>[minute]" class="option-tree-ui-select">
                            <?php
                            for($i = 0; $i < 60; $i++){
                                echo '<option '.selected($minute, $i, false).' value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select></td>
                </tr>
            </table>
<?php
echo '</div>';
echo '</div>';
echo '</div>';