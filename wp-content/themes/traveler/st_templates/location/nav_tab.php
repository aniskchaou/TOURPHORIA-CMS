<div class='location_tab tabbable <?php echo esc_attr($tab_nav_class) ; ?>'>
    <ul class="nav nav-tabs ">
      <?php 
      $meta = get_post_meta(get_the_ID()  , 'location_tab_item' ,true )  ;
      if (!$meta) {
        $meta = STLocation::get_opt_list_std();
      }  
      if (!empty($meta) and is_array($meta)){
        $i = 0 ; 
         foreach ($meta as $key => $value) {
            $href = $value['tab_type'].$key;
            $icon = $value['tab_icon_'] ;
            $name = $value['title']; 
            ?>
            <li class='<?php if ($i ==0) echo "active" ; ?>'>
                <a href="#<?php echo esc_attr($href) ; ?>" data-toggle="tab">
                  <i class=" fa <?php echo esc_attr($icon)?>"></i>
                  <span class="text"><?php echo esc_attr($name); ?></span>
               </a>
            </li>
            <?php    $i ++;
         }
         unset($i);
      }?>

    </ul>
</div>