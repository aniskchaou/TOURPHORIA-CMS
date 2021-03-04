<?php

/**
* @package  Wordpress 
* @subpackage shinetheme
* @since 1.1.3
*/

/**@update 1.1.5*/
class st_location_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'st_location_widget', 
			__('ST Location list', ST_TEXTDOMAIN), 
			array( 'description' => __( 'Show list post type by criteria', ST_TEXTDOMAIN ), ) 
		);
		add_action('admin_enqueue_scripts',array($this,'add_scripts'));

	    
	}
	public function add_scripts(){
		$screen=get_current_screen();

        if($screen->base=='widgets'){
        	wp_enqueue_style('jquery-ui',get_template_directory_uri().'/css/admin/jquery-ui.min.css');
            wp_enqueue_script('location_widget',get_template_directory_uri().'/js/admin/widgets/location_widget.js',array('jquery','jquery-ui-sortable'),null,true);            
        }
	}

	public function widget( $args, $instance ) {
		$instance=wp_parse_args($instance,array(
				'location'=>'',
				'style'=>'',
				'post_type'=>'',
				'count'=>5,
				'layout'=>'',
				'header_style'=>''
			) );
		$title                 = apply_filters( 'widget_title', $instance['title'] );
		$title = apply_filters( 'widget_title', empty( $title ) ? '' : $title, $instance, $this->id_base );
		$instance['title']     = $title;
		extract($instance);
		if (!empty($header_style) and $header_style =='tour_box') echo "<div class='st_tour_box_style' >";
		echo $args['before_widget'];
		echo apply_filters('the_content',st()->load_template('location/widget/list_widget' , NULL,array('instance'=>$instance)));
		echo $args['after_widget'];
		if (!empty($header_style) and $header_style =='tour_box') echo "<div class='end1'></div><div class='end2'></div></div>";
		
	}
		
	public function form( $instance ) { 		
		$instance=wp_parse_args($instance,array(
				'title'	=> '',
				'location'=>'',
				'style'=>'',
				'post_type'=>'',
				'count'=>5,
				'layout'=>'',
				'header_style'=>''
			) );
		extract($instance);
		?>
		<div class='location_widget_item'>
			<p>
				<label> <?php _e( 'Title', ST_TEXTDOMAIN ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p><label for="<?php echo $this->get_field_id('header_style') ; ?>"><?php echo __("Header style" , ST_TEXTDOMAIN) ; ?></label>
				<select id ="<?php echo $this->get_field_id('header_style') ; ?>" name="<?php echo $this->get_field_id('header_style') ; ?>">
					<option value="" <?php if (!empty($instance['header_style']) and $instance['header_style'] =="") echo "selected"; ?>><?php echo __("Default", ST_TEXTDOMAIN ) ; ?></option>
					<option value="tour_box" <?php if (!empty($instance['header_style']) and $instance['header_style'] =="tour_box") echo "selected"; ?>><?php echo __("Tour box style", ST_TEXTDOMAIN ) ; ?></option>
				</select>
			</p>
			<p>
				<label><?php _e( 'Select post type'  , ST_TEXTDOMAIN ); ?></label> 
				<select name="<?php echo esc_attr($this->get_field_name( 'post_type' )); ?>" >
					<?php if(st_check_service_available('st_cars')){ $a = new STCars() ;if ($a->is_available()) { ?> <option <?php if ($post_type =="st_cars") echo esc_attr("selected") ; ?>  value='st_cars'>Car</option> <?php } }; ?>
					<?php if(st_check_service_available('st_hotel')){ $a = new STHotel() ;if ($a->is_available()) { ?> <option <?php if ($post_type =="st_hotel") echo esc_attr("selected") ; ?>  value='st_hotel'>Hotel</option> <?php } }; ?>
					<?php if(st_check_service_available('st_rental')){ $a = new STRental() ;if ($a->is_available()) { ?> <option <?php if ($post_type =="st_rental") echo esc_attr("selected") ; ?>  value='st_rental'>Rental</option> <?php } }; ?>
					<?php if(st_check_service_available('st_tours')){ $a = new STTour() ;if ($a->is_available()) { ?> <option <?php if ($post_type =="st_tours") echo esc_attr("selected") ; ?>  value='st_tours'>Tour</option> <?php } }; ?>
					<?php if (class_exists('STActivity') and $a = STActivity::inst() and $a->is_available()) { ?> <option <?php if ($post_type =="st_activity") echo esc_attr("selected") ; ?>  value='st_activity'>Activity</option> <?php }; ?>
				</select>
			</p>
			<p>
				<label> <?php echo __( 'Style',ST_TEXTDOMAIN ); ?></label>
				
				<select name='<?php echo esc_attr($this->get_field_name('style')); ?>'>
					<option value=''> -- Select -- </option>
					<option <?php if ($style =="latest") echo esc_attr("selected") ;?> value='latest'><?php echo __("Latest" , ST_TEXTDOMAIN) ; ?></option>
					<option <?php if ($style =="famous") echo esc_attr("selected") ;?> value='famous'><?php echo __("Famous" , ST_TEXTDOMAIN) ; ?></option>
					<option <?php if ($style =="attraction") echo esc_attr("selected") ;?> value='attraction'><?php echo __("Tour Top Attractions" , ST_TEXTDOMAIN) ; ?></option>
				</select>
			</p>
			<p>
				<label for=""><?php echo __('Layout', ST_TEXTDOMAIN) ?></label>
				<select name='<?php echo esc_attr($this->get_field_name('layout')); ?>'>
					<option <?php if ($layout =="layout 1") echo esc_attr("selected") ;?> value='layout1'><?php echo __("Layout1" , ST_TEXTDOMAIN) ; ?></option>
					<option <?php if ($layout =="layout2") echo esc_attr("selected") ;?> value='layout2'><?php echo __("Layout2" , ST_TEXTDOMAIN) ; ?></option>
				</select>
			</p>
			<p>
				<label><?php echo __("Count num",ST_TEXTDOMAIN);?> </label>
				<input type='number' 
				name='<?php echo esc_attr($this->get_field_name('count'))  ; ?>' 
				value='<?php echo esc_attr($count);?>' />
			</p>
			<p>
				<label><?php echo __("Location select" , ST_TEXTDOMAIN) ; ?></label>				
				<?php 
				$list_location = TravelerObject::get_list_location();
				$old_location = $instance['location'];
				?>
				<select name="<?php echo esc_attr($this->get_field_name('location'));?>" class="form-control">
			       <option value=""><?php _e('-- Select --',ST_TEXTDOMAIN) ?></option>
			       <?php foreach($list_location as $k=>$v): ?>
			            <option <?php if($old_location == $v['id'] ) echo 'selected' ?> value="<?php echo esc_html($v['id']) ?>">
			                <?php echo esc_html($v['title']) ?>
			            </option>
			       <?php endforeach; ?>
			   </select>
			</p>

		</div>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';		
		$instance['style']     = ( ! empty( $new_instance['style'] ) ) ? strip_tags( $new_instance['style'] ) : '';		
		$instance['layout']    = ( ! empty( $new_instance['layout'] ) ) ? strip_tags( $new_instance['layout'] ) : '';		
		$instance['post_type'] = ( ! empty( $new_instance['post_type'] ) ) ? strip_tags( $new_instance['post_type'] ) : '';
		$instance['count']     = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';		
		$instance['location']  = ( ! empty( $new_instance['location'] ) ) ? strip_tags( $new_instance['location'] ) : '';
		$instance['header_style']  = ( ! empty( $_POST[$this->get_field_id('header_style')]))? $_POST[$this->get_field_id('header_style')] : "";
		return $instance;
	}
} // Class st_location_widget ends here

// Register and load the widget
function st_location_widget() {
	register_widget( 'st_location_widget' );
}
add_action( 'widgets_init', 'st_location_widget' );