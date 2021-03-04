<?php
    /*
    Template Name: Home Modern
    */

    get_header();
?>
    <div id="st-content-wrapper" class="search-result-page">
        <?php if(!is_front_page()){ ?>
            <?php echo st()->load_template('layouts/modern/hotel/elements/banner'); ?>
            <?php st_breadcrumbs_new() ?>
        <?php }?>
        <div class="container">
            <?php
                while ( have_posts() ) {
                    the_post();
                    the_content();
                }
            ?>
        </div>
    </div>
<?php
    get_footer();
