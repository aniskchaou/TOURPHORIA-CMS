<?php
if(!class_exists('ST_Traveler_Modern_Post_Configs')){
    class ST_Traveler_Modern_Post_Configs{
        static $_inst;

        function __construct()
        {
            add_action( 'category_add_form_fields', array($this, '__addColorPickerFieldCategory') );
            add_action( 'category_edit_form_fields', array($this, '__editColorPickerFieldCategory') );
            add_action( 'created_category', array($this, '__saveTermmeta') );
            add_action( 'edited_category',  array($this, '__saveTermmeta') );
            add_action( 'admin_enqueue_scripts', array($this, '__enqueueColorPickerCategory') );
            add_action( 'admin_print_scripts', array($this, '__initColorPicker'), 20 );
            add_filter('manage_edit-category_columns', array($this, '__addCategoryColumns'));
            add_filter('manage_category_custom_column', array($this, '__addCategoryColumnsContent'),10, 3);
        }

        public function __addCategoryColumnsContent($content, $column_name, $term_id){
            switch ($column_name) {
                case '_category_color':
                    $category_color = get_term_meta($term_id , '_category_color');
                    if($category_color) {
                        if(isset($category_color['0'])){
                            $content = '<div style="width: 50px;height:30px;background: #'. $category_color[0] .'"></div>';
                        }else{
                            $content = '___';
                        }
                    }else{
                        $content = '___';
                    }
                    break;
                default:
                    break;
            }
            return $content;
        }

        public function __addCategoryColumns($columns){
            $columns['_category_color'] = esc_html__('Color', ST_TEXTDOMAIN);
            return $columns;
        }

        public function __initColorPicker(){
            if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
                return;
            }
            ?>
            <script>
                jQuery( document ).ready( function( $ ) {
                    $( '.colorpicker' ).wpColorPicker();
                } );
            </script>
            <?php
        }

        public function __enqueueColorPickerCategory($taxonomy ){
            if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
                return;
            }
            wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_style( 'wp-color-picker' );
        }

        public function __saveTermmeta( $term_id ) {
            if( isset( $_POST['_category_color'] ) && ! empty( $_POST['_category_color'] ) ) {
                update_term_meta( $term_id, '_category_color', sanitize_hex_color_no_hash( $_POST['_category_color'] ) );
            } else {
                delete_term_meta( $term_id, '_category_color' );
            }
        }

        public function __editColorPickerFieldCategory($term ){
            $color = get_term_meta( $term->term_id, '_category_color', true );
            $color = ( ! empty( $color ) ) ? "#{$color}" : '';
            ?>
            <tr class="form-field term-colorpicker-wrap">
                <th scope="row"><label for="term-colorpicker"><?php echo __('Category Color', ST_TEXTDOMAIN); ?></label></th>
                <td>
                    <input name="_category_color" value="<?php echo $color; ?>" class="colorpicker" id="term-colorpicker" />
                </td>
            </tr>
            <?php
        }

        public function __addColorPickerFieldCategory($taxonomy ){
            ?>
            <div class="form-field term-colorpicker-wrap">
                <label for="term-colorpicker"><?php echo __('Category Color', ST_TEXTDOMAIN); ?></label>
                <input name="_category_color" value="" class="colorpicker" id="term-colorpicker" />
            </div>
            <?php
        }

        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }

    }
    ST_Traveler_Modern_Post_Configs::inst();
}