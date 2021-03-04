<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User my tours
 *
 * Created by ShineTheme
 *
 */
?>
<div class="st-create clearfix">
    <h2  class="pull-left clearfix"><?php st_the_language('my_tours') ?></h2>
    <a class="btn btn-default pull-right" href="<?php echo esc_url( add_query_arg( 'sc' , 'create-tours' , get_permalink() ) ) ?>">
        <?php _e("Add New Tour",ST_TEXTDOMAIN) ?>
    </a>
</div>
<div class="msg">
    <?php echo STUser_f::get_msg(); ?>
</div>
<div class="style-list">
<?php
    $paged  = (get_query_var('paged' ) ? get_query_var('paged' ) : 1) ; 

    $author = $data->ID;
    $cls_package = STAdminPackages::get_inst();

    if($cls_package->get_user_role() == 'administrator'){
        $author = '';
    }
    $args = array(
        'post_type' => 'st_tours',
        'post_status'=>'publish , draft , trash',
        'author'=>$author,
        'posts_per_page'=>10,
        'paged'=>$paged
    );
    $query=new WP_Query($args);
    if ( $query->have_posts() ) {
        while ($query->have_posts()) {
            $query->the_post();
            echo st()->load_template('user/loop/loop', 'tour' ,get_object_vars($data));
        }
    }else{
        echo '<h5>'.st_get_language('no_tours').'</h5>';
    };
    wp_reset_postdata();
?>
</div>
<div class="st-footer-wrap">
    <div class="pull-left">
        <?php st_paging_nav(null,$query) ?>
    </div>
    <div class="pull-right">
        <a class="btn btn-default pull-right" href="<?php echo esc_url( add_query_arg( 'sc' , 'create-tours' , get_permalink() ) ) ?>">
            <?php _e("Add New Tour",ST_TEXTDOMAIN) ?>
        </a>
    </div>
</div>
<?php  wp_reset_query(); ?>






























