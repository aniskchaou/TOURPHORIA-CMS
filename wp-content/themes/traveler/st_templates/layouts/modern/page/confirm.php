<?php
get_header();
$message=STTemplate::get_message();
?>
    <div class="gap"></div>
    <div class="container">
        <div class="row">
            <div class="st-confirm-order col-md-8 col-md-offset-2">
                <?php if($message['type']):?>
                    <i class="fa fa-check box-iconn-successnew mb30"></i>
                <?php else:?>
                    <i class="fa fa-close box-iconn-dangernew mb30"></i>
                <?php endif;?>
                <h2 class="text-center">
                    <?php echo esc_html($message['content']);
                    STTemplate::clear(); ?>
                </h2>
            </div>
        </div>
    </div>
<?php
get_footer();