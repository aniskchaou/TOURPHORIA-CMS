<header id="menu4" class="st_menu" >
    <div id='top_header' class="tour-version-nav <?php echo apply_filters('st_header_top_class','') ?>">
        <div class="container">
            <div class='row'>
                <?php
                $temp = TravelHelper::get_location_temp();
                $temp = $temp['temp'] ;
                if (!$temp){$class="12" ; } else {$class= "6" ; }
                ?>
                <div class='menu_div col-xs-12 col-lg-2'>
                    <a class="logo" href="<?php echo home_url('/')?>">
                        <?php
                        $logo_url = st()->get_option('logo',get_template_directory_uri().'/img/style3/logo3.png');
                        $logo = TravelHelper::get_attchment_size($logo_url , true);
                        ?>
                        <img src="<?php echo esc_url($logo_url); ?>" alt="logo" title="<?php bloginfo('name')?>">
                    </a>
                </div>

                <div class='col-xs-12 col-lg-10 menu-section'>
                    <div class="nav">
                        <?php if(has_nav_menu('primary')){
                            wp_nav_menu(
                                array(
                                    'theme_location'=>'primary',
                                    "container"=>"",
                                    'items_wrap'      => '<ul id="slimmenu" data-title="<a href=\''.home_url('/').'\'><img alt=\''.TravelHelper::get_alt_image().'\' width=auto height=40px class=st_logo_mobile src='.$logo_url.' /></a>" class="%2$s slimmenu">%3$s</ul>',
                                    'walker' => new st_menu_walker(),
                                )
                            );
                        } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

</header>