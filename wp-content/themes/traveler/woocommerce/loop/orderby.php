<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */
wp_enqueue_script('chosen.jquery');
wp_enqueue_style('chosen-css');

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<form class="woocommerce-ordering form-horizontal" method="get" about="<?php echo esc_url(remove_query_arg('paged')) ?>">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group row">
                <label class="control-label col-sm-4"><?php _e('SORT BY',ST_TEXTDOMAIN) ?>
                    </label>
                <div class="controls col-sm-8">
                    <select name="orderby" class="orderby chosen_select form-control">
                        <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                            <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class=" form-group row">
                <label class="control-label col-sm-3"><?php _e('SHOW',ST_TEXTDOMAIN) ?>
                </label>
                <div class="controls col-sm-9">
                    <select name="posts_per_page" class="chosen_select posts_per_page form-control">
                        <?php for ( $i=1;$i<7;$i++) : ?>
                            <option value="<?php echo esc_attr( 9*$i ); ?>" <?php selected( get_query_var('posts_per_page'), 9*$i ); ?>><?php echo esc_html( 9*$i ); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-4 clearfix" >
            <div class="form-group row pull-right view_as_box">
                <?php  $view_style=apply_filters('st_shop_product_style',false); ?>
                <label class="pull-left control-label"><?php _e('VIEW AS',ST_TEXTDOMAIN) ?>
                </label>
                <div class="pull-right ">
                    <div class="sort_icon fist"><a class="<?php echo (!$view_style or $view_style=='grid')?'active':false; ?>" href="<?php echo esc_url(add_query_arg(array('view_style'=>'grid'))) ?>"><i class="fa fa-th-large "></i></a></div>
                    <div class="sort_icon last"><a class="<?php echo ($view_style=='list')?'active':false; ?>" href="<?php echo esc_url(add_query_arg(array('view_style'=>'list'))) ?>"><i class="fa fa-list "></i></a></div>
                </div>
            </div>
        </div>
    </div>
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'orderby' === $key || 'submit' === $key || 'posts_per_page'===$key ) {
				continue;
			}
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	?>
</form>
