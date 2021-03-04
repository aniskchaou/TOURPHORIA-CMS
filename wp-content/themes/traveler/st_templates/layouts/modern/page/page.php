<?php
get_header();
?>
    <div id="st-content-wrapper" class="search-result-page">
        <?php st_breadcrumbs_new() ?>
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
