<?php	
	if (empty($container)){$container = "div"; }
	if (empty($class)) {$class = "top-user-area-lang nav-drop" ;}

	if(function_exists('icl_get_languages'))
	{
	    $langs=icl_get_languages('skip_missing=0');
	}
	else{
	    $langs=array();
	}

    if(!empty($langs))
            {
                foreach($langs as $key=>$value){
                    if($value['active']==1){
                        $current=$value['native_name'].' <img  height="12px" width= "18px" src="'.$value['country_flag_url'].'" alt="'.$value['native_name'].'" title="'.$value['native_name'].'">';
                        break;
                    }
                }
                ?>
                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  slimmenu-sub-menu st_menu_mobile_new" >
                    <a href="#"><?php echo balanceTags($current) ?></a>
                    <ul class="sub-menu" style="display: none;">
                        <?php
                        foreach($langs as $key=>$value){
                            if($value['active']==1) continue;
                            ?>
                            <li>
                                <a title="<?php echo esc_attr($value['native_name']) ?>" href="<?php echo esc_url($value['url']) ?>">
                                    <span class="right"><?php echo esc_attr($value['native_name']) ?></span> <img height="12px" width= "18px" src="<?php echo esc_attr($value['country_flag_url']) ?>" alt="<?php echo esc_attr($value['native_name']) ?>" title="<?php echo esc_attr($value['native_name']) ?>">
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
<?php }?>



<?php if(function_exists('qtranxf_init_language') and !function_exists('icl_get_languages')) {
    global $q_config;
    global $pagenow ;
    $flags = qtranxf_language_configured('flag');
    $flag_dir = qtranxf_flag_location() ;
    $current_language = $q_config['language'];
    $lang_name = $q_config['language_name'][$current_language];
    ?>
    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  slimmenu-sub-menu st_menu_mobile_new" style="display: none" >
        <a href="#">
            <?php echo esc_attr($lang_name) ; ?> <img height='12px' width= '18px' src="<?php echo esc_attr($flag_dir.$flags[$current_language]) ; ?>" alt="<?php echo esc_attr($lang_name) ; ?>" title="<?php echo esc_attr($lang_name) ; ?>">
        </a>
        <ul class="sub-menu" style="display: none;">
            <?php
            $variable = qtranxf_getSortedLanguages();
            if (!empty($variable) and is_array($variable)){
                foreach ( $variable as $key => $value) {
                    $qtrans_link = qtranxf_convertURL('',$value, false, true);
                    $lang_name = $q_config['language_name'][$value];
                    ?>
                    <li>
                        <a title="<?php echo esc_attr($lang_name) ; ?>" href="<?php echo esc_attr($qtrans_link);?>">
                            <img src="<?php echo esc_attr($flag_dir.$flags[$value]) ; ?>" alt="<?php echo esc_attr($lang_name) ; ?>" title="<?php echo esc_attr($lang_name) ; ?>">
                            <span class="right"><?php echo esc_attr($lang_name) ; ?></span>
                        </a>
                    </li>
                <?php
                }
            }?>
        </ul>
    </li>
<?php } ?>