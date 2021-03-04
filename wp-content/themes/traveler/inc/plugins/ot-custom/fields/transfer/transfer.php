<?php 
if(!class_exists('ST_Transfer_Field')){
	class ST_Transfer_Field{
		public  $url;
        public $dir;

        function __construct(){

            $this->dir = st()->dir('plugins/ot-custom/fields/transfer');
            $this->url = st()->url('plugins/ot-custom/fields/transfer');


            add_action('admin_enqueue_scripts',array($this,'add_scripts'));
        }
        function init(){

            if( !class_exists( 'OT_Loader' ) ) return false;

            add_filter( 'ot_st_activity_calendar_unit_types', array($this, 'ot_post_select_ajax_unit_types'), 10, 2 );

            add_filter( 'ot_option_types_array', array($this, 'ot_add_custom_option_types'));

        }
        function add_scripts(){
        
            wp_register_script('st_transfer',$this->url.'/js/st_transfer.js',array('jquery'),null,true);
        }

        function ot_post_select_ajax_unit_types($array, $id){
            return apply_filters( 'st_transfer', $array, $id );
        }

        function ot_add_custom_option_types( $types ) {
            $types['st_transfer'] = __('Transfer',ST_TEXTDOMAIN);

            return $types;
        }
	}

    $transfer = new ST_Transfer_Field();
    $transfer->init();

    if(!function_exists('ot_type_st_transfer')){
        function ot_type_st_transfer($args = array()){
            $default=array(

            'field_post_type'=>'location',
            'field_desc'=> 'Location'
        );

            wp_enqueue_script( 'select2-lang' );
            wp_enqueue_style('st-select2' );

        $args = wp_parse_args($args,$default);


        extract($args);

        $post_type = $field_post_type;

        /* verify a description */
        $has_desc = $field_desc ? true : false;

        echo '<div class="format-setting type-post_select_ajax ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

        echo balanceTags($has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '');

        echo '<div class="format-setting-inner">';

        $pl_name='';
        $pl_desc='';

        $data_transfer = TravelHelper::transferDestination();
        
        $old_id = (int) $field_value;

        ?>
        <div class="form-group select-wrapper st-select-transfer">
            <select class="option-tree-ui-select " name="<?php echo $field_name; ?>" id="<?php echo $field_id ?>">
                <option value=""><?php echo __('Select a Destination', ST_TEXTDOMAIN) ?></option>
                <?php 
                    if(!empty($data_transfer)){
                        foreach($data_transfer as $transfer){
                            $name = ($transfer['type'] == 'hotel')? __('Hotel: ', ST_TEXTDOMAIN) : __('Airport: ', ST_TEXTDOMAIN);
                            echo '<option value="'. $transfer['id']. '" '. selected( $old_id, $transfer['id'], false ).'>'. $name. $transfer['name'] .'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <?php
        echo '</div>';
        echo '</div>';
        }
    }    
}
?>