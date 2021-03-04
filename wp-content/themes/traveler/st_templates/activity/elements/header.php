<?php
/**
 * Created by PhpStorm.
 * User: Dungdt
 * Date: 12/23/2015
 * Time: 4:21 PM
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

$show_partner_info = st()->get_option('activity_hide_partner_info', 'on');
?>
<h1 class="lh1em featured_single" itemprop="name"><?php the_title(); ?><?php echo STFeatured::get_featured(); ?></h1>
<?php if($address=get_post_meta(get_the_ID(),'address',true)){?>
	<p class="lh1em text-small" itemprop="address"><i class="fa fa-map-marker"></i> <?php echo esc_html($address); ?></p>
<?php }?>

<?php if($show_partner_info == 'on'){ ?>
<?php if($use_agent_info){?>
	<ul class="list list-inline text-small">
		<?php
		$email = get_the_author_meta('user_email',$user_id);
		if(!empty($email))
			echo '<li><a href="mailto:'.$email.'"><i class="fa fa-envelope"></i> '.st_get_language('activity_email').'</a> </li>';
		?>
		<?php
		$web = get_the_author_meta('user_url',$user_id);
		if(!empty($web))
			echo '<li><a href="'.esc_url($web).'"><i class="fa fa-home"></i> '.st_get_language('activity_website').'</a></li>';
		?>

		<?php if($phone=get_user_meta($user_id,'st_phone',true)):?>
			<li><a href="tel:<?php echo str_replace(' ','',trim($phone)); ?>"> <i class="fa fa-phone"></i> <?php echo esc_html( $phone);?></a>
			</li>
		<?php endif;?>

		<?php if($fax=get_user_meta($user_id,'st_fax',true)):?>
			<li><a href="tel:<?php echo str_replace(' ','',trim($fax)); ?>"> <i class="fa fa-fax"></i> <?php echo esc_html( $fax);?></a>
			</li>
		<?php endif;?>
	</ul>
<?php } else{ ?>
	<ul class="list list-inline text-small">
		<?php
		$email = get_post_meta(get_the_ID(),'contact_email',true);
		if(!empty($email))
			echo '<li><a href="mailto:'.$email.'"><i class="fa fa-envelope"></i> '.st_get_language('activity_email').'</a> </li>';
		?>
		<?php
		$web = get_post_meta(get_the_ID(),'contact_web',true);
		if(!empty($web))
			echo '<li><a href="'.esc_url($web).'"><i class="fa fa-home"></i> '.st_get_language('activity_website').'</a></li>';
		?>

		<?php if($phone=get_post_meta(get_the_ID(),'contact_phone',true)):?>
			<li><a href="tel:<?php echo str_replace(' ','',trim($phone)); ?>"> <i class="fa fa-phone"></i> <?php echo esc_html( $phone);?></a>
			</li>
		<?php endif;?>

		<?php if($fax=get_post_meta(get_the_ID(),'contact_fax',true)):?>
			<li><a href="tel:<?php echo str_replace(' ','',trim($fax)); ?>"> <i class="fa fa-fax"></i> <?php echo esc_html( $fax);?></a>
			</li>
		<?php endif;?>
	</ul>
<?php }?>
<?php } ?>
