<?php
$default=array(
    'st_list_form'=>'',
    'st_style_search' =>'style_1',
    'st_direction'=>'horizontal',
    'st_box_shadow'=>'no',
    'st_search_tabs'=>'yes',
    'st_title_search'=>'',
    'field_size'    =>''
);

if(isset($data)){
    extract($data=wp_parse_args($data,$default));
}else{
    extract($data=$default);
}
?>
<div class="search-tabs search-tabs-bg <?php if($st_box_shadow=='no') echo 'no-boder-search'; else echo 'booking-item-dates-change'; ?>">
    <div class="tabbable">

        <div class="tab-content">
          <?php
              echo st()->load_template('search/content-search',$st_list_form,$data);
          ?>
        </div>
    </div>
</div>