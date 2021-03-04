<?php
/*
Template Name: Partner Information
*/
get_header();
$partner_id = STInput::get('partner_id', '');
$old_page_content = '';
while (have_posts()) {
    the_post();
    $st_search_page_id = get_the_ID();
    $old_page_content = get_the_content();
}

get_template_part('breadcrumb');
?>
    <div class="container">
        <h1 class="author-page-title">
            <?php the_title(); ?>
        </h1>
    </div>

    <div class="container mb20">
        <?php
        if (!STUser_f::check_partner_by_id($partner_id)) {
            echo __('Partner is not exists.', ST_TEXTDOMAIN);
        } else {
            $user_role = STUser_f::check_role_user_by_id($partner_id);
            if(!in_array($user_role, array('partner', 'administrator'))){
                echo __('This is not a partner.', ST_TEXTDOMAIN);
            }else{
                echo apply_filters('the_content', $old_page_content);
            }
        }
        ?>
    </div>
<?php
wp_reset_query();
get_footer();
?>