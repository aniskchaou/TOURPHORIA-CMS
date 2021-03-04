<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14/03/2016
 * Time: 8:37 SA
 */
if (!class_exists('st_search_blog')){
    class st_search_blog extends WP_Widget {
        public function __construct() {
            $widget_ops = array('classname' => 'st_widget_search', 'description' => __( "A search form for your site.") );
            parent::__construct( 'st_search_blog',__("ST Search Blog" , ST_TEXTDOMAIN), $widget_ops );
        }
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            echo $args['before_widget'];
            if ( $title ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }
            ?>
            <form role="search" method="get" class="search" action="<?php echo home_url( '/' ); ?>">
                <div class="form-group form-group-icon-right">
                    <i class="fa fa-search input-icon"></i>
                    <input class="form-control" type="text" placeholder="<?php esc_html_e('Search ...','traveler')?>" value="<?php echo get_search_query() ?>">
                    <input type="hidden" name="post_type" value="post">
                </div>
            </form>
            <?php
            echo $args['after_widget'];
        }
        public function form( $instance ) {
            $instance = wp_parse_args((array) $instance, array( 'title' => '','is_button'=> 'yes'));
            $title = $instance['title'];
            ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('is_button'); ?>"> <?php echo __("Show Icon Search ", ST_TEXTDOMAIN ); ?>:
                <input type="radio" id = "<?php echo $this->get_field_id('is_button'); ?>" name="<?php echo $this->get_field_id('is_button'); ?>" value="yes" <?php if ($instance['is_button'] =='yes'){ echo "checked" ; }?>> <?php echo __("Yes", ST_TEXTDOMAIN ) ; ?>
                <input type="radio" id = "<?php echo $this->get_field_id('is_button'); ?>" name="<?php echo $this->get_field_id('is_button'); ?>" value="no"  <?php if ($instance['is_button'] =='no'){ echo "checked" ; }?>> <?php echo __("No", ST_TEXTDOMAIN ) ; ?>
                </label></p>
            <?php
        }
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            if (!empty($_POST[$this->get_field_id('is_button')])){$new_instance['is_button'] = $_POST[$this->get_field_id('is_button')]; }
            $new_instance = wp_parse_args((array) $new_instance, array( 'title' => '','is_button'=> 'yes'));
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            $instance['is_button'] = sanitize_text_field( $new_instance['is_button'] );
            return $instance;
        }
    }
    function st_search_blog() {
        register_widget( 'st_search_blog' );
    }

    add_action( 'widgets_init', 'st_search_blog' );
}
