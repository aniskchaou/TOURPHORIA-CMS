<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Rental header
 *
 * Created by ShineTheme
 *
 */
$theme_option=st()->get_option('partner_show_contact_info');
$metabox=get_post_meta(get_the_ID(),'show_agent_contact_info',true);

$use_agent_info=FALSE;

if($theme_option=='on') $use_agent_info=true;
if($metabox=='user_agent_info') $use_agent_info=true;
if($metabox=='user_item_info') $use_agent_info=FALSE;

global $post;
$user_id = false;
if(!empty($post->post_author)){
    $user_id=$post->post_author;
}
extract(wp_parse_args( $arg, array('is_location'=> '1', 'is_contact'=>"1")));
?>
<header class="">
    <h1 class="lh1em featured_single" itemprop="name"><?php the_title()?><?php echo STFeatured::get_featured(); ?></h1>
	<?php if (!empty($is_location) and $is_location ==1){ ?>
    <?php if($address=get_post_meta(get_the_ID(),'address',true)){?>
    <p class="lh1em text-small"><i class="fa fa-map-marker"></i> <?php echo esc_html($address)  ?></p>
    <?php } }?>

	<?php if (!empty($is_contact) and $is_contact ==1){ ?>
	<?php if($use_agent_info){?>
    <ul class="list list-inline text-small">

        <?php if($email=get_the_author_meta('user_email',$user_id)):?>
            <li><a href="mailto:<?php echo esc_attr($email)?>"><i class="fa fa-envelope"></i> <?php st_the_language('rental_agent_mail')?></a>
            </li>
        <?php endif;?>

        <?php if($website=get_the_author_meta('user_url',$user_id)):?>
            <li><a target="_blank" href="<?php echo esc_url( $website )?>"> <i class="fa fa-home"></i> <?php st_the_language('rental_agent_website')?></a>
            </li>
        <?php endif;?>

		<?php if($phone=get_user_meta($user_id,'st_phone',true)):?>
            <li><a href="tel:<?php echo str_replace(' ','',trim($phone)) ?>"> <i class="fa fa-phone"></i> <?php echo esc_html( $phone)?></a>
            </li>
        <?php endif;?>

		<?php if($fax=get_user_meta($user_id,'st_fax',true)):?>
			<li><a href="tel:<?php echo str_replace(' ','',trim($fax)); ?>"> <i class="fa fa-fax"></i> <?php echo esc_html( $fax);?></a>
			</li>
		<?php endif;?>


    </ul>

	<?php }else{ ?>
		<ul class="list list-inline text-small">

			<?php if($email=get_post_meta(get_the_ID(),'agent_email',true)):?>
				<li><a href="mailto:<?php echo esc_attr($email)?>"><i class="fa fa-envelope"></i> <?php st_the_language('rental_agent_mail')?></a>
				</li>
			<?php endif;?>

			<?php if($website=get_post_meta(get_the_ID(),'agent_website',true)):?>
				<li><a target="_blank" href="<?php echo esc_url( $website )?>"> <i class="fa fa-home"></i> <?php st_the_language('rental_agent_website')?></a>
				</li>
			<?php endif;?>

			<?php if($phone=get_post_meta(get_the_ID(),'agent_phone',true)):?>
				<li><a href="tel:<?php echo str_replace(' ','',trim($phone)) ?>"> <i class="fa fa-phone"></i> <?php echo esc_html( $phone)?></a>
				</li>
			<?php endif;?>

			<?php if($fax=get_post_meta(get_the_ID(),'st_fax',true)):?>
				<li><a href="tel:<?php echo str_replace(' ','',trim($fax)); ?>"> <i class="fa fa-fax"></i> <?php echo esc_html( $fax);?></a>
				</li>
			<?php endif;?>


		</ul>
	<?php }?>
    <?php } ?>
</header>