<?php extract(shortcode_atts(array(
    'st_images_team'    => '',
    'st_team_name'      => '',
    'st_team_work'      => '',
    'list_social'      => '',
  ), $attr));
$image_src = wp_get_attachment_image_src($st_images_team,'full');
$social = vc_param_group_parse_atts($list_social);
?>
<div class="st-item-team">
	<div class="st-img-team">
		<?php if(isset($image_src) && !empty($image_src)){?>
			<img src="<?php echo esc_url($image_src[0]);?>" alt="<?php echo esc_attr($st_team_name);?>">
		<?php }?>
	</div>
	<div class="st-content-team">
		<div class="team-left">
			<div class="name"><?php echo esc_attr($st_team_name);?></div>
			<div class="work"><?php echo esc_attr($st_team_work);?></div>
		</div>
		<div class="team-right">
			<div class="sosical">
				<ul>
					<?php foreach ($social as $kk => $vv){
                        $link_social = vc_build_link($vv['link']);
                        if(isset($link_social) && !empty($link_social)){
			                $link_social = $link_social['url'];
			            } else {
			                $link_social = "#";
			            }
                        ?>
                            <li><a href="<?php echo $link_social; ?>"><i class="<?php echo $vv['icon']; ?>"></i></a></li>
                        <?php
                    }?>
				</ul>
			</div>
		</div>
	</div>
</div>