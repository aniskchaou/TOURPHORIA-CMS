<div class="style-dark">
        <div class="helios-navbar-header">
            <div class="control-left">
                <div class="option-item">
                    <div class="option-mid">
                        <div class="dl-menuwrapper helios_dl_mobile_menu">
                            <div class="nav-icon-bar dl-trigger">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </div>
                            <?php
                            $menu = st()->get_option('st_hotel_alone_menu_location', 'no-menu');
                            if(isset($menu)){
                                if ($menu != 'no-menu' && is_nav_menu($menu)){
	                                $args = array(
		                                'menu' => $menu,
		                                'menu_class'      => 'dl-menu',
		                                'container'      => '',
		                                'walker'          => new Helios_Dl_Menu_Walker,
	                                );
	                                wp_nav_menu($args);
                                }
                            }
                           ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="control-center">
                <div class="option-item">
                    <div class="option-mid">
                        <a href="<?php echo esc_url(home_url('/')) ?>">
                            <?php
                            $logo = st()->get_option('logo_mobile');
                            if(empty($logo)){
                                $logo = st()->get_option('hotel_alone_logo');
                            }
                            if(!empty($logo)){
                                ?>
                                <img class="logo" src="<?php echo esc_url($logo) ?>" alt="<?php esc_html_e("logo",ST_TEXTDOMAIN) ?>" />
                            <?php }else{ ?>
                                <h1><?php esc_html_e('Traveler',ST_TEXTDOMAIN) ?></h1>
                            <?php } ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</div>