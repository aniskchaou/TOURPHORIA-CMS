<?php
    if (!class_exists('ST_Section_Wrap_Start')) {
        class ST_Section_Wrap_Start extends WP_Widget
        {

            public function __construct()
            {
                $widget_ops = array('description' => __('Section Wrap Start',ST_TEXTDOMAIN));
                parent::__construct(false, __('ST Section Wrap Start',ST_TEXTDOMAIN), $widget_ops);
            }

            static function _init()
            {
                add_action('widgets_init', array(__CLASS__, '_add_widget'));
            }

            static function _add_widget()
            {
                register_widget('ST_Section_Wrap_Start');

            }

            public function widget($args, $instance)
            {
                $default = array(
                    'title'    => '',
                    'title_bg' => ''
                );


                $instance = wp_parse_args($instance, $default);
                $section_title_class='';
                if($instance['title_bg'])
                {
                    $section_title_class=Assets::build_css(
                        '
                    background-color:'.$instance['title_bg'].';
                  '
                    );
                }

                ?>
                <div class="st_sidebar_section_wrap">
                    <div class="sidebar_section_title <?php echo esc_attr($section_title_class) ?>">
                        <?php echo($instance['title']) ?>
                    </div>
                    <div class="sidebar_section_content">
            <?php
            }

            public function update($new_instance, $old_instance)
            {
                $instance = array();
                if (!empty($new_instance['title'])) {
                    $instance['title'] = strip_tags(stripslashes($new_instance['title']));
                }
                if (!empty($new_instance['title_bg'])) {
                    $instance['title_bg'] = strip_tags(stripslashes($new_instance['title_bg']));
                }

                return $instance;
            }

            public function form($instance)
            {
                $title = isset($instance['title']) ? $instance['title'] : '';
                $title_bg = isset($instance['title_bg']) ? $instance['title_bg'] : '';

                ?>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:',ST_TEXTDOMAIN) ?></label>
                    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                           name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_html($title); ?>"/>
                </p>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('title_bg')); ?>"><?php _e('Title Background:',ST_TEXTDOMAIN) ?></label>
                    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title_bg')); ?>"
                           name="<?php echo esc_attr($this->get_field_name('title_bg')); ?>" value="<?php echo($title_bg); ?>"/>
                </p>
            <?php
            }
        }


        ST_Section_Wrap_Start::_init();
    }
