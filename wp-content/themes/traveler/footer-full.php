<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Footer custom full
 *
 * Created by ShineTheme
 *
 */
    if(is_page_template("template-login.php")){
        if(has_nav_menu('login')){
            wp_nav_menu(array('theme_location'=>'login',
                "container"=>"",
                'items_wrap'      => '<ul class="%2$s footer-links">%3$s</ul>',
            ));
        }
    }
    if(is_page_template("template-commingsoon.php")){

        echo get_post_meta(get_the_ID(),'footer_social',true);

    }
    if(is_404()){
        if(has_nav_menu('login')){
            wp_nav_menu(array('theme_location'=>'login',
                "container"=>"",
                'items_wrap'      => '<ul class="%2$s footer-links">%3$s</ul>',
            ));
        }
    }
?>
          </div>
       </div>
    </div>
  </div>
</div>
<?php do_action('st_before_footer');?>
<?php wp_footer(); ?>
<?php do_action('st_after_footer');?>
</body>
</html>
