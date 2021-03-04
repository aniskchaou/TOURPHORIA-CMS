<?php
    if(!class_exists('st_recent_comment')){
        class st_recent_comment extends WP_Widget {

            public function __construct() {
                parent::__construct('recent-comments', __('ST Recent Comments',ST_TEXTDOMAIN));
                $this->alt_option_name = 'widget_recent_comments';

                if ( is_active_widget(false, false, $this->id_base) )
                    add_action( 'wp_head', array($this, 'recent_comments_style') );

                add_action( 'comment_post', array($this, 'flush_widget_cache') );
                add_action( 'edit_comment', array($this, 'flush_widget_cache') );
                add_action( 'transition_comment_status', array($this, 'flush_widget_cache') );
            }

            public function recent_comments_style() {

                /**
                 * Filter the Recent Comments default widget styles.
                 *
                 * @since 3.1.0
                 *
                 * @param bool   $active  Whether the widget is active. Default true.
                 * @param string $id_base The widget ID.
                 */
                if ( ! current_theme_supports( 'widgets' ) // Temp hack #14876
                    || ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
                    return;
                ?>
                <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
            <?php
            }

            public function flush_widget_cache() {
                wp_cache_delete('widget_recent_comments', 'widget');
            }

            public function widget( $args, $instance ) {
                global $comments, $comment;

                $cache = array();
                if ( ! $this->is_preview() ) {
                    $cache = wp_cache_get('widget_recent_comments', 'widget');
                }
                if ( ! is_array( $cache ) ) {
                    $cache = array();
                }

                if ( ! isset( $args['widget_id'] ) )
                    $args['widget_id'] = $this->id;

                if ( isset( $cache[ $args['widget_id'] ] ) ) {
                    echo balanceTags($cache[ $args['widget_id'] ]);
                    return;
                }

                $output = '';

                $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments',ST_TEXTDOMAIN );

                /** This filter is documented in wp-includes/default-widgets.php */
                $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

                $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
                if ( ! $number )
                    $number = 5;

                /**
                 * Filter the arguments for the Recent Comments widget.
                 *
                 * @since 3.4.0
                 *
                 * @see get_comments()
                 *
                 * @param array $comment_args An array of arguments used to retrieve the recent comments.
                 */
                $comments = get_comments( apply_filters( 'widget_comments_args', array(
                    'number'      => $number,
                    'status'      => 'approve',
                    'post_status' => 'publish'
                ) ) );

                $output .= $args['before_widget'];
                if ( $title ) {
                    $output .= $args['before_title'] . $title . $args['after_title'];
                }

                $output .= '<ul class="thumb-list thumb-list-right">';
                if ( $comments ) {
                    // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
                    $post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
                    _prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

                    foreach ( (array) $comments as $comment) {
                        $avatar =  st_get_profile_avatar( $comment->user_id,50 );
                        $output .= '<li class="recentcomments">';


                        $output.='
                         '.$avatar.'
                            ';
                        $output.='<div class="thumb-list-item-caption">
                        <p class="thumb-list-item-meta"><a href="'.esc_url( get_comment_link( $comment->comment_ID ) ).'">'.human_time_diff( get_comment_time('U'), current_time('timestamp') ) . __(' ago',ST_TEXTDOMAIN).'</a> </p>
                        <h4 class="thumb-list-item-title">
                        '.sprintf( __( '%s', ST_TEXTDOMAIN ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ).'
                        </h4>
                </div>';

                        ob_start();

                        comment_excerpt();

                        $comment_excerpt=@ob_get_clean();


                        $output.='<p class="thumb-list-item-desciption">'.$comment_excerpt.'</p>';



                        $output .= '</li>';
                    }
                }
                $output .= '</ul>';
                $output .= $args['after_widget'];

                echo balanceTags($output);

                if ( ! $this->is_preview() ) {
                    $cache[ $args['widget_id'] ] = $output;
                    wp_cache_set( 'widget_recent_comments', $cache, 'widget' );
                }
            }

            public function update( $new_instance, $old_instance ) {
                $instance = $old_instance;
                $instance['title'] = strip_tags($new_instance['title']);
                $instance['number'] = absint( $new_instance['number'] );
                $this->flush_widget_cache();

                $alloptions = wp_cache_get( 'alloptions', 'options' );
                if ( isset($alloptions['widget_recent_comments']) )
                    delete_option('widget_recent_comments');

                return $instance;
            }

            public function form( $instance ) {
                $title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
                $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
                ?>
                <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' ,ST_TEXTDOMAIN); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

                <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of comments to show:',ST_TEXTDOMAIN ); ?></label>
                    <input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
            <?php
            }
        }

        function st_recent_comment_register() {
            register_widget( 'st_recent_comment' );
        }

        add_action( 'widgets_init', 'st_recent_comment_register' );
    }
