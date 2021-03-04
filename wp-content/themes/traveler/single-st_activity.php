<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single activity
 *
 * Created by ShineTheme
 *
 */
    $new_layout = st()->get_option( 'st_theme_style', 'classic' );
    if ( $new_layout == 'modern' ) {
        get_header();
        $style = get_post_meta( get_the_ID(), 'st_custom_layout_new', true );
        if ( !$style ) {
            $style = st()->get_option('activity_layout_v2', 1);
        }
        echo st()->load_template( 'layouts/modern/activity/single/single', $style );
        get_footer();

        return;
    }

if(!class_exists('STActivity')) return;
global $st_post_content;
if ( have_posts() ) {
    while (have_posts()) {
        the_post();
        ob_start();
        the_content( );
        $st_post_content=@ob_get_clean();
    }
}
get_header();

$detail_layout=apply_filters('st_activity_detail_layout',st()->get_option('activity_layout'));
if(get_post_meta($detail_layout , 'is_breadcrumb' , true) !=='off'){
    get_template_part('breadcrumb');
}
$layout_class = get_post_meta($detail_layout , 'layout_size' , true);
if (!$layout_class) $layout_class = "container";
?>
<div itemscope itemtype="http://schema.org/TouristAttraction">
	<div class="<?php echo balanceTags($layout_class) ; ?>">
		<div class="booking-item-details no-border-top">
			<header class="booking-item-header">
				<div class="row">
					<div class="col-md-9">
						<?php echo st()->load_template('activity/elements/header') ?>

					</div>
					<div class="col-md-3 text-right price_activity">
						<p class="booking-item-header-price">
						<?php echo STActivity::get_price_html(get_the_ID(),false,'<br>'); ?>
						</p>
					</div>
				</div>
			</header>
			<?php
			if($detail_layout)
			{
				$content=STTemplate::get_vc_pagecontent($detail_layout);
				echo balanceTags( $content);
			}else{
				echo st()->load_template('activity/single','default');
			}
			?>
		</div>
	</div>
	<!--Review Rich Snippets-->
	<div itemprop="aggregateRating" class="hidden" itemscope itemtype="http://schema.org/AggregateRating">
		<div><?php _e('Book rating:',ST_TEXTDOMAIN)?>
			<?php printf(__('%s out of %s with %s ratings',ST_TEXTDOMAIN),
				'<span itemprop="ratingValue">'.(get_comments_number() > 0 ? (STReview::get_avg_rate() > 0 ? STReview::get_avg_rate() : 5) : 5).'</span>',
				'<span itemprop="bestRating">5</span>',
				'<span itemprop="ratingCount">'.(get_comments_number() > 0 ? get_comments_number() : 1).'</span>'
			); ?>
		</div>
	</div>
	<!--End Review Rich Snippets-->


</div>
	<span class="hidden st_single_activity"></span>

<?php get_footer( ) ?>