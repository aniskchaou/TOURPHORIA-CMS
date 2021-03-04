<?php
    if (!class_exists('ST_Shop_Reset_Filter')) {
        class ST_Shop_Reset_Filter extends WP_Widget
        {

            public function __construct()
            {
                $widget_ops = array('description' => __('Reset All Shop Filter',ST_TEXTDOMAIN));
                parent::__construct(false, __('ST Shop Reset Filter',ST_TEXTDOMAIN), $widget_ops);
            }
            static function _init()
            {
                add_action('widgets_init', array(__CLASS__,'_add_widget'));
            }
            static function _add_widget()
            {
                register_widget('ST_Shop_Reset_Filter');

            }

            public function widget($args, $instance)
            {
                $default=array(
                    'title'=>''
                );
                $instance=wp_parse_args($instance,$default);
                if(!class_exists('Woocommerce')) return;
                $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
                ?>
                <div class="shop_reset_filter">
                    <a href="<?php echo esc_url($shop_page_url) ?>"><i class="fa fa-trash"></i><?php echo ($instance['title']) ?></a>
                </div>

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
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:',ST_TEXTDOMAIN) ?></label>
                    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                           name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>"/>
                </p>

            <?php
            }
        }


        ST_Shop_Reset_Filter::_init();
    }
