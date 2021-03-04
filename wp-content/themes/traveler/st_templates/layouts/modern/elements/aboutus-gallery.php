<?php
$gallery_array = array();
if(!empty($attr['images'])){
    $img_arr = explode(',', $attr['images']);
    if(!empty($img_arr)){
        foreach ($img_arr as $k => $v){
            array_push($gallery_array, wp_get_attachment_image_url($v, 'full'));
        }
    }
}
?>
<div class="st-aboutus-gallery">
    <?php if ( !empty( $gallery_array ) ) { ?>
        <div class="st-flickity st-gallery">
            <div class="carousel"
                 data-flickity='{ "wrapAround": true, "pageDots": true , "autoPlay" : true}'>
                <?php
                foreach ( $gallery_array as $value ) {
                    ?>
                    <div class="carousel-cell" style="background-image: url('<?php echo $value; ?>')"></div>
                    <?php
                }
                ?>
            </div>
            <div class="slogan">
                <h4><?php echo $attr['title']; ?></h4>
                <?php
                $link  = vc_build_link($attr['link']);
                if(!empty($link)){
                    ?>
                        <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="btn btn-primary"><?php echo $link['title']; ?></a>
                    <?php
                }
                ?>
            </div>
        </div>
    <?php } ?>
</div>
