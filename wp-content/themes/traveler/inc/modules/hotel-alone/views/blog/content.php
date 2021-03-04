<?php
$st_blog_list_style = st()->get_option('st_hotel_alone_blog_list_style','list');

if(!empty($custom = STInput::request('blog_style'))){
    $st_blog_list_style = $custom;
}
?>
<?php if (have_posts()):
    ?>

        <div class="helios-list-blog <?php echo esc_html($st_blog_list_style) ?>">
            <?php
            if($st_blog_list_style == 'grid'){
                echo '<div class="row">';
            }
            ?>
            <?php while (have_posts()) :the_post(); ?>

                <?php
                if($st_blog_list_style == 'grid') {
                    echo '<div class="col-md-4">';
                    echo st_hotel_alone_load_view('blog/item-style/grid-style-3');
                    echo '</div>';
                }else{
                    echo st_hotel_alone_load_view('blog/item-style/list-style-2');
                }?>

            <?php endwhile;
            if($st_blog_list_style == 'grid'){
                echo '</div>';
            }
            ?>
        </div>

    <?php hotel_alone_paging_nav(); ?>

<?php else : ?>

    <?php echo st_hotel_alone_load_view('blog/content','none') ?>

<?php endif; ?>