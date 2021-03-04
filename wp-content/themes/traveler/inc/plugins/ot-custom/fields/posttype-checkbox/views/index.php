<?php
extract( $args );
$arr_selected = array();
if(!empty($field_value)){
    foreach ($field_value as $kk => $vv){
        array_push($arr_selected, $vv);
    }
}
$data_posttype = get_list_posttype();
$has_desc = $field_desc ? true : false;
echo '<div class="format-setting type-checkbox has-desc ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : ''; ?>
    <div class="format-setting-inner">
        <?php
        if(!empty($data_posttype)){
            foreach ($data_posttype as $k => $v){
	            $selected = '';
	            if ( in_array($v['value'], $arr_selected) ) {
		            $selected = 'checked';
	            }
                echo '<p><input type="checkbox" name="'.$field_name .'['.$k.']" value="'. $v['value'] .'" id="'. $field_id . $k .'"
                  class="option-tree-ui-checkbox " '. $selected .'><label for="'. $field_id . $k .'">'. $v['label'] .'</label></p>';
            }
        }
        ?>
    </div>
<?php echo '</div>';