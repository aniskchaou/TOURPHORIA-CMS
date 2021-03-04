<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Loop content blog
 *
 * Created by ShineTheme
 *
 */

?>
<div class="col-xs-12 col-sm-12">
    <div <?php  post_class('article post') ?> >
        <?php
            $col1 = $col2 = 6;
            switch (get_post_format(get_the_ID())){
                case "link":
                    $link=get_post_meta(get_the_ID(),'link',true);
                    if (empty($link)) {
                        $col1 = $col2 =12;
                    }
                    break ;
                case "quote":
                    if (empty(get_the_excerpt())){
                        $col1 = $col2 =12;
                    }
                    break;
                case "audio":
                    if (empty($media_url=get_post_meta(get_the_ID(),'media',true))) {
                        $col1 = $col2 =12;
                    }
                    break;
                case "video":
                    if (empty($media_url=get_post_meta(get_the_ID(),'media',true))) {
                        $col1 = $col2 =12;
                    }
                    break;
                    break;
                case "gallery":
                    $images=get_post_meta(get_the_ID(),'gallery',true);
                    $images=apply_filters('post_gallery_images',$images);
                    if (empty($images)){
                        $col1 = $col2 =12;
                    }
                    break;
                default :
                    if (!has_post_thumbnail()) {
                        $col1 = $col2 =12;
                    }
                    break ;
            }
        ?>
        <div class="row">
            <div class="col-xs-12 col-sm-<?php echo esc_attr($col1); ?>">
                <?php if(get_post_format()):?>
                    <header class="post-header">
                        <?php echo st()->load_template('blog/single/loop_st_tour_grid/loop',get_post_format());?>
                    </header>
                <?php elseif(has_post_thumbnail() and get_the_post_thumbnail() ):?>
                    <header class="post-header">
                        <?php echo st()->load_template('blog/single/loop_st_tour_grid/loop-image');?>
                    </header>
                <?php endif;?>
            </div>
            <div class="col-xs-12 col-sm-<?php echo esc_attr($col2); ?>">
                <div class="post-inner">
                    <?php echo st()-> load_template('blog/single/content-meta','st_tour_grid');?>
                    <div class="post-desciption">
                <span>
                    <?php
                    if (strlen(get_the_excerpt())>apply_filters('st_tour_grid_blog_excerpt_max_length',100)) {
                        echo substr(get_the_excerpt(),0,apply_filters('st_tour_grid_blog_excerpt_max_length',100))." [...]";
                    }else {
                        the_excerpt();
                    }

                    ?>
                </span>
                    </div>
                    <a class="st_tour_ver_btn bgr-main-hover text-white text-uppercase" href="<?php the_permalink()?>"><strong><?php esc_html_e('Read More','traveler')?></strong></a>
                </div>
            </div>
        </div>

    </div>
</div>