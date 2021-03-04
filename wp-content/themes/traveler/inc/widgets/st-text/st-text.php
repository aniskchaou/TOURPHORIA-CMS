<?php
if(!class_exists('st_wd_text')){
    class st_wd_text extends WP_Widget{
        public function __construct() {
            $widget_ops = array('classname' => 'st_wd_text', 'description' => __( "Text sidebar with traveler header style and can be shortcodes in content ",ST_TEXTDOMAIN) );
            parent::__construct('st_wd_text', __('ST Text',ST_TEXTDOMAIN), $widget_ops);
        }

        public function widget($args, $instance) {
            extract(wp_parse_args($instance , array('title'=>'','style'=>'','content'=>"")));
            $title = apply_filters( 'widget_title', empty( $title ) ? '' : $title, $instance, $this->id_base );
            if (empty($title)) {$style = "";}
            if (!empty($style) and $style =='tour_box') echo "<div class='st_tour_box_style' >";
            echo $args['before_widget'];
            if ( $title ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }
            echo apply_filters('start_st_text_wrapper'  , "<div class='col-xs-12 st_text_wrapper'>");
            echo apply_filters('the_content',$content);
            ?>
            <?php
            echo apply_filters('end_st_text_wrapper'  , "</div>");
            echo $args['after_widget'];
            if (!empty($style) and $style =='tour_box') echo "<div class='end1'></div><div class='end2'></div></div>";
            
        }

        public function update( $new_instance, $old_instance ) {
            return wp_parse_args($new_instance,$old_instance);
        }
        public function form( $instance ) {
            $instance = wp_parse_args((array) $instance, array( 'title' => '','content'=> '','style'=>''));
            extract($instance);
            ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
            <p>
                <label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('Style:'); ?>
                <select name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>">
                    <option <?php if (esc_attr($style) =='') echo "selected"; ?> value=""><?php echo __("Default" ,ST_TEXTDOMAIN) ;?></option>
                    <option <?php if (esc_attr($style) =='tour_box') echo "selected"; ?> value="tour_box"><?php echo __("Tour box style" , ST_TEXTDOMAIN);?></option>
                </select>
                </label>
            </p>
            <p><label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?> <textarea class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" type="text"><?php echo esc_attr($content); ?></textarea></label></p>
            <?php
        }
    }

    function st_wd_text() {
        register_widget( 'st_wd_text' );
    }

    add_action( 'widgets_init', 'st_wd_text' );
}
