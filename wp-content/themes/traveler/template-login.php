<?php
/*
Template Name: Login Full
*/
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Template Name : Login Full
 *
 * Created by ShineTheme
 *
 */
if(st()->get_option('enable_popup_login','off') == 'on'){
    wp_redirect( home_url( '/' ) );
    exit();
}
get_header("full");
?>
<div class="login full-center">
    <div class="container">
        <div class="row row-wrap" data-gutter="60">
            <div class="col-md-4">
                <div class="visible-lg visible-md">
                    <h3 class="mb15"><?php the_title(); ?></h3>
                    <?php
                    while(have_posts()){
                        the_post();
                        the_content();
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <h3><?php esc_html_e('Login','traveler') ?></h3>
                <?php echo st()->load_template('login/form','login') ?>
            </div>
            <div class="col-md-4">
                <h3 class="pb30 mb0"><?php printf(__("New To %s ?",ST_TEXTDOMAIN),get_bloginfo('title')) ?></h3>
                <?php   $page_user_register = st()->get_option("page_user_register");?>
                <div class="mt5"><b><a class="btn-lg btn btn-primary" href="<?php echo get_permalink($page_user_register) ?>"><?php _e("Register New",ST_TEXTDOMAIN) ?></a></b></div>
                <div class="mt15"><?php do_action( 'wordpress_social_login' ); ?></div>
            </div>
        </div>
    </div>
</div>
<?php  get_footer('full'); ?>
