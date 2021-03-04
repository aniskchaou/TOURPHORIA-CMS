<?php extract(shortcode_atts(array(
    'header_title'          => '',
    'layout_title'      => '',
    'style_layout'      => '',
  ), $attr));
if($layout_title === 'st_default'){
    $class_layout = 'st_default';
}else{
    $class_layout = 'text-center';
}
if($style_layout === 'st-style-2'){ ?>
    <div class="content-text padding-0 st-style-2">
        <div class="st-text-center">
            <div class="box__separator  hidden-thumb <?php echo $class_layout;?>"></div>
            <h2 class="<?php echo $class_layout;?>"><?php echo esc_attr($header_title);?></h2>
            <div class="<?php echo $class_layout;?>"><?php echo htmlspecialchars_decode($content);?></div>
        </div>
    </div>
<?php } elseif($style_layout === 'st-style-3'){ ?>
    <div class="content-text padding-0">
        <div class="st-text-center st-style-3">
            <h2 class="<?php echo $class_layout;?> <?php echo $style_layout?>"><?php echo esc_attr($header_title);?></h2>
            <div class="<?php echo $class_layout;?> style-3-content"><?php echo ($content);?></div>
        </div>
    </div>
<?php } elseif($style_layout === 'st-style-4'){ ?>
    <div class="content-text padding-0 style-4">
        <div class="st-text-center">
            <h2 class="<?php echo $class_layout;?> <?php echo $style_layout?>"><?php echo esc_attr($header_title);?></h2>
            <div class="box__separator  hidden-thumb st-default box__separator_style-4"></div>
            <div class="<?php echo $class_layout;?> style-4-content"><?php echo ($content);?></div>
        </div>
    </div>
<?php }elseif($style_layout === 'st-style-5'){ ?>
    <div class="content-text padding-0 st-style-5">
        <div class="st-text-center">
            <h2 class="<?php echo $class_layout;?> <?php echo $style_layout?>"><?php echo esc_attr($header_title);?></h2>
            <div class="process-bg">
                <img class="img-responsive" src="<?php echo get_template_directory_uri().'/v2/images/assets/quote.svg';?>" alt="image">
            </div>
            <div class="<?php echo $class_layout;?> style-5-content"><?php echo ($content);?></div>
        </div>
    </div>
<?php } else { ?>
    <div class="content-text padding-0 st-default">
        <div class="st-text-center">
            <h2 class="<?php echo $class_layout;?>  <?php echo $style_layout?> "><?php echo esc_attr($header_title);?></h2>
            <div class="box__separator  hidden-thumb "></div>
            <div class="<?php echo $class_layout;?>"><?php echo htmlspecialchars_decode($content);?></div>
        </div>
    </div>
<?php }