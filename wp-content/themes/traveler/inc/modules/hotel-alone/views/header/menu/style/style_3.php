<div class="content-menu menu-style-3 hide_scroll">
    <div class="logo">
        <a href="<?php echo esc_url(home_url('/')) ?>">
            <?php
            if(!empty($logo_light)){
                ?>
                <img src="<?php echo esc_url($logo_light) ?>" alt="<?php esc_html_e("logo",ST_TEXTDOMAIN) ?>" />
            <?php }else{ ?>
                <h1><?php bloginfo('name') ?></h1>
            <?php } ?>
        </a>
    </div>
    <div class="menu-right">
        <?php
        $menu = st()->get_option('st_hotel_alone_menu_location', 'no-menu');
        if ( !empty($menu) ) {
            $args = array(
                'menu' => $menu,
                'menu_class'      => 'st_menu menu nav navbar-nav '.implode(" ",$class_color),
                'walker'          => new Helios_Menu_Walker,
            );
            wp_nav_menu($args);
        }?>
    </div>
</div>