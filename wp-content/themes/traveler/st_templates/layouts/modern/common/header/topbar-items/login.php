<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 13-11-2018
     * Time: 8:27 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
    if ( !is_user_logged_in() ) {
        ?>
        <div class="modal fade" id="st-forgot-form" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document" style="max-width: 450px;">
                <div class="modal-content">
                    <?php echo st()->load_template( 'layouts/modern/common/loader' ); ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <?php echo TravelHelper::getNewIcon('Ico_close') ?>
                        </button>
                        <h4 class="modal-title"><?php echo __( 'Reset Password', ST_TEXTDOMAIN ) ?></h4>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form" method="post">
                            <input type="hidden" name="st_theme_style" value="modern"/>
                            <input type="hidden" name="action" value="st_reset_password">
                            <p class="c-grey f14">
                                <?php echo __( 'Enter the e-mail address associated with the account.', ST_TEXTDOMAIN ) ?>
                                <br/>
                                <?php echo __( 'We\'ll e-mail a link to reset your password.', ST_TEXTDOMAIN ) ?>
                            </p>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email"
                                       placeholder="<?php echo esc_html__( 'Email', ST_TEXTDOMAIN ) ?>">
                                <?php echo TravelHelper::getNewIcon('ico_email_login_form'); ?>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="form-submit"
                                       value="<?php echo esc_html__( 'Send Reset Link', ST_TEXTDOMAIN ) ?>">
                            </div>
                            <div class="message-wrapper mt20"></div>
                            <div class="text-center mt20">
                                <a href="" class="st-link font-medium open-login"
                                   data-toggle="modal"><?php echo esc_html__( 'Back to Log In', ST_TEXTDOMAIN ) ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="st-login-form" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document" style="max-width: 450px;">
                <div class="modal-content relative">
                    <?php echo st()->load_template( 'layouts/modern/common/loader' ); ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <?php echo TravelHelper::getNewIcon('Ico_close') ?>
                        </button>
                        <h4 class="modal-title"><?php echo esc_html__( 'Log In', ST_TEXTDOMAIN ) ?></h4>
                    </div>
                    <div class="modal-body relative">
                        <form action="" class="form" method="post">
                            <input type="hidden" name="st_theme_style" value="modern"/>
                            <input type="hidden" name="action" value="st_login_popup">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" autocomplete="off"
                                       placeholder="<?php echo esc_html__( 'Email or Username', ST_TEXTDOMAIN ) ?>">
                                <?php echo TravelHelper::getNewIcon('ico_email_login_form', '' ,'18px', ''); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" autocomplete="off"
                                       placeholder="<?php echo esc_html__( 'Password', ST_TEXTDOMAIN ) ?>">
                                <?php echo TravelHelper::getNewIcon('ico_pass_login_form', '','16px', ''); ?>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="form-submit"
                                       value="<?php echo esc_html__( 'Log In', ST_TEXTDOMAIN ) ?>">
                            </div>
                            <div class="message-wrapper mt20"></div>
                            <div class="mt20 st-flex space-between st-icheck">
                                <div class="st-icheck-item">
                                    <label for="remember-me" class="c-grey">
                                        <input type="checkbox" name="remember" id="remember-me"
                                               value="1"> <?php echo esc_html__( 'Remember me', ST_TEXTDOMAIN ) ?>
                                        <span class="checkmark fcheckbox"></span>
                                    </label>
                                </div>
                                <a href="" class="st-link open-loss-password"
                                   data-toggle="modal"><?php echo esc_html__( 'Forgot Password?', ST_TEXTDOMAIN ) ?></a>
                            </div>
                            <div class="advanced">
                                <p class="text-center f14 c-grey"><?php echo esc_html__( 'or continue with', ST_TEXTDOMAIN ) ?></p>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4">
                                        <?php if ( st_social_channel_status( 'facebook' ) ): ?>
                                            <a onclick="return false" href="#"
                                               class="btn_login_fb_link st_login_social_link" data-channel="facebook">
                                                <?php echo TravelHelper::getNewIcon('fb', '', '100%') ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <?php if ( st_social_channel_status( 'google' ) ): ?>
                                            <a onclick="return false" href="#"
                                               class="btn_login_gg_link st_login_social_link" data-channel="google">
                                                <?php echo TravelHelper::getNewIcon('g+', '', '100%') ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <?php if ( st_social_channel_status( 'twitter' ) ): ?>
                                            <a href="<?php echo site_url() ?>/social-login/twitter"
                                               onclick="return false"
                                               class="btn_login_tw_link st_login_social_link" data-channel="twitter">
                                                <?php echo TravelHelper::getNewIcon('tt', '', '100%') ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mt20 c-grey font-medium f14 text-center">
                                <?php echo esc_html__( 'Do not have an account? ', ST_TEXTDOMAIN ) ?>
                                <a href=""
                                   class="st-link open-signup"
                                   data-toggle="modal"><?php echo esc_html__( 'Sign Up', ST_TEXTDOMAIN ) ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <li class="topbar-item login-item">
            <a href="" class="login" data-toggle="modal"
               data-target="#st-login-form"><?php echo esc_html__( 'Login', ST_TEXTDOMAIN ) ?></a>
        </li>
        <div class="modal fade" id="st-register-form" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document" style="max-width: 520px;">
                <div class="modal-content relative">
                    <?php echo st()->load_template( 'layouts/modern/common/loader' ); ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <?php echo TravelHelper::getNewIcon('Ico_close') ?>
                        </button>
                        <h4 class="modal-title"><?php echo esc_html__( 'Sign Up', ST_TEXTDOMAIN ) ?></h4>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form" method="post">
                            <input type="hidden" name="st_theme_style" value="modern"/>
                            <input type="hidden" name="action" value="st_registration_popup">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" autocomplete="off"
                                       placeholder="<?php echo esc_html__( 'Username *', ST_TEXTDOMAIN ) ?>">
                                <?php echo TravelHelper::getNewIcon('ico_username_form_signup', '', '20px', ''); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="fullname" autocomplete="off"
                                       placeholder="<?php echo esc_html__( 'Full Name', ST_TEXTDOMAIN ) ?>">
                                <?php echo TravelHelper::getNewIcon('ico_fullname_signup', '', '20px', ''); ?>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" autocomplete="off"
                                       placeholder="<?php echo esc_html__( 'Email *', ST_TEXTDOMAIN ) ?>">
                                <?php echo TravelHelper::getNewIcon('ico_email_login_form', '', '18px', ''); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" autocomplete="off"
                                       placeholder="<?php echo esc_html__( 'Password *', ST_TEXTDOMAIN ) ?>">
                                <?php echo TravelHelper::getNewIcon('ico_pass_login_form', '', '16px', ''); ?>
                            </div>
                            <div class="form-group">
                                <p class="f14 c-grey"><?php echo esc_html__( 'Select User Type', ST_TEXTDOMAIN ) ?></p>
                                <label class="block" for="normal-user">
                                    <input checked id="normal-user" type="radio" class="mr5" name="register_as"
                                           value="normal"> <span class="c-main" data-toggle="tooltip" data-placement="right" title="<?php echo esc_html__('Used for booking services', ST_TEXTDOMAIN) ?>"><?php echo esc_html__( 'Normal User', ST_TEXTDOMAIN ) ?></span>
                                </label>
                                <label class="block" for="partner-user">
                                    <input id="partner-user" type="radio" class="mr5" name="register_as"
                                           value="partner">
                                    <span class="c-main" data-toggle="tooltip" data-placement="right" title="<?php echo esc_html__( 'Used for upload and booking services', ST_TEXTDOMAIN ) ?>"><?php echo esc_html__( 'Partner User', ST_TEXTDOMAIN ) ?></span>
                                </label>
                            </div>
                            <div class="form-group st-icheck-item">
                                <label for="term">
                                    <?php
                                        $term_id = get_option( 'wp_page_for_privacy_policy' );
                                    ?>
                                    <input id="term" type="checkbox" name="term"
                                           class="mr5"> <?php echo wp_kses( sprintf( __( 'I have read and accept the <a class="st-link" href="%s">Terms and Privacy Policy</a>', ST_TEXTDOMAIN ), get_the_permalink( $term_id ) ), [ 'a' => [ 'href' => [], 'class' => [] ] ] ); ?>
                                    <span class="checkmark fcheckbox"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="form-submit"
                                       value="<?php echo esc_html__( 'Sign Up', ST_TEXTDOMAIN ) ?>">
                            </div>
                            <div class="message-wrapper mt20"></div>
                            <div class="advanced">
                                <p class="text-center f14 c-grey"><?php echo esc_html__( 'or continue with', ST_TEXTDOMAIN ) ?></p>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4">
                                        <?php if ( st_social_channel_status( 'facebook' ) ): ?>
                                            <a onclick="return false" href="#"
                                               class="btn_login_fb_link st_login_social_link" data-channel="facebook">
                                                <?php echo TravelHelper::getNewIcon('fb', '', '100%') ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <?php if ( st_social_channel_status( 'google' ) ): ?>
                                            <a onclick="return false" href="#"
                                               class="btn_login_gg_link st_login_social_link" data-channel="google">
                                                <?php echo TravelHelper::getNewIcon('g+', '', '100%') ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <?php if ( st_social_channel_status( 'twitter' ) ): ?>
                                            <a href="<?php echo site_url() ?>/social-login/twitter"
                                               onclick="return false"
                                               class="btn_login_tw_link st_login_social_link" data-channel="twitter">
                                                <?php echo TravelHelper::getNewIcon('tt', '', '100%') ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mt20 c-grey f14 text-center">
                                <?php echo esc_html__( 'Already have an account? ', ST_TEXTDOMAIN ) ?>
                                <a href="" class="st-link open-login"
                                   data-toggle="modal"><?php echo esc_html__( 'Log In', ST_TEXTDOMAIN ) ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <li class="topbar-item signup-item">
            <a href="" class="signup" data-toggle="modal"
               data-target="#st-register-form"><?php echo esc_html__( 'Sign Up', ST_TEXTDOMAIN ) ?></a>
        </li>
        <script>
            jQuery(document).ready(function ($) {
                if (typeof window.gapi != 'undefined') {
                    initGoogleClient();
                }

                function initGoogleClient() {
                    var config = {
                        client_id: st_social_params.google_client_id,
                        scope    : 'profile email https://www.googleapis.com/auth/plus.login'
                    };

                    window.gapi.load('auth2', function () {
                        window.gapi.auth2.init(config);
                    })
                }

                function startLoginWithFacebook(btn) {
                    btn.addClass('loading');

                    FB.getLoginStatus(function (response) {
                        if (response.status === 'connected') {
                            sendLoginData({
                                'channel'     : 'facebook',
                                'access_token': response.authResponse.accessToken
                            });

                        } else {
                            FB.login(function (response) {
                                if (response.authResponse) {
                                    sendLoginData({
                                        'channel'     : 'facebook',
                                        'access_token': response.authResponse.accessToken
                                    });

                                } else {
                                    alert('User cancelled login or did not fully authorize.');
                                }
                            }, {
                                scope        : 'email',
                                return_scopes: true
                            });
                        }
                    });
                }

                function startLoginWithGoogle(btn) {
                    btn.addClass('loading');
                    if (typeof window.gapi.auth2 == 'undefined') return;

                    window.gapi.auth2.getAuthInstance().grantOfflineAccess({'redirect_uri': 'postmessage'}).then(function (response) {

                        sendLoginData({
                            'channel'          : 'google',
                            'authorizationCode': response.code
                        });
                    }, function (error) {
                        console.log(error);
                        alert('Google Server SIGN-IN ERROR');
                    })
                }

                function sendLoginData(data) {
                    data._s     = st_params._s;
                    data.action = 'traveler.socialLogin';

                    $.ajax({
                        data    : data,
                        type    : 'post',
                        dataType: 'json',
                        url     : st_params.ajax_url,
                        success : function (rs) {
                            handleSocialLoginResult(rs);
                        },
                        error   : function (e) {

                            alert('Can not login. Please try again later');
                        }
                    })
                }

                function handleSocialLoginResult(rs) {
                    if (rs.reload) window.location.reload();
                    if (rs.message) alert(rs.message);
                }

                $('.st_login_social_link').on('click', function () {
                    var channel = $(this).data('channel');

                    switch (channel) {
                        case "facebook":
                            startLoginWithFacebook($(this));
                            break;
                        case "google":
                            startLoginWithGoogle($(this));
                            break;
                    }
                })
            })
        </script>
        <?php
    } else {
        $userdata          = wp_get_current_user();
        $account_dashboard = st()->get_option( 'page_my_account_dashboard' );
        ?>
        <li class="dropdown dropdown-user-dashboard">
            <?php
                if(!empty($in_header)) {
                    echo st_get_profile_avatar($userdata->ID, 40);
                }
            ?>
            <a href="javascript: void(0);" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <?php echo __( 'Hi, ', ST_TEXTDOMAIN ) . TravelHelper::get_username( $userdata->ID ); ?>
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?php echo esc_url( get_the_permalink( $account_dashboard ) ) ?>"><?php echo __( 'Overviews', ST_TEXTDOMAIN ) ?></a>
                </li>
                <li>
                    <a href="<?php echo add_query_arg( 'sc', 'booking-history', get_the_permalink( $account_dashboard ) ) ?>"><?php echo __( 'Booking History', ST_TEXTDOMAIN ) ?></a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?php echo wp_logout_url() ?>"><?php echo __( 'Log out', ST_TEXTDOMAIN ) ?></a>
                </li>
            </ul>
        </li>
        <?php
    }

