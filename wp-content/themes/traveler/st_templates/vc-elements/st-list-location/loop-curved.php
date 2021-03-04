<div class=" st_top_location">
    <div class="row row-wrap">
<?php
$col = 12 / $st_col;
if ($st_type =='st_cars'){
    $location_text   = 'location_id_pick_up' ; 
}else{
    $location_text = 'location_id';
}
while(have_posts()){
    the_post();
?>
        <div class="col-md-<?php echo esc_attr($col) ?> col-sm-6 col-xs-12 loop-curved st_lazy_load">
            <div class="thumb">
                <header class="thumb-header">
                    <?php
                    if (empty($search_field)) $search_field = "";
                    $page_search = st_get_page_search_result($st_type);
                    
                    if($st_type == 'st_cars'){
                        $search_field .= '_pickup';
                    }

                    if(!empty($page_search) and get_post_type($page_search)=='page'){
                        $link = add_query_arg(array($location_text =>get_the_ID(), 'location_name' => get_the_title()),get_the_permalink($page_search));
                    }else{
                        //$link = home_url(esc_url('?s=&post_type='.$st_type."&".$location_text."=".get_the_ID()));

                        $link = add_query_arg(array(
                            's'=>'',
                            'post_type'=>$st_type,
                            $location_text=>get_the_ID(),
                            'location_name' => get_the_title()
                        ),home_url('/'));
                    }
                    if($link_to == 'single'){
                        $link = get_the_permalink();
                    }
                    ?>
                    <a href="<?php echo esc_url($link) ?>" class="hover-img curved">
                        <?php
                        /*$img = get_the_post_thumbnail( get_the_ID() , array(263,197,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ;
                        if(!empty($img)){
                            echo balanceTags($img);
                        }else{
                            echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(ST_TRAVELER_URI.'/img/no-image.png',array('width'=>800,'height'=>600)) .'">';
                        }*/
                        TravelHelper::getLazyLoadingImage(array(263,197,'bfi_thumb'=>true));
                        ?>
                        <i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>
                    </a>
                </header>
                <?php
                $img = get_post_meta(get_the_ID(),'logo',true);
                if(is_numeric($img)){
                    $img = wp_get_attachment_url($img);
                }
                if($st_show_logo == 'yes' && !empty($img)){
                    ?>
                    <div class="img-<?php echo esc_attr($st_logo_position) ?>">
                        <img title="logo" alt="logo" src="<?php echo balanceTags($img) ?>" width="32px" height="32px">
                    </div>
                <?php } ?>
                <div class="thumb-caption">
                    <h4 class="thumb-title"><?php the_title() ?></h4>
                    <p class="thumb-desc"><?php echo strip_tags(get_the_excerpt()) ?></p>
                </div>
            </div>
        </div>
<?php } ?>
    </div>
</div>