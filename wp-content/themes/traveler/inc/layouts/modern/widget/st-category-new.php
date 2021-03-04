<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14/03/2016
 * Time: 8:37 SA
 */
if (!class_exists('st_categories_new')){
    class st_categories_new extends WP_Widget {
        public function __construct() {
            $widget_ops = array('classname' => 'st_categories_new', 'description' => __( "The list categories for your site.") );
            parent::__construct( 'st_categories_new',__("ST Categories New" , ST_TEXTDOMAIN), $widget_ops );
        }
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            extract(wp_parse_args($instance, array(
                'title' => '',
                'show_count' => 'no',
                'hide_empty' => 'no'
            )));

            if(empty($instance['show_count']))
                $instance['show_count'] = 'no';

            if(empty($instance['hide_empty']))
                $instance['hide_empty'] = 'no';

            echo $args['before_widget'];
            if ( $title ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }
            ?>
            <?php
            $terms = get_terms( array(
                'taxonomy' => 'category',
                'hide_empty' => $instance['hide_empty'] == 'yes' ? true : false,
            ) );

            if(!is_wp_error($terms)){
                if(!empty($terms)){
                    echo '<ul>';
                    foreach ($terms as $k => $v){
                        $link = get_term_link($v->term_id, 'category');
                        $category_color = get_term_meta($v->term_id , '_category_color');
                        $scount = '';

                        if($instance['show_count'] == 'yes'){
                            $scount = ' ( '. $v->count .' )';
                        }

                        if(empty($category_color)) {
                            $category_color = '000000';
                        }else{
                            $category_color = $category_color[0];
                        }
                        echo '<li><span style="background: #'. $category_color .'"></span><a href="'. $link .'">'. $v->name . $scount . '</a></li>';
                    }
                    echo '</ul>';
                }
            }
            echo $args['after_widget'];
        }

        public function form( $instance )
        {
            $instance = wp_parse_args((array)$instance, array(
                    'title' => '',
                    'show_count' => 'no',
                    'hide_empty' => 'no'
                )
            );
            $title = $instance['title'];
            $show_count = $instance['show_count'];
            $hide_empty = $instance['hide_empty'];
            ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

            <p><label for="<?php echo $this->get_field_id('show_count'); ?>"><input class="widefat" id="<?php echo $this->get_field_id('show_count'); ?>" name="<?php echo $this->get_field_name('show_count'); ?>" type="checkbox" value="yes" <?php echo $show_count == 'yes' ? 'checked' : ''; ?> /><?php _e('Show Post Count'); ?></label></p>

            <p><label for="<?php echo $this->get_field_id('hide_empty'); ?>"><input class="widefat" id="<?php echo $this->get_field_id('hide_empty'); ?>" name="<?php echo $this->get_field_name('hide_empty'); ?>" type="checkbox" value="yes" <?php echo $hide_empty == 'yes' ? 'checked' : ''; ?> /><?php _e('Hide Empty'); ?></label></p>
            <?php
        }

        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $new_instance = wp_parse_args((array)$new_instance, array(
                'title' => '',
                'show_count' => '',
                'hide_empty' => ''
            ));
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            $instance['show_count'] = sanitize_text_field( $new_instance['show_count'] );
            $instance['hide_empty'] = sanitize_text_field( $new_instance['hide_empty'] );
            return $instance;
        }
    }

    function st_categories_wd_new() {
        register_widget( 'st_categories_new' );
    }

    add_action( 'widgets_init', 'st_categories_wd_new' );
}
