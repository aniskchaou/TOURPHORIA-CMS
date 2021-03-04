<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="blog-item">
        <div class="header-thumb">
             <?php
                if(has_post_thumbnail() and get_the_post_thumbnail()){
                    echo get_the_post_thumbnail(get_the_ID(), array(370, 370));
                }else{
                    echo st_get_default_image();
                }
            ?>
        </div>
        <div class="caption-post">
            <div class="category">
                <?php the_category(', '); ?>
            </div>
            <h3 class="title">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </h3>
            <div class="date">
                <span class="date-post"><?php echo get_the_date('d M Y');?></span>
            </div>
        </div>
    </div>
</div>