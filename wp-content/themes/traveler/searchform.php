<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * form search custom
 *
 * Created by ShineTheme
 *
 */
?>
<form role="search" method="get" class="search" action="<?php echo home_url( '/' ); ?>">
    <input type="text" class="form-control" value="<?php echo get_search_query() ?>"  name="s" placeholder="<?php esc_html_e('Search ...','traveler')?>">
    <input type="hidden" name="post_type" value="post">
    <?php
    if(New_Layout_Helper::isNewLayout()){
        echo '<button type="submit">'. TravelHelper::getNewIcon('search', '#ffffff', '15px', '15px') .'</button>';
    }
    ?>
</form>