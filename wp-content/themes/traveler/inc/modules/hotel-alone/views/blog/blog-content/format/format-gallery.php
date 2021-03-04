<!-- Gallery Slider -->
<?php
$st_gallery = get_post_meta(get_the_ID() , 'gallery' , true);
$st_gallery = explode(',',$st_gallery);
if(is_array($st_gallery) and count($st_gallery) > 1 ){
    ?>
    <div id="gallery" class="st-gallery-slider owl-carousel">
        <?php
        foreach($st_gallery as $key => $value){
            $image = wp_get_attachment_image_url( $value, array(1024,512) );
            $class = Hotel_Alone_Helper::inst()->build_css('background-image: url("'.$image.'")');
            ?>
            <div class="item <?php  echo esc_attr($class) ?>"></div>
            <?php
        }
        ?>
    </div>
    <?php
    if(hotel_alone_is_ajax()){
        echo '<style type="text/css">'.Hotel_Alone_Helper()->inline_css.'</style>';
        Hotel_Alone_Helper()->reset_css();
    }
}else{
    echo st_hotel_alone_load_view('blog/blog-content/format/format');
}
?>