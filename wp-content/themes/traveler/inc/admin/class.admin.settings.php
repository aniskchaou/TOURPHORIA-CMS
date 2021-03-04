<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 02/05/2018
 * Time: 10:58 SA
 */
class ST_Admin_Settings extends STAdmin
{
    public static $_inst;

    private static $_allSettings = [];

    public function __construct()
    {
        add_action('admin_menu', [$this, '__registerPage'], 9);
        add_action('admin_enqueue_scripts', [$this, '__addScripts']);
        add_action('wp_ajax_traveler.settings.schema', [$this, '__getSchema']);
        add_action('wp_ajax_traveler.settings.section_schema', [$this, '__getSectionSchema']);
        add_action('wp_ajax_traveler.settings.save', [$this, '__saveSettings']);
        add_action('wp_ajax_traveler.settings.post_select', [$this, '__getPostsAjax']);
        add_action('admin_notices', [$this, '__adminNoticeUpdateData']);
        add_action('wp_ajax_traveler.settings.email_document', [$this, '__getEmailDocument']);

        add_action('admin_init', [$this, 'removeThemeOptionMenu']);

        add_action('wp_ajax_st_get_icon_new', [$this, 'st_get_icon_new']);

        add_action('admin_init', array($this, '__updateThemeSettingsArr'));
    }

    public function __updateThemeSettingsArr()
    {
        $current_version = '1.1';
        $db_version = get_option('st_option_tree_settings_new_version');
        if (empty($db_version) or $db_version != $current_version) {
            $this->getAllSettings();
            $arr = self::$_allSettings;
            $options = [];

            if (!empty($arr)) {
                foreach ($arr as $k => $v) {
                    $options_old = $options;
                    $func = $v['settings'][1];
                    $options = array_merge($options_old, $this->$func());
                }
            }

            update_option('st_option_tree_settings_new', $options);
            update_option('st_option_tree_settings_new_version', $current_version);
        }
    }

    public function st_get_icon_new()
    {
        global $text;
        $text = STInput::post('text');
        $text = strtolower(trim($text));
        if (empty($text)) {
            echo json_encode([
                'status' => 0,
                'data' => __('Not found icons', ST_TEXTDOMAIN)
            ]);
            die;
        }
        include get_template_directory() . '/v2/fonts/fonts.php';
        if (!isset($fonts)) {
            echo json_encode([
                'status' => 0,
                'data' => __('Not found icons data', ST_TEXTDOMAIN)
            ]);
            die;
        }
        $results = array_filter($fonts, function ($key) {
            global $text;
            if (strpos(strtolower($key), $text) === false) {
                return false;
            } else {
                return true;
            }
        }, ARRAY_FILTER_USE_KEY);
        if (empty($results)) {
            echo json_encode([
                'status' => 0,
                'data' => __('Not found icons', ST_TEXTDOMAIN)
            ]);
            die;
        } else {
            echo json_encode([
                'status' => 1,
                'data' => $results
            ]);
            die;
        }
    }

    public function removeThemeOptionMenu()
    {
        remove_submenu_page('themes.php', 'ot-theme-options');
    }

    public function changeLinkThemeOption()
    {
        return 'st_traveler_option';
    }

    public function __adminNoticeUpdateData()
    {
        $last_sync_time = get_option('st_last_sync_availability');
        $st_import_setting_reading = get_option('st_import_setting_reading');
        if (empty($last_sync_time) and ($st_import_setting_reading == 'completed')) {
            ?>
            <div class="updated" style="padding: 10px !important;">
                <?php echo __('<b>Traveler data update</b> – We need to update your database to the latest version.', ST_TEXTDOMAIN); ?>
                <br/><br/>
                <?php echo '<a href="' . esc_url(admin_url('admin.php?page=st_sync_availability')) . '" class="button-primary">' . __('Run the updater', ST_TEXTDOMAIN) . '</a>' ?>
            </div>
            <?php
        }
    }

    public function __getPostsAjax()
    {
        $this->verifyRequest();
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $post_type = isset($_POST['post_type']) ? $_POST['post_type'] : 'page';
        $sparam = isset($_POST['sparam']) ? $_POST['sparam'] : 'page';

        $rows = [];
        switch ($sparam) {
            case 'page':
                $query = new WP_Query([
                    'post_type' => $post_type,
                    's' => $q,
                    'posts_per_page' => -1,
                    'post_status' => 'publish'
                ]);

                while ($query->have_posts()) {
                    $query->the_post();
                    $rows[] = [
                        'id' => get_the_ID(),
                        'name' => get_the_title(),
                    ];
                }
                wp_reset_postdata();
                break;
            case 'layout':
                $data_layout = st_get_layout($post_type, $q);
                if (!empty($data_layout)) {
                    foreach ($data_layout as $k => $v) {
                        $rows[] = [
                            'id' => $v['value'],
                            'name' => $v['label'],
                        ];
                    }
                }
                break;
            case 'sidebar':
                $data_sidebar = $GLOBALS['wp_registered_sidebars'];
                if (!empty($data_sidebar)) {
                    $sidebar_arr = [];
                    foreach ($data_sidebar as $k => $v) {
                        $sidebar_arr[$k] = strtolower($v['name']);
                    }

                    $input = preg_quote(strtolower($q), '~');
                    $result = preg_grep('~' . $input . '~', $sidebar_arr);

                    if (!empty($result)) {
                        foreach ($result as $k => $v) {
                            $rows[] = [
                                'id' => $k,
                                'name' => $data_sidebar[$k]['name'],
                            ];
                        }
                    }

                }

                break;
            case 'posttype_select':
                $data_post_type_select = TravelHelper::get_list_all_item_in_services($post_type, $q);
                if (!empty($data_post_type_select)) {
                    foreach ($data_post_type_select as $k => $v) {
                        $rows[] = [
                            'id' => $v['value'],
                            'name' => $v['label'],
                        ];
                    }
                }
                break;
        }
        $this->sendJson([
            'rows' => $rows
        ]);
    }

    public function __saveSettings()
    {
        $this->verifyRequest();
        $s = isset($_POST['settings']) ? $_POST['settings'] : '';
        $settings = json_decode(wp_unslash($s), true);
        if (empty($settings)) $this->sendError(esc_html__('Empty settings', 'traveler'));

        $old = get_option(st_options_id());

        $old = wp_parse_args($settings, $old);

        update_option(st_options_id(), $old);

        $this->sendJson(['message' => esc_html__('Settings Saved', 'traveler')]);
    }

    public function __addScripts()
    {
        if (!empty($_GET['page']) and $_GET['page'] == 'st_traveler_option') {
            $debug = (defined('SCRIPT_DEBUG') and SCRIPT_DEBUG) ? '' : '.min';

            $theme = wp_get_theme();
            $title = esc_html($theme->display('Name'));
            $title .= ' - ' . sprintf(__('Version %s', ST_TEXTDOMAIN), $theme->display('Version'));

            // if wpml
            if (defined('ICL_LANGUAGE_CODE') and defined('ICL_SITEPRESS_VERSION')) {
                $text = ICL_LANGUAGE_NAME ? ICL_LANGUAGE_NAME : ICL_LANGUAGE_CODE;
                $title .= ' ' . sprintf(__('for %s', ST_TEXTDOMAIN), $text);
            } else {
                // if qtranslate
                if (function_exists('qtranxf_init_language')) {
                    global $q_config;
                    $lan = $q_config['language'];
                    $title .= " " . sprintf(__('for %s', ST_TEXTDOMAIN), $q_config['language_name'][$lan]);
                }
            }

            wp_localize_script('jquery', 'traveler_settings', [
                '_s' => wp_create_nonce('traveler_settings_security'),
                'ajax_url' => admin_url('admin-ajax.php'),
                'info' => [
                    'blog_info' => get_bloginfo('title'),
                    'logo' => get_template_directory_uri() . '/css/admin/logo-st.png',
                    'name' => $title,
                ],
                'i18n' => [
                    'saveChanges' => esc_html__('Save Changes', 'traveler'),
                    'loading' => esc_html__('Loading...', 'traveler'),
                    'typing' => esc_html__('Typing to search your page...', 'traveler'),
                    'addNew' => esc_html__('Add New', 'traveler'),
                    'confirmDelete' => esc_html__('Do you want to delete', 'traveler'),
                    'language' => esc_html__('Languages', 'traveler'),
                    'defaultCurrency' => esc_html__('Default currency', 'traveler'),
                    'selectCurrency' => esc_html__('Select currency', 'traveler')
                ],
                'sections' => $this->getSections(),
            ]);
            wp_enqueue_media();
            wp_enqueue_script('tinymce_js', get_template_directory_uri() . '/js/admin/tinymce/tinymce.min.js', ['jquery'], false, true);
            wp_enqueue_style('traveler-spectrum', get_template_directory_uri() . '/assets/dist/spectrum/spectrum.css');
            wp_enqueue_script('traveler-spectrum', get_template_directory_uri() . '/assets/dist/spectrum/spectrum.js', [], null, true);
            wp_enqueue_script('traveler-settings', get_template_directory_uri() . '/assets/dist/traveler-settings' . $debug . '.js', [], null, true);
        }

    }

    public function __registerPage()
    {
        if (class_exists('Envato_WP_Toolkit')) {
            $pos = 59;
        } else
            $pos = 58;
        add_menu_page('Theme Settings', 'Theme Settings ', 'manage_options', 'st_traveler_option', [$this, '__showPage'], 'dashicons-st-traveler', $pos);
    }

    public function __showPage()
    {
        ?>
        <div class="wrap">
            <div id="traveler_settings_app"></div>
        </div>
        <?php
    }

    public function __getSchema()
    {
        $this->verifyRequest();
        $this->sendJson($this->getSchema());
    }

    public function __getSectionSchema()
    {
        $this->verifyRequest();
        $section = isset($_POST['section']) ? $_POST['section'] : '';

        $s = $this->findSection($section);
        $rs = [
            'tabs' => [],
            'fields' => [],
        ];
        $all = get_option(st_options_id());
        $model = [];
        $default = [];
        if ($s and is_callable($s['settings'])) {
            $settings = call_user_func($s['settings']);
            $lastTab = '';
            $lastSection = '';
            foreach ($settings as $index => $field) {
                if ($field['section'] != $section) continue;


                switch ($field['type']) {
                    case "list-item":
                        if (!is_array($all[$field['id']])) $all[$field['id']] = [];
                        $all[$field['id']] = array_values($all[$field['id']]);
                        break;
                    case "checkbox":
                        $all[$field['id']] = isset($all[$field['id']]) ? array_values($all[$field['id']]) : [];
                        break;

                }
                $model[$field['id']] = isset($all[$field['id']]) ? $all[$field['id']] : '';

                $field = $this->filterSettingsField($field);

                if ($field['type'] == 'tab') {
                    $lastTab = $field['id'];
                    $rs['tabs'][$lastTab] = [
                        'id' => $lastTab,
                        'title' => $field['label'],
                        'fields' => []
                    ];
                } else {
                    if ($lastTab and $lastSection == $field['section']) {
                        $rs['tabs'][$lastTab]['fields'][] = $field;
                    } else {
                        $rs['fields'][] = $field;
                    }
                }


                if (isset($field['std'])) $default[$field['id']] = $field['std'];

                $lastSection = $field['section'];
            }
        }


        $rs['fields'] = array_values($rs['fields']);
        $rs['tabs'] = array_values($rs['tabs']);
        $model = wp_parse_args($model, $default);
        $this->sendJson(['schema' => $rs, 'model' => $model]);
    }

    protected function filterSettingsField($field)
    {
        if (!empty($field['desc'])) {
            if (empty($field['v_hint'])) {
                $field['hint'] = $field['desc'];
            } else {
                if ($field['v_hint'] != 'yes') {
                    $field['hint'] = $field['desc'];
                }
            }
        }
        if ($field['type'] == 'post-select-ajax') {
            $field['sld'] = TravelHelper::getNamePropertyByID($field);
            $field['type'] = 'postSelectAjax';
        }

        if ($field['type'] == 'list-item') {
            $field['type'] = 'listItem';
        }
        if ($field['type'] == 'checkbox') {
            $field['type'] = 'checklist';
        }
        if ($field['type'] == 'upload') {
            $field['type'] = 'stUpload';
        }
        if ($field['type'] == 'colorpicker') {
            $field['type'] = 'spectrum';
        }

        if ($field['type'] == 'radio-image') {
            $field['type'] = 'radioimage';
        }

        if ($field['type'] == 'email_template_document') {
            $field['type'] = 'emailTemplateDocument';
        }

        if ($field['type'] == 'st_mapping_currency') {
            $field['type'] = 'mappingCurrency';
        }

        if ($field['type'] == 'custom-text') {
            $field['type'] = 'customText';
        }

        if ($field['type'] == 'custom-select') {
            $field['type'] = 'customSelect';
        }

        switch ($field['type']) {
            case "text":
                $field['type'] = 'textNew';
                break;
            case "number":
                $field["inputType"] = $field['type'];
                $field['type'] = 'input';
                break;
            case "textarea":
                $field['type'] = 'textAreaTiny';
                break;
            case "textarea-simple":
                $field['type'] = 'textAreaNew';
                break;
            case "select":
                $values = [];
                if (!empty($field['choices'])) {
                    foreach ($field['choices'] as $c) {
                        $values[] = [
                            'id' => $c['value'],
                            'name' => $c['label'],
                        ];
                    }
                    $field['values'] = $values;
                }
                $field['type'] = 'customSelect';
                break;
            case "checklist":
                $field['listBox'] = true;
                $values = [];
                if (!empty($field['choices'])) {
                    foreach ($field['choices'] as $c) {
                        $values[] = [
                            'value' => $c['value'],
                            'name' => $c['label'],
                        ];
                    }
                    $field['values'] = $values;
                }
                break;
            case "on-off":
                $field['type'] = 'switchNew';
                $field['textOn'] = esc_html__('On', 'traveler');
                $field['textOff'] = esc_html__('Off', 'traveler');
                $field['valueOn'] = 'on';
                $field['valueOff'] = 'off';
                break;
            case "listItem":
                if (!empty($field['settings'])) {
                    $field['settings'] = array_merge([
                        [
                            'type' => 'text',
                            'label' => esc_html__('Title', 'traveler'),
                            'id' => 'title'
                        ]
                    ], $field['settings']);
                    foreach ($field['settings'] as $k => $v) {
                        $field['settings'][$k] = $this->filterSettingsField($v);
                    }
                }
                break;
            case "st_select_tax":
                $field['type'] = 'select';
                $choices = st_get_post_taxonomy($field['post_type']);
                $values = [];
                if (!empty($choices)) {
                    foreach ($choices as $c) {
                        $values[] = [
                            'id' => $c['value'],
                            'name' => $c['label'],
                        ];
                    }
                }
                $field['values'] = $values;
                break;
        }
        $field['type'] = str_replace('-', '', $field['type']);
        $field['model'] = $field['id'];

        return $field;
    }

    public function findSection($section)
    {
        $all = $this->getAllSettings();

        foreach ($all as $v) {
            if ($v['id'] == $section) return $v;
        }

        return false;
    }

    protected function getSchema()
    {
        $schema = [];
        $model = get_option(st_options_id());
        $default = [];

        //include_once ST_TRAVELER_DIR . '/inc/st-theme-options.php';
        if (!empty($custom_settings)) {
            foreach ($custom_settings['sections'] as $section) {
                $section['fields'] = [];
                $section['tabs'] = [];
                $schema[$section['id']] = $section;
            }
        }
        $model = wp_parse_args($model, $default);

        return [
            'schema' => $schema,
            'model' => $model
        ];
    }

    protected function getSections()
    {
        $all = $this->getAllSettings();

        foreach ($all as $k => $v) {
            unset($all[$k]['settings']);
        }

        return $all;
    }

