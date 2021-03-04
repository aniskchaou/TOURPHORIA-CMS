<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 *Content custom none
 *
 * Created by ShineTheme
 *
 */
?>
<div class="col-xs-12">
<div class="alert alert-danger">
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
        <p><?php printf( st_get_language('ready_publish_post'), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
    <?php elseif ( is_search() ) : ?>
        <p><?php st_the_language('sorry_but_nothing_matched_your_search_please_try_again'); ?></p>
    <?php else : ?>
        <p><?php st_the_language('it_seems_we_can_not_find_what_your_looking_for') ?></p>
    <?php endif; ?>
</div>
</div>