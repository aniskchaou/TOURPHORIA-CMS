<?php
    if (!class_exists('ST_Section_Wrap_End')) {
        class ST_Section_Wrap_End extends WP_Widget
        {

            public function __construct()
            {
                $widget_ops = array('description' => __('Section Wrap End',ST_TEXTDOMAIN));
                parent::__construct(false, __('ST Section Wrap End',ST_TEXTDOMAIN), $widget_ops);
            }
            static function _init()
            {
                add_action('widgets_init', array(__CLASS__,'_add_widget'));
            }
            static function _add_widget()
            {
                register_widget('ST_Section_Wrap_End');

            }

            public function widget($args, $instance)
            {
                $default=array(
                    'title'=>''
                );
                $instance=wp_parse_args($instance,$default);
                ?>
                </div></div>
                <?php
            }

            public function update($new_instance, $old_instance)
            {
                $instance = array();
                if (!empty($new_instance['title'])) {
                    $instance['title'] = strip_tags(stripslashes($new_instance['title']));
                }

                return $instance;
            }

            public function form($instance)
            {
                $title = isset($instance['title']) ? $instance['title'] : '';

                ?>

            <?php
            }
        }


        ST_Section_Wrap_End::_init();
    }
