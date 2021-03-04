<?php
    if ( !class_exists( 'ST_Ical_Field' ) ) {
        class ST_Ical_Field
        {
            public $url;
            public $dir;

            function __construct()
            {

                $this->dir = st()->dir( 'plugins/ot-custom/fields/ical' );
                $this->url = st()->url( 'plugins/ot-custom/fields/ical' );


                add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ) );
                add_action('save_post', [$this, '_save_post'], 10, 2);
            }

            function init()
            {

                if ( !class_exists( 'OT_Loader' ) ) return false;


                add_filter( 'ot_option_types_array', array( $this, 'ot_add_custom_option_types' ) );

            }

            public function _save_post($post_id, $post_object){
                if(STInput::post('ical_url','') != ''){
                    update_post_meta($post_id, 'ical_url', STInput::post('ical_url',''));
                }
                return $post_id;
            }

            function add_scripts()
            {
                wp_register_script( 'ical.custom', $this->url . '/js/custom.js', array( 'jquery' ), NULL, TRUE );
                wp_register_style( 'ical.custom.css', $this->url . '/css/custom.css' );
            }

            function ot_post_select_ajax_unit_types( $array, $id )
            {
                return apply_filters( 'ical', $array, $id );
            }

            function ot_add_custom_option_types( $types )
            {
                $types[ 'ical' ] = __( 'iCal', ST_TEXTDOMAIN );

                return $types;
            }

            function load_view( $view = false, $data = array() )
            {

                if ( !$view ) $view = 'index';

                $file_name = $this->dir . '/views/' . $view . '.php';

                if ( file_exists( $file_name ) ) {
                    extract( $data );

                    ob_start();

                    include $file_name;

                    return @ob_get_clean();
                }
            }
        }

        $inventory = new ST_Ical_Field();
        $inventory->init();

        if ( !function_exists( 'ot_type_ical' ) ) {
            function ot_type_ical( $args = array() )
            {

                wp_enqueue_script( 'ical.custom' );
                wp_enqueue_style( 'ical.custom.css' );

                $inventory = new ST_Ical_Field();

                $default = array(
                    'field_name' => ''
                );
                $args = wp_parse_args( $args, $default );

                $default = array(
                    'field_desc'  => '',
                    'field_name'  => '',
                    'field_value' => '',
                    'meta'        => '',
                    'field_id'    => '',
                    'type'        => ''
                );

                $args = wp_parse_args( $args, $default );

                extract( $args );
                global $post;
                $post_id = $post->ID;
                $value = get_post_meta($post_id, 'ical_url', true);

                if ( !empty( $post_id ) ):
                    /* verify a description */
                    $has_desc = $field_desc ? TRUE : FALSE;
                    echo '<div class="format-setting type-post_select_ajax ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
                    /* description */
                    echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
                    /* format setting inner wrapper */
                    echo '<div class="format-setting-inner">';
                    /* allow fields to be filtered */
                    echo '<div class="option-tree-ui-' . $type . '-input-wrap">';
                    ?>
                    <!--<div class="widefat option-tree-ui-input ical-sync-option">
                        <input type="radio" name="type_ical" value="1" id="ical_google" checked/><label for="ical_google">Google calendar</label><br />
                        <input type="radio" name="type_ical" value="2" id="ical_airbnb" /><label for="ical_airbnb">Airbnb calendar</label>
                    </div>-->
                    <input name="ical_url" id="ical_url"
                           value="<?php echo esc_attr( $value ); ?>"
                           class="widefat option-tree-ui-input ical_input"
                           type="text">
                    <input type="hidden" name="post_id" value="<?php echo esc_attr( $post_id ); ?>">
                    <button class="button button-primary button-large"
                            id="save_ical"><?php echo __( 'Import', ST_TEXTDOMAIN ); ?></button>
                    <img class="spinner spinner-import" style="display: none; float: none; visibility: visible;"
                         src="<?php echo admin_url( '/images/spinner.gif' ); ?>" alt="spinner">
                    <p><i>
                            <?php
                                $time = get_post_meta( $post_id, 'sys_created', true );
                                if ( !empty( $time ) ) {
                                    echo '(Last updated: ' . date( 'Y-m-d H:i:s', $time ) . ')';
                                }
                            ?>
                        </i></p>
                    <div class="form-message">

                    </div>
                    <?php
                    echo '</div>';

                    echo '</div>';

                    echo '</div>';
                else:
                    ?>
                    <div class="format-setting">
                        <div
                            class="description"><?php echo __( 'This field will be shown when saved this post', ST_TEXTDOMAIN ); ?></div>
                    </div>
                    <?php
                endif;
            }
        }
    }