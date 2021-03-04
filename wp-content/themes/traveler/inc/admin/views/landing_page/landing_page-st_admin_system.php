<?php
$theme=wp_get_theme();
?>
<div class="traveler-system-status">

        <table class="widefat" cellspacing="0" >
            <thead>
            <tr>
                <th colspan="3" data-export-label="WordPress Environment"><?php _e( 'WordPress Environment', ST_TEXTDOMAIN ); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-export-label="Home URL"><?php _e( 'Home URL', ST_TEXTDOMAIN ); ?>:</td>
                <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The URL of your site\'s homepage.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
                <td><?php form_option( 'home' ); ?></td>
            </tr>
            <tr>
                <td data-export-label="Site URL"><?php _e( 'Site URL', ST_TEXTDOMAIN ); ?>:</td>
                <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The root URL of your site.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
                <td><?php form_option( 'siteurl' ); ?></td>
            </tr>
            <tr>
                <td data-export-label="Traveler Version"><?php _e( 'Traveler Version', ST_TEXTDOMAIN ); ?>:</td>
                <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of Traveler installed on your site.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
                <td><?php echo esc_html( ST_TRAVELER_VERSION ); ?></td>
            </tr>

            <tr>
                <td data-export-label="WP Version"><?php _e( 'WP Version', ST_TEXTDOMAIN ); ?>:</td>
                <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of WordPress installed on your site.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
                <td><?php bloginfo('version'); ?></td>
            </tr>
            <tr>
                <td data-export-label="WP Multisite"><?php _e( 'WP Multisite', ST_TEXTDOMAIN ); ?>:</td>
                <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Whether or not you have WordPress Multisite enabled.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
                <td><?php if ( is_multisite() ) echo '&#10004;'; else echo '&ndash;'; ?></td>
            </tr>
            <tr>
                <td data-export-label="WP Memory Limit"><?php _e( 'WP Memory Limit', ST_TEXTDOMAIN ); ?>:</td>
                <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum amount of memory (RAM) that your site can use at one time.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
                <td><?php
                    $memory = st_letter_to_number( WP_MEMORY_LIMIT );
                    if ( function_exists( 'memory_get_usage' ) ) {
                        $system_memory = TravelHelper::wc_let_to_num( @ini_get( 'memory_limit' ) );
                        $memory        = max( $memory, $system_memory );
                    }
                    if ( $memory < 128000000 ) {
                        echo '<mark class="error">' . sprintf( __( '%s - We recommend setting memory to at least 128MB. See: <a href="%s" target="_blank">Increasing memory allocated to PHP</a>', ST_TEXTDOMAIN ), size_format( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
                    } else {
                        echo '<mark class="yes">' . size_format( $memory ) . '</mark>';
                    }
                    ?></td>
            </tr>
            <tr>
                <td data-export-label="WP Debug Mode"><?php _e( 'WP Debug Mode', ST_TEXTDOMAIN ); ?>:</td>
                <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Displays whether or not WordPress is in Debug Mode.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
                <td><?php if ( defined('WP_DEBUG') && WP_DEBUG ) echo '<mark class="yes">&#10004;</mark>'; else echo '<mark class="no">&ndash;</mark>'; ?></td>
            </tr>
            <tr>
                <td data-export-label="Language"><?php _e( 'Language', ST_TEXTDOMAIN ); ?>:</td>
                <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The current language used by WordPress. Default = English', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
                <td><?php echo get_locale() ?></td>
            </tr>
            </tbody>
        </table>

        <table class="widefat" cellspacing="0">
        <thead>
        <tr>
            <th colspan="3" data-export-label="Server Environment"><?php _e( 'Server Environment', ST_TEXTDOMAIN ); ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td data-export-label="Server Info"><?php _e( 'Server Info', ST_TEXTDOMAIN ); ?>:</td>
            <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Information about the web server that is currently hosting your site.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
            <td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
        </tr>
        <tr>
            <td data-export-label="PHP Version"><?php _e( 'PHP Version', ST_TEXTDOMAIN ); ?>:</td>
            <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of PHP installed on your hosting server.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
            <td><?php
                if ( function_exists( 'phpversion' ) ) {
                    $php_version = phpversion();

                    if ( version_compare( $php_version, '5.3', '<' ) ) {
                        echo '<mark class="error">' . sprintf( __( '%s - We recommend a minimum PHP version of 5.6. See: <a href="%s" target="_blank">How to update your PHP version</a>', ST_TEXTDOMAIN ), esc_html( $php_version ), 'http://docs.woothemes.com/document/how-to-update-your-php-version/' ) . '</mark>';
                    } else {
                        echo '<mark class="yes">' . esc_html( $php_version ) . '</mark>';
                    }
                } else {
                    _e( "Couldn't determine PHP version because phpversion() doesn't exist.", ST_TEXTDOMAIN );
                }
                ?></td>
        </tr>
        <?php if ( function_exists( 'ini_get' ) ) : ?>
            <tr>
                <td data-export-label="PHP Post Max Size"><?php _e( 'PHP Post Max Size', ST_TEXTDOMAIN ); ?>:</td>
                <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The largest filesize that can be contained in one post.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
                <td><?php echo size_format( st_letter_to_number( ini_get('post_max_size') ) ); ?></td>
            </tr>
            <tr>
                <td data-export-label="PHP Time Limit"><?php _e( 'PHP Time Limit', ST_TEXTDOMAIN ); ?>:</td>
                <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
                <td><?php echo ini_get('max_execution_time'); ?></td>
            </tr>
            <tr>
                <td data-export-label="PHP Max Input Vars"><?php _e( 'PHP Max Input Vars', ST_TEXTDOMAIN ); ?>:</td>
                <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
                <td><?php echo ini_get('max_input_vars'); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td data-export-label="MySQL Version"><?php _e( 'MySQL Version', ST_TEXTDOMAIN ); ?>:</td>
            <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The version of MySQL installed on your hosting server.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
            <td>
                <?php
                global $wpdb;
                echo $wpdb->db_version();
                ?>
            </td>
        </tr>
        <tr>
            <td data-export-label="Max Upload Size"><?php _e( 'Max Upload Size', ST_TEXTDOMAIN ); ?>:</td>
            <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The largest filesize that can be uploaded to your WordPress installation.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
            <td><?php echo size_format( wp_max_upload_size() ); ?></td>
        </tr>
        <tr>
            <td data-export-label="Default Timezone is UTC"><?php _e( 'Default Timezone is UTC', ST_TEXTDOMAIN ); ?>:</td>
            <td class="help"><?php echo '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'The default timezone for your server.', ST_TEXTDOMAIN ) . '">[?]</a>'; ?></td>
            <td><?php
                $default_timezone = date_default_timezone_get();
                if ( 'UTC' !== $default_timezone ) {
                    echo '<mark class="error">&#10005; ' . sprintf( __( 'Default timezone is %s - it should be UTC', ST_TEXTDOMAIN ), $default_timezone ) . '</mark>';
                } else {
                    echo '<mark class="yes">&#10004;</mark>';
                } ?>
            </td>
        </tr>
        <?php
        $posting = array();

        // fsockopen/cURL
        $posting['fsockopen_curl']['name'] = 'fsockopen/cURL';
        $posting['fsockopen_curl']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'Payment gateways can use cURL to communicate with remote servers to authorize payments, other plugins may also use it when communicating with remote services.', ST_TEXTDOMAIN ) . '">[?]</a>';

        if ( function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) {
            $posting['fsockopen_curl']['success'] = true;
        } else {
            $posting['fsockopen_curl']['success'] = false;
            $posting['fsockopen_curl']['note']    = __( 'Your server does not have fsockopen or cURL enabled - PayPal IPN and other scripts which communicate with other servers will not work. Contact your hosting provider.', ST_TEXTDOMAIN ). '</mark>';
        }


        // DOMDocument
        $posting['dom_document']['name'] = 'DOMDocument';
        $posting['dom_document']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'HTML/Multipart emails use DOMDocument to generate inline CSS in templates.', ST_TEXTDOMAIN ) . '">[?]</a>';

        if ( class_exists( 'DOMDocument' ) ) {
            $posting['dom_document']['success'] = true;
        } else {
            $posting['dom_document']['success'] = false;
            $posting['dom_document']['note']    = sprintf( __( 'Your server does not have the <a href="%s">DOMDocument</a> class enabled - HTML/Multipart emails, and also some extensions, will not work without DOMDocument.', ST_TEXTDOMAIN ), 'http://php.net/manual/en/class.domdocument.php' ) . '</mark>';
        }

        // GZIP
        $posting['gzip']['name'] = 'GZip';
        $posting['gzip']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'GZip (gzopen) is used to open the GEOIP database from MaxMind.', ST_TEXTDOMAIN ) . '">[?]</a>';

        if ( is_callable( 'gzopen' ) ) {
            $posting['gzip']['success'] = true;
        } else {
            $posting['gzip']['success'] = false;
            $posting['gzip']['note']    = sprintf( __( 'Your server does not support the <a href="%s">gzopen</a> function - this is required to use the GeoIP database from MaxMind. The API fallback will be used instead for geolocation.', ST_TEXTDOMAIN ), 'http://php.net/manual/en/zlib.installation.php' ) . '</mark>';
        }

        // WP Remote Post Check
        $posting['wp_remote_post']['name'] = __( 'Remote Post', ST_TEXTDOMAIN);
        $posting['wp_remote_post']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'PayPal uses this method of communicating when sending back transaction information.', ST_TEXTDOMAIN ) . '">[?]</a>';

        $response = wp_safe_remote_post( 'https://www.paypal.com/cgi-bin/webscr', array(
            'timeout'    => 60,
            'user-agent' => 'Traveler/' . ST_TRAVELER_VERSION,
            'body'       => array(
                'cmd'    => '_notify-validate'
            )
        ) );

        if ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
            $posting['wp_remote_post']['success'] = true;
        } else {
            $posting['wp_remote_post']['note']    = __( 'wp_remote_post() failed. PayPal IPN won\'t work with your server. Contact your hosting provider.', ST_TEXTDOMAIN );
            if ( is_wp_error( $response ) ) {
                $posting['wp_remote_post']['note'] .= ' ' . sprintf( __( 'Error: %s', ST_TEXTDOMAIN ), wc_clean( $response->get_error_message() ) );
            } else {
                $posting['wp_remote_post']['note'] .= ' ' . sprintf( __( 'Status code: %s', ST_TEXTDOMAIN ), wc_clean( $response['response']['code'] ) );
            }
            $posting['wp_remote_post']['success'] = false;
        }

        // WP Remote Get Check
        $posting['wp_remote_get']['name'] = __( 'Remote Get', ST_TEXTDOMAIN);
        $posting['wp_remote_get']['help'] = '<a href="#" class="help_tip" data-tip="' . esc_attr__( 'WooCommerce plugins may use this method of communication when checking for plugin updates.', ST_TEXTDOMAIN ) . '">[?]</a>';

        $response = wp_safe_remote_get( 'http://www.woothemes.com/wc-api/product-key-api?request=ping&network=' . ( is_multisite() ? '1' : '0' ) );

        if ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
            $posting['wp_remote_get']['success'] = true;
        } else {
            $posting['wp_remote_get']['note']    = __( 'wp_remote_get() failed. The WooCommerce plugin updater won\'t work with your server. Contact your hosting provider.', ST_TEXTDOMAIN );
            if ( is_wp_error( $response ) ) {
                $posting['wp_remote_get']['note'] .= ' ' . sprintf( __( 'Error: %s', ST_TEXTDOMAIN ), wc_clean( $response->get_error_message() ) );
            } else {
                $posting['wp_remote_get']['note'] .= ' ' . sprintf( __( 'Status code: %s', ST_TEXTDOMAIN ), wc_clean( $response['response']['code'] ) );
            }
            $posting['wp_remote_get']['success'] = false;
        }

        $posting = apply_filters( 'woocommerce_debug_posting', $posting );

        foreach ( $posting as $post ) {
            $mark = ! empty( $post['success'] ) ? 'yes' : 'error';
            ?>
            <tr>
                <td data-export-label="<?php echo esc_html( $post['name'] ); ?>"><?php echo esc_html( $post['name'] ); ?>:</td>
                <td class="help"><?php echo isset( $post['help'] ) ? $post['help'] : ''; ?></td>
                <td>
                    <mark class="<?php echo $mark; ?>">
                        <?php echo ! empty( $post['success'] ) ? '&#10004' : '&#10005'; ?> <?php echo ! empty( $post['note'] ) ? wp_kses_data( $post['note'] ) : ''; ?>
                    </mark>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>


    <table class="widefat" cellspacing="0">
        <thead>
        <tr>
            <th colspan="3" data-export-label="Active Plugins (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)"><?php _e( 'Active Plugins', ST_TEXTDOMAIN ); ?> (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $active_plugins = (array) get_option( 'active_plugins', array() );

        if ( is_multisite() ) {
            $active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
        }

        foreach ( $active_plugins as $plugin ) {

            $plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
            $dirname        = dirname( $plugin );
            $version_string = '';
            $network_string = '';

            if ( ! empty( $plugin_data['Name'] ) ) {

                // link the plugin name to the plugin url if available
                $plugin_name = esc_html( $plugin_data['Name'] );

                if ( ! empty( $plugin_data['PluginURI'] ) ) {
                    $plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . esc_attr__( 'Visit plugin homepage' , ST_TEXTDOMAIN ) . '" target="_blank">' . $plugin_name . '</a>';
                }

                if ( strstr( $dirname, 'woocommerce-' ) && strstr( $plugin_data['PluginURI'], 'woothemes.com' ) ) {

                    if ( false === ( $version_data = get_transient( md5( $plugin ) . '_version_data' ) ) ) {
                        $changelog = wp_safe_remote_get( 'http://dzv365zjfbd8v.cloudfront.net/changelogs/' . $dirname . '/changelog.txt' );
                        $cl_lines  = explode( "\n", wp_remote_retrieve_body( $changelog ) );
                        if ( ! empty( $cl_lines ) ) {
                            foreach ( $cl_lines as $line_num => $cl_line ) {
                                if ( preg_match( '/^[0-9]/', $cl_line ) ) {

                                    $date         = str_replace( '.' , '-' , trim( substr( $cl_line , 0 , strpos( $cl_line , '-' ) ) ) );
                                    $version      = preg_replace( '~[^0-9,.]~' , '' ,stristr( $cl_line , "version" ) );
                                    $update       = trim( str_replace( "*" , "" , $cl_lines[ $line_num + 1 ] ) );
                                    $version_data = array( 'date' => $date , 'version' => $version , 'update' => $update , 'changelog' => $changelog );
                                    set_transient( md5( $plugin ) . '_version_data', $version_data, DAY_IN_SECONDS );
                                    break;
                                }
                            }
                        }
                    }

                    if ( ! empty( $version_data['version'] ) && version_compare( $version_data['version'], $plugin_data['Version'], '>' ) ) {
                        $version_string = ' &ndash; <strong style="color:red;">' . esc_html( sprintf( _x( '%s is available', 'Version info', ST_TEXTDOMAIN ), $version_data['version'] ) ) . '</strong>';
                    }

                    if ( $plugin_data['Network'] != false ) {
                        $network_string = ' &ndash; <strong style="color:black;">' . __( 'Network enabled', ST_TEXTDOMAIN ) . '</strong>';
                    }
                }

                ?>
                <tr>
                    <td><?php echo $plugin_name; ?></td>
                    <td class="help">&nbsp;</td>
                    <td><?php echo sprintf( _x( 'by %s', 'by author', ST_TEXTDOMAIN ), $plugin_data['Author'] ) . ' &ndash; ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string; ?></td>
                </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>
	</div>