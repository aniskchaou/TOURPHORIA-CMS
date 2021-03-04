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
                $current='
                    <a href="#" class="current_langs">
                        <img  height="12px" width= "18px" src="'.$value['country_flag_url'].'" alt="'.$value['native_name'].'" title="'.$value['native_name'].'">'.$value['native_name'].'<i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i>
                    </a>';
                        break;
                    }
                }
                echo '<'.esc_attr($container).' class="'.esc_attr($class).'">';
                if( count( $langs ) >= 2 ):
                echo balanceTags($current).'<ul class="list nav-drop-menu" style="min-width:120px">';
                foreach($langs as $key=>$value){
                    if($value['active']==1) continue;
                    ?>
                    <li>
                        <a title="<?php echo esc_attr($value['native_name']) ?>" href="<?php echo esc_url($value['url']) ?>">
                            <img height="12px" width= "18px" src="<?php echo esc_attr($value['country_flag_url']) ?>" alt="<?php echo esc_attr($value['native_name']) ?>" title="<?php echo esc_attr($value['native_name']) ?>"><span class="right"><?php echo esc_attr($value['native_name']) ?></span>
                        </a>
                    </li>
                    <?php
                }
                echo '</ul>';
                endif;
                echo '</'.($container).'>';
            }?>
