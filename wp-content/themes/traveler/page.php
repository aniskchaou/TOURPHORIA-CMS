<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Page.php
 *
 * Created by ShineTheme
 *
 */
if(New_Layout_Helper::isCheckWooPage()){
    echo st()->load_template('layouts/modern/page/page');
    return;
}
get_header();

wp_enqueue_script( 'bootstrap-datepicker.js' );
wp_enqueue_script( 'bootstrap-timepicker.js' );

    $sidebar_id=apply_filters('st_blog_sidebar_id','blog');
?>
    <div class="container">
        <h1 class="page-title"><?php the_title()?></h1>
        <div class="row mb20">
            <?php $sidebar_pos=apply_filters('st_blog_sidebar','right');
            if($sidebar_pos=="left"){
                get_sidebar('blog');
            }
            ?>
            <div class="<?php echo apply_filters('st_blog_sidebar','right')=='no'?'col-sm-12':'col-sm-9'; ?>">
                <?php while(have_posts()){
                    the_post();
                    ?>
                    <div <?php post_class()?>>
                        <div class="entry-content">
                            <?php
                            the_content();
                            ?>
                        </div>
                        <div>
                            <?php
                            if ( comments_open() || '0' != get_comments_number() ) :
                                comments_template();
                            endif; ?>
                        </div>
                        <div class="entry-meta">
                            <?php
                            wp_link_pages( );
                            edit_post_link(st_get_language('edit_this_page'), '<p>', '</p>');
                            ?>
                        </div>
                    </div>
                <?php
                }?>
            </div>
            <?php
            if($sidebar_pos=="right"){
                get_sidebar('blog');
            }
            ?>
        </div>
    </div>
<?php
get_footer();