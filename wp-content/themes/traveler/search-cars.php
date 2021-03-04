<?php

    /**
     * @package WordPress
     * @subpackage Traveler
     * @since 1.0
     *
     * Search custom cars
     *
     * Created by ShineTheme
     *
     */
    if(!st_check_service_available('st_cars'))
    {
        wp_redirect(home_url());
        die;
    }
    global $wp_query,$st_search_query;
    st()->car->alter_search_query();
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    query_posts(
        array(
            'post_type'=>'st_cars',
            's'=>get_query_var('s'),
            'paged'     => $paged
        )
    );
    $st_search_query=$wp_query;

    st()->car->remove_alter_search_query();
    global $wp_query; 
    $current_page = get_query_var('paged' );
    $total_posts =  $wp_query->found_posts;
    if( $total_posts == 0 && $current_page >= 2){
        global $wp_rewrite;
        $link = add_query_arg();
        if ($wp_rewrite->using_permalinks()){
            $link = preg_replace("/page\/(\d)\//", "page/1/", $link);
        }else{
            $link = add_query_arg('paged', 1);
        }
        wp_redirect( $link );
    }
    
    get_header();
    echo st()->load_template('search-loading');
?>
<?php 
    $cars_search_layout=st()->get_option('cars_layout_layout');

    if(!empty($_REQUEST['layout_id'])){
        $cars_search_layout = $_REQUEST['layout_id'];
    }
    
    $layout_class = get_post_meta($cars_search_layout , 'layout_size' , true);
    if (!$layout_class) $layout_class = "container";
?>

    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog">
        <?php echo st()->load_template('cars/search-form');?>
    </div>
    <?php 
        if(get_post_meta($cars_search_layout , 'is_breadcrumb' , true) !=='off'){
            get_template_part('breadcrumb');
        }
    ?>
    <div class="<?php echo balanceTags($layout_class) ; ?>">
        <?php  
            if($cars_search_layout)
            {
                echo  STTemplate::get_vc_pagecontent($cars_search_layout);
            }else{
                echo st()->load_template('cars/search-default');
            }
        ?>
    </div>
<?php
    get_footer();
?>