<?php
if (get_the_ID() != 0) {
    $post_author_id = get_post_field('post_author', get_the_ID());
    $current_user_upage = get_user_by('ID', $post_author_id);
    $role = $current_user_upage->roles[0];
    $user_meta = get_user_meta($current_user_upage->ID);
    $user_meta = array_filter(array_map(function ($a) {
        return $a[0];
    }, $user_meta));

    $default = array(
        'title' => __("Partner's Info", ST_TEXTDOMAIN),
        'font_size' => '4',
        'avatar_type' => 'square',
        'display_info' => 'all',
        'format_column' => '1'
    );
    extract(wp_parse_args($atts, $default));
    if ($format_column == 1) {
        $number_column = 12;
    } else {
        $number_column = 6;
    }
    $list_info = explode(',', $display_info);

    $partner_page = st()->get_option('partner_info_page', '');
    if ($partner_page != '') {
        $partner_link = get_permalink($partner_page);
        $partner_link = esc_url(add_query_arg(array('partner_id' => $post_author_id), $partner_link));
    } else {
        $partner_link = esc_url(get_author_posts_url(get_the_author_meta('ID')));
    }
    ?>
    <div class="partner-ipost-info">
        <h<?php echo esc_attr($font_size); ?>
                class="partner-ipost-title"><?php echo esc_attr($title); ?></h<?php echo esc_attr($font_size) ?>>
        <div class="partner-ipost-content">
            <div class="row">
                <div class="col-lg-<?php echo $number_column; ?>">
                    <div class="author-info-meta text-center <?php echo $avatar_type == 'square' ? 'avatar-square' : 'avatar-circle' ?>">
                        <a href="<?php echo $partner_link; ?>">
                            <?php
                            echo st_get_profile_avatar($current_user_upage->ID, 200);
                            ?>
                        </a>
                    </div>
                </div>
                <div class="col-lg-<?php echo $number_column; ?>">
                    <h4 class="text-center">
                        <strong><a href="<?php echo $partner_link; ?>"><?php echo esc_html($current_user_upage->display_name) ?></a></strong>
                    </h4>
                    <ul class="author-list-info">
                        <?php if (isset($user_meta['st_is_check_show_info']) && $user_meta['st_is_check_show_info'] == 'on') : ?>
                            <?php if((in_array('all', $list_info) || in_array('email', $list_info))){ ?>
                                <li>
                                    <i class="fa fa-envelope input-icon"></i> <?php echo '<strong>' . __('Email: ', ST_TEXTDOMAIN) . '</strong>' . $current_user_upage->user_email; ?>
                                </li>
                            <?php } ?>
                            <?php if (isset($user_meta['st_phone'])) { ?>
                                <?php if ($user_meta['st_phone'] != '' && (in_array('all', $list_info) || in_array('phone', $list_info))) { ?>
                                    <li><i class="fa fa-phone"
                                           aria-hidden="true"></i> <?php echo '<strong>' . __('Phone: ', ST_TEXTDOMAIN) . '</strong>' . $user_meta['st_phone']; ?>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                            <?php if (isset($user_meta['st_paypal_email'])) { ?>
                                <?php if ($user_meta['st_paypal_email'] != '' && (in_array('all', $list_info) || in_array('email_paypal', $list_info))) { ?>
                                    <li>
                                        <i class="fa fa-money input-icon"></i> <?php echo '<strong>' . __('Email Paypal: ', ST_TEXTDOMAIN) . '</strong>' . $user_meta['st_paypal_email']; ?>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        <?php endif; ?>
                        <?php if (isset($user_meta['st_airport'])): ?>
                            <?php if ($user_meta['st_airport'] != '' && (in_array('all', $list_info) || in_array('home_airport', $list_info))) { ?>
                                <li>
                                    <i class="fa fa-plane input-icon"></i> <?php echo '<strong>' . __('Home Airport: ', ST_TEXTDOMAIN) . '</strong>' . $user_meta['st_airport']; ?>
                                </li>
                            <?php } ?>
                        <?php endif; ?>
                        <?php if (isset($user_meta['st_address']) || isset($user_meta['st_city']) || isset($user_meta['st_country'])): ?>
                            <?php
                            if ((in_array('all', $list_info) || in_array('address', $list_info))) { ?>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <?php
                                    $address = '';
                                    echo '<strong>' . __('Address: ', ST_TEXTDOMAIN) . '</strong>';
                                    if (isset($user_meta['st_address'])) {
                                        $address .= $user_meta['st_address'];
                                    }
                                    if (isset($user_meta['st_city'])) {
                                        $address .= ', ' . $user_meta['st_city'];
                                    }
                                    if (isset($user_meta['st_country'])) {
                                        $address .= ', ' . $user_meta['st_country'];
                                    }
                                    echo $address;
                                    ?>
                                </li>
                            <?php } ?>
                        <?php endif; ?>
                    </ul>
                    <div class="author-verify-status">
                        <h4 class="verify-title"><?php esc_html_e('Verifications',ST_TEXTDOMAIN) ?></h4>
                        <ul>
                            <li><i class="left-icon fa fa-phone"></i> <span><?php esc_html_e('Phone number',ST_TEXTDOMAIN) ?></span> <i class="right-icon <?php echo st_check_user_verify('phone')?'fa fa-check':'fa fa-times' ?>"></i></li>
                            <li><i class="left-icon fa fa-user"></i> <span><?php esc_html_e('ID Card',ST_TEXTDOMAIN) ?></span> <i class="right-icon <?php echo st_check_user_verify('passport')?'fa fa-check':'fa fa-times' ?>"></i></li>
                            <li><i class="left-icon fa fa-book"></i> <span><?php esc_html_e('Travel Certificate',ST_TEXTDOMAIN) ?></span> <i class="right-icon <?php echo st_check_user_verify('travel_certificate')?'fa fa-check':'fa fa-times' ?>"></i></li>
                            <li><i class="left-icon fa fa-envelope"></i> <span><?php esc_html_e('Email',ST_TEXTDOMAIN) ?></span> <i class="right-icon <?php echo st_check_user_verify('email')?'fa fa-check':'fa fa-times' ?>"></i></li>
                            <li><i class="left-icon fa fa-share-alt"></i> <span><?php esc_html_e('Social media',ST_TEXTDOMAIN) ?></span> <i class="right-icon <?php echo st_check_user_verify('social')?'fa fa-check':'fa fa-times' ?>"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>