<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single location
 *
 * Created by ShineTheme
 *
 */
    get_header();
    $location_id = get_the_ID();
    get_template_part('breadcrumb');
    ?>
    <div class="single-location container" id="location-<?php echo get_the_ID() ; ?>">
        <header  class="booking-item-details">
            <h2><?php apply_filters('st_location_title' , the_title()) ;?></h2>
        </header>
        <div class="row" id="st_location_single">
            <?php
            $sidebar_pos = get_post_meta(get_the_ID() , 'post_sidebar_pos' , true);
            if ($sidebar_pos =='no' )$sidebar_pos ="";
            if($sidebar_pos=="left" and get_post_meta(get_the_ID(),'post_sidebar',true)){
                get_sidebar(get_post_meta(get_the_ID(),'post_sidebar',true));

            }
            ?>
            <div class="<?php echo (  (in_array($sidebar_pos, array("left" , "right"))) and get_post_meta(get_the_ID(),'post_sidebar',true) ) ?'col-sm-9 col-xs-12':'col-sm-12 col-xs-12'; ?>">
                <?php
                if ( 'on'== ($is_build = get_post_meta(get_the_ID() , 'st_location_use_build_layout' , true))) {
                    if (($is_gallery = get_post_meta(get_the_ID(), "is_gallery", true)) !="off")
                        echo st()->load_template('location/location_gallery' , NULL , array());
                    if (($is_tab = get_post_meta(get_the_ID(), "is_tabs" , true)) !="off")
                        echo st()->load_template('location/location_tab' , NUll , array()) ;
                }else {
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                }
                ?>
            </div>
            <?php
            if($sidebar_pos=="right" and get_post_meta(get_the_ID(),'post_sidebar',true)){
                get_sidebar(get_post_meta(get_the_ID(),'post_sidebar',true));
            }
            ?>
        </div>
    </div>
    <span class="hidden st_single_location"></span>
<?php
get_footer();