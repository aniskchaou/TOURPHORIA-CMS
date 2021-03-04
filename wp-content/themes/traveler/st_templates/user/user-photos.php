<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User my photos
 *
 * Created by ShineTheme
 *
 */
?>
<div class="st-create">
    <h2><?php STUser_f::get_title_account_setting() ?></h2>
</div>
<?php
if(!empty($_REQUEST['paged'])){
    $paged = $_REQUEST['paged'];
}else{
    $paged = 1;
}
$args = array(
    'post_type' => 'attachment',
    'post_mime_type' =>'image',
    'post_status' => 'inherit',
    'posts_per_page'=>18,
    'paged'=>$paged
);
query_posts($args);
?>
<div class="msg">
    <?php
    if(!empty(STUser_f::$msg)){
        echo '<div class="alert alert-'.STUser_f::$msg['status'].'">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">'.STUser_f::$msg['msg'].'</p>
                      </div>';
    }
    ?>
</div>
<form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
    <input type="file" name="my_image_upload" id="my_image_upload" class="hidden"  multiple="false" hidden="" />
    <input type="hidden" name="post_id" id="post_id" value="<?php the_ID() ?>" />
    <?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
    <input id="submit_my_image_upload" name="submit_my_image_upload" hidden="" type="submit" value="<?php st_the_language('user_upload') ?>" />
</form>
<a  id="btn_add_media" class="btn btn-primary mb20 cursor"><i class="fa fa-plus-circle"></i> Add new photo</a>
<div class="row row-no-gutter">
    <?php
    while(have_posts()){
        the_post();
        $img =  wp_get_attachment_image_src(get_the_ID(),'full');
        ?>
        <div class="col-md-4">
            <div class="thumb">
                <a class="hover-img" href="#">
                    <img src="<?php echo bfi_thumb(esc_url($img[0]),array('width'=>'800','height'=>'600')) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>" />
                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-inner-sm hover-hold">
                        <div class="text-small">
                            <p>
                                <?php the_title() ?>
                            </p>
                            <small class="text-white">
                                <?php
                                echo mysql2date('d M, Y', get_the_date() )
                                ?>
                            </small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
</div>
<div class="row row-no-gutter">
    <div class="col-md-12">
        <?php echo st_paging_nav() ?>
    </div>
</div>
<?php wp_reset_query(); ?>
