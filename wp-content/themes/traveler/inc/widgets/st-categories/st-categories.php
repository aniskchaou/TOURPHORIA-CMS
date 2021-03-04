<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14/03/2016
 * Time: 8:37 SA
 */
if (!class_exists('st_categories')){
    class st_categories extends WP_Widget {
        public function __construct() {
            $widget_ops = array('classname' => 'st_categories', 'description' => __( "A search form for your site.") );
            parent::__construct( 'st_categories',__("ST Categories" , ST_TEXTDOMAIN), $widget_ops );
        }
        public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            extract(wp_parse_args($instance , array('title'=>'','post_type'=>'','style'=>'')));
            if (empty($post_type)) return ;
            if (!empty($style) and $style =='tour_box') echo "<div class='st_tour_box_style' >";
            echo $args['before_widget'];
            if ( $title ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }
            ?>
            <?php
            echo $args['after_widget'];

            $array = explode('/',$post_type);
            $post_type = $array[0];
            $cat = $array[1];
            $terms = get_terms($cat);

            echo '<ul>';

            foreach ( $terms as $term ) {
                $page_search = st_get_page_search_result( 'st_tours' );
                if ($page_search){
                    $link_arg = array('taxonomy['.$cat.']'=>$term->term_id);
                    $term_link = add_query_arg($link_arg, get_permalink($page_search));
                }
                else {
                    $term_link = home_url("?s&post_type=".$post_type."&taxonomy[".$cat."]=".$term->term_id);
                }
                if ( is_wp_error( $term_link ) ) {
                    continue;
                }
                echo '<li><a class="text-darken" href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
            }
            echo '</ul>';
            if (!empty($style) and $style =='tour_box') echo "<div class='end1'></div><div class='end2'></div></div>";
        }
        public function form( $instance ) {
            $instance = wp_parse_args((array) $instance, array( 'title' => '','post_type'=> ''));
            $title = $instance['title'];
            ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('style') ; ?>"><?php echo __("Header style" , ST_TEXTDOMAIN) ; ?></label>
                <select id ="<?php echo $this->get_field_id('style') ; ?>" name="<?php echo $this->get_field_id('style') ; ?>">
                    <option value="" <?php if (isset($instance['style']) && $instance['style'] =="") echo "selected"; ?>>Default</option>
                    <option value="tour_box" <?php if (isset($instance['style']) && $instance['style'] =="tour_box") echo "selected"; ?>><?php echo __("Tour box style", ST_TEXTDOMAIN ) ; ?></option>
                </select>
            </p>
            <p><label for="<?php echo $this->get_field_id('post_type'); ?>"> <?php echo __("Choose a category", ST_TEXTDOMAIN ); ?>:<br>
                    <?php if(st_check_service_available('st_hotel')){ $hotel=new STHotel(); if($hotel->is_available()){?>
                        <?php
                        $taxonomies = get_object_taxonomies( 'st_hotel', 'objects' );
                        if (!empty($taxonomies) and is_array($taxonomies)) {
                            foreach ($taxonomies as $key=>$val) {
                                ?>
                                <input type="radio"
                                       id = "<?php echo $this->get_field_id('post_type').$val->labels->name; ?>"
                                       name="<?php echo $this->get_field_id('post_type'); ?>"
                                       value="st_hotel/<?php echo esc_attr($key);?>" <?php if ($instance['post_type'] =='st_hotel/'.$key){ echo "checked" ; }?>>
                                <?php
                                echo "<label for='".$this->get_field_id('post_type').$val->labels->name."''>".$val->labels->name."</label><br>";
                            }
                        }
                        ?>
                        <?php } } ?>

                    <?php if(st_check_service_available('st_rental')){ $rental=new STRental(); if($rental->is_available()){?>
                        <?php
                        $taxonomies = get_object_taxonomies( 'st_rental', 'objects' );
                        if (!empty($taxonomies) and is_array($taxonomies)) {
                            foreach ($taxonomies as $key=>$val) {
                                ?>
                                <input type="radio"
                                       id = "<?php echo $this->get_field_id('post_type').$val->labels->name; ?>"
                                       name="<?php echo $this->get_field_id('post_type'); ?>"
                                       value="st_rental/<?php echo esc_attr($key);?>" <?php if ($instance['post_type'] =='st_rental/'.$key){ echo "checked" ; }?>>
                                <?php
                                echo "<label for='".$this->get_field_id('post_type').$val->labels->name."''>".$val->labels->name."</label><br>";
                            }
                        }
                        ?>
                    <?php } } ?>

                    <?php if(st_check_service_available('st_cars')){ $st_cars=new STCars(); if($st_cars->is_available()){?>
                        <?php
                        $taxonomies = get_object_taxonomies( 'st_cars', 'objects' );
                        if (!empty($taxonomies) and is_array($taxonomies)) {
                            foreach ($taxonomies as $key=>$val) {
                                ?>
                                <input type="radio"
                                       id = "<?php echo $this->get_field_id('post_type').$val->labels->name; ?>"
                                       name="<?php echo $this->get_field_id('post_type'); ?>"
                                       value="st_cars/<?php echo esc_attr($key);?>" <?php if ($instance['post_type'] =='st_cars/'.$key){ echo "checked" ; }?>>
                                <?php
                                echo "<label for='".$this->get_field_id('post_type').$val->labels->name."''>".$val->labels->name."</label><br>";
                            }
                        }
                        ?>
                    <?php } } ?>

                    <?php if(st_check_service_available('st_tours')){ $st_tour=new STTour(); if($st_tour->is_available()){?>
                        <?php
                        $taxonomies = get_object_taxonomies( 'st_tours', 'objects' );
                        if (!empty($taxonomies) and is_array($taxonomies)) {
                            foreach ($taxonomies as $key=>$val) {
                                ?>
                                <input type="radio"
                                       id = "<?php echo $this->get_field_id('post_type').$val->labels->name; ?>"
                                       name="<?php echo $this->get_field_id('post_type'); ?>"
                                       value="st_tours/<?php echo esc_attr($key);?>" <?php if ($instance['post_type'] =='st_tours/'.$key){ echo "checked" ; }?>>
                                <?php
                                echo "<label for='".$this->get_field_id('post_type').$val->labels->name."''>".$val->labels->name."</label><br>";
                            }
                        }
                        ?>
                    <?php } } ?>

                    <?php if(st_check_service_available('st_activity')){ $activity=STActivity::inst(); if($activity->is_available()){?>
                        <?php
                        $taxonomies = get_object_taxonomies( 'st_activity', 'objects' );
                        if (!empty($taxonomies) and is_array($taxonomies)) {
                            foreach ($taxonomies as $key=>$val) {
                                ?>
                                <input type="radio"
                                       id = "<?php echo $this->get_field_id('post_type').$val->labels->name; ?>"
                                       name="<?php echo $this->get_field_id('post_type'); ?>"
                                       value="st_activity/<?php echo esc_attr($key);?>" <?php if ($instance['post_type'] =='st_activity/'.$key){ echo "checked" ; }?>>
                                <?php
                                echo "<label for='".$this->get_field_id('post_type').$val->labels->name."''>".$val->labels->name."</label><br>";
                            }
                        }
                        ?>
                    <?php } } ?>
                </label></p>
            <?php
        }
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            if (!empty($_POST[$this->get_field_id('post_type')])){$new_instance['post_type'] = $_POST[$this->get_field_id('post_type')]; }
            if (!empty($_POST[$this->get_field_id('style')])){$new_instance['style'] = $_POST[$this->get_field_id('style')]; }
            $new_instance = wp_parse_args((array) $new_instance, array( 'title' => '','post_type'=> ''));
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            $instance['post_type'] = sanitize_text_field( $new_instance['post_type'] );
            $instance['style'] = sanitize_text_field( $new_instance['style'] );
            return $instance;
        }
    }
    function st_categories_wd() {
        register_widget( 'st_categories' );
    }

    add_action( 'widgets_init', 'st_categories_wd' );
}
