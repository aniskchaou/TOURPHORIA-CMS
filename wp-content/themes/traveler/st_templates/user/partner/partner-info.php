<?php
$partner_id = STInput::get('partner_id', '');
if(STUser_f::check_partner_in_element($partner_id)){
    $current_user_upage = get_user_by( 'ID', $partner_id );
    $role               = $current_user_upage->roles[0];
    $user_meta          = get_user_meta( $current_user_upage->ID );
    $user_meta          = array_filter( array_map( function ( $a ) {
        return $a[0];
    }, $user_meta ) );

    $list_info = st()->get_option('display_list_partner_info', '');
    if($list_info == 'all'){
        $list_info = array('all');
    }
    if(empty($list_info)){
        $list_info = array('all');
    }
?>
<div class="author-info-wrapper">
    <div class="row">
        <div class="col-lg-3">
            <div class="text-center">
                <?php  echo st_get_profile_avatar( $current_user_upage->ID, 200 );  ?>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <div class="author-info-meta">

                        <h4><strong><?php echo esc_html( $current_user_upage->display_name ) ?></strong></h4>
                        <?php
                        $admin_packages = STAdminPackages::get_inst();
                        $order          = $admin_packages->get_order_by_partner( $current_user_upage->ID );
                        $enable         = $admin_packages->enabled_membership();
                        if ( $enable ):
                            if ( $order ):
                                if($order->status == 'completed') {
                                    ?>
                                    <img src="<?php echo ST_TRAVELER_URI; ?>/img/membership.png"
                                         alt="<?php echo TravelHelper::get_alt_image(); ?>"
                                         class="heading-image img-responsive img-mbp" width="200px">
                                    <h3 class="uppercase color-main">
                                        <strong><?php echo esc_html($order->package_name); ?></strong></h3><br/>
                                    <?php
                                }
                            endif;
                        endif;
                        ?>
                        <p>
                            <?php echo st_get_language( 'user_member_since' ) . mysql2date( ' M Y', $current_user_upage->data->user_registered ); ?>
                            -
                            <?php
                            $author_obj = ST_Author::inst();
                            echo '( ' . $author_obj->st_get_time_membership( $current_user_upage->data->user_registered ) . ' )';
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="author-info-meta">
                        <ul class="author-list-info">
                            <?php if ( isset( $user_meta['st_is_check_show_info'] ) && $user_meta['st_is_check_show_info'] == 'on' ): ?>
                                <?php if ( (in_array('all', $list_info) || in_array('email', $list_info)) ) { ?>
                                    <li>
                                        <i class="fa fa-envelope input-icon"></i> <?php echo '<strong>' . __( 'Email: ', ST_TEXTDOMAIN ) . '</strong>' . $current_user_upage->user_email; ?>
                                    </li>
                                <?php } ?>
                                <?php if ( isset( $user_meta['st_phone'] ) ) { ?>
                                    <?php if ( $user_meta['st_phone'] != '' && (in_array('all', $list_info) || in_array('phone', $list_info)) ) { ?>
                                        <li><i class="fa fa-phone"
                                               aria-hidden="true"></i> <?php echo '<strong>' . __( 'Phone: ', ST_TEXTDOMAIN ) . '</strong>' . $user_meta['st_phone']; ?>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ( isset( $user_meta['st_paypal_email'] ) ) { ?>
                                    <?php if ( $user_meta['st_paypal_email'] != '' && (in_array('all', $list_info) || in_array('email_paypal', $list_info)) ) { ?>
                                        <li>
                                            <i class="fa fa-money input-icon"></i> <?php echo '<strong>' . __( 'Email Paypal: ', ST_TEXTDOMAIN ) . '</strong>' . $user_meta['st_paypal_email']; ?>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            <?php endif; ?>
                            <?php if ( isset( $user_meta['st_airport'] ) ): ?>
                                <?php if ( $user_meta['st_airport'] != '' && (in_array('all', $list_info) || in_array('home_airport', $list_info)) ) { ?>
                                    <li>
                                        <i class="fa fa-plane input-icon"></i> <?php echo '<strong>' . __( 'Home Airport: ', ST_TEXTDOMAIN ) . '</strong>' . $user_meta['st_airport']; ?>
                                    </li>
                                <?php } ?>
                            <?php endif; ?>
                            <?php if ( isset( $user_meta['st_address'] ) || isset( $user_meta['st_city'] ) || isset( $user_meta['st_country'] ) ): ?>
                                <?php if ((in_array('all', $list_info) || in_array('address', $list_info))) { ?>
                                    <li><i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <?php
                                        $address = '';
                                        echo '<strong>' . __( 'Address: ', ST_TEXTDOMAIN ) . '</strong>';
                                        if ( isset( $user_meta['st_address'] ) ) {
                                            $address .= $user_meta['st_address'];
                                        }
                                        if ( isset( $user_meta['st_city'] ) ) {
                                            $address .= ', ' . $user_meta['st_city'];
                                        }
                                        if ( isset( $user_meta['st_country'] ) ) {
                                            $address .= ', ' . $user_meta['st_country'];
                                        }
                                        echo $address;
                                        ?>
                                    </li>
                                <?php } ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
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
    <div class="author-bio">
        <?php
        if (isset($user_meta['st_bio'])) {
            if ($user_meta['st_bio'] != '' && (in_array('all', $list_info) || in_array('bio', $list_info))) {
                echo '<strong>' . __("Author's description", ST_TEXTDOMAIN) . '</strong>';
                echo nl2br($user_meta['st_bio']);
            }
        }
        ?>
    </div>
</div>
<?php } ?>