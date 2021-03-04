<div class="mailchimp">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                <div class="row">
                    <div class="col-xs-12  col-md-7 col-lg-6">
                        <div class="media ">
                            <div class="media-left pr30 hidden-xs">
                                <img class="media-object"
                                     src="<?php echo get_template_directory_uri() ?>/v2/images/svg/ico_email_subscribe.svg"
                                     alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading st-heading-section f24"><?php echo esc_html__( 'Get Updates & More', ST_TEXTDOMAIN ) ?></h4>
                                <p class="f16 c-grey"><?php echo esc_html__( 'Thoughtful thoughts to your inbox', ST_TEXTDOMAIN ) ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-5 col-lg-6">
                        <?php
                            $form = st()->get_option( 'mailchimp_shortcode' );
                            if ( $form ) {
                                echo do_shortcode( $form );
                            } else {
                                ?>
                                <form action="" class="subcribe-form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your Email">
                                        <input type="submit" name="submit" value="Subcribe">
                                    </div>
                                </form>
                                <?php
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    wp_reset_postdata();
    wp_reset_query();
    $footer_template = TravelHelper::st_get_template_footer( get_the_ID(), true );
    if ( $footer_template ) {
        $vc_content = STTemplate::get_vc_pagecontent( $footer_template );
        if ( $vc_content ) {
            echo '<footer id="main-footer" class="clearfix">';
            echo $vc_content;
            echo ' </footer>';
        }
    } else {
        ?>
        <footer id="main-footer" class="container-fluid">
            <div class="container text-center">
                <p><?php _e( 'Copy &copy; 2014 Shinetheme. All Rights Reserved', ST_TEXTDOMAIN ) ?></p>
            </div>

        </footer>
    <?php } ?>
<div class="container main-footer-sub">
    <div class="st-flex space-between">
        <div class="left mt20">
            <div class="f14"><?php echo sprintf( esc_html__( 'Copyright © %s by', ST_TEXTDOMAIN ), date( 'Y' ) ); ?> <a
                        href="<?php echo esc_url( home_url( '/' ) ) ?>"
                        class="st-link"><?php bloginfo( 'name' ) ?></a></div>
        </div>
        <div class="right mt20">
            <img src="<?php echo get_template_directory_uri() ?>/v2/images/svg/ico_paymethod.svg" alt=""
                 class="img-responsive">
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>