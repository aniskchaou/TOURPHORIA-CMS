<?php 
    $col_size  =12/ $st_blog_style ; 
?>
<div class="col-lg-<?php echo esc_attr($col_size) ; ?> col-md-6 col-xs-12">
    <div class="grid">
        <div class="row">
            <figure class="effect-layla">
                <?php 
                    if(has_post_thumbnail(get_the_ID())){
                        the_post_thumbnail(array(600,450) , array("class"=> "st_blog_style3"), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))));
                    }else {
                        echo st_get_default_image();
                    } 
                ?>   
                <figcaption>
                    <h2><?php the_title(); ?><span></span></h2>
                    <p><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </figcaption>
            </figure>
        </div>

    </div>
</div>