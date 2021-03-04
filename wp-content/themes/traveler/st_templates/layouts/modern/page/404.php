<?php
get_header();
$option_404 = st()->get_option('404_text');
?>
    <div class="st-404-page">
        <div class="container">
            <?php
            if(!empty($option_404)){
                echo st()->get_option('404_text');
            }else{
                ?>
                    <h1><?php echo __('OOPS...', ST_TEXTDOMAIN); ?></h1>
                    <h3><?php echo __('Something went wrong here :(', ST_TEXTDOMAIN); ?></h3>
                    <img src="<?php echo get_template_directory_uri() . '/v2/images/404.jpg' ?>" alt="404 Page">
                    <p><?php echo __('Sorry, we couldn\'t find the page you\'re looking for.&nbsp;', ST_TEXTDOMAIN); ?></p>
                    <p><strong><?php echo __('Try returning to the', ST_TEXTDOMAIN); ?></strong> <a href="<?php echo site_url('/'); ?>"><?php echo __('Homepage', ST_TEXTDOMAIN); ?></a></p>
                <?php
            }
            ?>
        </div>
    </div>
<?php
get_footer();