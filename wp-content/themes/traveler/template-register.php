<?php
/*
Template Name: Register Form
*/

/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Template Name : Register Form
 *
 * Created by ShineTheme
 *
 */
if(st()->get_option('enable_popup_login','off') == 'on'){
    wp_redirect( home_url( '/' ) );
    exit();
}

get_header();
?>
<div class="container-fluid">
    <div class="row">
        <div class="container">
            <h1 class="page-title text-center mt60"><?php printf(__("Register on %s",ST_TEXTDOMAIN),get_bloginfo('name')) ?></h1>
        </div>
        <div class="container">
            <div class="row" data-gutter="60">
                <div class="col-md-8 col-md-offset-2">
                    <?php echo st()->load_template('login/form-new','login') ?>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>
</div>
<?php  get_footer(); ?>
