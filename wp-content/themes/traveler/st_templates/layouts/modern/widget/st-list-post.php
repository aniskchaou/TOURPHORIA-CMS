<li>
    <div class="thumb">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail(array(100,100,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( get_the_ID() ))))?>
        </a>
    </div>

    <div class="content">
        <?php
        $category_detail=get_the_category(get_the_ID());
        if(!empty($category_detail)){
            ?>
            <div class="cate">
                    <?php
                    $v = $category_detail[0];
                    $color = get_term_meta($v->term_id, '_category_color', true);
                    if(empty($color)) {
                        $color = '5191FA';
                    }

                    echo '<a style="color: #'. $color .' !important" href="'. get_category_link( $v->term_id ) .'">'. $v->name .'</a>';
                    ?>
            </div>
            <?php
        }
        ?>
        <h5 class="thumb-list-item-title"><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h5>
    </div>
</li>