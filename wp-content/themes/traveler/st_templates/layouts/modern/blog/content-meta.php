<div class="meta">
    <ul>
        <li>
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
            <?php
            echo st_get_profile_avatar(  get_the_author_meta( 'ID' ), 30 );
            echo '<span>' . __('BY', ST_TEXTDOMAIN) . '</span>';
            ?>
            <?php the_author() ?>
            </a>
        </li>
        <li>
            <?php the_time(get_option('date_format').' '.get_option('time_format'))?>
        </li>
        <li>
           <a href="<?php echo get_comments_link()?>"><?php  comments_number( st_get_language('0_comment'), st_get_language('1_comment'), st_get_language('s_comment'))?></a>
        </li>
    </ul>
</div>