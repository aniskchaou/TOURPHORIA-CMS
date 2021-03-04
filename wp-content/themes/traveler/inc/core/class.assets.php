<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class Assets
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('Assets'))
{
    class Assets{

        static $inline_css;
        static $current_css_id;
        static $prefix_class="st_";

        static function  init()
        {
            self::$current_css_id=time();
            add_action('wp_footer',array(__CLASS__,'action_footer_css'));
        }

        static function build_css($string=false,$effect = false){
            self::$current_css_id++;
            self::$inline_css.="
                .".self::$prefix_class.self::$current_css_id.$effect."{
                    {$string}
                }
        ";
            return self::$prefix_class.self::$current_css_id;
        }

        static function add_css($string=false){
            self::$inline_css.=$string;

        }

        static function action_footer_css(){
            ?>
            <style>
                <?php echo self::$inline_css;?>
            </style>
        <?php
        }
    }

    Assets::init();
}
