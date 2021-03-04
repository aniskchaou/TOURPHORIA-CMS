<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/12/2019
 * Time: 2:23 PM
 */
get_header('hotel-activity');
$message=STTemplate::get_message();
?>
    <div class="st-single-hotel-modern-page">
        <div class="container">
            <div class="row">
                <div class="st-confirm-order col-md-8 col-md-offset-2 mt50">
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
    </div>
<?php
get_footer('hotel-activity');