<div class="col-md-12">
    <div class="row">
        <div class="col-md-3">
            <header class="thumb-header">
                    <?php
                    $img = get_the_post_thumbnail( get_the_ID() , array(800,600,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ;
                    if(!empty($img)){
                        echo balanceTags($img);
                    }else{
                        echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.ST_TRAVELER_URI.'/img/no-image.png">';
                    }
                    ?>
            </header>
        </div>
        <div class="col-md-9">
            <div class="thumb text-left">
                <a href="<?php the_permalink() ?>">
                    <h5 class="text-color"><?php the_title() ?></h5>
                </a>
                <div class="thumb-caption">
                    <p class="thumb-desc"><?php echo st_get_the_excerpt_max_charlength(70) ?></p>
                    <p class="thumb-desc">
                        <?php the_time(get_option('date_format')) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>