    public function __socialLoginSettings()
    {
        $settings = [];
        $settings[] = [
            'id' => 'social_fb_tab',
            'label' => __('Facebook', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_social'
        ];
        $settings[] = [
            'id' => 'social_fb_login',
            'label' => __('Facebook Login', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_social'
        ];
        $settings[] = [
            'id' => 'social_fb_app_id',
            'label' => __('Facebook App ID', ST_TEXTDOMAIN),
            'type' => 'text',
            'std' => '',
            'section' => 'option_social'
        ];

        $settings[] = [
            'id' => 'social_google_tab',
            'label' => __('Google', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_social'
        ];
        $settings[] = [
            'id' => 'social_gg_login',
            'label' => __('Google Login', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_social'
        ];
        $settings[] = [
            'id' => 'social_gg_client_id',
            'label' => __('Client ID', ST_TEXTDOMAIN),
            'type' => 'text',
            'std' => '',
            'section' => 'option_social'
        ];
        $settings[] = [
            'id' => 'social_gg_client_secret',
            'label' => __('Client Secret', ST_TEXTDOMAIN),
            'type' => 'text',
            'std' => '',
            'section' => 'option_social'
        ];
        $settings[] = [
            'id' => 'social_gg_client_redirect_uri',
            'label' => __('Origin site URL', ST_TEXTDOMAIN),
            'type' => 'text',
            'std' => '',
            'desc' => __('Example: http://yourdomain.com', ST_TEXTDOMAIN),
            'section' => 'option_social'
        ];
        $settings[] = [
            'id' => 'social_tw_tab',
            'label' => __('Twitter', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_social'
        ];
        $settings[] = [
            'id' => 'social_tw_login',
            'label' => __('Twitter Login', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_social'
        ];

        $settings[] = [
            'id' => 'social_tw_client_id',
            'label' => __('Client ID', ST_TEXTDOMAIN),
            'type' => 'text',
            'std' => '',
            'section' => 'option_social'
        ];
        $settings[] = [
            'id' => 'social_tw_client_secret',
            'label' => __('Client Secret', ST_TEXTDOMAIN),
            'type' => 'text',
            'std' => '',
            'section' => 'option_social'
        ];

        return $settings;
    }

    public function __otherSettings()
    {
        return [
            [
                'id' => 'gen_enable_smscroll',
                'label' => __('Enable Nice Scroll', ST_TEXTDOMAIN),
                'desc' => __('This allows you to turn on or off "Nice Scroll Effect"', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_bc',
                'std' => 'off'
            ],
            [
                'id' => 'sp_disable_javascript',
                'label' => __('Support Disable javascript', ST_TEXTDOMAIN),
                'desc' => __('This allows css friendly with browsers what disable javascript', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_bc',
                'std' => 'off'
            ],
            [
                'id' => 'google_api_key',
                'label' => __('Google API key', ST_TEXTDOMAIN),
                'desc' => __('Input your Google API key ', ST_TEXTDOMAIN) . "<a target='_blank' href='https://developers.google.com/maps/documentation/javascript/get-api-key'>How to get it?</a>",
                'type' => 'custom-text',
                'section' => 'option_bc',
                'std' => 'AIzaSyA1l5FlclOzqDpkx5jSH5WBcC0XFkqmYOY',
                'v_hint' => 'yes'
            ],
            [
                'id' => 'google_font_api_key',
                'label' => __('Google Fonts API key', ST_TEXTDOMAIN),
                'desc' => __('Input your Google Fonts API key ', ST_TEXTDOMAIN) . "<a target='_blank' href='https://developers.google.com/fonts/docs/developer_api'>How to get it?</a>",
                'type' => 'custom-text',
                'section' => 'option_bc',
                'v_hint' => 'yes'
            ],
            [
                'id' => 'weather_api_key',
                'label' => __('Weather API key', ST_TEXTDOMAIN),
                'desc' => __('Input your Weather API key ', ST_TEXTDOMAIN) . "<a target='_blank' href='https://home.openweathermap.org/api_keys'>openweathermap.org</a>",
                'type' => 'custom-text',
                'section' => 'option_bc',
                'std' => 'a82498aa9918914fa4ac5ba584a7e623',
                'v_hint' => 'yes'
            ],
        ];
    }

    public function __apiConfigureSettings()
    {
        return [
            [
                'id' => 'tab_general_document',
                'label' => __(' General Configure', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'booking_room_by',
                'label' => __('Booking immediately in search result page', ST_TEXTDOMAIN),
                'desc' => __('Booking immediately in search result page without go to single page', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_api_update',
                'std' => 'on',
            ],
            /*[
                    'id'        => 'st_api_external_booking',
                    'section'   => 'option_api_update',
                    'label'     => __( 'External Booking', ST_TEXTDOMAIN ),
                    'desc'      => __( 'External Booking', ST_TEXTDOMAIN ),
                    'type'      => 'on-off',
                    'std'       => 'off',
                    'condition' => ""
                ],*/
            /*[
                    'id'      => 'show_only_room_by',
                    'label'   => __( 'Show Only Room By', ST_TEXTDOMAIN ),
                    'type'    => 'checkbox',
                    'section' => 'option_api_update',
                    'choices' => [
                        [
                            'label' => __( 'All', ST_TEXTDOMAIN ),
                            'value' => 'all'
                        ],
                        [
                            'label' => __( 'Roomorama', ST_TEXTDOMAIN ),
                            'value' => 'st_roomorama'
                        ],
                    ],
                    'std'     => 'all',
                ],*/
            //TravelPayouts
            [
                'id' => 'travelpayouts_option',
                'label' => esc_html__('TravelPayouts', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_api_update'
            ],
            [
                'id' => 'tp_marker',
                'label' => esc_html__('Your Marker', ST_TEXTDOMAIN),
                'type' => 'text',
                'desc' => esc_html__('Enter your marker', ST_TEXTDOMAIN),
                'section' => 'option_api_update'
            ],
            [
                'id' => 'tp_locale_default',
                'label' => esc_html__('Default Language', ST_TEXTDOMAIN),
                'type' => 'select',
                'operator' => 'and',
                'choices' => [
                    [
                        'value' => 'ez',
                        'label' => esc_html__('Azerbaijan', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'ms',
                        'label' => esc_html__('Bahasa Melayu', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'br',
                        'label' => esc_html__('Brazilian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'bg',
                        'label' => esc_html__('Bulgarian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'zh',
                        'label' => esc_html__('Chinese', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'da',
                        'label' => esc_html__('Danish', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'de',
                        'label' => esc_html__('Deutsch (DE)', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'en',
                        'label' => esc_html__('English', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'en-AU',
                        'label' => esc_html__('English (AU)', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'en-GB',
                        'label' => esc_html__('English (GB)', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'fr',
                        'label' => esc_html__('French', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'ka',
                        'label' => esc_html__('Georgian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'el',
                        'label' => esc_html__('Greek (Modern Greek)', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'it',
                        'label' => esc_html__('Italian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'ja',
                        'label' => esc_html__('Japanese', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'lv',
                        'label' => esc_html__('Latvian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'pl',
                        'label' => esc_html__('Polish', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'pt',
                        'label' => esc_html__('Portuguese', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'ro',
                        'label' => esc_html__('Romanian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'ru',
                        'label' => esc_html__('Russian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'sr',
                        'label' => esc_html__('Serbian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'es',
                        'label' => esc_html__('Spanish', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'th',
                        'label' => esc_html__('Thai', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'tr',
                        'label' => esc_html__('Turkish', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'uk',
                        'label' => esc_html__('Ukrainian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'vi',
                        'label' => esc_html__('Vietnamese', ST_TEXTDOMAIN)
                    ],

                ],
                'section' => 'option_api_update',
                'std' => 'en'
            ],

            [
                'id' => 'tp_currency_default',
                'label' => esc_html__('Default Currency', ST_TEXTDOMAIN),
                'type' => 'select',
                'choices' => [
                    [
                        'value' => 'amd',
                        'label' => esc_html__('UAE dirham (AED)', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'amd',
                        'label' => esc_html__('Armenian Dram (AMD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'ars',
                        'label' => esc_html__('Argentine peso (ARS)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'aud',
                        'label' => esc_html__('Australian Dollar (AUD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'azn',
                        'label' => esc_html__('Azerbaijani Manat (AZN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'bdt',
                        'label' => esc_html__('Bangladeshi taka (BDT)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'bgn',
                        'label' => esc_html__('Bulgarian lev (BGN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'brl',
                        'label' => esc_html__('Brazilian real (BRL)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'byr',
                        'label' => esc_html__('Belarusian ruble (BYR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'chf',
                        'label' => esc_html__('Swiss Franc (CHF)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'clp',
                        'label' => esc_html__('Chilean peso (CLP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'cny',
                        'label' => esc_html__('Chinese Yuan (CNY)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'cop',
                        'label' => esc_html__('Colombian peso (COP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'dkk',
                        'label' => esc_html__('Danish krone (DKK)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'egp',
                        'label' => esc_html__('Egyptian Pound (EGP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'eur',
                        'label' => esc_html__('Euro (EUR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'gpb',
                        'label' => esc_html__('British Pound Sterling (GPB)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'gel',
                        'label' => esc_html__('Georgian lari (GEL)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'hkd',
                        'label' => esc_html__('Hong Kong Dollar (HKD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'huf',
                        'label' => esc_html__('Hungarian forint (HUF)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'idr',
                        'label' => esc_html__('Indonesian Rupiah (IDR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'inr',
                        'label' => esc_html__('Indian Rupee (INR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'jpy',
                        'label' => esc_html__('Japanese Yen (JPY)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'kgs',
                        'label' => esc_html__('Som (KGS)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'krw',
                        'label' => esc_html__('South Korean won (KRW)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'mxn',
                        'label' => esc_html__('Mexican peso (MXN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'myr',
                        'label' => esc_html__('Malaysian ringgit (MYR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'nok',
                        'label' => esc_html__('Norwegian Krone (NOK)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'kzt',
                        'label' => esc_html__('Kazakhstani Tenge (KZT)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'ltl',
                        'label' => esc_html__('Latvian Lat (LTL)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'nzd',
                        'label' => esc_html__('New Zealand Dollar (NZD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'pen',
                        'label' => esc_html__('Peruvian sol (PEN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'php',
                        'label' => esc_html__('Philippine Peso (PHP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'pkr',
                        'label' => esc_html__('Pakistan Rupee (PKR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'pln',
                        'label' => esc_html__('Polish zloty (PLN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'ron',
                        'label' => esc_html__('Romanian leu (RON)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'rsd',
                        'label' => esc_html__('Serbian dinar (RSD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'rub',
                        'label' => esc_html__('Russian Ruble (RUB)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'sar',
                        'label' => esc_html__('Saudi riyal (SAR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'sek',
                        'label' => esc_html__('Swedish krona (SEK)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'sgd',
                        'label' => esc_html__('Singapore Dollar (SGD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'thb',
                        'label' => esc_html__('Thai Baht (THB)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'try',
                        'label' => esc_html__('Turkish lira (TRY)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'uah',
                        'label' => esc_html__('Ukrainian Hryvnia (UAH)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'usd',
                        'label' => esc_html__('US Dollar (USD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'vnd',
                        'label' => esc_html__('Vietnamese dong (VND)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'xof',
                        'label' => esc_html__('CFA Franc (XOF)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'zar',
                        'label' => esc_html__('South African Rand (ZAR)', ST_TEXTDOMAIN)
                    ],
                ],
                'section' => 'option_api_update',
                'std' => 'usd'
            ],

            [
                'id' => 'tp_redirect_option',
                'label' => esc_html__('Use Whitelabel', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_api_update',
                'std' => 'off'
            ],
            [
                'id' => 'tp_whitelabel',
                'label' => esc_html__('Whitelabel Name', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_api_update',
                'condition' => 'tp_redirect_option:is(on)'
            ],
            [
                'id' => 'tp_whitelabel_page',
                'label' => esc_html__('Whitelabel Page Search', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'travel_payout',
                'sparam' => 'posttype_select',
                'section' => 'option_api_update',
                'condition' => 'tp_redirect_option:is(on)',
            ],
            [
                'id' => 'tp_show_api_info',
                'label' => esc_html__('Show API Info', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_api_update',
                'std' => 'on'
            ],
            //Skyscanner
            [
                'id' => 'skyscanner_option',
                'label' => esc_html__('Skyscanner', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'ss_api_key',
                'label' => esc_html__('Api Key', ST_TEXTDOMAIN),
                'type' => 'text',
                'desc' => esc_html__('Enter a api key', ST_TEXTDOMAIN),
                'section' => 'option_api_update'
            ],
            [
                'id' => 'ss_locale',
                'label' => esc_html__('Locale', ST_TEXTDOMAIN),
                'desc' => esc_html__('The locales that Skyscanner support to translate your content', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
                'std' => 'en-US',
                'type' => 'select',
                'choices' => function_exists('st_get_ss_content_array') ? st_get_ss_content_array('locale') : array()
            ],
            [
                'id' => 'ss_currency',
                'label' => esc_html__('Currency', ST_TEXTDOMAIN),
                'desc' => esc_html__('The currencies that Skyscanner support', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
                'std' => 'USD',
                'type' => 'select',
                'choices' => function_exists('st_get_ss_content_array') ? st_get_ss_content_array('currency') : array()
            ],
            [
                'id' => 'ss_market_country',
                'label' => esc_html__('Market Country', ST_TEXTDOMAIN),
                'desc' => esc_html__('The market countries that Skyscanner support', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
                'std' => 'US',
                'type' => 'select',
                'choices' => function_exists('st_get_ss_content_array') ? st_get_ss_content_array('market') : array()
            ],
            //Hotelscombined
            [
                'id' => 'hotelscb_option',
                'label' => esc_html__('HotelsCombined', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'hotelscb_aff_id',
                'label' => esc_html__('Affiliate ID', ST_TEXTDOMAIN),
                'type' => 'text',
                'desc' => esc_html__('Enter your affiliate ID', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
            ],
            [
                'id' => 'hotelscb_searchbox_id',
                'label' => esc_html__('Searchbox ID', ST_TEXTDOMAIN),
                'type' => 'text',
                'desc' => esc_html__('Enter your search box ID', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
            ],
            //Booking.com
            [
                'id' => 'bookingdc_option',
                'label' => esc_html__('Booking.com', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'bookingdc_iframe',
                'label' => __('Using iframe search form', ST_TEXTDOMAIN),
                'desc' => __('Enable iframe search form', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_api_update',
                'std' => 'on',
            ],
            [
                'id' => 'bookingdc_iframe_code',
                'label' => __('Search form code', ST_TEXTDOMAIN),
                'desc' => __('Enter your search box code from booking.com', ST_TEXTDOMAIN),
                'type' => 'textarea-simple',
                'rows' => '4',
                'condition' => 'bookingdc_iframe:is(on)',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'bookingdc_aid',
                'label' => __('Your affiliate ID', ST_TEXTDOMAIN),
                'desc' => __('Enter your affiliate ID from booking.com', ST_TEXTDOMAIN),
                'type' => 'text',
                'condition' => 'bookingdc_iframe:is(off)',
                'section' => 'option_api_update',
            ],
            /*array(
		        'id' => 'bookingdc_cname',
		        'label' => __('Cname', ST_TEXTDOMAIN),
		        'desc' => __('Enter your Cname for search box', ST_TEXTDOMAIN),
		        'type' => 'text',
		        'condition' => 'bookingdc_iframe:is(off)',
		        'section' => 'option_api_update',
	        ),*/
            /*[
                    'id'        => 'bookingdc_lang',
                    'label'     => esc_html__( 'Default Language', ST_TEXTDOMAIN ),
                    'type'      => 'select',
                    'operator'  => 'and',
                    'choices'   => [
                        [
                            'value' => 'ez',
                            'label' => esc_html__( 'Azerbaijan', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'ms',
                            'label' => esc_html__( 'Bahasa Melayu', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'br',
                            'label' => esc_html__( 'Brazilian', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'bg',
                            'label' => esc_html__( 'Bulgarian', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'zh',
                            'label' => esc_html__( 'Chinese', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'da',
                            'label' => esc_html__( 'Danish', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'de',
                            'label' => esc_html__( 'Deutsch (DE)', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'en',
                            'label' => esc_html__( 'English', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'en-AU',
                            'label' => esc_html__( 'English (AU)', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'en-GB',
                            'label' => esc_html__( 'English (GB)', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'fr',
                            'label' => esc_html__( 'French', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'ka',
                            'label' => esc_html__( 'Georgian', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'el',
                            'label' => esc_html__( 'Greek (Modern Greek)', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'it',
                            'label' => esc_html__( 'Italian', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'ja',
                            'label' => esc_html__( 'Japanese', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'lv',
                            'label' => esc_html__( 'Latvian', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'pl',
                            'label' => esc_html__( 'Polish', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'pt',
                            'label' => esc_html__( 'Portuguese', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'ro',
                            'label' => esc_html__( 'Romanian', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'ru',
                            'label' => esc_html__( 'Russian', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'sr',
                            'label' => esc_html__( 'Serbian', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'es',
                            'label' => esc_html__( 'Spanish', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'th',
                            'label' => esc_html__( 'Thai', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'tr',
                            'label' => esc_html__( 'Turkish', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'uk',
                            'label' => esc_html__( 'Ukrainian', ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'vi',
                            'label' => esc_html__( 'Vietnamese', ST_TEXTDOMAIN )
                        ],

                    ],
                    'section'   => 'option_api_update',
                    'std'       => 'en',
                    'condition' => 'bookingdc_iframe:is(off)',
                ],*/

            [
                'id' => 'bookingdc_currency',
                'label' => esc_html__('Default Currency', ST_TEXTDOMAIN),
                'type' => 'select',
                'choices' => [
                    [
                        'value' => 'amd',
                        'label' => esc_html__('UAE dirham (AED)', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'amd',
                        'label' => esc_html__('Armenian Dram (AMD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'ars',
                        'label' => esc_html__('Argentine peso (ARS)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'aud',
                        'label' => esc_html__('Australian Dollar (AUD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'azn',
                        'label' => esc_html__('Azerbaijani Manat (AZN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'bdt',
                        'label' => esc_html__('Bangladeshi taka (BDT)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'bgn',
                        'label' => esc_html__('Bulgarian lev (BGN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'brl',
                        'label' => esc_html__('Brazilian real (BRL)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'byr',
                        'label' => esc_html__('Belarusian ruble (BYR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'chf',
                        'label' => esc_html__('Swiss Franc (CHF)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'clp',
                        'label' => esc_html__('Chilean peso (CLP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'cny',
                        'label' => esc_html__('Chinese Yuan (CNY)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'cop',
                        'label' => esc_html__('Colombian peso (COP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'dkk',
                        'label' => esc_html__('Danish krone (DKK)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'egp',
                        'label' => esc_html__('Egyptian Pound (EGP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'eur',
                        'label' => esc_html__('Euro (EUR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'gpb',
                        'label' => esc_html__('British Pound Sterling (GPB)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'gel',
                        'label' => esc_html__('Georgian lari (GEL)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'hkd',
                        'label' => esc_html__('Hong Kong Dollar (HKD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'huf',
                        'label' => esc_html__('Hungarian forint (HUF)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'idr',
                        'label' => esc_html__('Indonesian Rupiah (IDR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'inr',
                        'label' => esc_html__('Indian Rupee (INR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'jpy',
                        'label' => esc_html__('Japanese Yen (JPY)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'kgs',
                        'label' => esc_html__('Som (KGS)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'krw',
                        'label' => esc_html__('South Korean won (KRW)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'mxn',
                        'label' => esc_html__('Mexican peso (MXN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'myr',
                        'label' => esc_html__('Malaysian ringgit (MYR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'nok',
                        'label' => esc_html__('Norwegian Krone (NOK)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'kzt',
                        'label' => esc_html__('Kazakhstani Tenge (KZT)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'ltl',
                        'label' => esc_html__('Latvian Lat (LTL)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'nzd',
                        'label' => esc_html__('New Zealand Dollar (NZD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'pen',
                        'label' => esc_html__('Peruvian sol (PEN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'php',
                        'label' => esc_html__('Philippine Peso (PHP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'pkr',
                        'label' => esc_html__('Pakistan Rupee (PKR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'pln',
                        'label' => esc_html__('Polish zloty (PLN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'ron',
                        'label' => esc_html__('Romanian leu (RON)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'rsd',
                        'label' => esc_html__('Serbian dinar (RSD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'rub',
                        'label' => esc_html__('Russian Ruble (RUB)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'sar',
                        'label' => esc_html__('Saudi riyal (SAR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'sek',
                        'label' => esc_html__('Swedish krona (SEK)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'sgd',
                        'label' => esc_html__('Singapore Dollar (SGD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'thb',
                        'label' => esc_html__('Thai Baht (THB)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'try',
                        'label' => esc_html__('Turkish lira (TRY)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'uah',
                        'label' => esc_html__('Ukrainian Hryvnia (UAH)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'usd',
                        'label' => esc_html__('US Dollar (USD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'vnd',
                        'label' => esc_html__('Vietnamese dong (VND)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'xof',
                        'label' => esc_html__('CFA Franc (XOF)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'zar',
                        'label' => esc_html__('South African Rand (ZAR)', ST_TEXTDOMAIN)
                    ],
                ],
                'section' => 'option_api_update',
                'std' => 'usd',
                'condition' => 'bookingdc_iframe:is(off)',
            ],
            //Expedia
            [
                'id' => 'expedia_option',
                'label' => esc_html__('Expedia', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'expedia_iframe_code',
                'label' => __('Search form code', ST_TEXTDOMAIN),
                'desc' => __('Enter your search box code from expedia', ST_TEXTDOMAIN),
                'type' => 'textarea-simple',
                'rows' => '4',
                'section' => 'option_api_update',
            ],
        ];
    }


    public function __searchSettings()
    {
        $choices = get_list_posttype();

        return [ /*------------- Search Option -----------------*/
            [
                'id' => 'search_results_view',
                'label' => __('Select default search result layout', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_search',
                'desc' => __('List view or Grid view', ST_TEXTDOMAIN),
                'choices' => [
                    [
                        'value' => 'list',
                        'label' => __('List view', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'grid',
                        'label' => __('Grid view', ST_TEXTDOMAIN)
                    ],
                ]
            ],
            [
                'id' => 'search_tabs',
                'label' => __('Display searching tabs', ST_TEXTDOMAIN),
                'desc' => __('Search Tabs on home page', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_search',
                'settings' => [
                    [
                        'id' => 'check_tab',
                        'label' => __('Show tab', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                    ],
                    [
                        'id' => 'tab_icon',
                        'label' => __('Icon', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'desc' => __('This allows you to change icon next to the title', ST_TEXTDOMAIN)
                    ],
                    [
                        'id' => 'tab_search_title',
                        'label' => __('Form Title', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'desc' => __('This allows you to change the text above the form', ST_TEXTDOMAIN)
                    ],
                    [
                        'id' => 'tab_name',
                        'label' => __('Choose Tab', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'hotel',
                                'label' => __('Hotel', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'rental',
                                'label' => __('Rental', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'tour',
                                'label' => __('Tour', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'cars',
                                'label' => __('Car', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'activities',
                                'label' => __('Activities', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'hotel_room',
                                'label' => __('Room', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'flight',
                                'label' => __('Flight', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'all_post_type',
                                'label' => __('All Post Type', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'tp_flight',
                                'label' => esc_html__('TravelPayouts Flight', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'tp_hotel',
                                'label' => esc_html__('TravelPayout Hotel', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'ss_flight',
                                'label' => esc_html__('Skyscanner Flight', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'car_transfer',
                                'label' => esc_html__('Car Transfer', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'cbapi',
                                'label' => esc_html__('Colibri API', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'hotels_combined',
                                'label' => esc_html__('HotelsCombined', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'bookingdc',
                                'label' => esc_html__('Booking.com', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'expedia',
                                'label' => esc_html__('Expedia', ST_TEXTDOMAIN)
                            ],
                        ]
                    ],
                    [
                        'id' => 'tab_html_custom',
                        'label' => __('Use HTML bellow', ST_TEXTDOMAIN),
                        'type' => 'textarea-simple',
                        'rows' => 7,
                        'desc' => __('This allows you to do short code or HTML', ST_TEXTDOMAIN)
                    ],
                ],
                'std' => [
                    [
                        'title' => 'Hotel',
                        'check_tab' => 'on',
                        'tab_icon' => 'fa-building-o',
                        'tab_search_title' => 'Search and Save on Hotels',
                        'tab_name' => 'hotel'
                    ],
                    [
                        'title' => 'Cars',
                        'check_tab' => 'on',
                        'tab_icon' => 'fa-car',
                        'tab_search_title' => 'Search for Cheap Rental Cars',
                        'tab_name' => 'cars'
                    ],
                    [
                        'title' => 'Tours',
                        'check_tab' => 'on',
                        'tab_icon' => 'fa-flag-o',
                        'tab_search_title' => 'Tours',
                        'tab_name' => 'tour'
                    ],
                    [
                        'title' => 'Rentals',
                        'check_tab' => 'on',
                        'tab_icon' => 'fa-home',
                        'tab_search_title' => 'Find Your Perfect Home',
                        'tab_name' => 'rental'
                    ],
                    [
                        'title' => 'Activity',
                        'check_tab' => 'on',
                        'tab_icon' => 'fa-bolt',
                        'tab_search_title' => 'Find Your Perfect Activity',
                        'tab_name' => 'activities'
                    ],
                ]
            ],
            [
                'id' => 'all_post_type_search_result_page',
                'label' => __('Select page display search results for all services', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_search',
            ],
            [
                'id' => 'all_post_type_search_fields',
                'label' => __('Custom search form for all services', ST_TEXTDOMAIN),
                'desc' => __('Custom search form for all services', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_search',
                'settings' => [
                    [
                        'id' => 'field_search',
                        'label' => __('Field Type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => 'address',
                                'label' => __('Address', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'item_name',
                                'label' => __('Name', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'post_type',
                                'label' => __('Post Type', ST_TEXTDOMAIN)
                            ],
                        ]
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => [
                    [
                        'title' => 'Address',
                        'layout_col' => 12,
                        'field_search' => 'address'
                    ],
                ]
            ],
            [
                'id' => 'search_header_onoff',
                'label' => __('Allow header search', ST_TEXTDOMAIN),
                'desc' => __('Allow header search', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_search',
                'std' => 'on'
            ],
            [
                'id' => 'search_header_orderby',
                'label' => __('Header search - Order by', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_search',
                'desc' => __('Header search - Order by', ST_TEXTDOMAIN),
                'condition' => 'search_header_onoff:is(on)',
                'choices' => [
                    [
                        'value' => 'none',
                        'label' => __('None', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'ID',
                        'label' => __('ID', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'author',
                        'label' => __('Author', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'title',
                        'label' => __('Title', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'name',
                        'label' => __('Name', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'date',
                        'label' => __('Date', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'rand',
                        'label' => __('Random', ST_TEXTDOMAIN)
                    ],
                ],
            ],
            [
                'id' => 'search_header_order',
                'label' => __('Header search - order', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_search',
                'desc' => __('Header search - order', ST_TEXTDOMAIN),
                'condition' => 'search_header_onoff:is(on)',
                'choices' => [
                    [
                        'value' => 'ASC',
                        'label' => __('ASC', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'DESC',
                        'label' => __('DESC', ST_TEXTDOMAIN)
                    ],
                ],
            ],
            [
                'id' => 'search_header_list',
                'label' => __('Header search - Search by', ST_TEXTDOMAIN),
                'type' => 'checkbox',
                'section' => 'option_search',
                'desc' => __('Header search - Search by', ST_TEXTDOMAIN),
                'condition' => 'search_header_onoff:is(on)',
                'choices' => $choices,
            ],
        ];
    }

    public function __emailPartnerSettings()
    {
        return [/*------------- Email Partner Template --------------------*/
            [
                'id' => 'tab_partner_email_for_admin',
                'label' => __('[Register] Email For Admin', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_partner',
            ],
            [
                'id' => 'partner_email_for_admin',
                'label' => __('[Register] Email to administrator', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_partner',
                'std' => function_exists('st_default_email_template_for_admin_partner') ? st_default_email_template_for_admin_partner() : false
            ],
            [
                'id' => 'partner_resend_email_for_admin',
                'label' => __('[Register] Resend email to administrator', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_partner',
                'std' => function_exists('st_default_email_template_for_resend_admin_partner') ? st_default_email_template_for_resend_admin_partner() : false
            ],
            [
                'id' => 'user_register_email_for_admin',
                'label' => __('[Register normal user] Email to administrator', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_partner',
                'std' => function_exists('st_default_email_register_user_normal_template_for_admin') ? st_default_email_register_user_normal_template_for_admin() : false
            ],
            [
                'id' => 'tab_partner_email_for_customer',
                'label' => __('[Register] Email for customer', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_partner',
            ],
            [
                'id' => 'partner_email_for_customer',
                'label' => __('[Register] Email to customer', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_partner',
                'std' => function_exists('st_default_email_template_for_customer_partner') ? st_default_email_template_for_customer_partner() : false
            ],
            [
                'id' => 'partner_email_approved',
                'label' => __('[Register] Email to partner', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_partner',
                'std' => function_exists('st_default_email_template_for_customer_approved_partner') ? st_default_email_template_for_customer_approved_partner() : false
            ],
            [
                'id' => 'partner_email_cancel',
                'label' => __('[Register] Email for cancellation', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_partner',
                'std' => function_exists('st_default_email_template_for_customer_cancel_partner') ? st_default_email_template_for_customer_cancel_partner() : false
            ],
            [
                'id' => 'tab_withdrawal_email_for_admin',
                'label' => __('[Withdrawal] Email For Admin', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_partner',
            ],
            [
                'id' => 'send_admin_new_request_withdrawal',
                'label' => __('[Request] Email to administrator', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_partner',
                'std' => function_exists('st_default_admin_new_request_withdrawal') ? st_default_admin_new_request_withdrawal() : false
            ],
            [
                'id' => 'send_admin_approved_withdrawal',
                'label' => __('[Approved] Email to administrator', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_partner',
                'std' => function_exists('st_default_send_admin_approved_withdrawal') ? st_default_send_admin_approved_withdrawal() : false
            ],
            [
                'id' => 'tab_withdrawal_email_for_customer',
                'label' => __('[Withdrawal] Email For Customer', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_partner',
            ],
            [
                'id' => 'send_user_new_request_withdrawal',
                'label' => __('[Request] Email to user', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_partner',
                'std' => function_exists('st_default_send_user_new_request_withdrawal') ? st_default_send_user_new_request_withdrawal() : false

            ],
            [
                'id' => 'send_user_approved_withdrawal',
                'label' => __('[Approved] Email to user', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_partner',
                'std' => function_exists('st_default_send_user_approved_withdrawal') ? st_default_send_user_approved_withdrawal() : false
            ],
            [
                'id' => 'send_user_cancel_withdrawal',
                'label' => __('[Cancel] Email to user', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_partner',
                'std' => function_exists('st_default_send_user_cancel_withdrawal') ? st_default_send_user_cancel_withdrawal() : false
            ],
            [
                'id' => 'member_packages_tab',
                'label' => __('[Membership] Email For Admin', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_partner',
            ],
            [
                'id' => 'membership_email_admin',
                'label' => __('Email for admin when have a new member.', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'section' => 'option_email_partner',
                'std' => function_exists('st_email_member_packages_admin') ? st_email_member_packages_admin() : false
            ],
            [
                'id' => 'membership_email_partner',
                'label' => __('Email for partner when have a new member.', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'section' => 'option_email_partner',
                'std' => function_exists('st_email_member_packages_partner') ? st_email_member_packages_partner() : false
            ],
            /*------------- End Email Partner Template --------------------*/
        ];
    }

    public function __partnerSettings()
    {
        return [/*------------- Option Partner Option --------------------*/
            [
                'id' => 'partner_general_tab',
                'label' => __("General Options", ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_partner',
            ],
            [
                'id' => 'enable_automatic_approval_partner',
                'label' => __('Automatic approval', ST_TEXTDOMAIN),
                'desc' => __('Partner be automatic approval.', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_partner'
            ],
            [
                'id' => 'enable_pretty_link_partner',
                'label' => __('Allowed custom sort link for partner page', ST_TEXTDOMAIN),
                'desc' => __('ON: show link of partner page in form of pretty link', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_partner'
            ],
            [
                'id' => 'slug_partner_page',
                'label' => __('Slug of the partner page', ST_TEXTDOMAIN),
                'type' => 'text',
                'std' => 'page-user-setting',
                'desc' => __('Enter slug name of partner page to show pretty link', ST_TEXTDOMAIN),
                'condition' => 'enable_pretty_link_partner:is(on)',
                'section' => 'option_partner'
            ],
            [
                'id' => 'partner_show_contact_info',
                'label' => __('Show email contact info', ST_TEXTDOMAIN),
                'desc' => __('ON: Show email of author(who posts service) in single, email page. OFF: Show email entered in metabox of service', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_partner',
                'std' => 'off',
            ],
            [
                'id' => 'partner_enable_feature',
                'label' => __('Enable Partner Feature', ST_TEXTDOMAIN),
                'desc' => __('ON: Show services for partner. OFF: Turn off services, partner is not allowed to register service, it is not displayed in dashboard', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_partner',
                'std' => 'off',
            ],
            [
                'id' => 'partner_post_by_admin',
                'label' => __('Partner\'s post must be aprroved by admin', ST_TEXTDOMAIN),
                'desc' => __('ON: When partner posts a service, it needs to be approved by administrator ', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_partner',
                'std' => 'on'
            ],
            [
                'id' => 'admin_menu_partner',
                'label' => __('Partner menubar', ST_TEXTDOMAIN),
                'desc' => __('ON: Turn on partner menubar. OFF: Turn off partner menubar', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_partner',
                'std' => 'off'
            ],

            [
                'id' => 'partner_commission',
                'label' => __('Commission(%)', ST_TEXTDOMAIN),
                'desc' => __('Enter commission of partner for admin after each item is booked ', ST_TEXTDOMAIN),
                'type' => 'number',
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'section' => 'option_partner',
            ],
            /*array(
            'id'      => 'partner_commission_required' ,
            'label'   => __( 'Commission Required' , ST_TEXTDOMAIN ) ,
            'desc'   => __( 'The payment amount must be greater than the commission' , ST_TEXTDOMAIN ) ,
            'type'    => 'on-off' ,
            'section' => 'option_partner' ,
            'std'     => 'off'
        ) ,*/
            [
                'id' => 'partner_set_feature',
                'label' => __('Partner can set featured', ST_TEXTDOMAIN),
                'section' => 'option_partner',
                'type' => 'on-off',
                'desc' => __('It allows partner to set an item to be featured', ST_TEXTDOMAIN),
                'std' => 'off'
            ],
            [
                'id' => 'partner_set_external_link',
                'label' => __('Partner can set external link for services', ST_TEXTDOMAIN),
                'section' => 'option_partner',
                'type' => 'on-off',
                'desc' => __('It allows partner to set external link for services', ST_TEXTDOMAIN),
                'std' => 'off'
            ],
            //1.3.0
            [
                'id' => 'avatar_in_list_service',
                'label' => __('Show avatar user in list services', ST_TEXTDOMAIN),
                'section' => 'option_partner',
                'type' => 'on-off',
                'std' => 'off'
            ],
            //
            [
                'id' => 'display_list_partner_info',
                'label' => __("Show contact info of partner", ST_TEXTDOMAIN),
                'desc' => __('Display or hide contact information of partner in the partner page', ST_TEXTDOMAIN),
                'type' => 'checkbox',
                'section' => 'option_partner',
                'choices' => [
                    [
                        'label' => __('All', ST_TEXTDOMAIN),
                        'value' => 'all'
                    ],
                    [
                        'label' => __('Email', ST_TEXTDOMAIN),
                        'value' => 'email'
                    ],
                    [
                        'label' => __('Phone', ST_TEXTDOMAIN),
                        'value' => 'phone'
                    ],
                    [
                        'label' => __('Email PayPal', ST_TEXTDOMAIN),
                        'value' => 'email_paypal'
                    ],
                    [
                        'label' => __('Home Airport', ST_TEXTDOMAIN),
                        'value' => 'home_airport'
                    ],
                    [
                        'label' => __('Address', ST_TEXTDOMAIN),
                        'value' => 'address'
                    ],
                    [
                        'label' => __('Description', ST_TEXTDOMAIN),
                        'value' => 'bio'
                    ]
                ],
                'std' => 'all'
            ],
            [
                'id' => 'membership_tab',
                'label' => __('Membership', ST_TEXTDOMAIN),
                'section' => 'option_partner',
                'type' => 'tab'
            ],
            [
                'id' => 'enable_membership',
                'label' => __('Enable Membership', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'section' => 'option_partner',
            ],
            [
                'id' => 'member_packages_page',
                'label' => __('Member Packages Page', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'desc' => __('Select a page for member packages page', ST_TEXTDOMAIN),
                'section' => 'option_partner'
            ],
            [
                'id' => 'member_checkout_page',
                'label' => __('Member Checkout Page', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'desc' => __('Select a checkout page for member packages', ST_TEXTDOMAIN),
                'section' => 'option_partner'
            ],
            [
                'id' => 'member_success_page',
                'label' => __('Member Checkout Success Page', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'desc' => __('Select a checkout success page for member packages', ST_TEXTDOMAIN),
                'section' => 'option_partner'
            ],
            [
                'id' => 'partner_custom_layout_tab',
                'label' => __("Layout Dashboard", ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_partner',
            ],
            [
                'id' => 'partner_custom_layout',
                'label' => __('Configuration partner profile info', ST_TEXTDOMAIN),
                'desc' => __('Show/hide sections for partner dashboard', ST_TEXTDOMAIN),
                'section' => 'option_partner',
                'type' => 'on-off',
                'std' => 'off'
            ],
            [
                'id' => 'partner_custom_layout_total_earning',
                'label' => __('Show total earning', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'desc' => __('ON: Display earnings information in accordance with time periods', ST_TEXTDOMAIN),
                'std' => "on",
                'condition' => 'partner_custom_layout:is(on)',
                'section' => 'option_partner'
            ],
            [
                'id' => 'partner_custom_layout_service_earning',
                'label' => __('Show each service earning', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'desc' => __('ON: Display earnings according to each service', ST_TEXTDOMAIN),
                'std' => "on",
                'condition' => 'partner_custom_layout:is(on)',
                'section' => 'option_partner'
            ],
            [
                'id' => 'partner_custom_layout_chart_info',
                'label' => __('Show chart info', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'desc' => __('ON: Display visual graphs to follow your earnings through each time', ST_TEXTDOMAIN),
                'std' => "on",
                'condition' => 'partner_custom_layout:is(on)',
                'section' => 'option_partner'
            ],
            [
                'id' => 'partner_custom_layout_booking_history',
                'label' => __('Show booking history', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'desc' => __('ON: Show book ing history of partner', ST_TEXTDOMAIN),
                'std' => "on",
                'condition' => 'partner_custom_layout:is(on)',
                'section' => 'option_partner'
            ],
            [
                'id' => 'partner_withdrawal_options',
                'label' => __("Withdrawal Options", ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_partner',
            ],
            [
                'id' => 'enable_withdrawal',
                'label' => __('Allow request withdrawal', ST_TEXTDOMAIN),
                'desc' => __('ON: Partner is allowed to withdraw money', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'section' => 'option_partner'
            ],
            [
                'id' => 'partner_withdrawal_payout_price_min',
                'label' => __('Minimum value request when withdrawal', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_partner',
                'desc' => __('Enter minimum value when a withdrawal is conducted', ST_TEXTDOMAIN),
                'std' => '100'
            ],
            [
                'id' => 'partner_date_payout_this_month',
                'label' => __('Date of sucessful payment in current month', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_partner',
                'desc' => __('Enter the date monthly payment. Ex: 25', ST_TEXTDOMAIN),
                'std' => '25'
            ],
            [
                'id' => 'partner_inbox_options',
                'label' => __("Inbox Options", ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_partner',
            ],
            [
                'id' => 'enable_inbox',
                'label' => __('Allow request inbox', ST_TEXTDOMAIN),
                'desc' => __('ON: Partner is allowed to inbox', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_partner'
            ],

            [
                'id' => 'enable_send_email_partner',
                'label' => __('Allow send to partner', ST_TEXTDOMAIN),
                'desc' => __('It allows partner to receive email when there is a new message', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'section' => 'option_partner'
            ],

            [
                'id' => 'enable_send_email_buyer',
                'label' => __('Allow send to buyer', ST_TEXTDOMAIN),
                'desc' => __('It allows users to receive email when there is a new message', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'section' => 'option_partner'
            ],


            /*------------- End Option Partner Option --------------------*/
        ];
    }

    public function __tourModernSettings()
    {
        return [
            [
                'id' => 'tour_modern_general',
                'type' => 'tab',
                'label' => __('General Options', ST_TEXTDOMAIN),
                'section' => 'option_tour_modern',
            ],
            [
                'id' => 'tour_modern_topbar_menu',
                'label' => __('Topbar menu options', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_tour_modern',
                'desc' => __('Select topbar item shown in topbar', ST_TEXTDOMAIN),
                'settings' => [
                    [
                        'id' => 'topbar_item',
                        'label' => __('Item', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'desc' => __('Select item', ST_TEXTDOMAIN),
                        'choices' => [
                            [
                                'value' => 'login',
                                'label' => __('Login', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'currency',
                                'label' => __('Currency', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'language',
                                'label' => __('Language', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'link',
                                'label' => __('Custom Link', ST_TEXTDOMAIN)
                            ],
                        ]
                    ],
                    [
                        'id' => 'topbar_custom_link',
                        'label' => __('Link', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'condition' => 'topbar_item:is(link)'
                    ],
                    [
                        'id' => 'topbar_custom_link_title',
                        'label' => __('Title Link', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'condition' => 'topbar_item:is(link)'
                    ],
                    [
                        'id' => 'topbar_custom_link_icon',
                        'label' => __('Icon', ST_TEXTDOMAIN),
                        'type' => 'upload',
                        'condition' => 'topbar_item:is(link)'
                    ],
                    [
                        'id' => 'topbar_position',
                        'label' => __('Position', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'left',
                                'label' => __('Left', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'right',
                                'label' => __('Right', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    public function __hotelAloneSettings()
    {
        return [/*----------- Hotel Alone Options--------------*/
            /*----------------Begin Header --------------------*/
            [
                'id' => 'hotel_alone_general_setting',
                'label' => esc_html__('General Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_hotel_alone',
            ],
            [
                'id' => 'hotel_alone_logo',
                'label' => __('Logo options', ST_TEXTDOMAIN),
                'desc' => __('To change logo', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_hotel_alone',
            ],
            [
                'id' => 'st_hotel_alone_main_color',
                'label' => __('Main Color', ST_TEXTDOMAIN),
                'desc' => __('To change the main color for web', ST_TEXTDOMAIN),
                'type' => 'colorpicker',
                'section' => 'option_hotel_alone',
                'std' => '#ed8323',

            ],
            [
                'id' => 'st_hotel_alone_footer_page',
                'label' => __('Select footer page', ST_TEXTDOMAIN),
                'desc' => __('Select the page to display as footer', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_hotel_alone',
            ],
            [
                'id' => 'st_hotel_alone_room_search_page',
                'label' => __('Select room search page', ST_TEXTDOMAIN),
                'desc' => __('Select the page to display room result', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_hotel_alone',
            ],
            [
                'id' => 'st_hotel_alone_blog_list_style',
                'label' => esc_html__('Blog style', ST_TEXTDOMAIN),
                'section' => 'option_hotel_alone',
                'type' => 'select',
                'choices' => [
                    [
                        'value' => 'list',
                        'label' => esc_html__('List', ST_TEXTDOMAIN),
                    ],
                    [
                        'value' => 'grid',
                        'label' => esc_html__('Grid', ST_TEXTDOMAIN),
                    ],
                ]
            ],

            [
                'id' => 'hotel_alone_topbar_setting',
                'label' => esc_html__('Topbar Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_hotel_alone',
            ],
            [
                'id' => 'st_hotel_alone_topbar_style',
                'label' => esc_html__('TopBar style', ST_TEXTDOMAIN),
                'desc' => esc_html__('Choose a layout for your theme', ST_TEXTDOMAIN),
                'type' => 'radio-image',
                'section' => 'option_hotel_alone',
                'std' => 'none',
                'choices' => [
                    [
                        'id' => 'none',
                        'alt' => esc_html__('No Topbar', ST_TEXTDOMAIN),
                        'src' => function_exists('st_hotel_alone_load_assets_dir') ? st_hotel_alone_load_assets_dir() . '/images/topbar/no_topbar.jpg' : ''
                    ],
                    [
                        'id' => 'style_1',
                        'alt' => esc_html__('Style 1', ST_TEXTDOMAIN),
                        'src' => function_exists('st_hotel_alone_load_assets_dir') ? st_hotel_alone_load_assets_dir() . '/images/topbar/topbar1.jpg' : ''
                    ],
                    [
                        'id' => 'style_2',
                        'alt' => esc_html__('Style 2', ST_TEXTDOMAIN),
                        'src' => function_exists('st_hotel_alone_load_assets_dir') ? st_hotel_alone_load_assets_dir() . '/images/topbar/topbar2.jpg' : ''
                    ],
                    [
                        'id' => 'style_3',
                        'alt' => esc_html__('Style 3', ST_TEXTDOMAIN),
                        'src' => function_exists('st_hotel_alone_load_assets_dir') ? st_hotel_alone_load_assets_dir() . '/images/topbar/topbar3.jpg' : ''
                    ],
                    [
                        'id' => 'style_4',
                        'alt' => esc_html__('Style 4', ST_TEXTDOMAIN),
                        'src' => function_exists('st_hotel_alone_load_assets_dir') ? st_hotel_alone_load_assets_dir() . '/images/topbar/topbar4.jpg' : ''
                    ],
                ]
            ],
            [
                'id' => 'st_hotel_alone_topbar_background_transparent',
                'label' => esc_html__("Topbar Background Transparent", ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_hotel_alone'
            ],
            [
                'id' => 'st_hotel_alone_topbar_background',
                'label' => esc_html__("Topbar Background", ST_TEXTDOMAIN),
                'desc' => esc_html__("Topbar Background", ST_TEXTDOMAIN),
                'type' => 'colorpicker',
                'section' => 'option_hotel_alone',
                'condition' => 'st_hotel_alone_topbar_background_transparent:is(off)',
                'operator' => 'or',
                'std' => '#ffffff'
            ],
            [
                'id' => 'st_hotel_alone_topbar_contact_number',
                'label' => esc_html__('Contact Number', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_hotel_alone',
            ],
            [
                'id' => 'st_hotel_alone_topbar_email_address',
                'label' => esc_html__('Email Address', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_hotel_alone',
            ],
            [
                'id' => 'st_hotel_alone_topbar_location',
                'label' => esc_html__('Location Select', ST_TEXTDOMAIN),
                'section' => 'option_hotel_alone',
                'type' => 'post-select-ajax',
                'post_type' => 'location',
                'sparam' => 'posttype_select',
            ],

            //Search form topbar
            [
                'id' => 'hotel_alone_form_search_setting',
                'label' => esc_html__('Form Search On Topbar Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_hotel_alone',
            ],
            [
                'id' => 'st_hotel_alone_topbar_title_search_form',
                'label' => esc_html__('Title Form Search', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_hotel_alone',
            ],
            [
                'id' => 'st_hotel_alone_topbar_search_form',
                'label' => esc_html__('Room search form', ST_TEXTDOMAIN),
                'desc' => esc_html__('Room search fields', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_hotel_alone',
                'std' => [
                    [
                        'title' => esc_html__('Check in', ST_TEXTDOMAIN),
                        'placeholder' => esc_html__('Check in', ST_TEXTDOMAIN),
                        'name' => 'check_in',
                        'layout_size' => 6,
                    ],
                    [
                        'title' => esc_html__('Check out', ST_TEXTDOMAIN),
                        'placeholder' => esc_html__('Check out', ST_TEXTDOMAIN),
                        'name' => 'check_out',
                        'layout_size' => 6,
                    ],
                    [
                        'title' => esc_html__('Room', ST_TEXTDOMAIN),
                        'name' => 'room_number',
                        'layout_size' => 6,
                    ],
                    [
                        'title' => esc_html__('Adult', ST_TEXTDOMAIN),
                        'name' => 'adults',
                        'layout_size' => 6,
                    ]
                ],
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => esc_html__('Field Type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => function_exists('st_hotel_alone_option_tree_convert_array') ? st_hotel_alone_option_tree_convert_array(st_hotel_alone_get_search_fields_for_element()) : array()
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => esc_html__('Placeholder', ST_TEXTDOMAIN),
                        'desc' => esc_html__('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_size',
                        'label' => esc_html__('Layout Normal Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 6,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => esc_html__('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => esc_html__('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => esc_html__('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => esc_html__('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => esc_html__('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => esc_html__('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => esc_html__('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => esc_html__('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => esc_html__('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => esc_html__('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => esc_html__('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => esc_html__('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],

                ]
            ],
            [
                'id' => 'st_hotel_alone_topbar_desc_search_form',
                'label' => esc_html__('Description', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_hotel_alone',
            ],
            //----------------------------------------------------------------------------------------------------

            [
                'id' => 'hotel_alone_menu_setting',
                'label' => esc_html__('Menu Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_hotel_alone',
            ],
            [
                'id' => 'st_hotel_alone_menu_location',
                'label' => esc_html__('Menu Select', ST_TEXTDOMAIN),
                'section' => 'option_hotel_alone',
                'type' => 'post-select-ajax',
                'post_type' => 'nav_menu',
                'sparam' => 'posttype_select',
            ],
            [
                'id' => 'st_hotel_alone_menu_style',
                'label' => esc_html__('Menu style', ST_TEXTDOMAIN),
                'desc' => esc_html__('Choose a layout for your theme', ST_TEXTDOMAIN),
                'type' => 'radio-image',
                'section' => 'option_hotel_alone',
                'choices' => [
                    [
                        'id' => 'none',
                        'alt' => esc_html__('None', ST_TEXTDOMAIN),
                        'src' => function_exists('st_hotel_alone_load_assets_dir') ? st_hotel_alone_load_assets_dir() . '/images/menu/menu_none.jpg' : ''
                    ],
                    [
                        'id' => 'style_1',
                        'alt' => esc_html__('Style 1', ST_TEXTDOMAIN),
                        'src' => function_exists('st_hotel_alone_load_assets_dir') ? st_hotel_alone_load_assets_dir() . '/images/menu/menu1.jpg' : ''
                    ],
                    [
                        'id' => 'style_2',
                        'alt' => esc_html__('Style 2', ST_TEXTDOMAIN),
                        'src' => function_exists('st_hotel_alone_load_assets_dir') ? st_hotel_alone_load_assets_dir() . '/images/menu/menu2.jpg' : ''
                    ],
                    [
                        'id' => 'style_3',
                        'alt' => esc_html__('Style 3', ST_TEXTDOMAIN),
                        'src' => function_exists('st_hotel_alone_load_assets_dir') ? st_hotel_alone_load_assets_dir() . '/images/menu/menu3.jpg' : ''
                    ],
                ],
                'std' => 'style_2'
            ],

            [
                'id' => 'st_hotel_alone_left_menu',
                'label' => esc_html__('Left Menu', ST_TEXTDOMAIN),
                'section' => 'option_hotel_alone',
                'condition' => 'st_hotel_alone_menu_style:is(style_1)',
                'type' => 'post-select-ajax',
                'post_type' => 'nav_menu',
                'sparam' => 'posttype_select',
            ],
            [
                'id' => 'st_hotel_alone_right_menu',
                'label' => esc_html__('Right Menu', ST_TEXTDOMAIN),
                'section' => 'option_hotel_alone',
                'condition' => 'st_hotel_alone_menu_style:is(style_1)',
                'type' => 'post-select-ajax',
                'post_type' => 'nav_menu',
                'sparam' => 'posttype_select',
            ],
            [
                'id' => 'st_hotel_alone_menu_color',
                'label' => esc_html__('Menu color', ST_TEXTDOMAIN),
                'type' => 'colorpicker',
                'section' => 'option_hotel_alone',
                'std' => '#fff',
            ],
            [
                'id' => 'st_hotel_alone_fixed_menu',
                'label' => esc_html__('Sticky Menu', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_hotel_alone',
                'std' => 'off',
            ],
            /*----------- End Hotel Alone Options--------------*/
        ];
    }

    public function __carsTransferSettings()
    {
        return [
            [
                'id' => 'car_transfer_search_page',
                'label' => __('Select page to show search results for transfer', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_car_transfer',
            ],
            [
                'id' => 'car_transfer_by_location',
                'label' => esc_html__('Set car transfer search field by location', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_car_transfer',
                'std' => 'off',
                'desc' => __('ON: Search car transfer by location - Off: Search car transfer by hotel/airport', ST_TEXTDOMAIN)
            ],
            [
                'id' => 'car_transfer_search_fields',
                'label' => __('Transfer Search Fields', ST_TEXTDOMAIN),
                'desc' => __('You can add, sort search fields for transfer', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_car_transfer',
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Field Type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STCarTransfer') ? STCarTransfer::get_search_fields_name() : [],
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'layout2_col',
                        'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
            ],
        ];
    }

    public function __activitySettings()
    {
        return [/*------------- Activity Option  -----------------*/
            [
                'id' => 'activity_show_calendar',
                'label' => __('Show calendar', ST_TEXTDOMAIN),
                'desc' => __('ON: Show calendar<br/>OFF: Show small calendar in form of popup', ST_TEXTDOMAIN),
                'type' => 'custom-select',
                'choices' => [
                    [
                        'label' => __('Big calendar show in content', ST_TEXTDOMAIN),
                        'value' => 'on'
                    ],
                    [
                        'label' => __('Show calendar as date picker', ST_TEXTDOMAIN),
                        'value' => 'off'
                    ],
                ],
                'section' => 'option_activity',
                'std' => 'on',
                'v_hint' => 'yes'

            ],
            [
                'id' => 'activity_show_calendar_below',
                'label' => __('Calendar position', ST_TEXTDOMAIN),
                'desc' => __('ON: Show calendar below book form<br/>OFF: Show calendar above book form', ST_TEXTDOMAIN),
                'type' => 'custom-select',
                'choices' => [
                    [
                        'label' => __('Under check availability', ST_TEXTDOMAIN),
                        'value' => 'off'
                    ],
                    [
                        'label' => __('Below check availability', ST_TEXTDOMAIN),
                        'value' => 'on'
                    ],
                ],
                'section' => 'option_activity',
                'std' => 'off',
                'condition' => 'activity_show_calendar:is(on)',
                'v_hint' => 'yes'
            ],
            [
                'id' => 'activity_search_result_page',
                'label' => __('Activity Search Result Page', ST_TEXTDOMAIN),
                'desc' => __('Select page to show search results for activity', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_activity',
            ],
            [
                'id' => 'activity_review',
                'label' => __('Review options', ST_TEXTDOMAIN),
                'desc' => __('ON: Turn on the mode for reviewing activity', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_activity',
                'std' => 'on'
            ],
            [
                'id' => 'activity_review_stats',
                'label' => __('Review criteria', ST_TEXTDOMAIN),
                'desc' => __('You can add, sort review criteria for activity', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_activity',
                'condition' => 'activity_review:is(on)',
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Stat Name', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ]
                ],
                'std' => [

                    ['title' => 'Sleep'],
                    ['title' => 'Location'],
                    ['title' => 'Service'],
                    ['title' => 'Cleanliness'],
                    ['title' => 'Room(s)'],
                ]
            ],
            [
                'id' => 'activity_layout',
                'label' => __('Activity Layout', ST_TEXTDOMAIN),
                'label' => __('Select layout to show single activity', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'st_activity',
                'sparam' => 'layout',
                'section' => 'option_activity',
            ],
            [
                'id' => 'activity_search_layout',
                'label' => __('Activity Search Layout', ST_TEXTDOMAIN),
                'desc' => __('Select layout to show search results for activity', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'st_activity_search',
                'sparam' => 'layout',
                'section' => 'option_activity',
            ],
            [
                'id' => 'activity_sidebar_pos',
                'label' => __('Sidebar Position', ST_TEXTDOMAIN),
                'desc' => __('Just apply for default search layout', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_activity',
                'condition' => 'activity_search_layout:is()',
                'choices' => [
                    [
                        'value' => 'no',
                        'label' => __('No', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'left',
                        'label' => __('Left', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'right',
                        'label' => __('Right', ST_TEXTDOMAIN)
                    ]

                ],
                'std' => 'left'
            ],
            [
                'id' => 'is_featured_search_activity',
                'label' => __('Show featured activities on top of search result', ST_TEXTDOMAIN),
                'desc' => __('ON: Show featured activities on top of result search page', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_activity'
            ],
            [
                'id' => 'activity_search_fields',
                'label' => __('Activity  Search Fields', ST_TEXTDOMAIN),
                'desc' => __('You can add, sort search fields for activity', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_activity',
                'settings' => [

                    [
                        'id' => 'activity_field_search',
                        'label' => __('Field Type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STActivity') ? STActivity::get_search_fields_name() : []
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'layout2_col',
                        'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'condition' => 'activity_field_search:is(taxonomy)',
                        'operator' => 'and',
                        'type' => 'st_select_tax',
                        'post_type' => 'st_activity'
                    ],
                    [
                        'id' => 'type_show_taxonomy_activity',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'activity_field_search:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __('Max number', ST_TEXTDOMAIN),
                        'condition' => 'activity_field_search:is(list_name)',
                        'type' => 'text',
                        'operator' => 'and',
                        'std' => '20'
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => [
                    [
                        'title' => 'Address',
                        'layout_col' => 3,
                        'layout2_col' => 6,
                        'activity_field_search' => 'address',
                        'placeholder' => __("Location/ Zipcode", ST_TEXTDOMAIN),
                    ],
                    [
                        'title' => 'From',
                        'layout_col' => 3,
                        'layout2_col' => 3,
                        'activity_field_search' => 'check_in'
                    ],
                    [
                        'title' => 'To',
                        'layout_col' => 3,
                        'layout2_col' => 3,
                        'activity_field_search' => 'check_out'
                    ],
                ]
            ],
            [
                'id' => 'allow_activity_advance_search',
                'label' => __('Allowed Activity  Advanced Search', ST_TEXTDOMAIN),
                'desc' => __('ON: Turn on thiis mode to add advanced search of activities', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_activity'
            ],
            [
                'id' => 'activity_advance_search_fields',
                'label' => __('Activity Advanced Search Fields', ST_TEXTDOMAIN),
                'desc' => __('You can add, sort advanced search fields of activity', ST_TEXTDOMAIN),
                'condition' => 'allow_activity_advance_search:is(on)',
                'type' => 'list-item',
                'section' => 'option_activity',
                'settings' => [

                    [
                        'id' => 'activity_field_search',
                        'label' => __('Field Type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STActivity') ? STActivity::get_search_fields_name() : []
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'layout2_col',
                        'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'condition' => 'activity_field_search:is(taxonomy)',
                        'operator' => 'and',
                        'type' => 'st_select_tax',
                        'post_type' => 'st_activity'
                    ],
                    [
                        'id' => 'type_show_taxonomy_activity',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'activity_field_search:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __('Max number', ST_TEXTDOMAIN),
                        'condition' => 'activity_field_search:is(list_name)',
                        'type' => 'text',
                        'operator' => 'and',
                        'std' => '20'
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => [
                    [
                        'title' => __('Taxonomy', ST_TEXTDOMAIN),
                        'layout_col' => 12,
                        'layout2_col' => 12,
                        'activity_field_search' => 'taxonomy',
                        'taxonomy' => 'attractions'
                    ],
                    [
                        'title' => __('Price Filter', ST_TEXTDOMAIN),
                        'layout_col' => 12,
                        'layout2_col' => 12,
                        'activity_field_search' => 'price_slider'
                    ],
                ]
            ],
            [
                'id' => 'st_activity_unlimited_custom_field',
                'label' => __('Activity custom fields', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_activity',
                'desc' => __('You can create custom fields for activity. Fields will be displayed in metabox of single activity', ST_TEXTDOMAIN),
                'settings' => [
                    [
                        'id' => 'type_field',
                        'label' => __('Field type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => 'text',
                                'label' => __('Text field', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'textarea',
                                'label' => __('Textarea field', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'date-picker',
                                'label' => __('Date field', ST_TEXTDOMAIN)
                            ],
                        ]

                    ],
                    [
                        'id' => 'default_field',
                        'label' => __('Default', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and'
                    ],
                ],
            ],
            [
                'id' => 'st_show_number_activity_avai',
                'label' => __('Number seat availability in list activity', ST_TEXTDOMAIN),
                'desc' => __('ON: Show number seat availability on each item in search results page', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_activity',
                'std' => 'off'
            ],
            [
                'id' => 'st_activity_icon_map_marker',
                'label' => __('Map marker icon', ST_TEXTDOMAIN),
                'desc' => __('Select map icon to show hotel on Map Google', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_activity',
                'std' => 'http://maps.google.com/mapfiles/marker_yellow.png'
            ],
            [
                'id' => 'activity_hide_partner_info',
                'label' => __('Show/hide contact info of partner', ST_TEXTDOMAIN),
                'desc' => __('Show/hide partner info in single activity', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_activity',
                'std' => 'on'
            ],
            /*------------- Activity  Option  -----------------*/
        ];
    }

    public function __tourSettings()
    {
        return [/*------------- Activity - Tour Option  -----------------*/
            [
                'id' => 'tour_show_calendar',
                'label' => __('Show calendar', ST_TEXTDOMAIN),
                'desc' => __('ON: Show calendar<br/>OFF: Show small calendar in form of popup', ST_TEXTDOMAIN),
                'type' => 'custom-select',
                'choices' => [
                    [
                        'label' => __('Big calendar show in content', ST_TEXTDOMAIN),
                        'value' => 'on'
                    ],
                    [
                        'label' => __('Show calendar as date picker', ST_TEXTDOMAIN),
                        'value' => 'off'
                    ],
                ],
                'section' => 'option_activity_tour',
                'std' => 'on',
                'v_hint' => 'yes'
            ],
            [
                'id' => 'tour_show_calendar_below',
                'label' => __('Calendar position', ST_TEXTDOMAIN),
                'desc' => __('ON: Show calendar below book form<br/>OF: Show calendar above book form', ST_TEXTDOMAIN),
                'type' => 'custom-select',
                'choices' => [
                    [
                        'label' => __('Under check availability', ST_TEXTDOMAIN),
                        'value' => 'off'
                    ],
                    [
                        'label' => __('Below check availability', ST_TEXTDOMAIN),
                        'value' => 'on'
                    ],
                ],
                'section' => 'option_activity_tour',
                'std' => 'off',
                'condition' => 'tour_show_calendar:is(on)',
                'v_hint' => 'yes'
            ],

            [
                'id' => 'activity_tour_review',
                'label' => __('Review options', ST_TEXTDOMAIN),
                'desc' => __('ON: Turn on the mode for reviewing tour', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_activity_tour',
                'std' => 'on'

            ],
            [
                'id' => 'tour_review_stats',
                'label' => __('Review criteria', ST_TEXTDOMAIN),
                'desc' => __('You can add, sort review criteria for tour', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_activity_tour',
                'condition' => 'activity_tour_review:is(on)',
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Stat Name', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ]
                ],
                'std' => [

                    ['title' => 'Sleep'],
                    ['title' => 'Location'],
                    ['title' => 'Service'],
                    ['title' => 'Cleanliness'],
                    ['title' => 'Room(s)'],
                ]
            ],
            [
                'id' => 'tours_search_result_page',
                'label' => __('Select layout for result page', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_activity_tour',
            ],
            [
                'id' => 'tours_layout',
                'label' => __('Tour Layout', ST_TEXTDOMAIN),
                'desc' => __('Select layout to show single tour ', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'st_tours',
                'sparam' => 'layout',
                'section' => 'option_activity_tour',
            ],
            [
                'id' => 'tours_search_layout',
                'label' => __('Tour Search Result Page', ST_TEXTDOMAIN),
                'desc' => __('Select page to show search results for tour', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'st_tours_search',
                'sparam' => 'layout',
                'section' => 'option_activity_tour',
            ],
            [
                'id' => 'tour_posts_per_page',
                'label' => __('Items per page', ST_TEXTDOMAIN),
                'desc' => __('Number of items on a tour results search page', ST_TEXTDOMAIN),
                'type' => 'number',
                'max' => 50,
                'min' => 1,
                'step' => 1,
                'section' => 'option_activity_tour',
                'std' => '12'

            ],
            [
                'id' => 'tour_sidebar_pos',
                'label' => __('Sidebar position', ST_TEXTDOMAIN),
                'desc' => __('Just apply for default search layout', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_activity_tour',
                'condition' => 'tours_search_layout:is()',
                'choices' => [
                    [
                        'value' => 'no',
                        'label' => __('No', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'left',
                        'label' => __('Left', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'right',
                        'label' => __('Right', ST_TEXTDOMAIN)
                    ]

                ],
                'std' => 'left'
            ],
            [
                'id' => 'is_featured_search_tour',
                'label' => __('Show featured tours on top of search result', ST_TEXTDOMAIN),
                'desc' => __('ON: Show featured tours on top of result search page', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_activity_tour'
            ],
            [
                'id' => 'activity_tour_search_fields',
                'label' => __('Tour Search Fields', ST_TEXTDOMAIN),
                'desc' => __('You can add, sort search fields for tour', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_activity_tour',
                'settings' => [

                    [
                        'id' => 'tours_field_search',
                        'label' => __('Field Type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STTour') ? STTour::get_search_fields_name() : [],
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'layout2_col',
                        'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'condition' => 'tours_field_search:is(taxonomy)',
                        'operator' => 'and',
                        'type' => 'st_select_tax',
                        'post_type' => 'st_tours'
                    ],
                    [
                        'id' => 'type_show_taxonomy_tours',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'tours_field_search:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __("Max number", ST_TEXTDOMAIN),
                        'condition' => 'tours_field_search:is(list_name)',
                        'type' => "text",
                        'std' => 20
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => [
                    [
                        'title' => __('Where', ST_TEXTDOMAIN),
                        'layout_col' => 6,
                        'layout2_col' => 6,
                        'tours_field_search' => 'address',
                        'placeholder' => __("Location/ Zipcode", ST_TEXTDOMAIN)
                    ],
                    [
                        'title' => __('Departure date', ST_TEXTDOMAIN),
                        'layout_col' => 3,
                        'layout2_col' => 3,
                        'tours_field_search' => 'check_in'
                    ],
                    [
                        'title' => __('Arrival Date', ST_TEXTDOMAIN),
                        'layout_col' => 3,
                        'layout2_col' => 3,
                        'tours_field_search' => 'check_out'
                    ],
                ]
            ],
            [
                'id' => "tour_allow_search_advance",
                'label' => __("Allowed Tour  Advanced Search", ST_TEXTDOMAIN),
                'desc' => __("ON: Turn on thiis mode to add advanced search of tour", ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => "off",
                'section' => 'option_activity_tour'
            ],
            [
                'id' => 'tour_advance_search_fields',
                'label' => __('Tour advanced search fields', ST_TEXTDOMAIN),
                'desc' => __('You can add, sort advanced search fields of tour', ST_TEXTDOMAIN),
                'condition' => 'tour_allow_search_advance:is(on)',
                'type' => 'list-item',
                'section' => 'option_activity_tour',
                'settings' => [

                    [
                        'id' => 'tours_field_search',
                        'label' => __('Field Type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STTour') ? STTour::get_search_fields_name() : [],
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'layout2_col',
                        'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'condition' => 'tours_field_search:is(taxonomy)',
                        'operator' => 'and',
                        'type' => 'st_select_tax',
                        'post_type' => 'st_tours'
                    ],
                    [
                        'id' => 'type_show_taxonomy_tours',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'tours_field_search:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __("Max number", ST_TEXTDOMAIN),
                        'condition' => 'tours_field_search:is(list_name)',
                        'type' => "text",
                        'std' => 20
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => [
                    [
                        'title' => __('Tour Duration ', ST_TEXTDOMAIN),
                        'layout_col' => 12,
                        'layout2_col' => 12,
                        'tours_field_search' => 'duration-dropdown'
                    ],
                    [
                        'title' => __('Taxonomy', ST_TEXTDOMAIN),
                        'layout_col' => 12,
                        'layout2_col' => 12,
                        'tours_field_search' => 'taxonomy',
                        'taxonomy' => 'st_tour_type'
                    ],
                ]
            ],
            [
                'id' => 'st_show_number_user_book',
                'label' => __('Number of tour booked users', ST_TEXTDOMAIN),
                'desc' => __('ON: Show number of users who booked tour on each item in search results page', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_activity_tour',
                'std' => 'off'
            ],
            [
                'id' => 'st_show_number_avai',
                'label' => __('Number seat availability in list tours', ST_TEXTDOMAIN),
                'desc' => __('ON: Show number seat availability on each item in search results page', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_activity_tour',
                'std' => 'off'
            ],
            [
                'id' => 'tours_unlimited_custom_field',
                'label' => __('Tour custom fields', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_activity_tour',
                'desc' => __('You can create custom fields for tour. Fields will be displayed in metabox of single tour', ST_TEXTDOMAIN),
                'settings' => [
                    [
                        'id' => 'type_field',
                        'label' => __('Field type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => 'text',
                                'label' => __('Text field', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'textarea',
                                'label' => __('Textarea field', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'date-picker',
                                'label' => __('Date field', ST_TEXTDOMAIN)
                            ],
                        ]

                    ],
                    [
                        'id' => 'default_field',
                        'label' => __('Default', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and'
                    ],

                ],
            ],
            [
                'id' => 'st_tours_icon_map_marker',
                'label' => __('Map marker icon', ST_TEXTDOMAIN),
                'desc' => __('Select map icon to show hotel on Map Google', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_activity_tour',
                'std' => 'http://maps.google.com/mapfiles/marker_purple.png'
            ],
            /*------------- Activity - Tour Option  -----------------*/
        ];
    }

    public function __emailTemplateSettings()
    {
        return [/*-------------Email Template ----------------*/
            [
                'id' => 'tab_email_document',
                'label' => __('Email Documents', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_template',
            ],
            [
                'id' => 'email_document',
                'label' => __('Email Documents', ST_TEXTDOMAIN),
                'type' => 'email_template_document',
                'section' => 'option_email_template',
            ],
            [
                'id' => 'tab_email_header_footer',
                'label' => __('Email Header/Footer', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_template',
            ],
            [
                'id' => 'email_head_foot_on_off',
                'label' => __('User this header and footer for all template', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_email_template',
                'std' => 'off'
            ],
            [
                'id' => 'email_header',
                'label' => __('Email header template', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_template',
                'condition' => 'email_head_foot_on_off:is(on)',
                'std' => function_exists('st_default_email_header_template') ? st_default_email_header_template() : false
            ],
            [
                'id' => 'email_footer',
                'label' => __('Email footer template', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_template',
                'condition' => 'email_head_foot_on_off:is(on)',
                'std' => function_exists('st_default_email_footer_template') ? st_default_email_footer_template() : false
            ],
            [
                'id' => 'tab_email_for_admin',
                'label' => __('Email For Admin', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_template',
            ],
            [
                'id' => 'email_for_admin',
                'label' => __('Email template send to administrator', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '10',
                'section' => 'option_email_template',
                'std' => function_exists('st_default_email_template_admin') ? st_default_email_template_admin() : false
            ],

            [
                'id' => 'tab_email_for_partner',
                'label' => __('Email For Partner', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_template',
            ],
            [
                'id' => 'email_for_partner',
                'label' => __('Email template send to partner/owner', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '50',
                'section' => 'option_email_template',
                'std' => function_exists('st_default_email_template_partner') ? st_default_email_template_partner() : false
            ],
            //Email to partner when expired date
            [
                'id' => 'email_for_partner_expired_date',
                'label' => __('Email template send to partner when package is expired date', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '50',
                'section' => 'option_email_template',
                'std' => function_exists('st_default_email_template_partner_expired_date') ? st_default_email_template_partner_expired_date() : false
            ],
            [
                'id' => 'tab_email_for_customer',
                'label' => __('Email For Customer', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_template',
            ],
            [
                'id' => 'email_for_customer',
                'label' => __('Email template for booking info send to customer', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '50',
                'section' => 'option_email_template',
                'std' => function_exists('st_default_email_template_customer') ? st_default_email_template_customer() : false
            ],
            //Email to custommer when out of date
            [
                'id' => 'email_for_customer_out_of_depature_date',
                'label' => __('Email template for notification of departure date send to customer', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '50',
                'section' => 'option_email_template',
                'std' => function_exists('st_default_email_template_notification_depature_customer') ? st_default_email_template_notification_depature_customer() : false
            ],
            [
                'id' => 'tab_email_confirm',
                'label' => __('Email Confirm', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_template',
            ],
            [
                'id' => 'email_confirm',
                'label' => __('Email template for confirm send to customer', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '50',
                'section' => 'option_email_template',
                'std' => function_exists('get_email_confirm_template') ? get_email_confirm_template() : false
            ],
            [
                'id' => 'tab_email_approved',
                'label' => __('Email Approved', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_template',
            ],
            [
                'id' => 'email_approved_subject',
                'label' => __('Email Subject', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_email_template',
                'std' => __('You have a item is approved', ST_TEXTDOMAIN),
            ],
            [
                'id' => 'email_approved',
                'label' => __('Email template for approve send to administrator', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '50',
                'section' => 'option_email_template',
                'std' => function_exists('get_email_approved_template') ? get_email_approved_template() : false
            ],
            [
                'id' => 'tab_email_cancel_booking',
                'label' => __('Email Cancel Booking', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_email_template',
            ],
            [
                'id' => 'email_has_refund',
                'label' => __('Email template for cancel booking send to administrator', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '50',
                'section' => 'option_email_template',
                'std' => function_exists('get_email_has_refund_template') ? get_email_has_refund_template() : false
            ],
            [
                'id' => 'email_has_refund_for_partner',
                'label' => __('Email template for cancel booking send to partner', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '50',
                'section' => 'option_email_template',
                'std' => function_exists('get_email_has_refund_for_partner_template') ? get_email_has_refund_for_partner_template() : false
            ],
            [
                'id' => 'email_cancel_booking_success_for_partner',
                'label' => __('Email template for successful canceled send to partner', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '100',
                'section' => 'option_email_template',
                'std' => function_exists('get_email_cancel_booking_success_for_partner_template') ? get_email_cancel_booking_success_for_partner_template() : false
            ],
            [
                'id' => 'email_cancel_booking_success',
                'label' => __('Email template for successful canceled send to customer', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '100',
                'section' => 'option_email_template',
                'std' => function_exists('get_email_cancel_booking_success_template') ? get_email_cancel_booking_success_template() : false
            ],

            /*------------- End Email Template ----------------*/
        ];
    }

    public function __emailSettings()
    {
        return [
            /*------------ Begin Email Option --------------*/

            [
                'id' => 'email_from',
                'label' => __('From name', ST_TEXTDOMAIN),
                'desc' => __('Email from name', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_email',
                'std' => 'Traveler Shinetheme'

            ],
            [
                'id' => 'email_from_address',
                'label' => __('From address', ST_TEXTDOMAIN),
                'desc' => __('Email from address', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_email',
                'std' => 'traveler@shinetheme.com'

            ],
            [
                'id' => 'email_logo',
                'label' => __('Select logo in email', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_email',
                'desc' => __('Logo in Email', ST_TEXTDOMAIN),
                'std' => get_template_directory_uri() . '/img/logo.png'

            ],
            [
                'id' => 'enable_email_for_custommer',
                'label' => __('Email to customer after booking', ST_TEXTDOMAIN),
                'desc' => __('Email to customer after booking', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'section' => 'option_email',
            ],
            [
                'id' => 'enable_email_confirm_for_customer',
                'label' => __('Email confirm to customer after booking', ST_TEXTDOMAIN),
                'desc' => __('Email confirm to customer after booking', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'section' => 'option_email',
                //'condition' => 'enable_email_for_custommer:is(on)' ,
            ],
            [
                'id' => 'enable_email_for_admin',
                'label' => __('Email to administrator after booking', ST_TEXTDOMAIN),
                'desc' => __('Email to administrator after booking', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'section' => 'option_email',
            ],
            [
                'id' => 'email_admin_address',
                'label' => __('Input administrator email', ST_TEXTDOMAIN),
                'desc' => __('Booking information will be sent to here', ST_TEXTDOMAIN),
                'type' => 'text',
                'condition' => '',
                'section' => 'option_email',
            ],
            [
                'id' => 'enable_email_for_owner_item',
                'label' => __('Email after booking for partner/owner item', ST_TEXTDOMAIN),
                'desc' => __('Email after booking for partner/owner item', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'section' => 'option_email',
            ],
            [
                'id' => 'enable_email_approved_item',
                'label' => __('Email to partner when item approved by administrator', ST_TEXTDOMAIN),
                'desc' => __('Email to partner when item approved by administrator', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'section' => 'option_email',
            ],
            [
                'id' => 'enable_email_cancel',
                'label' => __('Email to administrator when have an cancel booking', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'desc' => __('Email to administrator when have an cancel booking', ST_TEXTDOMAIN),
                'section' => 'option_email'
            ],
            [
                'id' => 'enable_partner_email_cancel',
                'label' => __('Email to partner when have an cancel booking', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'desc' => __('Email to partner when have an cancel booking', ST_TEXTDOMAIN),
                'section' => 'option_email'
            ],
            [
                'id' => 'enable_email_cancel_success',
                'label' => __('Email to user when booking is cancelled', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'desc' => __('Email to user when booking is cancelled', ST_TEXTDOMAIN),
                'section' => 'option_email'
            ],
            /*------------ End Email Option --------------*/
        ];
    }

    public function __carSettings()
    {
        return [/*------------- Cars Option -----------------*/
            [
                'id' => 'car_equipment_info_limit',
                'label' => __('Equipment Limit', ST_TEXTDOMAIN),
                'desc' => __('Number of equipment showing on search results', ST_TEXTDOMAIN),
                'type' => 'number',
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'section' => 'option_car',
            ],
            [
                'id' => 'cars_search_result_page',
                'label' => __('Search Result Page', ST_TEXTDOMAIN),
                'desc' => __('Select page to show search results for car', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_car',
            ],
            [
                'id' => 'cars_single_layout',
                'label' => __('Cars Single Layout', ST_TEXTDOMAIN),
                'desc' => __('Select layout to show single car', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'st_cars',
                'sparam' => 'layout',
                'section' => 'option_car',
            ],
            [
                'id' => 'cars_layout_layout',
                'label' => __('Cars Search Layout', ST_TEXTDOMAIN),
                'desc' => __('Select layout to show search page for car', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'st_cars_search',
                'sparam' => 'layout',
                'section' => 'option_car',
            ],
            [
                'id' => 'cars_price_unit',
                'label' => __('Price unit', ST_TEXTDOMAIN),
                'desc' => __('The unit to calculate the price of car<br/>Day: The price is calculated according to day<br/>Hour: The price is calculated according to hour<br/>Distance: The price is calculated according to distance', ST_TEXTDOMAIN),
                'type' => 'custom-select',
                'section' => 'option_car',
                'choices' => class_exists('STCars') ? STCars::get_option_price_unit() : [],
                'std' => 'day',
                'v_hint' => 'yes'
            ],
            [
                'id' => 'cars_price_by_distance',
                'label' => __('Price by distance', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_car',
                'choices' => [
                    [
                        'value' => 'kilometer',
                        'label' => __('Kilometer', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'mile',
                        'label' => __('Mile', ST_TEXTDOMAIN)
                    ]
                ],
                'std' => 'kilometer',
                'condition' => 'cars_price_unit:is(distance)'
            ],
            /*array(
            'id' => 'equipment_by_unit',
            'label' => __('Set equipment price by day/hour', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_car',
            'operator' => 'or',
            'condition' => 'cars_price_unit:is(day),cars_price_unit:is(hour)'
        ),*/
            [
                'id' => 'booking_days_included',
                'label' => __('Set default booking info', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_car',
                'desc' => __("ON: Add one day / hour into day / hour for check in. For example: 22-23/11/2017 will be 2 days.", ST_TEXTDOMAIN)
            ],
            [
                'id' => 'is_featured_search_car',
                'label' => __('Show featured cars on top of search results', ST_TEXTDOMAIN),
                'desc' => __('Show featured cars on top of result search page', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_car'
            ],
            [
                'id' => 'car_search_fields',
                'label' => __('Car Search Fields', ST_TEXTDOMAIN),
                'desc' => __('You can add, sort search fields for car', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_car',
                'settings' => [

                    [
                        'id' => 'field_atrribute',
                        'label' => __('Field Atrribute', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STCars') ? STCars::get_search_fields_name() : []
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col_normal',
                        'label' => __('Layout Normal size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'condition' => 'field_atrribute:is(taxonomy)',
                        'operator' => 'and',
                        'type' => 'st_select_tax',
                        'post_type' => 'st_cars'
                    ],
                    [
                        'id' => 'type_show_taxonomy_cars',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'field_atrribute:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __('Max number', ST_TEXTDOMAIN),
                        'condition' => 'field_atrribute:is(list_name)',
                        'type' => 'text',
                        'operator' => 'and',
                        'std' => 20
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => [
                    ['title' => 'Pick Up From, Drop Off To', 'layout_col_normal' => 12, 'field_atrribute' => 'location'],
                    [
                        'title' => 'Pick-up Date ,Pick-up Time',
                        'layout_col_normal' => 6,
                        'field_atrribute' => 'pick-up-date-time'
                    ],
                    [
                        'title' => 'Drop-off Date ,Drop-off Time',
                        'layout_col_normal' => 6,
                        'field_atrribute' => 'drop-off-date-time'
                    ],
                ]
            ],
            [
                'id' => 'car_allow_search_advance',
                'label' => __('Allow advanced search', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_car'
            ],
            [
                'id' => 'car_advance_search_fields',
                'label' => __('Allowed Advanced Search  ', ST_TEXTDOMAIN),
                'desc' => __('ON: Turn on thiis mode to add advanced search  ', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_car',
                'condition' => 'car_allow_search_advance:is(on)',
                'settings' => [

                    [
                        'id' => 'field_atrribute',
                        'label' => __('Field Atrribute', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STCars') ? STCars::get_search_fields_name() : []
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col_normal',
                        'label' => __('Layout Normal size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'condition' => 'field_atrribute:is(taxonomy)',
                        'operator' => 'and',
                        'type' => 'st_select_tax',
                        'post_type' => 'st_cars'
                    ],
                    [
                        'id' => 'type_show_taxonomy_cars',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'field_atrribute:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __('Max number', ST_TEXTDOMAIN),
                        'condition' => 'field_atrribute:is(list_name)',
                        'type' => 'text',
                        'operator' => 'and',
                        'std' => 20
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => [
                    ['title' => __('Taxonomy', ST_TEXTDOMAIN), 'layout_col_normal' => 12, 'field_atrribute' => 'taxonomy'],
                    [
                        'title' => __('Filter Price', ST_TEXTDOMAIN),
                        'layout_col_normal' => 12,
                        'field_atrribute' => 'price_slider',
                    ],
                ]
            ],
            [
                'id' => 'car_search_fields_box',
                'label' => __('Location & Date Change Box', ST_TEXTDOMAIN),
                'desc' => __('You can add, sort fields in the change box for car search in the car single page', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_car',
                'settings' => [


                    [
                        'id' => 'field_atrribute',
                        'label' => __('Field Atrribute', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STCars') ? STCars::get_search_fields_name() : []
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col_box',
                        'label' => __('Layout Box size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1/12', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2/12', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3/12', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4/12', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5/12', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6/12', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7/12', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8/12', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9/12', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10/12', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11/12', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12/12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'condition' => 'field_atrribute:is(taxonomy)',
                        'operator' => 'and',
                        'type' => 'st_select_tax',
                        'post_type' => 'st_cars'
                    ],
                    [
                        'id' => 'type_show_taxonomy_cars',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'field_atrribute:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __('Max number', ST_TEXTDOMAIN),
                        'condition' => 'field_atrribute:is(list_name)',
                        'type' => 'text',
                        'operator' => 'and',
                        'std' => 20
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => [
                    ['title' => 'Pick Up From, Drop Off To', 'layout_col_box' => 6, 'field_atrribute' => 'location'],
                    ['title' => 'Pick-up Date', 'layout_col_box' => 3, 'field_atrribute' => 'pick-up-date'],
                    ['title' => 'Pick-up Time', 'layout_col_box' => 3, 'field_atrribute' => 'pick-up-time'],
                    ['title' => 'Drop-off Date', 'layout_col_box' => 3, 'field_atrribute' => 'drop-off-date'],
                    ['title' => 'Drop-off Time', 'layout_col_box' => 3, 'field_atrribute' => 'drop-off-time'],

                ]
            ],
            [
                'id' => 'car_review',
                'label' => __('Review options', ST_TEXTDOMAIN),
                'desc' => __('ON: Turn on the mode of car review', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_car',
                'std' => 'on'

            ],
            [
                'id' => 'car_review_stats',
                'label' => __('Review criterias', ST_TEXTDOMAIN),
                'desc' => __('You can add, sort review criteria for car', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_car',
                'condition' => 'car_review:is(on)',
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Stat Name', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ]
                ],
                'std' => [

                    ['title' => 'stat name 1'],
                    ['title' => 'stat name 2'],
                    ['title' => 'stat name 3'],
                    ['title' => 'stat name 4'],
                    ['title' => 'stat name 5'],
                ]
            ],
            [
                'id' => 'st_cars_unlimited_custom_field',
                'label' => __('Car custom fields', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_car',
                'desc' => __('You can create, add custom fields for car', ST_TEXTDOMAIN),
                'settings' => [
                    [
                        'id' => 'type_field',
                        'label' => __('Field type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => 'text',
                                'label' => __('Text field', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'textarea',
                                'label' => __('Textarea field', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'date-picker',
                                'label' => __('Date field', ST_TEXTDOMAIN)
                            ],
                        ]

                    ],
                    [
                        'id' => 'default_field',
                        'label' => __('Default', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and'
                    ],

                ],
            ],
            [
                'id' => 'st_cars_icon_map_marker',
                'label' => __('Map marker icon', ST_TEXTDOMAIN),
                'desc' => __('Select map icon to show car on Map Google', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_car',
                'std' => 'http://maps.google.com/mapfiles/marker_green.png'
            ],
            [
                'id' => 'car_hide_partner_info',
                'label' => __('Show/hide contact info of partner', ST_TEXTDOMAIN),
                'desc' => __('Show/hide contact info of partner in single car', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_car',
                'std' => 'on'
            ],
            /*------------ End Car Option --------------*/
        ];
    }

    public function __rentalSettings()
    {
        return [ /*------------- Rental Option -----------------*/
            [
                'id' => 'rental_search_result_page',
                'label' => __('Select Search Result Page', ST_TEXTDOMAIN),
                'desc' => __('Select page to show search results page for rental', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_rental',
            ],
            [
                'id' => 'rental_single_layout',
                'label' => __('Rental Single Layout', ST_TEXTDOMAIN),
                'desc' => __('Select layout to show single retal', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'st_rental',
                'sparam' => 'layout',
                'section' => 'option_rental'
            ],
            [
                'id' => 'rental_search_layout',
                'label' => __('Rental Search Layout', ST_TEXTDOMAIN),
                'desc' => __('Select layout to show rental search page', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'st_rental_search',
                'sparam' => 'layout',
                'section' => 'option_rental'
            ],
            [
                'id' => 'rental_room_layout',
                'label' => __('Rental Room Default Layout', ST_TEXTDOMAIN),
                'desc' => __('Select layout to show single room rental page', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'rental_room',
                'sparam' => 'layout',
                'section' => 'option_rental'
            ],
            [
                'id' => 'rental_review',
                'label' => __('Review options', ST_TEXTDOMAIN),
                'desc' => __('ON: Turn on review feature for rental', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_rental',
                'std' => 'on'

            ],

            [
                'id' => 'rental_review_stats',
                'label' => __('Rental Review Criteria', ST_TEXTDOMAIN),
                'desc' => __('You can add, delete, sort review criteria for rental', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_rental',
                'condition' => 'rental_review:is(on)',
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Stat Name', ST_TEXTDOMAIN),
                        'type' => 'text',
                    ]
                ],
                'std' => [

                    ['title' => 'Sleep'],
                    ['title' => 'Location'],
                    ['title' => 'Service'],
                    ['title' => 'Cleanliness'],
                    ['title' => 'Room(s)'],
                ]
            ],
            [
                'id' => 'rental_sidebar_pos',
                'label' => __('Rental slidebar position', ST_TEXTDOMAIN),
                'desc' => __('The position to show sidebar for rental', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_rental',
                'choices' => [
                    [
                        'value' => 'no',
                        'label' => __('No', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'left',
                        'label' => __('Left', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'right',
                        'label' => __('Right', ST_TEXTDOMAIN)
                    ]

                ],
                'std' => 'left'

            ],
            [
                'id' => 'rental_sidebar_area',
                'label' => __('Sidebar Area', ST_TEXTDOMAIN),
                'desc' => __('Select a sidebar widget to display for rental', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => '',
                'sparam' => 'sidebar',
                'section' => 'option_rental',
                'std' => 'rental-sidebar'

            ],
            [
                'id' => 'is_featured_search_rental',
                'label' => __('Show featured rentals on top of search result', ST_TEXTDOMAIN),
                'desc' => __('ON: Show featured items on top of result search page', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_rental'
            ],
            [
                'id' => 'rental_search_fields',
                'label' => __('Rental Search Fields', ST_TEXTDOMAIN),
                'desc' => __('You can add, delete, sort rental search fields', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_rental',
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Field Type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => TravelHelper::st_get_field_search('st_rental', 'option_tree')
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Large-box column size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'layout_col2',
                        'label' => __('Small-box column size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'operator' => 'and',
                        'condition' => 'name:is(taxonomy)',
                        'type' => 'st_select_tax',
                        'post_type' => 'st_rental'
                    ],
                    [
                        'id' => 'type_show_taxonomy_rental',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __('Max number', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'condition' => 'name:is(list_name)',
                        'operator' => 'and',
                        'std' => 20
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => [
                    [
                        'title' => __('Where are you going?', ST_TEXTDOMAIN),
                        'name' => 'location',
                        'placeholder' => __('Location/ Zipcode', ST_TEXTDOMAIN),
                        'layout_col' => '12',
                        'layout_col2' => '12'
                    ],
                    [
                        'title' => __('Check in', ST_TEXTDOMAIN),
                        'name' => 'checkin',
                        'layout_col' => '3',
                        'layout_col2' => '3'
                    ],
                    [
                        'title' => __('Check out', ST_TEXTDOMAIN),
                        'name' => 'checkout',
                        'layout_col' => '3',
                        'layout_col2' => '3'
                    ],
                    [
                        'title' => __('Room(s)', ST_TEXTDOMAIN),
                        'name' => 'room_num',
                        'layout_col' => '3',
                        'layout_col2' => '3'
                    ],
                    [
                        'title' => __('Adults', ST_TEXTDOMAIN),
                        'name' => 'adult',
                        'layout_col' => '3',
                        'layout_col2' => '3'
                    ]
                ]
            ],
            [
                'id' => 'allow_rental_advance_search',
                'label' => __("Allowed Rental Advanced Search", ST_TEXTDOMAIN),
                'desc' => __("ON: Turn on this mode to add advanced search fields", ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => "off",
                'section' => 'option_rental'
            ],
            [
                'id' => 'rental_advance_search_fields',
                'label' => __('Rental advanced search fields', ST_TEXTDOMAIN),
                'desc' => __('You can add, sort advanced search fields', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_rental',
                'condition' => "allow_rental_advance_search:is(on)",
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Field Type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => TravelHelper::st_get_field_search('st_rental', 'option_tree')
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Large-box column size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'layout_col2',
                        'label' => __('Small-box column size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                        'std' => 4
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'operator' => 'and',
                        'condition' => 'name:is(taxonomy)',
                        'type' => 'st_select_tax',
                        'post_type' => 'st_rental'
                    ],
                    [
                        'id' => 'type_show_taxonomy_rental',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __('Max number', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'condition' => 'name:is(list_name)',
                        'operator' => 'and',
                        'std' => 20
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => [
                    [
                        'title' => __('Amenities', ST_TEXTDOMAIN),
                        'name' => 'taxonomy',
                        'layout_col' => '12',
                        'layout_col2' => '12',
                        'taxonomy' => 'amenities'
                    ],
                    [
                        'title' => __('Suitabilities', ST_TEXTDOMAIN),
                        'name' => 'taxonomy',
                        'layout_col' => '12',
                        'layout_col2' => '12',
                        'taxonomy' => 'suitability'
                    ],
                ]
            ],
            [
                'id' => 'rental_unlimited_custom_field',
                'label' => __('Rental custom fields', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_rental',
                'desc' => __('You can create, add custom fields for rental', ST_TEXTDOMAIN),
                'settings' => [
                    [
                        'id' => 'type_field',
                        'label' => __('Field type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => 'text',
                                'label' => __('Text field', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'textarea',
                                'label' => __('Textarea field', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'date-picker',
                                'label' => __('Date field', ST_TEXTDOMAIN)
                            ],
                        ]

                    ],
                    [
                        'id' => 'default_field',
                        'label' => __('Default', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and'
                    ],

                ],
            ],
            [
                'id' => 'st_rental_icon_map_marker',
                'label' => __('Map marker icon', ST_TEXTDOMAIN),
                'desc' => __('Select map icon to show rental on Map Google', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_rental',
                'std' => 'http://maps.google.com/mapfiles/marker_brown.png'
            ],
            /*------------ End Rental Option --------------*/
        ];
    }

    public function __advanceSettings()
    {
        return [
            [
                'id' => 'datetime_format',
                'label' => __('Input date format', ST_TEXTDOMAIN),
                'type' => 'custom-text',
                'std' => '{mm}/{dd}/{yyyy}',
                'section' => 'option_advance',
                'desc' => __('The date format, combination of d, dd, mm, yy, yyyy. It is surrounded by <code>\'{}\'</code>. Ex: {dd}/{mm}/{yyyy}.
                <ul>
                <li><code>d, dd</code>: Numeric date, no leading zero and leading zero, respectively. Eg, 5, 05.</li>
                <li><code>m, mm</code>: Numeric month, no leading zero and leading zero, respectively. Eg, 7, 07.</li>
                <li><code>yy, yyyy:</code> 2- and 4-digit years, respectively. Eg, 12, 2012.</li>
                </ul>
                ', ST_TEXTDOMAIN),
                'v_hint' => 'yes'
            ],
            [
                'id' => 'time_format',
                'label' => __('Select time format', ST_TEXTDOMAIN),
                'type' => 'select',
                'std' => '12h',
                'choices' => [
                    [
                        'value' => '12h',
                        'label' => __('12h', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => '24h',
                        'label' => __('24h', ST_TEXTDOMAIN)
                    ],
                ],
                'section' => 'option_advance',
            ],
            [
                'id' => 'update_weather_by',
                'label' => __('Weather auto update after:', ST_TEXTDOMAIN),
                'type' => 'number',
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'std' => 12,
                'section' => 'option_advance',
                'desc' => __('Weather updates (Unit: hour)', ST_TEXTDOMAIN),
            ],
            [
                'id' => 'show_price_free',
                'label' => __('Show info when service is free', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'desc' => __('Price is not shown when accommodation is free', ST_TEXTDOMAIN),
                'section' => 'option_advance',
                'std' => 'off'
            ],
            [
                'id' => 'adv_before_body_content',
                'label' => __('Before Body Content', ST_TEXTDOMAIN),
                'desc' => __("Input content after <body> tag.", ST_TEXTDOMAIN),
                'type' => 'textarea-simple',
                'section' => 'option_advance',
                //'std'=>'off'
            ],
            [
                'id' => 'edv_enable_demo_mode',
                'label' => __('Show demo mode', ST_TEXTDOMAIN),
                'desc' => __('Do some magical', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_advance',
                'std' => 'off',
                //'std'=>'off'
            ],

            [
                'id' => 'mailchimp_shortcode',
                'label' => __('MailChimp Shortcode Form', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_advance',
                'std' => '',
                //'std'=>'off'
            ],
            //            array(
            //                'id'      => 'enable_amp_support',
            //                'label'   => __('Enable AMP Support', ST_TEXTDOMAIN),
            //                'type'    => 'on-off',
            //                'section' => 'option_advance',
            //                'std'     => 'off',
            //            ),

        ];
    }

    public function __skyscannerSettings()
    {
        return [
            /*------------------- Skyscanner ----------------------*/
            [
                'id' => 'skyscanner_option',
                'label' => esc_html__('Skyscanner', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'ss_api_key',
                'label' => esc_html__('Api Key', ST_TEXTDOMAIN),
                'type' => 'text',
                'desc' => esc_html__('Enter a api key', ST_TEXTDOMAIN),
                'section' => 'option_api_update'
            ],
            [
                'id' => 'ss_locale',
                'label' => esc_html__('Locale', ST_TEXTDOMAIN),
                'type' => 'ss_content_select',
                'post_type' => 'locale',
                'test' => '12',
                'desc' => esc_html__('The locales that Skyscanner support to translate your content', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
                'std' => 'en-US',
            ],
            [
                'id' => 'ss_currency',
                'label' => esc_html__('Currency', ST_TEXTDOMAIN),
                'type' => 'ss_content_select',
                'post_type' => 'currency',
                'desc' => esc_html__('The currencies that Skyscanner support', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
                'std' => 'USD',
            ],
            [
                'id' => 'ss_market_country',
                'label' => esc_html__('Market Country', ST_TEXTDOMAIN),
                'type' => 'ss_content_select',
                'post_type' => 'market',
                'desc' => esc_html__('The market countries that Skyscanner support', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
                'std' => 'US',
            ]
        ];
    }

    public function __colibriSettings()
    {
        return [
            /*------------------- Colibri API ----------------------*/
            [
                'id' => 'colibri_api_option',
                'label' => esc_html__('Traveler PMS', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'cba_enable',
                'label' => esc_html__('Turn on Traveler PMS', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_api_update',
                'std' => 'off'
            ],
            [
                'id' => 'cba_id',
                'label' => esc_html__('Username', ST_TEXTDOMAIN),
                'type' => 'text',
                'desc' => esc_html__('Enter your username', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
                'condition' => 'cba_enable:is(on)'
            ],
            [
                'id' => 'cba_pw',
                'label' => esc_html__('Password', ST_TEXTDOMAIN),
                'type' => 'text',
                'desc' => esc_html__('Enter your password', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
                'condition' => 'cba_enable:is(on)'
            ],
            [
                'id' => 'cba_page_list_hotel',
                'label' => __('List hotel page', ST_TEXTDOMAIN),
                'desc' => __('Select the page to display list hotel', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_api_update',
                'condition' => 'cba_enable:is(on)'
            ],
            [
                'id' => 'cba_page_detail_hotel',
                'label' => __('Detail hotel page', ST_TEXTDOMAIN),
                'desc' => __('Select the page to display detail hotel', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_api_update',
                'condition' => 'cba_enable:is(on)'
            ],
            [
                'id' => 'cba_number_post_list_hotel',
                'label' => __('Number of items in list hotels', ST_TEXTDOMAIN),
                'desc' => __('Default number of posts are shown in list hotels page', ST_TEXTDOMAIN),
                'type' => 'number',
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'section' => 'option_api_update',
                'std' => 10,
                'condition' => 'cba_enable:is(on)'
            ],
            [
                'id' => 'cba_room_checkout',
                'label' => __('Check out popup form', ST_TEXTDOMAIN),
                'desc' => __('Turn on popup form for checkout', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_api_update',
                'std' => 'off',
                'condition' => 'cba_enable:is(on)'
            ],
            [
                'id' => 'cba_page_checkout',
                'label' => __('Checkout page', ST_TEXTDOMAIN),
                'desc' => __('Select checkout page', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_api_update',
                'condition' => 'cba_enable:is(on),cba_room_checkout:is(off)'
            ],
            [
                'id' => 'cba_room_gallery_type',
                'label' => __('Select room gallery style', ST_TEXTDOMAIN),
                'desc' => __('Choose Grid or Slider room gallery', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_api_update',
                'condition' => 'cba_enable:is(on)',
                'std' => 'slider',
                'choices' => [
                    [
                        'label' => __('Slider', ST_TEXTDOMAIN),
                        'value' => 'slider'
                    ],
                    [
                        'label' => __('Grid', ST_TEXTDOMAIN),
                        'value' => 'grid'
                    ]
                ],
            ],

            [
                'id' => 'cba_default_country',
                'label' => __('Select default country', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_api_update',
                'condition' => 'cba_enable:is(on)',
                'std' => 'PT',
                'choices' => PMS_City_Controller::inst()->getCountryDataOptionTree(),
            ],

            [
                'id' => 'cba_curency',
                'label' => __('Select curency format', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_api_update',
                'condition' => 'cba_enable:is(on)',
                'std' => '1',
                'choices' => [
                    [
                        'label' => __('$500', ST_TEXTDOMAIN),
                        'value' => '1'
                    ],
                    [
                        'label' => __('$ 500', ST_TEXTDOMAIN),
                        'value' => '2'
                    ],
                    [
                        'label' => __('500$', ST_TEXTDOMAIN),
                        'value' => '3'
                    ],
                    [
                        'label' => __('500 $', ST_TEXTDOMAIN),
                        'value' => '4'
                    ],
                ],
            ],
            /*----------------- End Colibri API --------------------*/
        ];
    }

    public function __hotelCombinedSettings()
    {
        return [

            /*------------------- HotelsCombined API ----------------------*/
            [
                'id' => 'hotelscb_option',
                'label' => esc_html__('HotelsCombined', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'hotelscb_aff_id',
                'label' => esc_html__('Affiliate ID', ST_TEXTDOMAIN),
                'type' => 'text',
                'desc' => esc_html__('Enter your affiliate ID', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
            ],
            [
                'id' => 'hotelscb_searchbox_id',
                'label' => esc_html__('Searchbox ID', ST_TEXTDOMAIN),
                'type' => 'text',
                'desc' => esc_html__('Enter your search box ID', ST_TEXTDOMAIN),
                'section' => 'option_api_update',
            ],
            /*------------------- HotelsCombined API ----------------------*/
        ];
    }

    public function __bookingdotcomSettings()
    {
        return [

            /*------------------- Booking.com API ----------------------*/
            [
                'id' => 'bookingdc_option',
                'label' => esc_html__('Booking.com', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'bookingdc_iframe',
                'label' => __('Using iframe search form', ST_TEXTDOMAIN),
                'desc' => __('Enable iframe search form', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_api_update',
                'std' => 'on',
            ],
            [
                'id' => 'bookingdc_iframe_code',
                'label' => __('Search form code', ST_TEXTDOMAIN),
                'desc' => __('Enter your search box code from booking.com', ST_TEXTDOMAIN),
                'type' => 'textarea-simple',
                'rows' => '4',
                'condition' => 'bookingdc_iframe:is(on)',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'bookingdc_aid',
                'label' => __('Your affiliate ID', ST_TEXTDOMAIN),
                'desc' => __('Enter your affiliate ID from booking.com', ST_TEXTDOMAIN),
                'type' => 'text',
                'condition' => 'bookingdc_iframe:is(off)',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'bookingdc_cname',
                'label' => __('Cname', ST_TEXTDOMAIN),
                'desc' => __('Enter your Cname for search box', ST_TEXTDOMAIN),
                'type' => 'text',
                'condition' => 'bookingdc_iframe:is(off)',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'bookingdc_lang',
                'label' => esc_html__('Default Language', ST_TEXTDOMAIN),
                'type' => 'select',
                'operator' => 'and',
                'choices' => [
                    [
                        'value' => 'ez',
                        'label' => esc_html__('Azerbaijan', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'ms',
                        'label' => esc_html__('Bahasa Melayu', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'br',
                        'label' => esc_html__('Brazilian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'bg',
                        'label' => esc_html__('Bulgarian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'zh',
                        'label' => esc_html__('Chinese', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'da',
                        'label' => esc_html__('Danish', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'de',
                        'label' => esc_html__('Deutsch (DE)', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'en',
                        'label' => esc_html__('English', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'en-AU',
                        'label' => esc_html__('English (AU)', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'en-GB',
                        'label' => esc_html__('English (GB)', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'fr',
                        'label' => esc_html__('French', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'ka',
                        'label' => esc_html__('Georgian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'el',
                        'label' => esc_html__('Greek (Modern Greek)', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'it',
                        'label' => esc_html__('Italian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'ja',
                        'label' => esc_html__('Japanese', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'lv',
                        'label' => esc_html__('Latvian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'pl',
                        'label' => esc_html__('Polish', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'pt',
                        'label' => esc_html__('Portuguese', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'ro',
                        'label' => esc_html__('Romanian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'ru',
                        'label' => esc_html__('Russian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'sr',
                        'label' => esc_html__('Serbian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'es',
                        'label' => esc_html__('Spanish', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'th',
                        'label' => esc_html__('Thai', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'tr',
                        'label' => esc_html__('Turkish', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'uk',
                        'label' => esc_html__('Ukrainian', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'vi',
                        'label' => esc_html__('Vietnamese', ST_TEXTDOMAIN)
                    ],

                ],
                'section' => 'option_api_update',
                'std' => 'en',
                'condition' => 'bookingdc_iframe:is(off)',
            ],

            [
                'id' => 'bookingdc_currency',
                'label' => esc_html__('Default Currency', ST_TEXTDOMAIN),
                'type' => 'select',
                'choices' => [
                    [
                        'value' => 'amd',
                        'label' => esc_html__('UAE dirham (AED)', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'amd',
                        'label' => esc_html__('Armenian Dram (AMD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'ars',
                        'label' => esc_html__('Argentine peso (ARS)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'aud',
                        'label' => esc_html__('Australian Dollar (AUD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'azn',
                        'label' => esc_html__('Azerbaijani Manat (AZN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'bdt',
                        'label' => esc_html__('Bangladeshi taka (BDT)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'bgn',
                        'label' => esc_html__('Bulgarian lev (BGN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'brl',
                        'label' => esc_html__('Brazilian real (BRL)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'byr',
                        'label' => esc_html__('Belarusian ruble (BYR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'chf',
                        'label' => esc_html__('Swiss Franc (CHF)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'clp',
                        'label' => esc_html__('Chilean peso (CLP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'cny',
                        'label' => esc_html__('Chinese Yuan (CNY)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'cop',
                        'label' => esc_html__('Colombian peso (COP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'dkk',
                        'label' => esc_html__('Danish krone (DKK)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'egp',
                        'label' => esc_html__('Egyptian Pound (EGP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'eur',
                        'label' => esc_html__('Euro (EUR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'gpb',
                        'label' => esc_html__('British Pound Sterling (GPB)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'gel',
                        'label' => esc_html__('Georgian lari (GEL)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'hkd',
                        'label' => esc_html__('Hong Kong Dollar (HKD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'huf',
                        'label' => esc_html__('Hungarian forint (HUF)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'idr',
                        'label' => esc_html__('Indonesian Rupiah (IDR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'inr',
                        'label' => esc_html__('Indian Rupee (INR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'jpy',
                        'label' => esc_html__('Japanese Yen (JPY)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'kgs',
                        'label' => esc_html__('Som (KGS)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'krw',
                        'label' => esc_html__('South Korean won (KRW)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'mxn',
                        'label' => esc_html__('Mexican peso (MXN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'myr',
                        'label' => esc_html__('Malaysian ringgit (MYR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'nok',
                        'label' => esc_html__('Norwegian Krone (NOK)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'kzt',
                        'label' => esc_html__('Kazakhstani Tenge (KZT)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'ltl',
                        'label' => esc_html__('Latvian Lat (LTL)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'nzd',
                        'label' => esc_html__('New Zealand Dollar (NZD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'pen',
                        'label' => esc_html__('Peruvian sol (PEN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'php',
                        'label' => esc_html__('Philippine Peso (PHP)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'pkr',
                        'label' => esc_html__('Pakistan Rupee (PKR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'pln',
                        'label' => esc_html__('Polish zloty (PLN)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'ron',
                        'label' => esc_html__('Romanian leu (RON)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'rsd',
                        'label' => esc_html__('Serbian dinar (RSD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'rub',
                        'label' => esc_html__('Russian Ruble (RUB)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'sar',
                        'label' => esc_html__('Saudi riyal (SAR)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'sek',
                        'label' => esc_html__('Swedish krona (SEK)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'sgd',
                        'label' => esc_html__('Singapore Dollar (SGD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'thb',
                        'label' => esc_html__('Thai Baht (THB)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'try',
                        'label' => esc_html__('Turkish lira (TRY)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'uah',
                        'label' => esc_html__('Ukrainian Hryvnia (UAH)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'usd',
                        'label' => esc_html__('US Dollar (USD)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'vnd',
                        'label' => esc_html__('Vietnamese dong (VND)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'xof',
                        'label' => esc_html__('CFA Franc (XOF)', ST_TEXTDOMAIN)
                    ], [
                        'value' => 'zar',
                        'label' => esc_html__('South African Rand (ZAR)', ST_TEXTDOMAIN)
                    ],
                ],
                'section' => 'option_api_update',
                'std' => 'usd',
                'condition' => 'bookingdc_iframe:is(off)',
            ],
            /*------------------- End Booking.com API ----------------------*/
        ];
    }

    public function __expediaSettings()
    {
        return [

            /*------------------- Expedia API ----------------------*/
            [
                'id' => 'expedia_option',
                'label' => esc_html__('Expedia', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_api_update',
            ],
            [
                'id' => 'expedia_iframe_code',
                'label' => __('Search form code', ST_TEXTDOMAIN),
                'desc' => __('Enter your search box code from expedia', ST_TEXTDOMAIN),
                'type' => 'textarea-simple',
                'rows' => '4',
                'section' => 'option_api_update',
            ],
            /*------------------- End Expedia API ----------------------*/
        ];
    }

    public function __pageSettings()
    {
        return [

            /*--------------Page Options------------*/

            [
                'id' => 'page_my_account_dashboard',
                'label' => __('Select user dashboard page', ST_TEXTDOMAIN),
                'desc' => __('Select the page to display dashboard user page', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
            ],
            [
                'id' => 'page_redirect_to_after_login',
                'label' => __('Redirect page after login', ST_TEXTDOMAIN),
                'desc' => __('Select the page to display after users login to the system ', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
            ],
            [
                'id' => 'page_redirect_to_after_logout',
                'label' => __('Redirect page after logout', ST_TEXTDOMAIN),
                'desc' => __('Select the page to display after users logout from the system ', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
            ],
            [
                'id' => 'enable_popup_login',
                'label' => esc_html__('Show popup when register', ST_TEXTDOMAIN),
                'desc' => esc_html__('Enable/disable login/ register mode in form of popup', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_page',
                'std' => 'off'
            ],
            [
                'id' => 'page_user_login',
                'label' => __('User Login', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
                'condition' => 'enable_popup_login:is(off)'
            ],
            [
                'id' => 'page_user_register',
                'label' => __('User Register', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
                'condition' => 'enable_popup_login:is(off)'
            ],
            [
                'id' => 'page_reset_password',
                'label' => __('Select page for reset password', ST_TEXTDOMAIN),
                'desc' => __('Select page for resetting password', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
            ],
            [
                'id' => 'page_checkout',
                'label' => __('Select page for checkout', ST_TEXTDOMAIN),
                'desc' => __('Select page for checkout', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
            ],
            [
                'id' => 'page_payment_success',
                'label' => __('Select page for successfully booking', ST_TEXTDOMAIN),
                'desc' => __('Select page for successful booking', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
            ],
            [
                'id' => 'page_order_confirm',
                'label' => __('Order Confirmation Page', ST_TEXTDOMAIN),
                'desc' => __('Select page to show booking order', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
            ],
            [
                'id' => 'page_terms_conditions',
                'label' => __('Terms and Conditions Page', ST_TEXTDOMAIN),
                'desc' => __('Select page to show Terms and Conditions', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
            ],

            [
                'id' => 'footer_template',
                'label' => __('Footer Page', ST_TEXTDOMAIN),
                'desc' => __('Select page to show Footer', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
            ],

            [
                'id' => 'footer_template_new',
                'label' => __('Modern Footer Page', ST_TEXTDOMAIN),
                'desc' => __('Select page to show Modern Footer', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
            ],
            [
                'id' => 'partner_info_page',
                'label' => __('Partner Page', ST_TEXTDOMAIN),
                'desc' => __('Select page to show Partner Information', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_page',
            ],
            /*--------------End Page Options------------*/
        ];
    }

    public function __blogSettings()
    {
        return [


            /*--------------Blog Options------------*/
            [
                'id' => 'blog_sidebar_pos',
                'label' => __('Sidebar position', ST_TEXTDOMAIN),
                'desc' => __('Select the position to show sidebar', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_blog',
                'choices' => [
                    [
                        'value' => 'no',
                        'label' => __('No', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'left',
                        'label' => __('Left', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'right',
                        'label' => __('Right', ST_TEXTDOMAIN)
                    ]

                ],
                'std' => 'right'
            ],
            [
                'id' => 'blog_sidebar_id',
                'label' => __('Widget position on slidebar', ST_TEXTDOMAIN),
                'desc' => __('You can choose from the list', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => '',
                'sparam' => 'sidebar',
                'section' => 'option_blog',
                'std' => 'blog-sidebar',
            ],
            [
                'id' => 'header_blog_image',
                'label' => __('Header Blog Background', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_blog',

            ]
            /*--------------End Blog Options------------*/
        ];
    }

    public function __bookingSettings()
    {
        $r = [
            /*------------- Booking Option --------------*/
            [
                'id' => 'booking_tab',
                'label' => __('Booking Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_booking'
            ],
            [
                'id' => 'booking_modal',
                'label' => __('Show popup booking form', ST_TEXTDOMAIN),
                'desc' => __('Show/hide booking mode with popup form. This option only works when turning off Woocommerce Checkout', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_booking',
                'condition' => 'use_woocommerce_for_booking:is(off)'
            ],
            [
                'id' => 'booking_enable_captcha',
                'label' => __('Show captcha', ST_TEXTDOMAIN),
                'desc' => __('Enable captcha for booking form. It is applied for normal booking form', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'on',
                'section' => 'option_booking',
                'desc' => __('Only use for submit form booking', ST_TEXTDOMAIN),
            ],
            [
                'id' => 'booking_card_accepted',
                'label' => __('Accepted cards', ST_TEXTDOMAIN),
                'desc' => __('Add, remove accepted payment cards ', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'settings' => [
                    [
                        'id' => 'image',
                        'label' => __('Image', ST_TEXTDOMAIN),
                        'desc' => __('Image', ST_TEXTDOMAIN),
                        'type' => 'upload'
                    ]
                ],
                'std' => [
                    [
                        'title' => 'Master Card',
                        'image' => get_template_directory_uri() . '/img/card/mastercard.png'
                    ],
                    [
                        'title' => 'JCB',
                        'image' => get_template_directory_uri() . '/img/card/jcb.png'
                    ],
                    [
                        'title' => 'Union Pay',
                        'image' => get_template_directory_uri() . '/img/card/unionpay.png'
                    ],
                    [
                        'title' => 'VISA',
                        'image' => get_template_directory_uri() . '/img/card/visa.png'
                    ],
                    [
                        'title' => 'American Express',
                        'image' => get_template_directory_uri() . '/img/card/americanexpress.png'
                    ],
                ],
                'section' => 'option_booking',
            ],
            [
                'id' => 'booking_currency',
                'label' => __('List of currencies', ST_TEXTDOMAIN),
                'desc' => __('Add, remove a kind of currency for payment', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_booking',
                'settings' => [
                    [

                        'id' => 'name',
                        'label' => __('Currency Name', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => TravelHelper::ot_all_currency()
                    ],
                    [

                        'id' => 'symbol',
                        'label' => __('Currency Symbol', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and'
                    ],
                    [

                        'id' => 'rate',
                        'label' => __('Exchange rate', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                        'desc' => __('Exchange rate vs Primary Currency', ST_TEXTDOMAIN)
                    ],
                    [

                        'id' => 'booking_currency_pos',
                        'label' => __('Currency Position', ST_TEXTDOMAIN),
                        'desc' => __('This controls the position of the currency symbol.<br>Ex: $400 or 400 $', ST_TEXTDOMAIN),
                        'type' => 'custom-select',
                        'choices' => [
                            [
                                'value' => 'left',
                                'label' => __('Left (£99.99)', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'right',
                                'label' => __('Right (99.99£)', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'left_space',
                                'label' => __('Left with space (£ 99.99)', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'right_space',
                                'label' => __('Right with space (99.99 £)', ST_TEXTDOMAIN),
                            ]
                        ],
                        'std' => 'left',
                        'v_hint' => 'yes'
                    ],
                    [
                        'id' => 'currency_rtl_support',
                        'type' => "on-off",
                        'label' => __("This currency is use for RTL languages?", ST_TEXTDOMAIN),
                        'std' => 'off'
                    ],
                    [

                        'id' => 'thousand_separator',
                        'label' => __('Thousand Separator', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'std' => '.',
                        'desc' => __('Optional. Specifies what string to use for thousands separator.', ST_TEXTDOMAIN)
                    ],
                    [
                        'id' => 'decimal_separator',
                        'label' => __('Decimal Separator', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'std' => ',',
                        'desc' => __('Optional. Specifies what string to use for decimal point', ST_TEXTDOMAIN)

                    ],
                    [
                        'id' => 'booking_currency_precision',
                        'label' => __('Currency decimal', ST_TEXTDOMAIN),
                        'desc' => __('Sets the number of decimal points.', ST_TEXTDOMAIN),
                        'type' => 'number',
                        'min' => 0,
                        'max' => 5,
                        'step' => 1,
                        'std' => 2
                    ],

                ],
                'std' => [
                    [
                        'title' => 'USD',
                        'name' => 'USD',
                        'symbol' => '$',
                        'rate' => 1,
                        'booking_currency_pos' => 'left',
                        'thousand_separator' => '.',
                        'decimal_separator' => ',',
                        'booking_currency_precision' => 2,

                    ],
                    [
                        'title' => 'EUR',
                        'name' => 'EUR',
                        'symbol' => '€',
                        'rate' => 0.796491,
                        'booking_currency_pos' => 'left',
                        'thousand_separator' => '.',
                        'decimal_separator' => ',',
                        'booking_currency_precision' => 2,
                    ],
                    [
                        'title' => 'GBP',
                        'name' => 'GBP',
                        'symbol' => '£',
                        'rate' => 0.636169,
                        'booking_currency_pos' => 'right',
                        'thousand_separator' => ',',
                        'decimal_separator' => ',',
                        'booking_currency_precision' => 2,
                    ],
                ]

            ],
            [
                'id' => 'booking_primary_currency',
                'label' => __('Primary Currency', ST_TEXTDOMAIN),
                'desc' => __('Select a unit of currency as main currency', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_booking',
                'choices' => TravelHelper::get_currency(true),
                'std' => 'USD'
            ],
            [
                'id' => 'booking_currency_conversion',
                'label' => __('Currency conversion', ST_TEXTDOMAIN),
                'desc' => __('It is used to convert any currency into dollars (USD) when booking in paypal with the currencies having not been supported yet.', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_booking',
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Currency Name', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => TravelHelper::ot_all_currency()
                    ],
                    [
                        'id' => 'rate',
                        'label' => __('Exchange rate', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                        'desc' => __('Exchange rate vs Primary Currency', ST_TEXTDOMAIN)
                    ],
                ]
            ],
            [
                'id' => 'is_guest_booking',
                'label' => __('Allow guest booking', ST_TEXTDOMAIN),
                'desc' => __("Enable/disable this mode to allow users who have not logged in to book", ST_TEXTDOMAIN),
                'section' => 'option_booking',
                'type' => 'on-off',
                'std' => 'off'
            ],

            [
                'id' => 'st_booking_enabled_create_account',
                'label' => __('Enable create account option', ST_TEXTDOMAIN),
                'desc' => __('Enable create account option in checkout page. Default: Enabled', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_booking',
                'condition' => 'is_guest_booking:is(on)'
            ],
            [
                'id' => 'guest_create_acc_required',
                'label' => __('Always create new account after checkout', ST_TEXTDOMAIN),
                'desc' => __('This options required input checker "Create new account" for Guest booking ', ST_TEXTDOMAIN),
                'section' => 'option_booking',
                'type' => 'on-off',
                'std' => 'off',
                'condition' => 'is_guest_booking:is(on)st_booking_enabled_create_account:is(on)'
            ],
            [
                'id' => 'enable_send_message_button',
                'label' => __('Enable/disable send message button in the booking form', ST_TEXTDOMAIN),
                'section' => 'option_booking',
                'type' => 'on-off',
                'std' => 'off',
            ],
            [
                'id' => 'woocommerce_tab',
                'label' => __('Woocommerce Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_booking',
            ],
            [
                'id' => 'use_woocommerce_for_booking',
                'section' => 'option_booking',
                'label' => __('Use WooCommerce checkout', ST_TEXTDOMAIN),
                'desc' => __('Enable/disable Woocomerce for Booking', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
            ],
            [
                'id' => 'woo_checkout_show_shipping',
                'section' => 'option_booking',
                'label' => __('Show Shipping Information', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'condition' => "use_woocommerce_for_booking:is(on)"
            ],
            [
                'id' => 'st_woo_cart_is_collapse',
                'section' => 'option_booking',
                'label' => __('Show Cart item Information collapsed', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'condition' => "use_woocommerce_for_booking:is(on)"
            ],
            [
                'id' => 'tax_tab',
                'label' => __('Tax Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_booking',
            ],
            [
                'id' => 'tax_enable',
                'label' => __('Enable tax', ST_TEXTDOMAIN),
                'desc' => __('Enable/disable this feature for tax', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_booking',
                'std' => 'off'
            ],
            [
                'id' => 'st_tax_include_enable',
                'label' => __('Price included tax', ST_TEXTDOMAIN),
                'desc' => __('ON: Tax has been included in the price of product - OFF: Tax has not been included in the price of product', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_booking',
                'condition' => 'tax_enable:is(on)',
                'std' => 'off'
            ],
            [
                'id' => 'tax_value',
                'label' => __('Tax value (%)', ST_TEXTDOMAIN),
                'desc' => __('Tax percentage', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_booking',
                'condition' => 'tax_enable:is(on)',
                'std' => 10
            ],
            [
                'id' => 'invoice_tab',
                'label' => __('Invoice Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_booking'
            ],
            [
                'id' => 'invoice_enable',
                'label' => __('Enable invoice', ST_TEXTDOMAIN),
                'desc' => __('Enable/disable this feature for invoice', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_booking',
                'std' => 'off'
            ],
            [
                'id' => 'invoice_logo',
                'label' => __('Company Logo', ST_TEXTDOMAIN),
                'desc' => __('Company Logo', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_booking',
                'condition' => 'invoice_enable:is(on)',
            ],
            [
                'id' => 'invoice_company_name',
                'label' => __('Company Name', ST_TEXTDOMAIN),
                'desc' => __('Company Name', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_booking',
                'condition' => 'invoice_enable:is(on)',
            ],
            [
                'id' => 'invoice_address',
                'label' => __('Address', ST_TEXTDOMAIN),
                'desc' => __('Address', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_booking',
                'condition' => 'invoice_enable:is(on)',
            ],
            [
                'id' => 'invoice_phone_number',
                'label' => __('Phone Number', ST_TEXTDOMAIN),
                'desc' => __('Phone Number', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_booking',
                'condition' => 'invoice_enable:is(on)',
            ],
            [
                'id' => 'invoice_zpc',
                'label' => __('Zip / Postal Code', ST_TEXTDOMAIN),
                'desc' => __('Zip / Postal Code', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_booking',
                'condition' => 'invoice_enable:is(on)',
            ],
            [
                'id' => 'invoice_registration_number',
                'label' => __('Registration Number', ST_TEXTDOMAIN),
                'desc' => __('Registration Number', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_booking',
                'condition' => 'invoice_enable:is(on)',
            ],
            [
                'id' => 'invoice_tax_vat_number',
                'label' => __('Tax / VAT Number', ST_TEXTDOMAIN),
                'desc' => __('Tax / VAT Number', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_booking',
                'condition' => 'invoice_enable:is(on)',
            ],
            [
                'id' => 'invoice_show_link_page_order',
                'label' => __('Show download link in page order success', ST_TEXTDOMAIN),
                'desc' => __('Show download link in page order success', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_booking',
                'std' => 'off',
                'condition' => 'invoice_enable:is(on)'
            ],
            [
                'id' => 'booking_fee_tab',
                'label' => __('Booking Fee Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_booking',
            ],
            [
                'id' => 'booking_fee_enable',
                'label' => __('Enable Booking Fee', ST_TEXTDOMAIN),
                'desc' => __('This feature only for normal booking', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_booking',
                'std' => 'off'
            ],
            [
                'id' => 'booking_fee_type',
                'label' => __("Fee Type", ST_TEXTDOMAIN),
                'type' => 'select',
                'choices' => [
                    [
                        'value' => 'percent',
                        'label' => __('Fee by percent', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'amount',
                        'label' => __('Fee by amount', ST_TEXTDOMAIN)
                    ],
                ],
                'section' => 'option_booking',
                'condition' => 'booking_fee_enable:is(on)',
            ],
            [
                'id' => 'booking_fee_amount',
                'label' => __('Fee amount', ST_TEXTDOMAIN),
                'desc' => __('Leave empty for disallow booking fee', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_booking',
                'std' => '0',
                'condition' => 'booking_fee_enable:is(on)',
            ],

            /*------------- End Booking Option --------------*/
        ];
        if (function_exists('icl_get_languages')) {
            $custom_settings_currency_mapping =
                [
                    [
                        'id' => 'booking_currency_mapping_detect',
                        'label' => __('Auto detect currency by language', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'section' => 'option_booking',
                        'std' => 'off'
                    ],
                    [
                        'id' => 'booking_currency_mapping',
                        'label' => __('Mapping currencies', ST_TEXTDOMAIN),
                        'desc' => __('Mapping currency with language', ST_TEXTDOMAIN),
                        'type' => 'st_mapping_currency',
                        'condition' => 'booking_currency_mapping_detect:is(on)',
                        'section' => 'option_booking',
                        'sdata' => [
                            'langs' => icl_get_languages('skip_missing=0'),
                            'list_currency' => st()->get_option('booking_currency'),
                            'mapping_currency' => get_option('mapping_currency_' . ICL_LANGUAGE_CODE)
                        ]
                    ]
                ];
            array_splice($r, 5, 0, $custom_settings_currency_mapping);
        }

        return $r;
    }

    public function __locationSettings()
    {
        return [/*--------------Location options ----------*/

            [
                'id' => 'location_posts_per_page',
                'label' => __('Number of items in one location', ST_TEXTDOMAIN),
                'desc' => __('Default number of posts are shown in Location tab', ST_TEXTDOMAIN),
                'type' => 'number',
                'min' => 1,
                'max' => 15,
                'step' => 1,
                'section' => 'option_location',
                'std' => 5
            ],

            [
                'id' => 'bc_show_location_url',
                'label' => __('Location link options', ST_TEXTDOMAIN),
                'desc' => __('ON: Link of items will redirect to results search page - OFF: Link of items will redirect to details page', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_location',
                'std' => 'on'
            ],
            [
                'id' => 'bc_show_location_tree',
                'label' => __('Build locations by tree structure', ST_TEXTDOMAIN),
                'desc' => __('Build locations by tree structure', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_location',
                'std' => 'off'
            ],
            [
                'id' => 'location_tab_type',
                'label' => __('Type of the content location tab', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_location',
                'std' => 'list',
                'choices' => [
                    [
                        'value' => 'list',
                        'label' => __('List', ST_TEXTDOMAIN)

                    ],
                    [
                        'value' => 'grid',
                        'label' => __('Grid', ST_TEXTDOMAIN)
                    ],
                ],
            ],

            /*--------------End Location options ----------*/
        ];
    }

    public function __reviewSettings()
    {
        return [ /*--------------Review Options------------*/

            [
                'id' => 'review_without_login',
                'label' => __('Write review', ST_TEXTDOMAIN),
                'desc' => __('ON: Reviews can be written without logging in - OFF: Reviews cannot be written without logging in', ST_TEXTDOMAIN),
                'section' => 'option_review',
                'type' => 'on-off',
                'std' => 'on'
            ],
            [
                'id' => 'review_need_booked',
                'label' => __('User who booked can write review', ST_TEXTDOMAIN),
                'desc' => __('ON: User booked can write review - OFF: Everyone can write review', ST_TEXTDOMAIN),
                'section' => 'option_review',
                'type' => 'on-off',
                'std' => 'off'
            ],
            [
                'id' => 'review_once',
                'label' => __('Times for review', ST_TEXTDOMAIN),
                'desc' => __('ON: Only one time for review - OFF: Many times for review', ST_TEXTDOMAIN),
                'section' => 'option_review',
                'type' => 'on-off',
                'std' => 'off'
            ],
            [
                'id' => 'is_review_must_approved',
                'label' => __('Review approved', ST_TEXTDOMAIN),
                'desc' => __('ON: Review must be approved by admin - OFF: Review is automatically approved', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_review',
                'std' => 'off'
            ],
            /*--------------End Review Options------------*/
        ];
    }

    public function __hotelSettings()
    {
        $r = [

            /*------------- Hotel Option --------------*/
            [
                'id' => 'hotel_single_book_room',
                'label' => __('Booking room in single hotel', ST_TEXTDOMAIN),
                'desc' => '',
                'type' => 'on-off',
                'section' => 'option_hotel',
                'std' => 'off'
            ],
            [
                'id' => 'hotel_show_min_price',
                'label' => __("Price show on listing", ST_TEXTDOMAIN),
                'desc' => __('AVG: Show average price on results search page <br>MIN: Show minimum price on results search page', ST_TEXTDOMAIN),
                'type' => 'custom-select',
                'choices' => [
                    [
                        'value' => 'avg_price',
                        'label' => __('Avg Price', ST_TEXTDOMAIN)

                    ],
                    [
                        'value' => 'min_price',
                        'label' => __('Min Price', ST_TEXTDOMAIN)
                    ],
                ],
                'section' => 'option_hotel',
                'v_hint' => 'yes'
            ],
            [
                'id' => 'view_star_review',
                'label' => __('Show Hotel Stars or Hotel Reviews', ST_TEXTDOMAIN),
                'desc' => __('Hotel star: Show hotel stars on elements of hotel list <br>Hotel review: Show the number of review stars on elements of hotel list ', ST_TEXTDOMAIN),
                'type' => 'custom-select',
                'section' => 'option_hotel',
                'choices' => [
                    [
                        'label' => __('Hotel Stars', ST_TEXTDOMAIN),
                        'value' => 'star'
                    ],
                    [
                        'label' => __('Hotel Reviews', ST_TEXTDOMAIN),
                        'value' => 'review'
                    ]
                ],
                'v_hint' => 'yes'
            ],
            [
                'id' => 'hotel_search_result_page',
                'label' => __('Hotel search result page', ST_TEXTDOMAIN),
                'desc' => __('Select page to show hotel results search page', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_hotel',
            ],
            [
                'id' => 'hotel_posts_per_page',
                'label' => __('Items per page', ST_TEXTDOMAIN),
                'desc' => __('Number of items on a hotel results search page', ST_TEXTDOMAIN),
                'type' => 'number',
                'max' => 50,
                'min' => 1,
                'step' => 1,
                'section' => 'option_hotel',
                'std' => '12'

            ],
            [
                'id' => 'hotel_single_layout',
                'label' => __('Hotel details layout', ST_TEXTDOMAIN),
                'desc' => __('Select layout to display default single hotel', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'st_hotel',
                'sparam' => 'layout',
                'section' => 'option_hotel'
            ],
            [
                'id' => 'hotel_search_layout',
                'label' => __('Hotel search layout', ST_TEXTDOMAIN),
                'desc' => __('Select page to display hotel search page', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'st_hotel_search',
                'sparam' => 'layout',
                'section' => 'option_hotel'
            ],
            [
                'id' => 'hotel_max_adult',
                'label' => __('Max Adults in search field', ST_TEXTDOMAIN),
                'desc' => __('Select max adults for search field', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_hotel',
                'std' => 14

            ],
            [
                'id' => 'hotel_max_child',
                'label' => __('Max Children in search field', ST_TEXTDOMAIN),
                'desc' => __('Select max children for search field', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_hotel',
                'std' => 14

            ],
            [
                'id' => 'hotel_review',
                'label' => __('Enable Review', ST_TEXTDOMAIN),
                'desc' => __('ON: Users can review for hotel  - OFF: User can not review for hotel', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_hotel',
                'std' => 'on'
            ],
            [
                'id' => 'hotel_review_stats',
                'label' => __('Review criterias', ST_TEXTDOMAIN),
                'desc' => __('You can add, edit, delete an review criteria for hotel', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_hotel',
                'condition' => 'hotel_review:is(on)',
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Stat Name', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'icon',
                        'label' => __('Icon review', ST_TEXTDOMAIN),
                        'type' => 'upload',
                        'operator' => 'and',
                    ]
                ],
                'std' => [

                    ['title' => 'Sleep'],
                    ['title' => 'Location'],
                    ['title' => 'Service'],
                    ['title' => 'Cleanliness'],
                    ['title' => 'Room(s)'],
                ]
            ],
            [
                'id' => 'hotel_sidebar_pos',
                'label' => __('Hotel slidebar position', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_hotel',
                'choices' => [
                    [
                        'value' => 'no',
                        'label' => __('No', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'left',
                        'label' => __('Left', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'right',
                        'label' => __('Right', ST_TEXTDOMAIN)
                    ]

                ],
                'std' => 'left'

            ],
            [
                'id' => 'hotel_sidebar_area',
                'label' => __('Sidebar Area', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => '',
                'sparam' => 'sidebar',
                'section' => 'option_hotel',
            ],
            [
                'id' => 'is_featured_search_hotel',
                'label' => __('Show featured hotels on top of search result', ST_TEXTDOMAIN),
                'desc' => __('ON: Show featured items on top of result search page', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'std' => 'off',
                'section' => 'option_hotel'
            ],
            'flied_hotel' => [
                'id' => 'hotel_search_fields',
                'label' => __('Hotel custom search form', ST_TEXTDOMAIN),
                'desc' => __('You can add, edit, delete or sort fields to make a search form for hotel', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_hotel',
                'std' => [
                    [
                        'title' => __('Where are you going?', ST_TEXTDOMAIN),
                        'name' => 'location',
                        'placeholder' => __("Location/ Zipcode", ST_TEXTDOMAIN),
                        'layout_col' => 12,
                        'layout2_col' => 12

                    ],
                    [
                        'title' => __('Check in', ST_TEXTDOMAIN),
                        'name' => 'checkin',
                        'layout_col' => 3,
                        'layout2_col' => 3
                    ],
                    [
                        'title' => __('Check out', ST_TEXTDOMAIN),
                        'name' => 'checkout',
                        'layout_col' => 3,
                        'layout2_col' => 3
                    ],
                    [
                        'title' => __('Room(s)', ST_TEXTDOMAIN),
                        'name' => 'room_num',
                        'layout_col' => 3,
                        'layout2_col' => 3
                    ],
                    [
                        'title' => __('Adult', ST_TEXTDOMAIN),
                        'name' => 'adult',
                        'layout_col' => 3,
                        'layout2_col' => 3
                    ]
                ],
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Field Type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STHotel') ? STHotel::get_search_fields_name() : []
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Layout 1 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                    [
                        'id' => 'layout2_col',
                        'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'st_select_tax',
                        'post_type' => 'st_hotel'
                    ],
                    [
                        'id' => 'type_show_taxonomy_hotel',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'taxonomy_room',
                        'label' => __('Taxonomy Room', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy_room)',
                        'operator' => 'or',
                        'type' => 'st_select_tax',
                        'post_type' => 'hotel_room'
                    ],
                    [
                        'id' => 'type_show_taxonomy_hotel_room',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy_room)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __("Max number", ST_TEXTDOMAIN),
                        'condition' => 'name:is(list_name)',
                        'type' => "text",
                        'std' => 20
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ]
            ],
            [
                'id' => 'hotel_allow_search_advance',
                'label' => __('Allow advanced search', ST_TEXTDOMAIN),
                'desc' => __('ON: Turn on the mode to add advanced search field in hotel search form', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_hotel',
                'std' => 'off',
            ],
            [
                'id' => 'hotel_search_advance',
                'label' => __('Hotel Advanced Search fields', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_hotel',
                'condition' => 'hotel_allow_search_advance:is(on)',
                'desc' => __('You can add, edit, delete, drag and drop any field for settingup advanced search form', ST_TEXTDOMAIN),
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Field', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STHotel') ? STHotel::get_search_fields_name() : []

                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Layout 1 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                    [
                        'id' => 'layout2_col',
                        'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'operator' => 'and',
                        'type' => 'st_select_tax',
                        'post_type' => 'st_hotel'
                    ],
                    [
                        'id' => 'type_show_taxonomy_hotel',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'taxonomy_room',
                        'label' => __('Taxonomy Room', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy_room)',
                        'operator' => 'or',
                        'type' => 'st_select_tax',
                        'post_type' => 'hotel_room'
                    ],
                    [
                        'id' => 'type_show_taxonomy_hotel_room',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy_room)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __("Max number", ST_TEXTDOMAIN),
                        'condition' => 'name:is(list_name)',
                        'type' => "text",
                        'std' => 20
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => [
                    [
                        'title' => __('Hotel Theme', ST_TEXTDOMAIN),
                        'name' => 'taxonomy',
                        'layout_col' => 12,
                        'layout2_col' => 12,
                        'taxonomy' => 'hotel_theme',


                    ],
                    [
                        'title' => __('Room Facilitites', ST_TEXTDOMAIN),
                        'name' => 'taxonomy_room',
                        'layout_col' => 12,
                        'layout2_col' => 12,
                        'taxonomy' => 'hotel_facilities',
                    ],
                ],
            ],
            [
                'id' => 'hotel_nearby_range',
                'label' => __('Hotel Nearby Range', ST_TEXTDOMAIN),
                'type' => 'text',
                'section' => 'option_hotel',
                'desc' => __('You can input distance (km) to find nearby hotels ', ST_TEXTDOMAIN),
                'std' => 10
            ],
            [
                'id' => 'hotel_unlimited_custom_field',
                'label' => __('Hotel custom fields', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_hotel',
                'desc' => __('You can add, edit, delete custom fields for hotel', ST_TEXTDOMAIN),
                'settings' => [
                    [
                        'id' => 'type_field',
                        'label' => __('Field type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => [
                            [
                                'value' => 'text',
                                'label' => __('Text field', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'textarea',
                                'label' => __('Textarea field', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'date-picker',
                                'label' => __('Date field', ST_TEXTDOMAIN)
                            ],
                        ]

                    ],
                    [
                        'id' => 'default_field',
                        'label' => __('Default', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and'
                    ],

                ],
            ],
            [
                'id' => 'st_hotel_icon_map_marker',
                'label' => __('Map marker icon', ST_TEXTDOMAIN),
                'desc' => __('Select map icon to show hotel on Map Google', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_hotel',
                'std' => 'http://maps.google.com/mapfiles/marker_black.png'
            ],
            /*------------- End Hotel Option --------------*/
        ];
        $taxonomy_hotel = st_get_post_taxonomy('st_hotel');
        if (!empty($taxonomy_hotel)) {
            foreach ($taxonomy_hotel as $k => $v) {
                $terms_hotel = get_terms($v['value']);
                $ids = [];
                if (!empty($terms_hotel)) {
                    foreach ($terms_hotel as $key => $value) {
                        $ids[] = [
                            'value' => $value->term_id . "|" . $value->name,
                            'label' => $value->name,
                        ];
                    }
                    $rt['flied_hotel']['settings'][] = [
                        'id' => 'custom_terms_' . $v['value'],
                        'label' => $v['label'],
                        'condition' => 'name:is(taxonomy),taxonomy:is(' . $v['value'] . ')',
                        'operator' => 'and',
                        'type' => 'checkbox',
                        'choices' => $ids,
                        'desc' => __('It will show all Hotel theme If you don\'t have any choose.', ST_TEXTDOMAIN),
                    ];
                    $ids = [];
                }
            }
        }

        return $r;
    }

    public function __hotelRoomSettings()
    {
        return [


            /*------------- Hotel Room Option --------------*/
            [
                'id' => 'hotel_room_search_layout',
                'label' => __('Select room search layout', ST_TEXTDOMAIN),
                'desc' => __('Select layout for searching room', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'hotel_room',
                'sparam' => 'layout',
                'section' => 'option_hotel_room'
            ],
            [
                'id' => 'hotel_room_search_result_page',
                'label' => __('Room Search Result Page', ST_TEXTDOMAIN),
                'desc' => __('Select page to show room search results', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'page',
                'sparam' => 'page',
                'section' => 'option_hotel_room',
            ],
            [
                'id' => 'hotel_single_room_layout',
                'label' => __('Single room layout', ST_TEXTDOMAIN),
                'desc' => __('Select layout to show single room', ST_TEXTDOMAIN),
                'type' => 'post-select-ajax',
                'post_type' => 'hotel_room',
                'sparam' => 'layout',
                'section' => 'option_hotel_room'
            ],
            'flied_room' => [
                'id' => 'room_search_fields',
                'label' => __('Room advanced search fields', ST_TEXTDOMAIN),
                'desc' => __('You can add, edit, delete, drag and drop any fields to setup advanced form', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_hotel_room',
                'std' => [
                    [
                        'title' => __('Where are you going?', ST_TEXTDOMAIN),
                        'name' => 'location',
                        'placeholder' => __("Location/ Zipcode", ST_TEXTDOMAIN),
                        'layout_col' => 12,
                        'layout2_col' => 12

                    ],
                    [
                        'title' => __('Check in', ST_TEXTDOMAIN),
                        'name' => 'checkin',
                        'layout_col' => 3,
                        'layout2_col' => 3
                    ],
                    [
                        'title' => __('Check out', ST_TEXTDOMAIN),
                        'name' => 'checkout',
                        'layout_col' => 3,
                        'layout2_col' => 3
                    ],
                    [
                        'title' => __('Room(s)', ST_TEXTDOMAIN),
                        'name' => 'room_num',
                        'layout_col' => 3,
                        'layout2_col' => 3
                    ]
                ],
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Field Type', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STRoom') ? STRoom::get_search_fields_name() : array()
                    ],
                    [
                        'id' => 'placeholder',
                        'label' => __('Placeholder', ST_TEXTDOMAIN),
                        'desc' => __('Placeholder', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'operator' => 'and',
                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Layout 1 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                    [
                        'id' => 'layout2_col',
                        'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'st_select_tax',
                        'post_type' => 'hotel_room'
                    ],
                    [
                        'id' => 'type_show_taxonomy_hotel',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'taxonomy_room',
                        'label' => __('Taxonomy Room', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy_room)',
                        'operator' => 'or',
                        'type' => 'st_select_tax',
                        'post_type' => 'hotel_room'
                    ],
                    [
                        'id' => 'type_show_taxonomy_hotel_room',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy_room)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __("Max number", ST_TEXTDOMAIN),
                        'condition' => 'name:is(list_name)',
                        'type' => "text",
                        'std' => 20
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],

                ]
            ],
            [
                'id' => 'hotel_room_allow_search_advance',
                'label' => __('Allow advanced search', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_hotel_room',
                'std' => 'off',
            ],
            [
                'id' => 'hotel_room_search_advance',
                'label' => __('Room advanced search fields', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_hotel_room',
                'condition' => 'hotel_room_allow_search_advance:is(on)',
                'desc' => __('You can add, edit, delete, drag and drop any field for setup advanced form', ST_TEXTDOMAIN),
                'settings' => [
                    [
                        'id' => 'name',
                        'label' => __('Field', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'choices' => class_exists('STRoom') ? STRoom::get_search_fields_name() : array()

                    ],
                    [
                        'id' => 'layout_col',
                        'label' => __('Layout 1 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                    [
                        'id' => 'layout2_col',
                        'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'operator' => 'and',
                        'std' => 4,
                        'choices' => [
                            [
                                'value' => '1',
                                'label' => __('column 1', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '2',
                                'label' => __('column 2', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '3',
                                'label' => __('column 3', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '4',
                                'label' => __('column 4', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '5',
                                'label' => __('column 5', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '6',
                                'label' => __('column 6', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '7',
                                'label' => __('column 7', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '8',
                                'label' => __('column 8', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '9',
                                'label' => __('column 9', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '10',
                                'label' => __('column 10', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '11',
                                'label' => __('column 11', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => '12',
                                'label' => __('column 12', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                    [
                        'id' => 'taxonomy',
                        'label' => __('Taxonomy', ST_TEXTDOMAIN),
                        'operator' => 'and',
                        'type' => 'st_select_tax',
                        'post_type' => 'hotel_room'
                    ],
                    [
                        'id' => 'type_show_taxonomy_hotel',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'type_show_taxonomy_hotel_room',
                        'label' => __('Type show', ST_TEXTDOMAIN),
                        'condition' => 'name:is(taxonomy_room)',
                        'operator' => 'or',
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'checkbox',
                                'label' => __('Checkbox', ST_TEXTDOMAIN),
                            ],
                            [
                                'value' => 'select',
                                'label' => __('Select', ST_TEXTDOMAIN),
                            ],
                        ]
                    ],
                    [
                        'id' => 'max_num',
                        'label' => __("Max number", ST_TEXTDOMAIN),
                        'condition' => 'name:is(list_name)',
                        'type' => "text",
                        'std' => 20
                    ],
                    [
                        'id' => 'is_required',
                        'label' => __('Field required', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'operator' => 'and',
                        'std' => 'on',
                    ],
                ],
                'std' => "",
            ],

            /*------------- End Hotel Room Option --------------*/
        ];
    }

    public function getAllSettings()
    {
        $allSetings = [
            [
                'id' => 'option_general',
                'title' => __('<i class="fa fa-tachometer"></i> General Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__generalSettings']
            ],
            [
                'id' => 'option_style',
                'title' => __('<i class="fa fa-paint-brush"></i> Styling Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__styleSettings']
            ],
            [
                'id' => 'option_page',
                'title' => __('<i class="fa fa-file-text"></i> Page Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__pageSettings']
            ],
            [
                'id' => 'option_blog',
                'title' => __('<i class="fa fa-bold"></i> Blog Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__blogSettings']
            ],
            [
                'id' => 'option_booking',
                'title' => __('<i class="fa fa-book"></i> Booking Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__bookingSettings']
            ],
            [
                'id' => 'option_location',
                'title' => __('<i class="fa fa-location-arrow"></i> Location Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__locationSettings']
            ],
            [
                'id' => 'option_review',
                'title' => __('<i class="fa fa-comments-o"></i> Review Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__reviewSettings']
            ],
            [
                'id' => 'option_hotel',
                'title' => __('<i class="fa fa-building"></i> Hotel Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__hotelSettings']
            ],
            [
                'id' => 'option_hotel_room',
                'title' => __('<i class="fa fa-building"></i> Room Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__hotelRoomSettings']
            ],
            [
                'id' => 'option_rental',
                'title' => __('<i class="fa fa-home"></i> Rental Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__rentalSettings']
            ],
            [
                'id' => 'option_car',
                'title' => __('<i class="fa fa-car"></i> Car Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__carSettings']
            ],
            [
                'id' => 'option_activity_tour',
                'title' => __('<i class="fa fa-suitcase"></i> Tour Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__tourSettings']
            ],
            [
                'id' => 'option_activity',
                'title' => __('<i class="fa fa-ticket"></i> Activity Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__activitySettings']
            ],
            [
                'id' => 'option_car_transfer',
                'title' => __('<i class="fa fa-car"></i> Transfer Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__carsTransferSettings']
            ],
            [
                'id' => 'option_hotel_alone',
                'title' => __('<i class="fa fa-building"></i> Hotel Alone Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__hotelAloneSettings']
            ],
            [
                'id' => 'option_tour_modern',
                'title' => __('<i class="fa fa-building"></i> Tocom Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__tourModernSettings']
            ],
            [
                'id' => 'option_partner',
                'title' => __('<i class="fa fa-users"></i> Partner Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__partnerSettings']
            ],
            [
                'id' => 'option_email_partner',
                'title' => __('<i class="fa fa-users"></i> Email Partner', ST_TEXTDOMAIN),
                'settings' => [$this, '__emailPartnerSettings']
            ],
            [
                'id' => 'option_search',
                'title' => __('<i class="fa fa-search"></i> Search Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__searchSettings']
            ],
            [
                'id' => 'option_email',
                'title' => __('<i class="fa fa-envelope"></i> Email Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__emailSettings']
            ],
            [
                'id' => 'option_email_template',
                'title' => __('<i class="fa fa-envelope"></i> Email Templates', ST_TEXTDOMAIN),
                'settings' => [$this, '__emailTemplateSettings']
            ],
            [
                'id' => 'option_social',
                'title' => __('<i class="fa fa-facebook-official"></i> Social Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__socialLoginSettings']
            ],
            [
                'id' => 'option_advance',
                'title' => __('<i class="fa fa-cogs"></i> Advance Options', ST_TEXTDOMAIN),
                'settings' => [$this, '__advanceSettings']
            ],
            [
                'id' => 'option_api_update',
                'title' => __('<i class="fa fa-download"></i> API Configure', ST_TEXTDOMAIN),
                'settings' => [$this, '__apiConfigureSettings']
            ],
            [
                'id' => 'option_bc',
                'title' => __('<i class="fa fa-hashtag"></i> Other options', ST_TEXTDOMAIN),
                'settings' => [$this, '__otherSettings']
            ],
        ];

        self::$_allSettings = $allSetings;

        return apply_filters('traveler_all_settings', $allSetings);
    }

    public function __styleSettings()
    {
        return [
            /*---- .START STYLE OPTIONS ----*/
            [
                'id' => 'general_style_tab',
                'label' => __('General', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_style',
            ],
            [
                'id' => 'st_theme_style',
                'label' => __('Theme style', ST_TEXTDOMAIN),
                'desc' => __('Showing classic or modern style for theme.', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_style',
                'choices' => [
                    [
                        'value' => 'classic',
                        'label' => __('Classic', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'modern',
                        'label' => __('Modern', ST_TEXTDOMAIN)
                    ],

                ],
                'std' => 'classic'
            ],
            [
                'id' => 'right_to_left',
                'label' => __('Right to left mode', ST_TEXTDOMAIN),
                'desc' => __('Enable "Right to let" displaying mode for content', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_style',
                'output' => '',
                'std' => 'off'
            ],
            [
                'id' => 'style_layout',
                'label' => __('Layout', ST_TEXTDOMAIN),
                'desc' => __('You can choose wide layout or boxed layout', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_style',
                'choices' => [
                    [
                        'value' => 'wide',
                        'label' => __('Wide', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'boxed',
                        'label' => __('Boxed', ST_TEXTDOMAIN)
                    ]

                ]
            ],
            [
                'id' => 'typography',
                'label' => __('Typography, Google Fonts', ST_TEXTDOMAIN),
                'desc' => __('To change the display of text', ST_TEXTDOMAIN),
                'type' => 'typography',
                'section' => 'option_style',
                'output' => 'body',
                'fonts' => st()->get_option('google_fonts')
            ],
            [
                'id' => 'google_fonts',
                'label' => __('Google Fonts', ST_TEXTDOMAIN),
                'type' => 'google-fonts',
                'section' => 'option_style',
                'choose' => $this->getGoogleFontsData(),
                'std' => st()->get_option('google_fonts')
            ],
            [
                'id' => 'star_color',
                'label' => __('Star color', ST_TEXTDOMAIN),
                'desc' => __('To change the color of star hotel', ST_TEXTDOMAIN),
                'type' => 'colorpicker',
                'section' => 'option_style',
            ],
            [
                'id' => 'body_background',
                'label' => __('Body Background', ST_TEXTDOMAIN),
                'desc' => __('To change the color, background image of body', ST_TEXTDOMAIN),
                'type' => 'background',
                'section' => 'option_style',
                'output' => 'body',
                'std' => [
                    'background-color' => "",
                    'background-image' => "",
                ]
            ],
            [
                'id' => 'main_wrap_background',
                'label' => __('Wrap background', ST_TEXTDOMAIN),
                'desc' => __('To change background color, bachground image of box surrounding the content', ST_TEXTDOMAIN),
                'type' => 'background',
                'section' => 'option_style',
                'output' => '.global-wrap',
                'std' => [
                    'background-color' => "",
                    'background-image' => "",
                ]
            ],
            [
                'id' => 'style_default_scheme',
                'label' => __('Default Color Scheme', ST_TEXTDOMAIN),
                'desc' => __('Select  available color scheme to display', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_style',
                'output' => '',
                'std' => '',
                'choices' => [
                    ['label' => '-- Please Select ---', 'value' => ''],
                    ['label' => 'Bright Turquoise', 'value' => '#0EBCF2'],
                    ['label' => 'Turkish Rose', 'value' => '#B66672'],
                    ['label' => 'Salem', 'value' => '#12A641'],
                    ['label' => 'Hippie Blue', 'value' => '#4F96B6'],
                    ['label' => 'Mandy', 'value' => '#E45E66'],
                    ['label' => 'Green Smoke', 'value' => '#96AA66'],
                    ['label' => 'Horizon', 'value' => '#5B84AA'],
                    ['label' => 'Cerise', 'value' => '#CA2AC6'],
                    ['label' => 'Brick red', 'value' => '#cf315a'],
                    ['label' => 'De-York', 'value' => '#74C683'],
                    ['label' => 'Shamrock', 'value' => '#30BBB1'],
                    ['label' => 'Studio', 'value' => '#7646B8'],
                    ['label' => 'Leather', 'value' => '#966650'],
                    ['label' => 'Denim', 'value' => '#1A5AE4'],
                    ['label' => 'Scarlet', 'value' => '#FF1D13'],
                ]
            ],
            [
                'id' => 'main_color',
                'label' => __('Main Color', ST_TEXTDOMAIN),
                'desc' => __('To change the main color for web', ST_TEXTDOMAIN),
                'type' => 'colorpicker',
                'section' => 'option_style',
                'std' => '#ed8323',

            ],
            [
                'id' => 'custom_css',
                'label' => __('CSS custom', ST_TEXTDOMAIN),
                'desc' => __('Use CSS Code to customize the interface', ST_TEXTDOMAIN),
                'type' => 'css',
                'section' => 'option_style',
            ],
            [
                'id' => 'header_tab',
                'label' => __('Header', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_style',
            ],
            [
                'id' => 'header_background',
                'label' => __('Header background', ST_TEXTDOMAIN),
                'desc' => __('To change background color, background image of header section', ST_TEXTDOMAIN),
                'type' => 'background',
                'section' => 'option_style',
                'output' => '.header-top, .menu-style-2 .header-top',
                'std' => [
                    'background-color' => "",
                    'background-image' => "",
                ]
            ],
            [
                'id' => 'gen_enable_sticky_header',
                'label' => __('Sticky header', ST_TEXTDOMAIN),
                'desc' => __('Enable fixed mode for header', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_style',
                'std' => 'off'
            ],
            [
                'id' => 'sort_header_menu',
                'label' => __('Header menu items', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_style',
                'desc' => __('Select  items displaying at the right of main menu', ST_TEXTDOMAIN),
                'settings' => [
                    [
                        'id' => 'header_item',
                        'label' => __('Item', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'desc' => __('Select header item shown in header right', ST_TEXTDOMAIN),
                        'choices' => [
                            [
                                'value' => 'login',
                                'label' => __('Login', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'currency',
                                'label' => __('Currency', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'language',
                                'label' => __('Language', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'search',
                                'label' => __('Search Header', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'shopping_cart',
                                'label' => __('Shopping Cart', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'link',
                                'label' => __('Custom Link', ST_TEXTDOMAIN)
                            ],
                        ]
                    ],
                    [
                        'id' => 'header_custom_link',
                        'label' => __('Link', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'condition' => 'header_item:is(link)'
                    ],
                    [
                        'id' => 'header_custom_link_title',
                        'label' => __('Title Link', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'condition' => 'header_item:is(link)'
                    ],
                    [
                        'id' => 'header_custom_link_icon',
                        'label' => __('Icon Link', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'desc' => __('Enter a awesome font icon. Example: <code>fa-facebook</code>', ST_TEXTDOMAIN),
                        'condition' => 'header_item:is(link)'
                    ]
                ],
            ],
            [
                'id' => 'menu_bar',
                'label' => __('Menu', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_style',
            ],
            [
                'id' => 'gen_enable_sticky_menu',
                'label' => __('Sticky menu', ST_TEXTDOMAIN),
                'desc' => __('This allows you to turn on or off "Sticky Menu Feature"', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_style',
                'std' => 'off',
            ],
            [
                'id' => 'menu_style',
                'label' => __('Select menu style', ST_TEXTDOMAIN),
                'desc' => __('Select  styles of menu ( it is default as style 1)', ST_TEXTDOMAIN),
                'type' => 'radio-image',
                'section' => 'option_style',
                'std' => '1',
                'choices' => [
                    [
                        'id' => '1',
                        'alt' => __('Default', ST_TEXTDOMAIN),
                        'src' => get_template_directory_uri() . '/img/nav1.png'
                    ],
                    [
                        'id' => '2',
                        'alt' => __('Logo Center', ST_TEXTDOMAIN),
                        'src' => get_template_directory_uri() . '/img/nav2-new.png'
                    ],
                ],
                'condition' => 'st_theme_style:is(classic)'
            ],
            [
                'id' => 'menu_style_modern',
                'label' => __('Select menu style', ST_TEXTDOMAIN),
                'desc' => __('Select  styles of menu ( it is default as style 1)', ST_TEXTDOMAIN),
                'type' => 'radio-image',
                'section' => 'option_style',
                'std' => '1',
                'choices' => [
                    [
                        'id' => '1',
                        'alt' => __('Default', ST_TEXTDOMAIN),
                        'src' => get_template_directory_uri() . '/img/nav3.png'
                    ],
                ],
                'condition' => 'st_theme_style:is(modern)'
            ],
            //Turn On/Off Mega menu
            [
                'id' => 'allow_megamenu',
                'label' => __('Mega menu', ST_TEXTDOMAIN),
                'desc' => __('Enable Mega Menu', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_style',
                'std' => 'off'
            ],

            [
                'id' => 'mega_menu_background',
                'label' => __('Mega Menu background', ST_TEXTDOMAIN),
                'desc' => __('To change mega menu\'s background', ST_TEXTDOMAIN),
                'type' => 'colorpicker',
                'section' => 'option_style',
                'std' => '#ffffff',

            ],

            [
                'id' => 'mega_menu_color',
                'label' => __('Mega Menu color', ST_TEXTDOMAIN),
                'desc' => __('To change mega menu\'s color', ST_TEXTDOMAIN),
                'type' => 'colorpicker',
                'section' => 'option_style',
                'std' => '#333333',
            ],

            [
                'id' => 'menu_color',
                'label' => __('Menu color', ST_TEXTDOMAIN),
                'desc' => __('To change the color for menu', ST_TEXTDOMAIN),
                'type' => 'typography',
                'section' => 'option_style',
                'std' => '#333333',
                'output' => '.st_menu ul.slimmenu li a, .st_menu ul.slimmenu li .sub-toggle>i,.menu-style-2 ul.slimmenu li a, .menu-style-2 ul.slimmenu li .sub-toggle>i, .menu-style-2 .nav .collapse-user',
                'fonts' => st()->get_option('google_fonts')
            ],
            [
                'id' => 'menu_background',
                'label' => __('Menu background', ST_TEXTDOMAIN),
                'desc' => __('To change menu\'s background image', ST_TEXTDOMAIN),
                'type' => 'background',
                'section' => 'option_style',
                'output' => '#menu1,#menu1 .menu-collapser, #menu2 .menu-wrapper, .menu-style-2 .user-nav-wrapper',
                'std' => [
                    'background-color' => "#ffffff",
                    'background-image' => "",
                ]
            ],
            [
                'id' => 'top_bar',
                'label' => __('Top Bar', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_style',
            ],
            [
                'id' => 'enable_topbar',
                'label' => __('Topbar menu', ST_TEXTDOMAIN),
                'desc' => __('On to Enable Top bar ', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_style',
                'std' => 'off',
            ],
            [
                'id' => 'sort_topbar_menu',
                'label' => __('Topbar menu options', ST_TEXTDOMAIN),
                'type' => 'list-item',
                'section' => 'option_style',
                'desc' => __('Select topbar item shown in topbar right', ST_TEXTDOMAIN),
                'settings' => [
                    [
                        'id' => 'topbar_item',
                        'label' => __('Item', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'desc' => __('Select item shown in topbar', ST_TEXTDOMAIN),
                        'choices' => [
                            [
                                'value' => 'login',
                                'label' => __('Login', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'currency',
                                'label' => __('Currency', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'language',
                                'label' => __('Language', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'search',
                                'label' => __('Search Topbar', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'shopping_cart',
                                'label' => __('Shopping Cart', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'link',
                                'label' => __('Custom Link', ST_TEXTDOMAIN)
                            ],
                        ]
                    ],
                    [
                        'id' => 'topbar_custom_link',
                        'label' => __('Link', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'condition' => 'topbar_item:is(link)'
                    ],
                    [
                        'id' => 'topbar_custom_link_title',
                        'label' => __('Title Link', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'condition' => 'topbar_item:is(link)'
                    ],
                    [
                        'id' => 'topbar_custom_link_icon',
                        'label' => __('Icon Link', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'desc' => __('Enter a awesome font icon. Example: <code>fa-facebook</code>', ST_TEXTDOMAIN),
                        'condition' => 'topbar_item:is(link)'
                    ],
                    [
                        'id' => 'topbar_custom_link_target',
                        'label' => __('Open new window', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'desc' => __('Open new window', ST_TEXTDOMAIN),
                        'condition' => 'topbar_item:is(link)'
                    ],
                    [
                        'id' => 'topbar_position',
                        'label' => __('Position', ST_TEXTDOMAIN),
                        'type' => 'select',
                        'choices' => [
                            [
                                'value' => 'left',
                                'label' => __('Left', ST_TEXTDOMAIN)
                            ],
                            [
                                'value' => 'right',
                                'label' => __('Right', ST_TEXTDOMAIN)
                            ],
                        ],
                    ],
                    [
                        'id' => 'topbar_is_social',
                        'label' => __('is Social Link', ST_TEXTDOMAIN),
                        'type' => 'on-off',
                        'std' => 'off'
                    ],
                    [
                        'id' => 'topbar_custom_class',
                        'label' => __('Custom Class', ST_TEXTDOMAIN),
                        'type' => 'text',
                        'desc' => __('Add your Custom Class', ST_TEXTDOMAIN),
                    ],
                ],
            ],
            [
                'id' => 'hidden_topbar_in_mobile',
                'label' => esc_html__('Hidden topbar in mobile', ST_TEXTDOMAIN),
                'desc' => __('Hidden top bar in mobile', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_style',
                'std' => 'on',
                'condition' => 'enable_topbar:is(on)'
            ],
            [
                'id' => 'gen_enable_sticky_topbar',
                'label' => __('Sticky topbar', ST_TEXTDOMAIN),
                'desc' => __('Enable fixed mode for topbar', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_style',
                'std' => 'off',
            ],
            [
                'id' => 'topbar_bgr',
                'label' => __('Topbar background', ST_TEXTDOMAIN),
                'desc' => __('To change background color for topbar', ST_TEXTDOMAIN),
                'type' => 'colorpicker',
                'condition' => 'enable_topbar:is(on)',
                'section' => 'option_style',
                'std' => '#333',
            ],
            [
                'id' => 'featured_tab',
                'label' => __('Featured', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_style',
            ],
            [
                'id' => 'st_text_featured',
                'label' => __("Feature text", ST_TEXTDOMAIN),
                'desc' => __("To change text to display featured content:", ST_TEXTDOMAIN) . "<br>Example: <br>-  Feature<xmp>- BEST <br><small>CHOICE</small></xmp>",
                'type' => 'custom-text',
                'section' => 'option_style',
                'class' => '',
                'std' => 'Featured',
                'v_hint' => 'yes'
            ],

            [
                'id' => 'st_ft_label_w',
                'label' => __("Label style fixed width (pixel)", ST_TEXTDOMAIN),
                'desc' => __("Type label width, Default : automatic ", ST_TEXTDOMAIN),
                'type' => 'text',
                'condition' => 'feature_style:is(label)',
                'section' => 'option_style',
            ],
            [
                'id' => 'st_text_featured_bg',
                'label' => __('Feature background color', ST_TEXTDOMAIN),
                'desc' => __('Text color of featured word', ST_TEXTDOMAIN),
                'type' => 'colorpicker',
                'section' => 'option_style',
                'class' => '',
                'std' => '#19A1E5',
            ],
            [
                'id' => 'st_sl_height',
                'label' => __("Sale label fixed height (pixel)", ST_TEXTDOMAIN),
                'desc' => __("Type label height, Default : automatic ", ST_TEXTDOMAIN),
                'type' => 'text',
                'condition' => 'sale_style:is(label)',
                'section' => 'option_style',
            ],
            [
                'id' => 'st_text_sale_bg',
                'label' => __('Promotion background color', ST_TEXTDOMAIN),
                'desc' => __('To change background color of the box displaying sale', ST_TEXTDOMAIN),
                'type' => 'colorpicker',
                'section' => 'option_style',
                'class' => '',
                'std' => '#cc0033',
            ],

            /*---- ./END STYLE OPTIONS ----*/
        ];
    }

    public function __generalSettings()
    {
        return [
            /*---- .START GENERAL OPTIONS ----*/
            [
                'id' => 'general_tab',
                'label' => __('General Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_general',
            ],
            [
                'id' => 'enable_user_online_noti',
                'label' => __('User notification info', ST_TEXTDOMAIN),
                'desc' => __('Enable/disable online notification of user', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_general',
                'std' => 'on'
            ],
            [
                'id' => 'enable_last_booking_noti',
                'label' => __('Last booking notification', ST_TEXTDOMAIN),
                'desc' => __('Enable/disable notification of last booking', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_general',
                'std' => 'on'
            ],
            [
                'id' => 'enable_user_nav',
                'label' => __('User navigator', ST_TEXTDOMAIN),
                'desc' => __('Enable/disable user dashboard menu', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_general',
                'std' => 'on'
            ],
            [
                'id' => 'noti_position',
                'label' => __('Notification position', ST_TEXTDOMAIN),
                'desc' => __('The position to appear notices', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_general',
                'std' => 'topRight',
                'choices' => [
                    [
                        'label' => __('Top Right', ST_TEXTDOMAIN),
                        'value' => 'topRight'
                    ],
                    [
                        'label' => __('Top Left', ST_TEXTDOMAIN),
                        'value' => 'topLeft'
                    ],
                    [
                        'label' => __('Bottom Right', ST_TEXTDOMAIN),
                        'value' => 'bottomRight'
                    ],
                    [
                        'label' => __('Bottom Left', ST_TEXTDOMAIN),
                        'value' => 'bottomLeft'
                    ]
                ],
            ],
            [
                'id' => 'admin_menu_normal_user',
                'label' => __('Normal user adminbar', ST_TEXTDOMAIN),
                'desc' => __('Show/hide adminbar for user', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_general',
                'std' => 'off'
            ],
            [
                'id' => 'once_notification_per_each_session',
                'label' => __('Only show notification for per session', ST_TEXTDOMAIN),
                'desc' => __('Only show the unique notification for each user\'s session', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_general',
                'std' => 'off'
            ],
            [
                'id' => 'st_weather_temp_unit',
                'label' => __('Weather unit', ST_TEXTDOMAIN),
                'desc' => __('The unit of weather- you can use Fahrenheit or Celsius or Kelvin', ST_TEXTDOMAIN),
                'type' => 'select',
                'section' => 'option_general',
                'std' => 'c',
                'choices' => [
                    [
                        'label' => __('Fahrenheit (f)', ST_TEXTDOMAIN),
                        'value' => 'f'
                    ],
                    [
                        'label' => __('Celsius (c)', ST_TEXTDOMAIN),
                        'value' => 'c'
                    ],
                    [
                        'label' => __('Kelvin (k)', ST_TEXTDOMAIN),
                        'value' => 'k'
                    ],
                ],
            ],
            [
                'id' => 'search_enable_preload',
                'label' => __('Preload option', ST_TEXTDOMAIN),
                'desc' => __('Enable Preload when loading site', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_general',
                'std' => 'on'
            ],
            [
                'id' => 'search_preload_image',
                'label' => __('Preload image', ST_TEXTDOMAIN),
                'desc' => __('This is the background for preload', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_general',
                'condition' => 'search_enable_preload:is(on)'
            ],
            [
                'id' => 'search_preload_icon_default',
                'label' => __('Customize preloader icon', ST_TEXTDOMAIN),
                'desc' => __('Using custom preload icon', ST_TEXTDOMAIN),
                'type' => 'on-off',
                'section' => 'option_general',
                'condition' => 'search_enable_preload:is(on)',
                'std' => 'off'
            ],
            [
                'id' => 'search_preload_icon_custom',
                'label' => __('Upload custom preload image', ST_TEXTDOMAIN),
                'desc' => __('This is the image for preload', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_general',
                'operator' => 'and',
                'condition' => 'search_preload_icon_default:is(on),search_enable_preload:is(on)'
            ],
            [
                'id' => 'list_disabled_feature',
                'label' => __('Disable Theme Service Option', ST_TEXTDOMAIN),
                'desc' => __('Hide one or many services of theme. In order to disable services (holtel, tour,..) you do not use, please tick the checkbox', ST_TEXTDOMAIN),
                'type' => 'checkbox',
                'section' => 'option_general',
                'choices' => [
                    [
                        'label' => __('Hotel', ST_TEXTDOMAIN),
                        'value' => 'st_hotel'
                    ],
                    [
                        'label' => __('Car', ST_TEXTDOMAIN),
                        'value' => 'st_cars'
                    ],
                    [
                        'label' => __('Rental', ST_TEXTDOMAIN),
                        'value' => 'st_rental'
                    ],
                    [
                        'label' => __('Tour', ST_TEXTDOMAIN),
                        'value' => 'st_tours'
                    ],
                    [
                        'label' => __('Activity', ST_TEXTDOMAIN),
                        'value' => 'st_activity'
                    ],
                    [
                        'label' => __('Flight', ST_TEXTDOMAIN),
                        'value' => 'st_flight'
                    ]
                ],
            ],

            [
                'id' => 'logo_tab',
                'label' => __('Logo', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_general',
            ],
            [
                'id' => 'logo',
                'label' => __('Logo options', ST_TEXTDOMAIN),
                'desc' => __('To change logo', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_general',
            ],
            [
                'id' => 'logo_new',
                'label' => __('Modern Logo', ST_TEXTDOMAIN),
                'desc' => __('To change modern logo', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_general',
            ],
            [
                'id' => 'logo_dashboard',
                'label' => __('Logo user dashboard', ST_TEXTDOMAIN),
                'desc' => __('To change user dashboard logo', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_general',
            ],
            [
                'id' => 'logo_retina',
                'label' => __('Retina logo', ST_TEXTDOMAIN),
                'desc' => __('Note: You MUST re-name Logo Retina to logo-name@2x.ext-name. Example:<br>
                                    Logo is: <em>my-logo.jpg</em><br>Logo Retina must be: <em>my-logo@2x.jpg</em>  ', ST_TEXTDOMAIN),
                'v_hint' => 'yes',
                'type' => 'upload',
                'section' => 'option_general',
                'std' => get_template_directory_uri() . '/img/logo@2x.png'
            ],
            [
                'id' => 'logo_mobile',
                'label' => __('Mobile logo', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_general',
                'std' => '',
                "desc" => __("To change logo used for mobile screen", ST_TEXTDOMAIN)
            ],
            [
                'id' => 'favicon',
                'label' => __('Favicon', ST_TEXTDOMAIN),
                'desc' => __('To change favicon', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_general',
            ],
            [
                'id' => '404_tab',
                'label' => __('404 Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_general',
            ],
            [
                'id' => '404_bg',
                'label' => __('Background for 404 page', ST_TEXTDOMAIN),
                'desc' => __('To change background for 404 error page', ST_TEXTDOMAIN),
                'type' => 'upload',
                'section' => 'option_general',
            ],
            [
                'id' => '404_text',
                'label' => __('Text of 404 page', ST_TEXTDOMAIN),
                'desc' => __('To change text for 404 page', ST_TEXTDOMAIN),
                'type' => 'textarea',
                'rows' => '3',
                'section' => 'option_general',
            ],
            [
                'id' => 'seo_tab',
                'label' => __('SEO Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_general',
            ],
            [
                'id' => 'st_seo_option',
                'label' => __('Enable SEO info', ST_TEXTDOMAIN),
                'desc' => __('Show/hide SEO feature', ST_TEXTDOMAIN),
                'std' => '',
                'type' => 'on-off',
                'section' => 'option_general',
                'class' => '',
            ],
            [
                'id' => 'st_seo_title',
                'label' => __('Site title', ST_TEXTDOMAIN),
                'desc' => __('To change SEO title', ST_TEXTDOMAIN),
                'std' => '',
                'type' => 'text',
                'section' => 'option_general',
                'class' => '',
                'condition' => 'st_seo_option:is(on)',
            ],
            [
                'id' => 'st_seo_desc',
                'label' => __('Site description', ST_TEXTDOMAIN),
                'desc' => __('To change SEO description', ST_TEXTDOMAIN),
                'std' => '',
                'rows' => '5',
                'type' => 'textarea-simple',
                'section' => 'option_general',
                'class' => '',
                'condition' => 'st_seo_option:is(on)',
            ],
            [
                'id' => 'st_seo_keywords',
                'label' => __('Site keywords', ST_TEXTDOMAIN),
                'desc' => __('To change the list of SEO keywords', ST_TEXTDOMAIN),
                'std' => '',
                'rows' => '5',
                'type' => 'textarea-simple',
                'section' => 'option_general',
                'class' => '',
                'condition' => 'st_seo_option:is(on)',
            ],
            [
                'id' => 'login_tab',
                'label' => __('Login Options', ST_TEXTDOMAIN),
                'type' => 'tab',
                'section' => 'option_general',
            ],
            [
                'id' => 'enable_captcha_login',
                'label' => __('Enable Google Captcha Login', ST_TEXTDOMAIN),
                'desc' => __('Show/hide google captcha for page login and register. Note: This function not support for popup login and popup register', ST_TEXTDOMAIN),
                'std' => 'off',
                'type' => 'on-off',
                'section' => 'option_general',
                'class' => '',
            ],
            [
                'id' => 'recaptcha_key',
                'label' => __('Re-Captcha Key', ST_TEXTDOMAIN),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'section' => 'option_general',
                'class' => '',
                'condition' => 'enable_captcha_login:is(on)',
            ],
            [
                'id' => 'recaptcha_secretkey',
                'label' => __('Re-Captcha Secret Key', ST_TEXTDOMAIN),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'section' => 'option_general',
                'class' => '',
                'condition' => 'enable_captcha_login:is(on)',
            ],
            /*---- .END GENERAL OPTIONS ----*/
        ];
    }

    public function __getEmailDocument()
    {
        ob_start();
        echo '<div class="format-setting type-textblock wide-desc">';

        echo '<div class="description">';
        ?>
        <style>
            table {
                border: 1px solid #CCC;
            }

            table tr:not(:last-child) td {
                border-bottom: 1px solid #CCC;
            }

            xmp {
                margin: 0;
            }
        </style>
        <p>
            <?php echo __('From version 1.1.9 you can edit email template for Admin, Partner, Customer by use our shortcodes system with some layout we ready build in. Below is the list shortcodes you can use', ST_TEXTDOMAIN); ?>
            :
        </p>
        <h4><?php echo __('List All Shortcode:', ST_TEXTDOMAIN); ?></h4>
        <ul>
            <li>
                <h5><?php echo __('Customer Information:', ST_TEXTDOMAIN); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr style="background: #CCC;">
                        <th align="center" width="33.3333%"><?php echo __('Name', ST_TEXTDOMAIN); ?></th>
                        <th align="center" width="33.3333%"><?php echo __('Code', ST_TEXTDOMAIN); ?></th>
                        <th align="center" width="33.3333%"><?php echo __('Description', ST_TEXTDOMAIN); ?></th>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('First Name', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_first_name]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Last Name', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_last_name]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Email', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_email]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Address', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_address]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Phone Number', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_phone]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('City', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_city]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Province', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_province]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Zipcode', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_zip_code]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Apt/Unit', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_apt_unit]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Country', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_country]</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Custom field (ST form builder)', ST_TEXTDOMAIN); ?>:</strong>
                        </td>
                        <td>[st_email_booking_custom_field]</td>
                        <td><i>@param 'field_name' 'string'.<br/>
                                Eg: field_name="st_media_upload"</i></td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __('Item booking Information', ST_TEXTDOMAIN); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr style="background: #CCC;">
                        <th align="center" width="33.3333%"><?php echo __('Name', ST_TEXTDOMAIN); ?></th>
                        <th align="center" width="33.3333%"><?php echo __('Code', ST_TEXTDOMAIN); ?></th>
                        <th align="center" width="33.3333%"><?php echo __('Description', ST_TEXTDOMAIN); ?></th>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Post type name', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_booking_posttype]</td>
                        <td><em><?php echo __('Show post-type name.', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('ID', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_id]</td>
                        <td>
                            <em><?php echo __('Display the Order ID', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Thumbnail Image', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_thumbnail]</td>
                        <td>
                            <em><?php echo __('Display the product\'s thumbnail image (if have)', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Date', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_date]</td>
                        <td>
                            <em><?php echo __('Display the booking date', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Special Requirements', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_note]</td>
                        <td>
                            <em><?php echo __('Display the information of the \'Special Requirements\' when booking', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Payment Method', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_payment_method]</td>
                        <td>
                            <em><?php echo __('Display the booking method', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Name', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_item_name]</td>
                        <td>
                            <em><?php echo __('Display item name of service.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Link', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_item_link]</td>
                        <td>
                            <em><?php echo __('Display the item title with a link under.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Number', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_number_item]</td>
                        <td>
                            <em><?php echo __('Display number of items when booking.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong><?php echo __('Check In', ST_TEXTDOMAIN); ?>:</strong><br/>
                            <strong><?php echo __('Check Out', ST_TEXTDOMAIN); ?>:</strong>
                        </td>
                        <td>
                            [st_email_booking_check_in]<br/>
                            [st_email_booking_check_out]<br/>
                            [st_check_in_out_title] <br/>
                            [st_check_in_out_value]
                        </td>
                        <td>
                            <em>
                                1. <?php echo __('Display check in, check out with Hotel and Rental', ST_TEXTDOMAIN); ?>
                                <br/>
                                2. <?php echo __('Display Pick-up Date and Drop-off Date with Car', ST_TEXTDOMAIN); ?>
                                <br/>
                                3. <?php echo __('Display Departure date and Return date with Tour and Activity', ST_TEXTDOMAIN); ?>
                            </em>
                        </td>
                    </tr>
                    <!-- Since 2.0.0 Start Time Order Shortcode -->
                    <tr>
                        <td><strong><?php echo __('Start Time', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_start_time]</td>
                        <td>
                            <em><?php echo __('Display Start Time with Tour', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Price', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_item_price]</td>
                        <td>
                            <em><?php echo __('Display item price (not included Tour and Activity)', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Origin Price', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_origin_price]</td>
                        <td>
                            <em>
                                <?php echo __('Display original price of the item (not included custom price, sale price and tax)', ST_TEXTDOMAIN); ?>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Sale Price', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_sale_price]</td>
                        <td>
                            <em><?php echo __('Display the sale price.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Tax Price', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_price_with_tax]</td>
                        <td>
                            <em><?php echo __('Display the price with tax.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Deposit Price', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_deposit_price]</td>
                        <td>
                            <em><?php echo __('Display the deposit require. ', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Total Price', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_total_price]</td>
                        <td>
                            <em><?php echo __('Display the total price (included sale price and tax).', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Tax Percent', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_total_price]</td>
                        <td>
                            <em><?php echo __('Display the total amount payment.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Address', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_item_address]</td>
                        <td>
                            <em><?php echo __('Display the address.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Website', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_item_website]</td>
                        <td>
                            <em><?php echo __('Display the website.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Email', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_item_email]</td>
                        <td>
                            <em><?php echo __('Display the email.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Phone', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_item_phone]</td>
                        <td>
                            <em><?php echo __('Display the phone.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item Fax', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_item_fax]</td>
                        <td>
                            <em><?php echo __('Display the fax.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Booking Status', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_status]</td>
                        <td>
                            <em><?php echo __('Display the booking status.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Booking Payment method', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_payment_method]</td>
                        <td>
                            <em><?php echo __('Display the booking payment method.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>

                    <tr>
                        <td><strong><?php echo __('Booking Guest Name', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_guest_name]</td>
                        <td>
                            <em><?php echo __('Display the booking guest name.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>

                </table>
            </li>
            <li>
                <h5><?php echo __('Use for Hotel', ST_TEXTDOMAIN); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr style="background: #CCC;">
                        <th align="center" width="33.3333%"><?php echo __('Name', ST_TEXTDOMAIN); ?></th>
                        <th align="center" width="33.3333%"><?php echo __('Code', ST_TEXTDOMAIN); ?></th>
                        <th align="center" width="33.3333%"><?php echo __('Description', ST_TEXTDOMAIN); ?></th>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Room Name', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_room_name]</td>
                        <td>
                            <em>
                                <?php echo __('Display the room name of hotel.', ST_TEXTDOMAIN); ?>
                                <br/>
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="Room Name"</xmp>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Extra Items', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_extra_items]</td>
                        <td>
                            <em><?php echo __('Display all service/facillities inside a room.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Extra Price', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_extra_price]</td>
                        <td>
                            <em><?php echo __('Display total price of service in room.', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __('Use for Car', ST_TEXTDOMAIN); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr style="background: #CCC;">
                        <th align="center" width="33.3333%"><?php echo __('Name', ST_TEXTDOMAIN); ?></th>
                        <th align="center" width="33.3333%"><?php echo __('Code', ST_TEXTDOMAIN); ?></th>
                        <th align="center" width="33.3333%"><?php echo __('Description', ST_TEXTDOMAIN); ?></th>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Car Time', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_check_in_out_time]</td>
                        <td>
                            <em>
                                <?php echo __('Display Pick up and Drop off time.', ST_TEXTDOMAIN); ?>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Car pick up from', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_pick_up_from]</td>
                        <td>
                            <em>
                                <?php echo __('Display Pick up from.', ST_TEXTDOMAIN); ?>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Car Drop off to ', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_drop_off_to]</td>
                        <td>
                            <em>
                                <?php echo __('Car Drop off to ', ST_TEXTDOMAIN); ?>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Car Driver Informations', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_car_driver]</td>
                        <td>
                            <em>
                                <?php echo __('Car Driver Informations  ', ST_TEXTDOMAIN); ?>
                            </em>
                        </td>
                    </tr>

                    <tr>
                        <td><strong><?php echo __('Car Equipments', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_equipments]</td>
                        <td>
                            <em>
                                <?php echo __('Display equipment list in a car.', ST_TEXTDOMAIN); ?>
                                </br />
                                @param 'tag' 'string'.<br/>
                                <xmp> Eg: tag="<h3>"</xmp>
                                <br/>
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="Equipments"</xmp>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Car Equipments Price', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_equipment_price]</td>
                        <td>
                            <em>
                                <?php echo __('Display total price of equipment in car.', ST_TEXTDOMAIN); ?>
                                <br/>
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="Equipments Price"</xmp>
                            </em>
                        </td>
                    </tr>

                    <tr>
                        <td><strong><?php echo __('Car Transfer Information', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_car_transfer_info]</td>
                        <td>
                            <em>
                                <?php echo __('Arrival Date', ST_TEXTDOMAIN); ?><br/>
                                <?php echo __('Departure Date', ST_TEXTDOMAIN); ?><br/>
                                <?php echo __('Passengers', ST_TEXTDOMAIN); ?><br/>
                                <?php echo __('Estimated distance', ST_TEXTDOMAIN); ?>
                            </em>
                        </td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __('Use for Tour and Activity', ST_TEXTDOMAIN); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr style="background: #CCC;">
                        <th align="center" width="33.3333%"><?php echo __('Name', ST_TEXTDOMAIN); ?></th>
                        <th align="center" width="33.3333%"><?php echo __('Code', ST_TEXTDOMAIN); ?></th>
                        <th align="center" width="33.3333%"><?php echo __('Description', ST_TEXTDOMAIN); ?></th>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Adult Information', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_adult_info]</td>
                        <td>
                            <em>
                                <?php echo __('Display info of adult (number and price)', ST_TEXTDOMAIN); ?>
                                </br />
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="No. Adults"</xmp>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Children Information', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_children_info]</td>
                        <td>
                            <em>
                                <?php echo __('Display info of adult (number and price)', ST_TEXTDOMAIN); ?>
                                </br />
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="No. Children"</xmp>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Infant Information', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_infant_info]</td>
                        <td>
                            <em>
                                <?php echo __('Display info of infant  (number and price)', ST_TEXTDOMAIN); ?>
                                </br />
                                @param 'title' 'string'.<br/>
                                <xmp> Eg: title="No. Infant"</xmp>
                            </em>
                        </td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __('Use for Flight', ST_TEXTDOMAIN); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr>
                        <td><strong><?php echo __('Flight Information', ST_TEXTDOMAIN); ?>:</strong></td>
                        <td>[st_email_booking_flight_extra_info]</td>
                        <td></td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __('Use for Confirm Email ', ST_TEXTDOMAIN); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr>
                        <td><strong><?php echo __('Confirm Link', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_confirm_link]</td>
                        <td><em><?php echo __('Get confirm email link', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __('Use for Approved Email', ST_TEXTDOMAIN); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr>
                        <td><strong><?php echo __('Account name', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_approved_email_admin_name]</td>
                        <td>
                            <em><?php echo __('Returns the name of the accounts was approved', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Post type', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_approved_email_item_type]</td>
                        <td>
                            <em><?php echo __('Returns type is type approved post (Hotel, Rental, Car, ...)', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item name', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_approved_email_item_name]</td>
                        <td>
                            <em><?php echo __('Returns the name of the item has been approved', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Item link', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_approved_email_item_link]</td>
                        <td><em><?php echo __('Returns link to item', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Approval date', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_approved_email_date]</td>
                        <td><em><?php echo __('Returns the Approval date', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __('MemberShip', ST_TEXTDOMAIN); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr>
                        <td><strong><?php echo __('Partner\'s Name', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_package_partner_name]</td>
                        <td><em><?php echo __('Returns the name of the partner', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Partner\'s Email', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_package_partner_email]</td>
                        <td><em><?php echo __('Returns email of the partner', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Partner\'s Phone', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_package_partner_phone]</td>
                        <td><em><?php echo __('Returns phone number of the partner', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Package Name', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_package_name]</td>
                        <td><em><?php echo __('Returns name of the package', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Package Price', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_package_price]</td>
                        <td><em><?php echo __('Returns price of the package', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Package Commission', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_package_commission]</td>
                        <td><em><?php echo __('Returns commission of the package', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Package Time', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_package_time]</td>
                        <td><em><?php echo __('Returns time available of the package', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Package Item Upload', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_package_upload]</td>
                        <td>
                            <em><?php echo __('Returns number of item uploaded of the package', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Package Item Set Featured', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_package_featured]</td>
                        <td>
                            <em><?php echo __('Returns number of item set featured of the package', ST_TEXTDOMAIN); ?></em>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo __('Package Description', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_package_description]</td>
                        <td><em><?php echo __('Returns description of the package', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                </table>
            </li>
            <li>
                <h5><?php echo __('Invoice', ST_TEXTDOMAIN); ?></h5>
                <table width="95%" style="margin-left: 20px;">
                    <tr>
                        <td><strong><?php echo __('Link Download Invoice', ST_TEXTDOMAIN); ?></strong></td>
                        <td>[st_email_booking_url_download_invoice]</td>
                        <td><em><?php echo __('Returns link download invoice', ST_TEXTDOMAIN); ?></em></td>
                    </tr>
                </table>
            </li>
        </ul>
        <?php
        echo '</div>';

        echo '</div>';
        $data = @ob_get_contents();
        ob_clean();
        ob_end_flush();
        $this->sendJson([
            'rows' => $data
        ]);
    }

    public function getGoogleFontsData()
    {
        $this->__fetchGoogleFonts();
        $google_fonts = get_theme_mod('st_google_fonts', []);

        return $google_fonts;
    }

    /**
     * @return ST_Admin_Settings
     * Google fonts
     * After one week will be reset google font
     */
    public function __fetchGoogleFonts()
    {
        $st_google_fonts_cache_key = 'st_google_fonts_cache';
        /* get the fonts from cache */
        $st_google_fonts = get_transient($st_google_fonts_cache_key);
        if (!is_array($st_google_fonts) or empty($st_google_fonts)) {
            $st_google_fonts = [];

            /* API url and key */
            $st_google_fonts_api_url = 'https://www.googleapis.com/webfonts/v1/webfonts';
            $st_google_fonts_api_key = st()->get_option('google_font_api_key', 'AIzaSyB8G-4UtQr9fhDYTiNrDP40Y5GYQQKrNWI');

            /* API arguments */
            $st_google_fonts_fields = ['family', 'variants', 'subsets'];
            $st_google_fonts_sort = 'alpha';

            /* Initiate API request */
            $st_google_fonts_query_args = [
                'key' => $st_google_fonts_api_key,
                'fields' => 'items(' . implode(',', $st_google_fonts_fields) . ')',
                'sort' => $st_google_fonts_sort
            ];

            /* Build and make the request */
            $st_google_fonts_query = esc_url_raw(add_query_arg($st_google_fonts_query_args, $st_google_fonts_api_url));
            $st_google_fonts_response = wp_safe_remote_get($st_google_fonts_query, ['sslverify' => false, 'timeout' => 15]);

            /* continue if we got a valid response */
            if (200 == wp_remote_retrieve_response_code($st_google_fonts_response)) {

                if ($response_body = wp_remote_retrieve_body($st_google_fonts_response)) {

                    /* JSON decode the response body and cache the result */
                    $st_google_fonts_data = json_decode(trim($response_body), true);

                    if (is_array($st_google_fonts_data) && isset($st_google_fonts_data['items'])) {

                        $st_google_fonts = $st_google_fonts_data['items'];

                        // Normalize the array key
                        $st_google_fonts_tmp = [];
                        foreach ($st_google_fonts as $key => $value) {
                            $id = remove_accents($value['family']);
                            $id = strtolower($id);
                            $id = preg_replace('/[^a-z0-9_\-]/', '', $id);
                            $st_google_fonts_tmp[$id] = $value;
                        }

                        $st_google_fonts = $st_google_fonts_tmp;

                        set_theme_mod('st_google_fonts', $st_google_fonts);
                        set_transient($st_google_fonts_cache_key, $st_google_fonts, WEEK_IN_SECONDS);

                    }

                }

            }
        } else {
            $google_fonts = get_theme_mod('st_google_fonts', []);
            if (empty($google_fonts)) {
                set_theme_mod('st_google_fonts', $st_google_fonts);
            }
        }
    }


    public static function inst()
    {
        if (!self::$_inst) self::$_inst = new self();

        return self::$_inst;
    }
}

ST_Admin_Settings::inst();