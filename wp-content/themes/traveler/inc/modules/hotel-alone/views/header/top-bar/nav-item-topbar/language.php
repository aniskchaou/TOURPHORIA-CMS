<?php
if (function_exists('icl_get_languages')) {
    $langs = icl_get_languages('skip_missing=0');
} else {
    $langs = array();
}
if (!empty($langs)) {
    foreach ($langs as $key => $value) {
        if ($value['active'] == 1) {
            $current = '<img  height="12px" width= "18px" src="' . $value['country_flag_url'] . '" alt="' . $value['native_name'] . '" title="' . $value['native_name'] . '"> &nbsp;<strong>' . $value['native_name'] . '</strong>';
            break;
        }
    }
?>
<div class="dropdown">
        <span class="dropdown-toggle" data-toggle="dropdown">
            <?php echo $current; ?>
            <i class="fa fa-angle-down"></i>
        </span>
    <?php
    if( count( $langs ) >= 2 ){
        echo '<ul class="dropdown-menu">';
        foreach($langs as $key=>$value){
            if($value['active']==1) continue;
            ?>
            <li>
                <a title="<?php echo esc_attr($value['native_name']) ?>" href="<?php echo esc_url($value['url']) ?>">
                    <img height="12px" width= "18px" src="<?php echo esc_attr($value['country_flag_url']) ?>" alt="<?php echo esc_attr($value['native_name']) ?>" title="<?php echo esc_attr($value['native_name']) ?>"> &nbsp;<strong><?php echo esc_attr($value['native_name']) ?></strong>
                </a>
            </li>
            <?php
        }
        echo '</ul>';
    }
    ?>
</div>
<?php }else{
    $language = get_locale();
    $language_a = explode('_',$language);
    if(!empty($language_a[0])) {
        $language = $language_a[0];
    }
    ?>
    <div class="dropdown">
        <span class="dropdown-toggle" data-toggle="dropdown">
            <strong><?php echo esc_html($language) ?></strong>
            <i class="fa fa-angle-down"></i>
        </span>
        <ul class="dropdown-menu hide">
            <li><a href="#"><?php echo esc_html($language) ?></a> </li>
        </ul>
    </div>
<?php
}