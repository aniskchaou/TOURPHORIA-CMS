<?php
    if(!class_exists('STTwitterWidget')){
        class STTwitterWidget extends WP_Widget
        {
            function __construct(){
                parent::__construct(false, 'ST Twitter Widget');

                //require_once 'class-wp-twitter-api.php';
            }
            static function st_add_widget()
            {
                register_widget( 'STTwitterWidget' );
            }
            /**
             * Front-end display of widget.
             *
             * @see WP_Widget::widget()
             *
             * @param array $args     Widget arguments.
             * @param array $instance Saved values from database.
             */
            public function widget( $args, $instance ) {
                $default=array(
                    'title'=>'recent tweet',
                    'number_tweet'=>5,
                    'user_id'=>'evanto'
                );
                $instance=wp_parse_args($instance,$default);
                extract($instance);
                echo balanceTags($args['before_widget']);
                if ( ! empty( $title ) ) {
                    echo balanceTags($args['before_title'] . $title . $args['after_title']);
                }
                if($user_id)
                {

                    $credentials = array(
                        'consumer_key' => '18ihEuNsfOJokCLb8SAgA',
                        'consumer_secret' => '7vTYnLYYiP4BhXvkMWtD3bGnysgiGqYlsPFfwXhGk'
                    );

                    $twitter_api = new Wp_Twitter_Api( $credentials );

                    $query = 'count='.$number_tweet.'&include_entities=true&include_rts=true&screen_name='.$user_id;

//                    $args=array(
//
//                        'type'=>'statuses/user_timeline',
//                    );

                    $twitters=$twitter_api->query( $query );

                    $output = array();
                    $output[]='<div class="twitter">';
                    $output[]='<ul class="tweet-list list-unstyled">';
                    if (!isset($twitters['errors']) && count($twitters)>0 and is_array($twitters)) {
                        foreach( $twitters as $twitter ) {
                            $twitter=(array)$twitter;

                            $output[] = '<li class="tweet">';
                            $output[] ="<span class='tweet-text'><a href='http://twitter.com/".$user_id."/status/".$twitter['id']."'>";
                            ob_start();
                                printf( __( '%s ago', ST_TEXTDOMAIN ), human_time_diff( strtotime($twitter['created_at'])  , current_time( 'timestamp' ) ) );
                            $output[]=@ob_get_clean();
                            $output[] = '</a></span>';
                            $output[] = "<span class='tweet-time'>".$twitter['text']."</span>";                            
                            $output[] = '</li>';
                        }
                    }
                    $output[]='</ul>';
                    $output[]='</div>';
                    echo implode("\n",$output);
                }

                echo balanceTags($args['after_widget']);
            }
            /**
             * Back-end widget form.
             *
             * @see WP_Widget::form()
             *
             * @param array $instance Previously saved values from database.
             */
            public function form( $instance ) {
                $default=array(
                    'title'=>'Recent tweet',
                    'number_tweet'=>5,
                    'user_id'=>'evanto'
                );
                $instance=wp_parse_args($instance,$default);
                extract($instance);
                ?>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:',ST_TEXTDOMAIN ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id( 'user_id' )); ?>"><?php _e( 'Twitter User:',ST_TEXTDOMAIN ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'user_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user_id' )); ?>" type="text" value="<?php echo esc_attr( $user_id ); ?>">
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id( 'number_tweet' )); ?>"><?php _e( 'Number of Tweet (default is 5):',ST_TEXTDOMAIN ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number_tweet' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number_tweet' )); ?>" type="text" value="<?php echo esc_attr( $number_tweet ); ?>">
                </p>
            <?php
            }
            /**
             * Sanitize widget form values as they are saved.
             *
             * @see WP_Widget::update()
             *
             * @param array $new_instance Values just sent to be saved.
             * @param array $old_instance Previously saved values from database.
             *
             * @return array Updated safe values to be saved.
             */
            public function update( $new_instance, $old_instance ) {
                $instance = array();
                $instance['user_id'] = ( ! empty( $new_instance['user_id'] ) ) ? strip_tags( $new_instance['user_id'] ) : '';
                $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
                $instance['number_tweet'] = ( ! empty( $new_instance['number_tweet'] ) ) ? strip_tags( $new_instance['number_tweet'] ) : '';
                return $instance;
            }
        }
        add_action( 'widgets_init', array('STTwitterWidget','st_add_widget'));
    }
