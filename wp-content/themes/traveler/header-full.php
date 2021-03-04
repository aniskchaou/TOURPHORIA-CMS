<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Header custom full
 *
 * Created by ShineTheme
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="full">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <?php if(defined('ST_TRAVELER_VERSION')){?>  <meta name="traveler" content="<?php echo esc_attr(ST_TRAVELER_VERSION) ?>"/>  <?php };?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('full'); ?>>
    <?php do_action('before_body_content')?>
    <?php
    $class_bg_img = "";
    $class_bg_blur ="";
    if(has_post_thumbnail( get_the_ID() )){
        $img = $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
        $class_bg_img = Assets::build_css("
                                            background: url(".$img[0].")
                                         ");
    }else{
		$background= get_post_meta(get_the_ID(),'cs_bgr',true);
		$css=FALSE;
		if (!empty($background) and is_array($background)){
			foreach ($background as $key=>$val){
				if (!empty($val)){
					if ($key =='background-image'){
						$css.= $key.": url(".$val .");";
					}else {
						$css.= $key.": ".$val .";";
					}
				}
			}
			$class_bg_img = Assets::build_css($css);
		}
	}
    if(is_404()){
        $img = st()->get_option('404_bg');
        $class_bg_blur = Assets::build_css("
                                            background: url(".$img.")
                                         ");
    }
    ?>
<div class="global-wrap <?php echo apply_filters('st_container',true) ?>" style="height: 100%">
<div class="row st-full">
    <div class="full-page <?php if(is_page_template("template-commingsoon.php")) echo "text-center"; if(is_404()){echo "full_404";} ?> ">
        <div class="bg-holder full">
            <?php if(is_page_template("template-commingsoon.php")){?>
                <div class="bg-mask-darken"></div>
                <div class="bg-img <?php echo esc_attr($class_bg_img)?>"></div>
            <?php }else{ ?>
                <div class="bg-mask"></div>
                <div class="bg-img <?php echo esc_attr($class_bg_img)?>"></div>
                <div class="bg-blur <?php echo esc_attr($class_bg_blur)?>"></div>
            <?php } ?>
            <div class="bg-holder-content full text-white">
                <a class="logo-holder" href="<?php echo site_url()?>">
                    <img src="<?php echo st()->get_option('logo',get_template_directory_uri().'/img/logo-invert.png') ?>" alt="logo" title="<?php bloginfo('name')?>">
                </a>



