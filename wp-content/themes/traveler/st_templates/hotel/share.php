<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel share
 *
 * Created by ShineTheme
 *
 */
?>
<div class="share clear">
    <span><?php st_the_language('share')?><i class="fa fa-share fa-lg"></i></span>
    
        <ul class="clear">
        <li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>&amp;title=<?php the_title()?>" target="_blank" rel="noopener" original-title="Facebook"><i class="fa fa-facebook fa-lg"></i></a></li>
        <li><a class="twitter" href="https://twitter.com/share?url=<?php the_permalink() ?>&amp;title=<?php the_title()?>" target="_blank" rel="noopener" original-title="Twitter"><i class="fa fa-twitter fa-lg"></i></a></li>
        <li><a class="google" href="https://plus.google.com/share?url=<?php the_permalink() ?>&amp;title=<?php the_title()?>" target="_blank" rel="noopener" original-title="Google+"><i class="fa fa-google-plus fa-lg"></i></a></li>
        <li><a class="no-open pinterest" href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" target="_blank" rel="noopener" original-title="Pinterest"><i class="fa fa-pinterest fa-lg"></i></a></li>
        <li><a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title()?>" target="_blank" rel="noopener" original-title="LinkedIn"><i class="fa fa-linkedin fa-lg"></i></a></li>
        
    </ul>
</div>