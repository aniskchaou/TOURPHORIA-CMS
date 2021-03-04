<?php
/*
Template Name: Blog
*/
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Template Name : Blog
 *
 * Created by ShineTheme
 *
 */
if(New_Layout_Helper::isNewLayout()){
    echo st()->load_template('layouts/modern/page/blog');
    return;
}
get_header();
$blog_style  = get_post_meta(get_the_ID(),'blog_style',true);
?>
    <div class="container-fluid"><?php
		while(have_posts()){
			the_post();
			the_content();
		}
		?>
    </div>
<?php
if ($blog_style =='st_grid' or !$blog_style){ ?>
    <div class="container">
        <h1 class="page-title"><?php the_title() ?></h1>
    </div>
<?php };
?>
    <div class="container">
        <div class="row <?php echo esc_attr($blog_style) ;?>">
			<?php
			$sidebar_pos=apply_filters('st_blog_sidebar','right');
			if($sidebar_pos=="left"){
				get_sidebar('blog');
			}

			?>
            <div class="<?php echo apply_filters('st_blog_sidebar','right')=='no'?'col-sm-12 col-xs-12':'col-sm-9 col-xs-12'; ?> ">
                <div class="row">
					<?php
					$query=array(
						'post_type' => 'post',
						'paged'=>get_query_var('paged')
					);
					query_posts($query);
					if(have_posts()):
						while(have_posts())
						{
							the_post();
							echo st()->load_template('blog/content-loop',$blog_style);
						}
						TravelHelper::paging();
					else:
						echo st()->load_template('blog/content','none');
					endif;
					wp_reset_query();
					?>
                </div>
            </div>
			<?php $sidebar_pos=apply_filters('st_blog_sidebar','right');
			if($sidebar_pos=="right"){
				get_sidebar('blog');
			}
			?>
        </div>
    </div>
<?php
get_footer();
?>