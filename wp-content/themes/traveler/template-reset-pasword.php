<?php
/**
 * Template Name: Reset Password
 */
get_header("full");
?>
<div class="login full-center">
    <div class="container">
        <div class="row row-wrap" data-gutter="60">
            <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                <form action="" class="form-reset-password" method="post">
                    <?php 
                        while( have_posts() ): the_post();
                    ?>
                        <h3 class="text-center"><?php the_title(); ?></h3>
                        <div class="description"><?php the_content(); ?></div>
                        <div class="input-group">
                            <span class="input-group-addon bgr-main"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo STInput::request('email', ''); ?>">
                        </div>
                        <div class="form-group">
                            <?php wp_nonce_field( 'security', 'security_field' ); ?>
                            <input type="hidden" name="action" value="reset_password">
                            <input class="btn btn-primary form-control" type="submit" name="submit" value="<?php echo __('Reset', ST_TEXTDOMAIN); ?>">
                        </div>
                        <div class="form-group">
                            <?php echo STTemplate::message(); ?>
                        </div>
                        <div class="form-group">
                            <a href="<?php echo home_url( '/' ); ?>"><i class="fa fa-long-arrow-left mr5"></i><?php echo __('back to Homepage', ST_TEXTDOMAIN); ?></a>
                        </div>
                    <?php endwhile; ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php  get_footer('full'); ?>
