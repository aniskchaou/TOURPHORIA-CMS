<?php
if(has_post_thumbnail()){
$image = get_the_post_thumbnail_url(get_the_ID(),array(1024,512));
$class = Hotel_Alone_Helper::inst()->build_css('background: #bbb url("'.$image.'") ;
    background-position: center center;
    background-size: cover;
    height: 500px;
    width: 100%;');

    if(hotel_alone_is_ajax()){
        echo '<style type="text/css">'.Hotel_Alone_Helper()->inline_css.'</style>';
        Hotel_Alone_Helper()->reset_css();
    }
?>
    <div class="hide feature_image <?php  echo esc_attr($class) ?> "></div>
    <?php the_post_thumbnail('full') ?>
<?php }
?>