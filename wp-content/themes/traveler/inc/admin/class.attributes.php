<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STAttribute
     *
     * Created by ShineTheme
     *
     */
    if ( !class_exists( 'STAttribute' ) ) {

        class STAttribute extends STAdmin
        {
            public static $inst;
            private $option_holder_name = 'st_attribute_taxonomy';

            function __construct()
            {
                self::$inst = &$this;
                add_action( 'admin_init', [ $this, 'copy_option_from_default' ] );
                add_action( 'admin_init', [ $this, '_coppy_default_options_to_all_option' ] );

            }

            static function get_inst()
            {
                return self::$inst;
            }

            function init()
            {
                //Check delete when availabe
                $this->delete_attributes();

                $attr_list = $this->get_attributes();

                if ( !empty( $attr_list ) ) {
                    foreach ( $attr_list as $key => $value ) {
                        // Add columns
                        add_filter( 'manage_edit-' . $key . '_columns', [
                            $this,
                            'product_cat_columns'
                        ] );
                        add_filter( 'manage_' . $key . '_custom_column', [
                            $this,
                            'product_cat_column'
                        ], 10, 3 );
                    }
                }


                $this->add_meta_field();

                //Enqueue font Icons

                add_action( 'admin_enqueue_scripts', [
                    $this,
                    'add_font_icons'
                ] );

                //Atribute
                $this->save_attributes();
            }

            function add_font_icons()
            {

            }

            public function get_key_by_language()
            {
                if ( TravelHelper::is_wpml() ) {
                    global $sitepress;

                    return $this->option_holder_name . '_' . ICL_LANGUAGE_CODE;
                }

                return $this->option_holder_name;
            }

            public function copy_option_from_default()
            {
                $option = get_option( 'st_attribute_taxonomy', [] );
                if ( TravelHelper::is_wpml() ) {
                    $langs = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );
                    if ( !empty( $langs ) ) {
                        foreach ( $langs as $lang => $data ) {
                            $old_option = get_option( $this->option_holder_name . '_' . $lang, [] );
                            if ( empty( $old_option ) ) {
                                update_option( $this->option_holder_name . '_' . $lang, $option );
                            }
                        }
                    }
                }
            }

            public function product_cat_column( $columns, $column, $id )
            {

                if ( $column == 'icon' ) {

                    $icon     = get_tax_meta( $id, 'st_icon' );
                    $icon_new = get_tax_meta( $id, 'st_icon_new' );
                    $new_layout = st()->get_option('st_theme_style', 'classic');
                    if ( !$icon_new || $new_layout != 'modern') {
                        $columns .= '<i style="font-size:24px" class="' . TravelHelper::handle_icon( $icon ) . '"></i>';
                    } else {
                        $columns .= TravelHelper::getNewIcon( $icon_new , '', '24px', '24px');
                    }


                }

                return $columns;
            }

            public function _coppy_default_options_to_all_option()
            {
                if ( !TravelHelper::is_wpml() ) {
                    return false;
                }

                global $sitepress;

                if ( $sitepress ) {
                    $default_lang = $sitepress->get_default_language();
                    $options      = get_option( $this->option_holder_name . "_" . $default_lang );

                    if ( ICL_LANGUAGE_CODE == 'all' ) {
                        update_option( $this->option_holder_name . '_' . 'all', $options );
                    }
                }

            }

            public function product_cat_columns( $columns )
            {
                $new_columns           = [];
                $new_columns[ 'cb' ]   = $columns[ 'cb' ];
                $new_columns[ 'icon' ] = __( 'Icon', ST_TEXTDOMAIN );

                unset( $columns[ 'cb' ] );

                return array_merge( $new_columns, $columns );
            }

            function fonicon_list()
            {
                $fonicon = [
                    'glass',
                    'music',
                    'search',
                    'envelope-o',
                    'heart',
                    'star',
                    'star-o',
                    'user',
                    'film',
                    'th-large',
                    'th',
                    'th-list',
                    'check',
                    'times',
                    'search-plus',
                    'search-minus',
                    'power-off',
                    'signal',
                    'gear',
                    'cog',
                    'trash-o',
                    'home',
                    'file-o',
                    'clock-o',
                    'road',
                    'download',
                    'arrow-circle-o-down',
                    'arrow-circle-o-up',
                    'inbox',
                    'play-circle-o',
                    'rotate-right',
                    'repeat',
                    'refresh',
                    'list-alt',
                    'lock',
                    'flag',
                    'headphones',
                    'volume-off',
                    'volume-down',
                    'volume-up',
                    'qrcode',
                    'barcode',
                    'tag',
                    'tags',
                    'book',
                    'bookmark',
                    'print',
                    'camera',
                    'font',
                    'bold',
                    'italic',
                    'text-height',
                    'text-width',
                    'align-left',
                    'align-center',
                    'align-right',
                    'align-justify',
                    'list',
                    'dedent',
                    'outdent',
                    'indent',
                    'video-camera',
                    'picture-o',
                    'pencil',
                    'map-marker',
                    'adjust',
                    'tint',
                    'edit',
                    'pencil-square-o',
                    'share-square-o',
                    'check-square-o',
                    'move',
                    'step-backward',
                    'fast-backward',
                    'backward',
                    'play',
                    'pause',
                    'stop',
                    'forward',
                    'fast-forward',
                    'step-forward',
                    'eject',
                    'chevron-left',
                    'chevron-right',
                    'plus-circle',
                    'minus-circle',
                    'times-circle',
                    'check-circle',
                    'question-circle',
                    'info-circle',
                    'crosshairs',
                    'times-circle-o',
                    'check-circle-o',
                    'ban',
                    'arrow-left',
                    'arrow-right',
                    'arrow-up',
                    'arrow-down',
                    'mail-forward',
                    'share',
                    'resize-full',
                    'resize-small',
                    'plus',
                    'minus',
                    'asterisk',
                    'exclamation-circle',
                    'gift',
                    'leaf',
                    'fire',
                    'eye',
                    'eye-slash',
                    'warning',
                    'exclamation-triangle',
                    'plane',
                    'calendar',
                    'random',
                    'comment',
                    'magnet',
                    'chevron-up',
                    'chevron-down',
                    'retweet',
                    'shopping-cart',
                    'folder',
                    'folder-open',
                    'resize-vertical',
                    'resize-horizontal',
                    'bar-chart-o',
                    'twitter-square',
                    'facebook-square',
                    'camera-retro',
                    'key',
                    'gears',
                    'cogs',
                    'comments',
                    'thumbs-o-up',
                    'thumbs-o-down',
                    'star-half',
                    'heart-o',
                    'sign-out',
                    'linkedin-square',
                    'thumb-tack',
                    'external-link',
                    'sign-in',
                    'trophy',
                    'github-square',
                    'upload',
                    'lemon-o',
                    'phone',
                    'square-o',
                    'bookmark-o',
                    'phone-square',
                    'twitter',
                    'facebook',
                    'github',
                    'unlock',
                    'credit-card',
                    'rss',
                    'hdd-o',
                    'bullhorn',
                    'bell',
                    'certificate',
                    'hand-o-right',
                    'hand-o-left',
                    'hand-o-up',
                    'hand-o-down',
                    'arrow-circle-left',
                    'arrow-circle-right',
                    'arrow-circle-up',
                    'arrow-circle-down',
                    'globe',
                    'wrench',
                    'tasks',
                    'filter',
                    'briefcase',
                    'fullscreen',
                    'group',
                    'chain',
                    'link',
                    'cloud',
                    'flask',
                    'cut',
                    'scissors',
                    'copy',
                    'files-o',
                    'paperclip',
                    'save',
                    'floppy-o',
                    'square',
                    'reorder',
                    'list-ul',
                    'list-ol',
                    'strikethrough',
                    'underline',
                    'table',
                    'magic',
                    'truck',
                    'pinterest',
                    'pinterest-square',
                    'google-plus-square',
                    'google-plus',
                    'money',
                    'caret-down',
                    'caret-up',
                    'caret-left',
                    'caret-right',
                    'columns',
                    'unsorted',
                    'sort',
                    'sort-down',
                    'sort-asc',
                    'sort-up',
                    'sort-desc',
                    'envelope',
                    'linkedin',
                    'rotate-left',
                    'undo',
                    'legal',
                    'gavel',
                    'dashboard',
                    'tachometer',
                    'comment-o',
                    'comments-o',
                    'flash',
                    'bolt',
                    'sitemap',
                    'umbrella',
                    'paste',
                    'clipboard',
                    'lightbulb-o',
                    'exchange',
                    'cloud-download',
                    'cloud-upload',
                    'user-md',
                    'stethoscope',
                    'suitcase',
                    'bell-o',
                    'coffee',
                    'cutlery',
                    'file-text-o',
                    'building',
                    'hospital',
                    'ambulance',
                    'medkit',
                    'fighter-jet',
                    'beer',
                    'h-square',
                    'plus-square',
                    'angle-double-left',
                    'angle-double-right',
                    'angle-double-up',
                    'angle-double-down',
                    'angle-left',
                    'angle-right',
                    'angle-up',
                    'angle-down',
                    'desktop',
                    'laptop',
                    'tablet',
                    'mobile-phone',
                    'mobile',
                    'circle-o',
                    'quote-left',
                    'quote-right',
                    'spinner',
                    'circle',
                    'mail-reply',
                    'reply',
                    'github-alt',
                    'folder-o',
                    'folder-open-o',
                    'expand-o',
                    'collapse-o',
                    'smile-o',
                    'frown-o',
                    'meh-o',
                    'gamepad',
                    'keyboard-o',
                    'flag-o',
                    'flag-checkered',
                    'terminal',
                    'code',
                    'reply-all',
                    'mail-reply-all',
                    'star-half-empty',
                    'star-half-full',
                    'star-half-o',
                    'location-arrow',
                    'crop',
                    'code-fork',
                    'unlink',
                    'chain-broken',
                    'question',
                    'info',
                    'exclamation',
                    'superscript',
                    'subscript',
                    'eraser',
                    'puzzle-piece',
                    'microphone',
                    'microphone-slash',
                    'shield',
                    'calendar-o',
                    'fire-extinguisher',
                    'rocket',
                    'maxcdn',
                    'chevron-circle-left',
                    'chevron-circle-right',
                    'chevron-circle-up',
                    'chevron-circle-down',
                    'html5',
                    'css3',
                    'anchor',
                    'unlock-o',
                    'bullseye',
                    'ellipsis-horizontal',
                    'ellipsis-vertical',
                    'rss-square',
                    'play-circle',
                    'ticket',
                    'minus-square',
                    'minus-square-o',
                    'level-up',
                    'level-down',
                    'check-square',
                    'pencil-square',
                    'external-link-square',
                    'share-square',
                    'compass',
                    'toggle-down',
                    'caret-square-o-down',
                    'toggle-up',
                    'caret-square-o-up',
                    'toggle-right',
                    'caret-square-o-right',
                    'euro',
                    'eur',
                    'gbp',
                    'dollar',
                    'usd',
                    'rupee',
                    'inr',
                    'cny',
                    'rmb',
                    'yen',
                    'jpy',
                    'ruble',
                    'rouble',
                    'rub',
                    'won',
                    'krw',
                    'bitcoin',
                    'btc',
                    'file',
                    'file-text',
                    'sort-alpha-asc',
                    'sort-alpha-desc',
                    'sort-amount-asc',
                    'sort-amount-desc',
                    'sort-numeric-asc',
                    'sort-numeric-desc',
                    'thumbs-up',
                    'thumbs-down',
                    'youtube-square',
                    'youtube',
                    'xing',
                    'xing-square',
                    'youtube-play',
                    'dropbox',
                    'stack-overflow',
                    'instagram',
                    'flickr',
                    'adn',
                    'bitbucket',
                    'bitbucket-square',
                    'tumblr',
                    'tumblr-square',
                    'long-arrow-down',
                    'long-arrow-up',
                    'long-arrow-left',
                    'long-arrow-right',
                    'apple',
                    'windows',
                    'android',
                    'linux',
                    'dribbble',
                    'skype',
                    'foursquare',
                    'trello',
                    'female',
                    'male',
                    'gittip',
                    'sun-o',
                    'moon-o',
                    'archive',
                    'bug',
                    'vk',
                    'weibo',
                    'renren',
                    'pagelines',
                    'stack-exchange',
                    'arrow-circle-o-right',
                    'arrow-circle-o-left',
                    'toggle-left',
                    'caret-square-o-left',
                    'dot-circle-o',
                    'wheelchair',
                    'vimeo-square',
                    'turkish-lira',
                    'try'
                ];

                sort( $fonicon );

                return $fonicon;
            }

            function add_meta_field()
            {

                if ( is_admin() ) {


                    $attr_list = $this->get_attributes();

                    $pages = [];

                    if ( !empty( $attr_list ) ) {
                        foreach ( $attr_list as $key => $value ) {
                            $pages[] = $key;
                        }
                    }

                    /*
                     * prefix of meta keys, optional
                     */
                    $prefix = 'st_';
                    /*
                     * configure your meta box
                     */
                    $config = [
                        'id'             => 'st_extra_infomation', // meta box id, unique per meta box
                        'title'          => __( 'Extra Information', ST_TEXTDOMAIN ), // meta box title
                        'pages'          => $pages, // taxonomy name, accept categories, post_tag and custom taxonomies
                        'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
                        'fields'         => [], // list of meta fields (can be added by field arrays)
                        'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
                        'use_with_theme' => false //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
                    ];

                    if ( !class_exists( 'Tax_Meta_Class' ) ) {
                        STFramework::write_log( 'Tax_Meta_Class not found in class.attribute.php line 121' );

                        return;
                    }

                    /*
                     * Initiate your meta box
                     */
                    $my_meta = new Tax_Meta_Class( $config );

                    /*
                     * Add fields to your meta box
                     */

                    //select field
                    $my_meta->addText( $prefix . 'icon', [
                        'name' => __( 'Icon', ST_TEXTDOMAIN ),
                        'desc' => __( 'You can upload your font-icon file in the site by navigating to Traveler Settings -> Importer Fonticon', ST_TEXTDOMAIN )
                    ] );

                    $my_meta->addText( $prefix . 'icon_new', [
                        'name' => __( 'Icon New', ST_TEXTDOMAIN ),
                        'desc' => __( 'Only use for the New Design', ST_TEXTDOMAIN )
                    ] );

                    $my_meta->Finish();
                }

            }

            function delete_attributes()
            {
                if ( isset( $_REQUEST[ 'delete' ] ) and $_REQUEST[ 'delete' ] ) {
                    $tax = $_REQUEST[ 'delete' ];
                    check_admin_referer( 'st_delete_attribute' );

                    $all = $this->get_attributes();
                    unset( $all[ $tax ] );
                    update_option( $this->get_key_by_language(), $all );

                    if ( TravelHelper::is_wpml() ) {
                        $langs = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );
                        if ( !empty( $langs ) ) {
                            foreach ( $langs as $lang => $data ) {
                                if ( $lang != ICL_LANGUAGE_CODE ) {
                                    $options = get_option( $this->option_holder_name . '_' . $lang, [] );
                                    unset( $options[ $tax ] );
                                    update_option( $this->option_holder_name . '_' . $lang, $options );
                                }
                            }
                        }
                    }
                    wp_safe_redirect( admin_url( 'admin.php?page=hotel_attributes' ) );
                    die;

                }
            }

            function save_attributes()
            {

                //Save Attribute
                if ( isset( $_REQUEST[ 'st_save_attribute' ] ) ) {
                    check_admin_referer( 'st_save_attribute' );

                    $action = isset( $_REQUEST[ 'edit' ] ) ? 'edit' : 'add';

                    $all = $this->get_attributes();
                    if ( !is_array( $all ) ) {
                        $all = [];
                    }

                    if ( is_array( $all ) ) {
                        $attribute_label     = ( isset( $_POST[ 'attribute_label' ] ) ) ? (string)stripslashes( $_POST[ 'attribute_label' ] ) : '';
                        $attribute_name      = ( isset( $_POST[ 'attribute_name' ] ) ) ? stripslashes( (string)$_POST[ 'attribute_name' ] ) : '';
                        $attribute_type      = ( isset( $_POST[ 'attribute_type' ] ) ) ? (string)stripslashes( $_POST[ 'attribute_type' ] ) : 0;
                        $attribute_post_type = ( isset( $_POST[ 'attribute_post_type' ] ) ) ? $_POST[ 'attribute_post_type' ] : '';

                        // Auto-generate the label or slug if only one of both was provided
                        if ( !$attribute_label ) {
                            $attribute_label = ucfirst( $attribute_name );
                        }

                        if ( !$attribute_name ) {
                            $attribute_name = self::convert_vi_to_en( $attribute_label );
                            $attribute_name = sanitize_title_with_dashes( stripslashes( $attribute_name ) );
                            $attribute_name = str_replace( '-', '_', $attribute_name );
                            $attribute_name = mb_strtolower( $attribute_name );
                        } elseif ( $action == 'add' or ( $action = 'edit' and !$attribute_name ) ) {
                            $attribute_name = self::convert_vi_to_en( $attribute_label );
                            $attribute_name = sanitize_title_with_dashes( stripslashes( $attribute_name ) );
                            $attribute_name = mb_strtolower( $attribute_name );
                        } else {
                            $attribute_name = mb_strtolower( $attribute_name );
                        }

                        // Forbidden attribute names
                        // http://codex.wordpress.org/Function_Reference/register_taxonomy#Reserved_Terms
                        $reserved_terms = [
                            'attachment',
                            'attachment_id',
                            'author',
                            'author_name',
                            'calendar',
                            'cat',
                            'category',
                            'category__and',
                            'category__in',
                            'category__not_in',
                            'category_name',
                            'comments_per_page',
                            'comments_popup',
                            'cpage',
                            'day',
                            'debug',
                            'error',
                            'exact',
                            'feed',
                            'hour',
                            'link_category',
                            'm',
                            'minute',
                            'monthnum',
                            'more',
                            'name',
                            'nav_menu',
                            'nopaging',
                            'offset',
                            'order',
                            'orderby',
                            'p',
                            'page',
                            'page_id',
                            'paged',
                            'pagename',
                            'pb',
                            'perm',
                            'post',
                            'post__in',
                            'post__not_in',
                            'post_format',
                            'post_mime_type',
                            'post_status',
                            'post_tag',
                            'post_type',
                            'posts',
                            'posts_per_archive_page',
                            'posts_per_page',
                            'preview',
                            'robots',
                            's',
                            'search',
                            'second',
                            'sentence',
                            'showposts',
                            'static',
                            'subpost',
                            'subpost_id',
                            'tag',
                            'tag__and',
                            'tag__in',
                            'tag__not_in',
                            'tag_id',
                            'tag_slug__and',
                            'tag_slug__in',
                            'taxonomy',
                            'tb',
                            'term',
                            'type',
                            'w',
                            'withcomments',
                            'withoutcomments',
                            'year'
                        ];

                        // Error checking
                        if ( !$attribute_name || !$attribute_label ) {
                            $error = __( 'Please, provide an attribute name, slug and type.', ST_TEXTDOMAIN );
                        } elseif ( strlen( $attribute_name ) >= 28 ) {
                            $error = sprintf( __( 'Slug “%s” is too long (28 characters max). Shorten it, please.', ST_TEXTDOMAIN ), sanitize_title( $attribute_name ) );
                        } elseif ( in_array( $attribute_name, $reserved_terms ) ) {
                            $error = sprintf( __( 'Slug “%s” is not allowed because it is a reserved term. Change it, please.', ST_TEXTDOMAIN ), sanitize_title( $attribute_name ) );
                        } else {

                            $taxonomy_exists = taxonomy_exists( $attribute_name );

                            if ( 'add' === $action && $taxonomy_exists ) {
                                $error = sprintf( __( 'Slug “%s” is already in use. Change it, please.', ST_TEXTDOMAIN ), sanitize_title( $attribute_name ) );
                            }
                            if ( 'edit' === $action ) {
                                $old_attribute_name = $_GET[ 'edit' ];
                                if ( $old_attribute_name != $attribute_name && $old_attribute_name != $attribute_name && $taxonomy_exists ) {
                                    $error = sprintf( __( 'Slug “%s” is already in use. Change it, please.', ST_TEXTDOMAIN ), sanitize_title( $attribute_name ) );
                                }
                            }

                            if ( !isset( $error ) or !$error ) {

                                $all[ $attribute_name ] = [
                                    'name'         => $attribute_label,
                                    'post_type'    => $attribute_post_type,
                                    'hierarchical' => absint( (int)$attribute_type )
                                ];
                                update_option( $this->get_key_by_language(), $all );

                                if ( TravelHelper::is_wpml() ) {
                                    $langs = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );
                                    if ( !empty( $langs ) ) {
                                        foreach ( $langs as $lang => $data ) {
                                            if ( $lang != ICL_LANGUAGE_CODE ) {
                                                $options                    = get_option( $this->option_holder_name . '_' . $lang, [] );
                                                $options[ $attribute_name ] = [
                                                    'name'         => ( $options[ $attribute_name ] != null && $action == 'edit' ) ? $options[ $attribute_name ][ 'name' ] : $attribute_label,
                                                    'post_type'    => $attribute_post_type,
                                                    'hierarchical' => absint( (int)$attribute_type )
                                                ];
                                                update_option( $this->option_holder_name . '_' . $lang, $options );
                                            }

                                        }
                                    }
                                }
                            }

                            if ( isset( $error ) and $error ) {
                                wp_die( $error );
                            }

                        }

                        if ( isset( $error ) and $error ) {
                            wp_die( $error );
                        }
                    }


                }
            }

            function convert_vi_to_en( $str )
            {
                $str = preg_replace( '/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str );
                $str = preg_replace( '/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str );
                $str = preg_replace( '/(ì|í|ị|ỉ|ĩ)/', 'i', $str );
                $str = preg_replace( '/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str );
                $str = preg_replace( '/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str );
                $str = preg_replace( '/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str );
                $str = preg_replace( '/(đ)/', 'd', $str );
                $str = preg_replace( '/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/', 'A', $str );
                $str = preg_replace( '/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/', 'E', $str );
                $str = preg_replace( '/(Ì|Í|Ị|Ỉ|Ĩ)/', 'I', $str );
                $str = preg_replace( '/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/', 'O', $str );
                $str = preg_replace( '/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/', 'U', $str );
                $str = preg_replace( '/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/', 'Y', $str );
                $str = preg_replace( '/(Đ)/', 'D', $str );

                $str = str_replace( ' ', '-', $str ); // Replaces all spaces with hyphens.
                $str = preg_replace( '/[^A-Za-z0-9\-]/', '', $str ); // Removes special chars.

                $str = preg_replace( '/-+/', '-', $str ); // Replaces multiple hyphens with single one.

                return $str;
            }


            function get_attributes()
            {

                return get_option( $this->get_key_by_language(), [] );
            }

            function content()
            {
                if ( isset( $_GET[ 'edit' ] ) and $_GET[ 'edit' ] ) {
                    $tax = $_GET[ 'edit' ];
                    $all = $this->get_attributes();

                    if ( isset( $all[ $tax ] ) ) {
                        $all[ $tax ][ 'tax' ] = $tax;

                        return $this->load_view( 'attributes/edit', false, [
                            'row'       => $all[ $tax ],
                            'class_tax' => $this
                        ] );

                    } else {

                        wp_safe_redirect( admin_url( 'admin.php?page=hotel_attributes' ) );
                        die;
                    }


                }

                return $this->load_view( 'attributes/index', false, [ 'class_tax' => $this ] );

            }

            function find_attribute( $attr, $return_type = 'bool' )
            {
                $all = $this->get_attributes();

                switch ( $return_type ) {
                    case "bool":
                        if ( isset( $all[ $attr ] ) )
                            return true;

                        return false;
                        break;

                    case "array";
                        return isset( $all[ $attr ] ) ? $all[ $attr ] : [];
                        break;
                }
            }
        }

        $a = new STAttribute();
        $a->init();
    }