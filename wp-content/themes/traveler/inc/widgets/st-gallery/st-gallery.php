<?php
    if(!class_exists('st_widget_list_gallery')){
        class st_widget_list_gallery extends WP_Widget{

            public $cache_key='widget_st_list_gallery';

            public function __construct() {
                $widget_ops = array('classname' => 'widget_st_list_gallery', 'description' => __( "Your site&#8217;s list gallery.",ST_TEXTDOMAIN) );
                parent::__construct('st_widget_list_gallery', __('ST List Gallery',ST_TEXTDOMAIN), $widget_ops);
                $this->alt_option_name = $this->cache_key;

                add_action( 'save_post', array($this, 'flush_widget_cache') );
                add_action( 'deleted_post', array($this, 'flush_widget_cache') );
                add_action( 'switch_theme', array($this, 'flush_widget_cache') );
            }

            public function widget($args, $instance) {


                $cache = array();
                if ( ! $this->is_preview() ) {
                    $cache = wp_cache_get( $this->cache_key, 'widget' );
                }

                if ( ! is_array( $cache ) ) {
                    $cache = array();
                }

                if ( ! isset( $args['widget_id'] ) ) {
                    $args['widget_id'] = $this->id;
                }

                if ( isset( $cache[ $args['widget_id'] ] ) ) {
                    echo balanceTags($cache[ $args['widget_id'] ]);
                    return;
                }

                ob_start();

                $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'List Gallery',ST_TEXTDOMAIN );

                $sort = ( ! empty( $instance['sort'] ) ) ? $instance['sort'] : 'desc';

                /** This filter is documented in wp-includes/default-widgets.php */
                $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

                $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
                if ( ! $number )
                    $number = 5;

                /**
                 * Filter the arguments for the Recent Posts widget.
                 *
                 * @since 3.4.0
                 *
                 * @see WP_Query::get_posts()
                 *
                 * @param array $args An array of arguments used to retrieve the recent posts.
                 */
                $arg= array(
                    'posts_per_page'      => $number,
                    'post_type'           =>'attachment',
                    'post_mime_type'      =>'image',
                    'post_status' => 'inherit',
                    'orderby' => 'date',
                    'order' => $sort
                );


                $r = new WP_Query( apply_filters( 'widget_posts_args',$arg ) );

                if ($r->have_posts()) :
                    ?>
                    <?php echo balanceTags($args['before_widget']); ?>
                    <?php if ( $title ) {
                    echo balanceTags($args['before_title'] . $title . $args['after_title']);
                } ?>



                    <div class="row row-no-gutter">
                        <?php while ( $r->have_posts() ) : $r->the_post();

                            $image=wp_get_attachment_image_src(get_the_ID(),'full');
                            ?>
                            <div class="col-md-4">
                                <a class="hover-img" href="<?php echo isset($image[0])?$image[0]:false;  ?>">
                                    <?php echo wp_get_attachment_image( get_the_ID(),array(100,100,'bfi_thumb'=>true) ); ?>
                                </a>
                            </div>

                        <?php endwhile; ?>
                    </div>
                    <?php echo balanceTags($args['after_widget']); ?>
                    <?php
                    // Reset the global $the_post as this query will have stomped on it
                    wp_reset_postdata();

                endif;

                if ( ! $this->is_preview() ) {
                    $cache[ $args['widget_id'] ] = ob_get_flush();
                    wp_cache_set( $this->cache_key, $cache, 'widget' );
                } else {
                    ob_end_flush();
                }
            }

            public function update( $new_instance, $old_instance ) {
                $instance = $old_instance;
                $instance['title'] = strip_tags($new_instance['title']);
                $instance['number'] = (int) $new_instance['number'];
                $instance['sort'] = $new_instance['sort'];
                $this->flush_widget_cache();

                $alloptions = wp_cache_get( 'alloptions', 'options' );
                if ( isset($alloptions[$this->cache_key]) )
                    delete_option($this->cache_key);

                return $instance;
            }

            public function flush_widget_cache() {
                wp_cache_delete($this->cache_key, 'widget');
            }

            public function form( $instance ) {
                $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
                $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
                $sort    = isset( $instance['sort'] ) ? $instance['sort']: 'desc';
                ?>
                <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' ,ST_TEXTDOMAIN); ?></label>
                    <input class="widefat" id="<?php echo  esc_attr( $this->get_field_id( 'title' )); ?>" name="<?php echo esc_html($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>

                <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of Image to show:',ST_TEXTDOMAIN ); ?></label>
                    <input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
                <p><label for="<?php echo esc_attr($this->get_field_id( 'sort' )); ?>"><?php _e( 'Sort by date:',ST_TEXTDOMAIN ); ?></label>
                    <select id="<?php echo esc_attr($this->get_field_id( 'sort' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'sort' )); ?>">
                        <option value="desc" <?php echo $sort == 'desc' ? 'selected' : ''; ?>><?php echo __('Descending', ST_TEXTDOMAIN); ?></option>
                        <option value="asc" <?php echo $sort == 'asc' ? 'selected' : ''; ?>><?php echo __('Ascending', ST_TEXTDOMAIN); ?></option>
                    </select>
                </p>


            <?php
            }
        }


        function st_gallery_widget_register() {
            register_widget( 'st_widget_list_gallery' );
        }

        add_action( 'widgets_init', 'st_gallery_widget_register' );
    }
