<?php
    if(!class_exists('st_widget_search_activity')){
        class st_widget_search_activity extends WP_Widget{

            public $cache_key='st_widget_search_activity';

            public function __construct() {
                $widget_ops = array('classname' => 'st_widget_search_activity', 'description' => __( "Activity Filter Box",ST_TEXTDOMAIN) );
                parent::__construct('st_widget_search_activity', __('ST Activity Filter Box',ST_TEXTDOMAIN), $widget_ops);
                $this->alt_option_name = $this->cache_key;

                add_action( 'save_post', array($this, 'flush_widget_cache') );
                add_action( 'deleted_post', array($this, 'flush_widget_cache') );
                add_action( 'switch_theme', array($this, 'flush_widget_cache') );

                add_action('admin_enqueue_scripts',array($this,'add_scripts'));
            }

            function add_scripts()
            {


                $screen=get_current_screen();

                if($screen->base=='widgets'){
                    wp_enqueue_style('jquery-ui',get_template_directory_uri().'/css/admin/jquery-ui.min.css');
                    wp_enqueue_script('search-activity',get_template_directory_uri().'/js/admin/widgets/search-activity.js',array('jquery','jquery-ui-sortable'),null,true);
                    wp_enqueue_style('search-activity',get_template_directory_uri().'/css/admin/widgets/search-hotel.css',array('jquery-ui'));

                    wp_localize_script('search-activity','st_search_activity',array(
                        'default_item'=>$this->default_item()
                    ));
                }

            }

            public function widget($args, $instance) {


                $cache = array();
                if ( ! $this->is_preview() ) {
                    $cache = wp_cache_get( $this->cache_key, 'widget' );
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

                $default=array(
                    'title'=>__('Filter By:', ST_TEXTDOMAIN),
                    'show_attribute'=>'',
                    'st_search_fields'=>'',
                    'st_style'=>''
                );

                $instance=wp_parse_args($instance,$default);


                echo st()->load_template('activity/filter',null,array(
                    'instance'=>$instance
                ));


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

                $default=array(
                    'title'=>__('Filter By:', ST_TEXTDOMAIN),
                    'show_attribute'=>'',
                    'st_search_fields'=>'',
                    'st_style'=>''
                );

                $new_instance=wp_parse_args($new_instance,$default);

                $instance=$new_instance;


                $this->flush_widget_cache();

                $alloptions = wp_cache_get( 'alloptions', 'options' );
                if ( isset($alloptions[$this->cache_key]) )
                    delete_option($this->cache_key);

                return $instance;
            }

            public function flush_widget_cache() {
                wp_cache_delete($this->cache_key, 'widget');
            }
            function default_item($key=0,$old=array()){

                $default=array(
                    'title'=>'',
                    'field'=>'',
                    'taxonomy'=>'',
                    'order'   =>'',
                );

                extract(wp_parse_args($old,$default));



                $taxonomy_html='<select name="taxonomy['.$key.']" class="widefat field_taxonomy">';

                $tax=get_object_taxonomies('st_activity','OBJECTS');

                if(!empty($tax)){
                    foreach($tax as $key2=>$value2){
                        $taxonomy_html.="<option ".selected($key2,$taxonomy,false)." value='{$key2}'>{$value2->label}</option>";
                    }
                }
                $taxonomy_html.='</select>';



                $fields='<select name="field['.$key.']" class="widefat field_name">
                        <option '.selected('price',$field,false).' value="price">'.__('Price',ST_TEXTDOMAIN).'</option>
                        <option '.selected('rate',$field,false).' value="rate">'.__('Rate',ST_TEXTDOMAIN).'</option>
                        <option '.selected('taxonomy',$field,false).' value="taxonomy">'.__('Taxonomy',ST_TEXTDOMAIN).'</option>
                    </select>';

                return '<li class="ui-state-default">
                <p><label>'.__('Title',ST_TEXTDOMAIN).':</label><input class="widefat field_title" name="title['.$key.']" type="text" value="'.$title.'"></p>
                <input type="hidden" class="field_order" name="order['.$key.']" value="'.$key.'">
                <p><label>'.__('Field',ST_TEXTDOMAIN).':</label>'.$fields.'</p>
                <p class=""><label>'.__('Taxonomy',ST_TEXTDOMAIN).':</label>'.$taxonomy_html.'</p>
                <p class="field_tax_wrap"><a href="#" class="button st_delete_field" onclick="return false">'.__('Delete',ST_TEXTDOMAIN).'</a></p>
                </li>';
            }
            public function form( $instance ) {

                $default=array(
                    'title'=>__('Filter By:', ST_TEXTDOMAIN),
                    'show_attribute'=>'',
                    'st_search_fields'=>'',
                    'st_style'         =>'dark'
                );

                extract($instance=wp_parse_args($instance,$default));


                ?>
                <p><label for="<?php echo esc_attr($this->get_field_id( 'st_style' )); ?>"><?php _e( 'Style:' ,ST_TEXTDOMAIN ); ?></label>
                    <br>
                    <select class=" widefat field_name" id="<?php echo esc_attr($this->get_field_id( 'st_style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'st_style' )); ?>">
                        <option <?php if($st_style == 'light') echo 'selected'; ?>  value="light"><?php _e('Light',ST_TEXTDOMAIN)?>,</option>
                        <option <?php if($st_style == 'dark') echo 'selected'; ?> value="dark"><?php _e('Dark',ST_TEXTDOMAIN)?></option>
                    </select>
                </p>
                <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' ,ST_TEXTDOMAIN); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

                <div class="st-search-fields">
                    <div class="fields-form" onsubmit="return false">
                        <ul class="fields-wrap">
                            <?php $list=json_decode($st_search_fields);

                                if(!empty($list) and is_array($list)){
                                    foreach($list as $key=>$value){
                                        echo balanceTags($this->default_item($key,$value));

                                    }
                                }
                            ?>
                        </ul>
                    </div>
                    <textarea name="<?php echo esc_attr($this->get_field_name( 'st_search_fields' )); ?>" class="st_search_fields_value"><?php echo balanceTags($st_search_fields)?></textarea>
                    <a href="#" class="button st_add_field_activity" onclick="return false;"><?php _e('Add New',ST_TEXTDOMAIN)?></a>
                    <a href="#" class="button st_save_fields_activity" onclick="return false;"><?php _e('Save List',ST_TEXTDOMAIN)?></a>
                </div>
            <?php
            }
        }


        function st_search_activity_widget_register() {
            if(st_check_service_available('st_activity'))
            register_widget( 'st_widget_search_activity' );
        }

        add_action( 'widgets_init', 'st_search_activity_widget_register' );
    }
