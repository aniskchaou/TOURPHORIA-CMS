<?php
   $tab_nav_position = get_post_meta(get_the_ID() , 'tab_position' , true) ;
   if (!$tab_nav_position) $tab_nav_position ="top";

$tab_content_class = "col-xs-12 col-md-10";
$tab_nav_class = "col-xs-12 col-md-2" ." tabs-".$tab_nav_position ;
    if ($tab_nav_position =='top'){
        $tab_nav_class = $tab_content_class = "col-xs-12 col-md-12" ;
        $tab_content_class .=" mt20";
    }

?>
<!-- start tab -->
   <div class='row mt50 location_tab'>
      <div class="search-tabs search-tabs-bg col-xs-12">
          <div class="row">
         <?php if ($tab_nav_position =="left") {
            echo st()->load_template('location/nav_tab' , NULL, array('tab_nav_class'=> $tab_nav_class));
         }?>
         <?php if ($tab_nav_position =="top") {
            echo st()->load_template('location/nav_tab' , NULL, array('tab_nav_class'=> $tab_nav_class));
         }?>


         <!-- content -->
         <div class="tab-content col-xs-12 <?php echo esc_attr($tab_content_class)  ;?>">
            <?php 
               $meta = get_post_meta(get_the_ID()  , 'location_tab_item' ,true )  ;
               if(!empty ($meta) and is_array($meta)){
                $i = 0 ;
                 foreach ($meta as $key => $value) {               
                     ?>
                       <div class="tab-pane row <?php if ($i ==0) echo "active in" ; ?> fade <?php echo esc_attr($value['tab_type']) ?>" style="position: relative; " id="<?php echo esc_attr($value['tab_type']).$key;?>">
                           <?php echo st()->load_template('location/location_tabcontent',$value['tab_type'] ,  array('value'=> $value , 'key'   => $key));?>
                       </div>
                     <?php 
                     $i ++; 
                 }
                 unset($i);
              }
            ?>         
         </div>
         <!-- content -->


         <?php if ($tab_nav_position =="right") {
            echo st()->load_template('location/nav_tab' , NULL, array('tab_nav_class'=> $tab_nav_class));
         }?>
          </div>
      </div>
    </div>