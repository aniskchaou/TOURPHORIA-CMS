<?php
/*
Template Name: Comming Soon
*/
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Template Name : Comming Soon
 *
 * Created by ShineTheme
 *
 */

?>
<?php
$cs_style= 'default';
    switch ($cs_style){
        case "st_tour_ver";
            ?>
            <?php get_header("center"); ?>
            <div class="cs-content">
                <h1 class="title"><strong><?php echo apply_filters('the_title',get_the_title())   ; ?></strong></h1>
                <h4 class="email"><i><?php echo sprintf(__('Please come back later or contact us, %s',ST_TEXTDOMAIN),"<a href='mailto:".st()->get_option('email_admin_address' , "example@email.com")."'><span class='main-color'>".st()->get_option('email_admin_address' , "example@email.com")."</span></a>"); ?></i></h4>
                <!-- count down -->
                <?php
                    $data_count_down =explode('-',get_post_meta(get_the_ID(),'data_countdown',true));
                    $datadiv = (get_bloginfo( 'language' ))== "en-US" ? "data-lang= eng" :"data-lang= rus";
                    if (!empty($data_count_down) and is_array($data_count_down)){
                        $datadiv.=' data-year= '.$data_count_down[0].'  ';
                        $datadiv.=' data-month= '.$data_count_down[1].'  ';
                        $datadiv.=' data-day= '.$data_count_down[2].'  ';
                    }
                ?>
                <div class= "st_tour_ver_countdown" <?php echo esc_attr($datadiv)?>></div>
                <!-- end count down  -->
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        <span class="sr-only"><?php _e('100% Complete',ST_TEXTDOMAIN) ?></span>
                    </div>
                </div>
            </div>
            <?php
            break;
        case "default":
            ?>
            <?php get_header("full"); ?>
            <div class="full-center">
                <div class="container">
                    <h2 class="text-center"><?php the_title(); ?></h2>
                    <div class="countdown countdown-lg" inline_comment="countdown" data-countdown="<?php echo get_post_meta(get_the_ID(),'data_countdown',true); ?>" id="countdown"></div>
                    <div class="gap"></div>
                    </div>
                </div>
            </div>
            <?php
            while(have_posts()){
                the_post();
                the_content();
            }
            ?>
            <?php
            break;
        default:
            ?>
            <?php get_header("full"); ?>
            <div class="full-center">
                <div class="container">
                    <h2 class="text-center"><?php the_title(); ?></h2>
                    <div class="countdown countdown-lg" inline_comment="countdown" data-countdown="<?php echo get_post_meta(get_the_ID(),'data_countdown',true); ?>" id="countdown"></div>
                    <div class="gap"></div>
                    </div>
                </div>
            </div>
            <?php
            while(have_posts()){
                the_post();
                the_content();
            }
            ?>
            <?php break;    
    }
?>
<?php  get_footer("full"); ?>
