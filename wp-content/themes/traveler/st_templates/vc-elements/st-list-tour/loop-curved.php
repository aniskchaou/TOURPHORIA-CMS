<div class=" st_top_location">

    <div class="row row-wrap">

<?php

$col = 12 / $st_col;

while(have_posts()){

    the_post();

?>

        <div class="col-md-<?php echo esc_attr($col) ?> col-sm-6 col-xs-12">

            <div class="thumb">

                <header class="thumb-header">

                    <?php

                    $page_search = st_get_page_search_result($st_type);

                    if(!empty($page_search)){

                        $link = add_query_arg(array('location_id'=>get_the_ID()),get_the_permalink($page_search));

                    }else{

                        $link = add_query_arg(array(
                            's'=>'',
                            'post_type'=>$st_type,
                            'location_id'=>get_the_ID(),
                        ),home_url('/'));
                    }

                    ?>

                    <a href="<?php echo esc_url($link) ?>" class="hover-img curved">

                        <?php

                        $img = get_the_post_thumbnail( get_the_ID() , array(400,300,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ;

                        if(!empty($img)){

                            echo balanceTags($img);

                        }else{

                            echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(ST_TRAVELER_URI.'/img/no-image.png',array('width'=>800,'height'=>600)) .'">';

                        }

                        ?>

                        <i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>

                    </a>

                </header>

                <?php

                $img = get_post_meta(get_the_ID(),'logo',true);

                if($st_show_logo == 'yes' && !empty($img)){

                    ?>

                    <div class="img-<?php echo esc_attr($st_logo_position) ?>">

                        <img title="logo" alt="logo" src="<?php echo balanceTags($img) ?>">

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