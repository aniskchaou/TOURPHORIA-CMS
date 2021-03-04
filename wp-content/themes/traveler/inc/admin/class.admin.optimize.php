<?php
    /**
     * @since 1.4.3
     */
    if ( !class_exists( 'STAdminOptimize' ) ) {
        class STAdminOptimize extends STAdmin
        {
            private static $instance;
            private $output;

            public function __construct()
            {
                //parent::__construct();
                self::$instance = &$this;
                add_action( 'admin_menu', [ $this, '_register_optimize_page' ], 50 );
                add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
                add_action( 'wp_ajax_st_transient_optimie', [ $this, 'transient_optimie' ] );
                add_action( 'wp_ajax_st_post_revision_optimize', [ $this, 'post_revision_optimize' ] );
                add_action( 'wp_ajax_st_post_draft_optimize', [ $this, 'post_draft_optimize' ] );
                add_action( 'wp_ajax_st_comment_spam_optimize', [ $this, 'comment_spam_optimize' ] );
                add_action( 'wp_ajax_st_availability_optimize', [ $this, 'availability_optimize' ] );
            }

            public function enqueue_scripts()
            {
                wp_register_script( 'st-optimize', get_template_directory_uri() . '/js/admin/optimize.js', [ 'jquery' ], null, true );
            }

            public function _register_optimize_page()
            {
                add_submenu_page( 'st_traveler_option',
                    __( 'ST Optimize', ST_TEXTDOMAIN ),
                    __( 'ST Optimize', ST_TEXTDOMAIN ), 'manage_options', 'st-optimize',
                    [ $this, '_st_optimize_content' ] );
            }

            public function _st_optimize_content()
            {
                echo balanceTags( $this->load_view( 'optimize/index', false ) );
            }


            public function post_revision_get_info()
            {
                $this->clear_message();
                global $wpdb;

                $sql = "SELECT COUNT(*) FROM `" . $wpdb->posts . "` WHERE post_type = 'revision';";

                $revisions = $wpdb->get_var( $sql );

                if ( !$revisions == 0 || !$revisions == NULL ) {
                    $message = sprintf( _n( '%s post revision in your database', '%s post revisions in your database', $revisions, ST_TEXTDOMAIN ), number_format_i18n( $revisions ) );
                } else {
                    $message = __( 'No post revisions found', ST_TEXTDOMAIN );
                }

                $this->add_message( $message );

                return $this->show_message();
            }

            public function post_revision_optimize()
            {
                $this->clear_message();
                global $wpdb;

                $clean = "DELETE FROM `" . $wpdb->posts . "` WHERE post_type = 'revision';";

                $revisions = $wpdb->query( $clean );

                $message = sprintf( _n( '%d post revision deleted', '%d post revisions deleted', $revisions, ST_TEXTDOMAIN ), number_format_i18n( $revisions ) );

                $this->add_message( $message );

                echo json_encode( [ 'message' => $this->show_message() ] );
                die;
            }

            public function post_draft_get_info()
            {
                $this->clear_message();
                global $wpdb;
                $sql = "SELECT COUNT(*) FROM `" . $wpdb->posts . "` WHERE post_status = 'auto-draft';";

                $autodraft = $wpdb->get_var( $sql );

                if ( 0 != $autodraft && null != $autodraft ) {
                    $message = sprintf( _n( '%d auto draft post in your database', '%d auto draft posts in your database', $autodraft, ST_TEXTDOMAIN ), number_format_i18n( $autodraft ) );
                } else {
                    $message = __( 'No auto draft posts found', ST_TEXTDOMAIN );
                }

                $this->add_message( $message );

                $sql2 = "SELECT COUNT(*) FROM `" . $wpdb->posts . "` WHERE post_status = 'trash';";

                $trash = $wpdb->get_var( $sql2 );

                if ( 0 != $trash && null != $trash ) {
                    $message2 = sprintf( _n( '%d trashed post in your database', '%d trashed posts in your database', $trash, ST_TEXTDOMAIN ), number_format_i18n( $trash ) );
                } else {
                    $message2 = __( 'No trashed posts found', ST_TEXTDOMAIN );
                }

                $this->add_message( $message2 );

                return $this->show_message();
            }

            public function post_draft_optimize() {
                $this->clear_message();
                global $wpdb;
                $clean = "DELETE FROM `".$wpdb->posts."` WHERE post_status = 'auto-draft';";

                $autodraft = $wpdb->query($clean);

                $this->add_message(sprintf(_n('%d auto draft deleted', '%d auto drafts deleted', $autodraft, ST_TEXTDOMAIN), number_format_i18n($autodraft)));

                $clean = "DELETE FROM `".$wpdb->posts."` WHERE post_status = 'trash';";

                $posttrash = $wpdb->query($clean);

                $this->add_message(sprintf(_n('%d item removed from Trash', '%d items removed from Trash', $posttrash, ST_TEXTDOMAIN), number_format_i18n($posttrash)));
                echo json_encode( [ 'message' => $this->show_message() ] );
                die;
            }

            public function comment_spam_get_info()
            {
                $this->clear_message();
                global $wpdb;
                $sql = "SELECT COUNT(*) FROM `" . $wpdb->comments . "` WHERE comment_approved = 'spam';";

                $comments = $wpdb->get_var( $sql );

                if ( null != $comments && 0 != $comments ) {
                    $message = sprintf( _n( '%d spam comment found', '%d spam comments found', $comments, ST_TEXTDOMAIN ), number_format_i18n( $comments ) ) . ' | <a id="wp-optimize-edit-comments-spam" href="' . admin_url( 'edit-comments.php?comment_status=spam' ) . '">' . ' ' . __( 'Review', ST_TEXTDOMAIN ) . '</a>';
                } else {
                    $message = __( 'No spam comments found', ST_TEXTDOMAIN );
                }

                $this->add_message( $message );

                $sql2 = "SELECT COUNT(*) FROM `" . $wpdb->comments . "` WHERE comment_approved = 'trash';";

                $comments = $wpdb->get_var( $sql2 );

                if ( null != $comments && 0 != $comments ) {
                    $message2 = sprintf( _n( '%d trashed comment found', '%d trashed comments found', $comments, ST_TEXTDOMAIN ), number_format_i18n( $comments ) ) . ' | <a id="wp-optimize-edit-comments-trash" href="' . admin_url( 'edit-comments.php?comment_status=trash' ) . '">' . ' ' . __( 'Review', ST_TEXTDOMAIN ) . '</a>';
                } else {
                    $message2 = __( 'No trashed comments found', ST_TEXTDOMAIN );
                }

                $this->add_message( $message2 );

                return $this->show_message();

            }

            public function comment_spam_optimize()
            {
                $this->clear_message();
                global $wpdb;
                $clean = "DELETE FROM `" . $wpdb->comments . "` WHERE comment_approved = 'spam';";

                $comments = $wpdb->query( $clean );

                $this->add_message( sprintf( _n( '%d spam comment deleted', '%d spam comments deleted', $comments, ST_TEXTDOMAIN ), number_format_i18n( $comments ) ) );

                $clean = "DELETE FROM `" . $wpdb->comments . "` WHERE comment_approved = 'trash';";
                $commentstrash = $wpdb->query( $clean );

                $this->add_message( sprintf( _n( '%d comment removed from Trash', '%d comments removed from Trash', $commentstrash, ST_TEXTDOMAIN ), number_format_i18n( $commentstrash ) ) );

                echo json_encode( [ 'message' => $this->show_message() ] );
                die;
            }

            public function transient_get_info()
            {
                $this->clear_message();
                global $wpdb;
                $options_table_sql = "
                    SELECT
                        COUNT(*)
                    FROM
                        " . $wpdb->options . " a, " . $wpdb->options . " b
                    WHERE
                        a.option_name LIKE '%_transient_%' AND
                        a.option_name NOT LIKE '%_transient_timeout_%' AND
                        b.option_name = CONCAT(
                            '_transient_timeout_',
                            SUBSTRING(
                                a.option_name,
                                CHAR_LENGTH('_transient_') + 1
                            )
                        )
                    AND b.option_value < UNIX_TIMESTAMP()
                ";

                $options_table_transients = $wpdb->get_var( $options_table_sql );

                if ( is_multisite() && is_main_network() ) {

                    $sitemeta_table_sql = "
                        SELECT
                            COUNT(*)
                        FROM
                            " . $wpdb->sitemeta . " a, " . $wpdb->sitemeta . " b
                        WHERE
                            a.meta_key LIKE '_site_transient_%' AND
                            a.meta_key NOT LIKE '_site_transient_timeout_%' AND
                            b.meta_key = CONCAT(
                                '_site_transient_timeout_',
                                SUBSTRING(
                                    a.meta_key,
                                    CHAR_LENGTH('_site_transient_') + 1
                                )
                            )
                        AND b.meta_value < UNIX_TIMESTAMP()
                    ";

                    $sitemeta_table_transients = $wpdb->get_var( $sitemeta_table_sql );
                } else {
                    $sitemeta_table_transients = 0;
                }

                $total_transients = ( is_numeric( $options_table_transients ) ? $options_table_transients : 0 );

                if ( $total_transients ) {
                    $message = sprintf( _n( '%d expired transient in your database', '%d expired transient in your database', $total_transients, ST_TEXTDOMAIN ), number_format_i18n( $total_transients ) );
                } else {
                    $message = __( 'No transient options found', ST_TEXTDOMAIN );
                }

                $this->add_message( $message );

                return $this->show_message();
            }

            public function transient_optimie()
            {
                $this->clear_message();
                global $wpdb;
                $clean = "
                    DELETE
                        a, b
                    FROM
                        " . $wpdb->options . " a, " . $wpdb->options . " b
                    WHERE
                        a.option_name LIKE '%_transient_%' AND
                        a.option_name NOT LIKE '%_transient_timeout_%' AND
                        b.option_name = CONCAT(
                            '_transient_timeout_',
                            SUBSTRING(
                                a.option_name,
                                CHAR_LENGTH('_transient_') + 1
                            )
                        )
                    AND b.option_value < UNIX_TIMESTAMP()
                ";

                $options_table_transients_deleted = $wpdb->query( $clean );

                $message = sprintf( _n( '%d transient option deleted', '%d transient options deleted', $options_table_transients_deleted, ST_TEXTDOMAIN ), number_format_i18n( $options_table_transients_deleted ) );

                $this->add_message( $message );

                echo json_encode( [ 'message' => $this->show_message() ] );
                die;
            }

            public function availability_get_info(){
                $this->clear_message();
                global $wpdb;
                $date = strtotime('-1 day');
                $sql = "SELECT COUNT(id) FROM {$wpdb->prefix}st_availability WHERE check_in < {$date}";

                $options_table_availability = $wpdb->get_var( $sql );

                $total_transients = ( is_numeric( $options_table_availability ) ? $options_table_availability : 0 );

                if ( $total_transients ) {
                    $message = sprintf( _n( '%d expired availability in your database', '%d expired availability in your database', $total_transients, ST_TEXTDOMAIN ), number_format_i18n( $total_transients ) );
                } else {
                    $message = __( 'No availability found', ST_TEXTDOMAIN );
                }

                $this->add_message( $message );

                return $this->show_message();
            }
            public function availability_optimize(){
                $this->clear_message();
                global $wpdb;
                $date = strtotime('-1 day');

                $sql = "DELETE FROM {$wpdb->prefix}st_availability WHERE check_in < {$date}";

                $options_table_availability = $wpdb->query( $sql );

                $final_message = sprintf( _n( '%d expired availability deleted', '%d expired availability deleted', $options_table_availability, ST_TEXTDOMAIN ), number_format_i18n( $options_table_availability ) );

                $this->add_message( $final_message );

                echo json_encode( [ 'message' => $this->show_message() ] );
                die;
            }


            public function add_message( $output )
            {
                $this->output[] = $output;
            }

            public function clear_message()
            {
                $this->output = [];
            }

            public function show_message()
            {
                $html = '';
                foreach ( $this->output as $value ) {
                    $html .= esc_html( $value ) . '<br/>';
                }

                return $html;
            }

            static function get_inst()
            {
                return self::$instance;
            }
        }


        new STAdminOptimize();
    }