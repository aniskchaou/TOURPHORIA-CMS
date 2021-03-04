<?php extract($atts) ?>
<div class="st-share <?php echo esc_attr($extra_class) ?>">
    <span class="title">
        <?php echo esc_html($title) ?>
    </span>
    <ul class="list-social">
        <li><a class="wb-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>&amp;title=<?php echo urlencode(get_the_title())?>" target="_blank" title="<?php esc_html_e("Facebook",'heliospress') ?>"><i class="fa fa-facebook"></i></a></li>
        <li><a class="wb-twitter" href="http://twitter.com/share?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(get_the_title())?>" target="_blank" title="<?php esc_html_e("Twitter",'heliospress') ?>"><i class="fa fa-twitter fa-lg"></i></a></li>
        <li><a class="wb-google" href="https://plus.google.com/share?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(get_the_title())?>" target="_blank" title="<?php esc_html_e("Google+",'heliospress') ?>"><i class="fa fa-google-plus fa-lg"></i></a></li>
        <li><a class="wb-pinterest" href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" target="_blank" title="<?php esc_html_e("Pinterest",'heliospress') ?>"><i class="fa fa-pinterest fa-lg"></i></a></li>
    </ul>
</div>

