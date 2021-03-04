<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * sidebar blog
 *
 * Created by ShineTheme
 *
 */
?>
<div class="col-sm-3 col-xs-12">
    <?php $sidebar_pos=apply_filters('st_blog_sidebar','right');
        if($sidebar_pos=="left"){
            echo "<aside class='sidebar-left'>";
        }elseif($sidebar_pos=="right"){
            echo "<aside class='sidebar-right'>";
        }
    ?>
    <?php dynamic_sidebar(apply_filters('st_blog_sidebar_id','blog-sidebar')); ?>
    </aside>
</div>