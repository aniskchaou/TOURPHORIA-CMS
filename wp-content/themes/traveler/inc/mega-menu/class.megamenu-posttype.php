<?php
class ST_Mega_Menu_Post_Type{

    protected $post_type = 'st_mega_menu';

    public function __construct()
    {
        add_action('init', [$this, 'init_post_type']);
    }

    function init_post_type()
    {
        if ( !st_check_service_available( $this->post_type ) ) {
            return;
        }

        if ( !function_exists( 'st_reg_post_type' ) ) return;

        $labels = [
            'name'                  => __( 'Mega Menus', ST_TEXTDOMAIN ),
            'singular_name'         => __( 'Mega Menu', ST_TEXTDOMAIN ),
            'menu_name'             => __( 'Mega Menu', ST_TEXTDOMAIN ),
            'name_admin_bar'        => __( 'Mega Menu', ST_TEXTDOMAIN ),
            'add_new'               => __( 'Add New', ST_TEXTDOMAIN ),
            'add_new_item'          => __( 'Add New Mega Menu', ST_TEXTDOMAIN ),
            'new_item'              => __( 'New Mega Menu', ST_TEXTDOMAIN ),
            'edit_item'             => __( 'Edit Mega Menu', ST_TEXTDOMAIN ),
            'view_item'             => __( 'View Mega Menu', ST_TEXTDOMAIN ),
            'all_items'             => __( 'All Mega Menu', ST_TEXTDOMAIN ),
            'search_items'          => __( 'Search Mega Menu', ST_TEXTDOMAIN ),
            'parent_item_colon'     => __( 'Parent Mega Menu:', ST_TEXTDOMAIN ),
            'not_found'             => __( 'No Mega Menu found.', ST_TEXTDOMAIN ),
            'not_found_in_trash'    => __( 'No Mega Menu found in Trash.', ST_TEXTDOMAIN ),
            'insert_into_item'      => __( 'Insert into Mega Menu', ST_TEXTDOMAIN ),
            'uploaded_to_this_item' => __( "Uploaded to this Mega Menu", ST_TEXTDOMAIN ),
            'featured_image'        => __( "Feature Image", ST_TEXTDOMAIN ),
            'set_featured_image'    => __( "Set featured image", ST_TEXTDOMAIN )
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'query_var'          => false,
            'rewrite'            => false,
            'capability_type'    => 'post',
            'hierarchical'       => false,
            'supports'           => ['title', 'editor' ],
            'menu_icon'          => 'dashicons-editor-kitchensink'
        ];
        st_reg_post_type( $this->post_type, $args );
    }
}

new ST_Mega_Menu_Post_Type();