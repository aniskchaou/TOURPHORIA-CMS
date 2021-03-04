<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single loop link
 *
 * Created by ShineTheme
 *
 */
$link=get_post_meta(get_the_ID(),'link',true);
if(!empty($link)){
?>
    <a class="post-link" href="<?php echo esc_url($link) ?>"><?php echo esc_url($link) ?></a>
<?php } ?>
