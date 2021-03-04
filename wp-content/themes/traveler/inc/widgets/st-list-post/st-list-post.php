<?php
    if(!class_exists('st_widget_list_post')){
        class st_widget_list_post extends WP_Widget{

            public $cache_key='widget_st_list_entries';

            public function __construct() {
                $widget_ops = array('classname' => 'widget_st_list_entries', 'description' => __( "Your site&#8217;s list posts.",ST_TEXTDOMAIN) );
                parent::__construct('st_widget_list_post', __('ST List Posts',ST_TEXTDOMAIN), $widget_ops);
                $this->alt_option_name = 'widget_st_list_entries';

                add_action( 'save_post', array($this, 'flush_widget_cache') );
                add_action( 'deleted_post', array($this, 'flush_widget_cache') );
                add_action( 'switch_theme', array($this, 'flush_widget_cache') );
            }

            public function widget($args, $instance) {


                $cache = array();
                if ( ! $this->is_preview() ) {
                    $cache = wp_cache_get( 'widget_st_list_entries', 'widget' );
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

                $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts',ST_TEXTDOMAIN );

                /** This filter is documented in wp-includes/default-widgets.php */
                $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

                $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
                if ( ! $number )
                    $number = 5;
                $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

                $orderby   = isset( $instance['orderby'] ) ?  $instance['orderby']:"views_count";


                $order  = isset( $instance['order'] ) ?  $instance['order']:"ASC";

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
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'order'               =>$order
                );

                if($orderby=='views_count')
                {
                    $arg['meta_key']='post_views_count';
                    $arg['orderby']='meta_value';
                }else{
                    $arg['orderby']=$orderby;
                }



                $r = new WP_Query( apply_filters( 'widget_posts_args',$arg ) );

                if ($r->have_posts()) :
                    ?>
                    <?php echo balanceTags($args['before_widget']); ?>
                    <?php if ( $title ) {
                    echo ($args['before_title'] . $title . $args['after_title']);
                } ?>
                    <ul class="thumb-list">
                        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                            <?php
                                if(New_Layout_Helper::isNewLayout()){
                                    echo st()->load_template('layouts/modern/widget/st-list-post');
                                }else{
                                    ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail(array(70,70,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( get_the_ID() ))))?>
                                        </a>
                                        <div class="thumb-list-item-caption">
                                            <?php if ( $show_date ) : ?>
                                                <p class="thumb-list-item-meta"><?php echo  get_the_date()?></p>
                                            <?php endif; ?>

                                            <h5 class="thumb-list-item-title"><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h5>
                                            <p class="thumb-list-item-desciption"><?php echo TravelHelper::cutnchar(strip_tags(get_the_excerpt()),50)?></p>
                                        </div>
                                    </li>
                                    <?php
                                }
                            ?>
                        <?php endwhile; ?>
                    </ul>
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
                $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

                $instance['orderby']    = isset( $new_instance['orderby'] ) ?  $new_instance['orderby']:"views_count";
                $instance['order']    = isset( $new_instance['order'] ) ?  $new_instance['order']:"ASC";
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
                $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
                $orderby    = isset( $instance['orderby'] ) ?  $instance['orderby']:"views_count";
                $order    = isset( $instance['order'] ) ?  $instance['order']:"ASC";
                ?>
                <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' ,ST_TEXTDOMAIN); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

                <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of posts to show:',ST_TEXTDOMAIN ); ?></label>
                    <input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

                <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" />
                    <label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php _e( 'Display post date?',ST_TEXTDOMAIN ); ?></label></p>

                <p>
                    <label for="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>"><?php _e( 'Order By',ST_TEXTDOMAIN ); ?></label>
                    <select name="<?php echo esc_attr($this->get_field_name( 'orderby' )); ?>">
                        <option <?php selected($orderby,"views_count");?> value="views_count"><?php echo _('Views Count')?></option>
                        <?php $orderbys=TravelHelper::get_orderby_list();
                            if(!empty($orderbys))
                            {
                                foreach($orderbys as $key=>$value)
                                {
                                    $checked=selected($orderby,$key,false);
                                    echo "<option {$checked} value='{$key}'>{$value}</option>";
                                }
                            }

                        ?>

                    </select>
                </p>

                <p>
                    <label for="<?php echo esc_attr($this->get_field_id( 'order' )); ?>"><?php _e( 'Order',ST_TEXTDOMAIN ); ?></label>
                    <select name="<?php echo esc_attr($this->get_field_name( 'order' )); ?>">
                        <option <?php selected($order,"ASC");?> value="ASC"><?php echo __('ASC',ST_TEXTDOMAIN)?></option>
                        <option <?php selected($order,"DESC");?> value="DESC"><?php echo __('DESC',ST_TEXTDOMAIN)?></option>

                    </select>
                </p>
            <?php
            }
        }


        function st_recent_post_register() {
            register_widget( 'st_widget_list_post' );
        }

        add_action( 'widgets_init', 'st_recent_post_register' );
    }
