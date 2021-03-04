<?php  
   $class = "col-md-3 ";
   $class_ul = " nav-stacked ";
   if (($child_tab_position)  =="top"){
      $class_ul = "";
      $class = "col-md-12 col-lg-12 col-xs-12" ; 
   }
?>
<div class="<?php echo esc_html($class);?> page-navigation">
   <ul class="nav nav-tabs <?php echo esc_html($class_ul);?>">
      <?php
         $list_item = get_post_meta(get_the_ID() , 'info_tab_item' , true );
         $i = 0 ;
         if (is_array($list_item)  and !empty($list_item)){
            foreach ($list_item as $key => $value) { 
               if (!empty($value) and !empty($tab_key ) and $value['tab_item_key'] ==$tab_key ) {
               $post_id = !empty($value['post_info_select']) ? $value['post_info_select'] :1 ; 
               $title  = !empty($value['title']) ? $value['title'] : get_the_title($post_id);               
               if (!$title){$title = get_the_title($post_id) ;}   
               ?>
               <li class='<?php if ($i ==0 ) echo esc_attr('active'); ?>'>
                  <a href="#<?php echo esc_attr("tab_".$post_id.$tab_key); ?>" data-toggle="tab"><?php echo esc_attr(ucfirst($title));?></a>
               </li>

               <?php  $i ++; 
               } // end if            
            }            
         }
         unset($i);
         
      ?>      
   </ul>
</div>