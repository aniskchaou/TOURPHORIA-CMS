<?php

/**
 * Created by PhpStorm.
 * User: me664
 * Date: 11/24/14
 * Time: 8:58 AM
 */
class ST_List_Item_Post_Type
{
    public $url;
    public $dir;

    function __construct()
    {

        $this->dir = st()->dir('plugins/custom-option-tree');
        $this->url = st()->url('plugins/custom-option-tree');


        add_action('admin_enqueue_scripts', array($this, 'add_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'add_scripts'));
    }

    function init()
    {


        if (!class_exists('OT_Loader')) return false;


        //Default Fields
        add_filter('ot_post_select_ajax_unit_types', array($this, 'ot_post_select_ajax_unit_types'), 10, 2);


        add_filter('ot_option_types_array', array($this, 'ot_add_custom_option_types'));
        add_action('wp_ajax_list_item_post_type', array($this, 'list_item_post_type'));
        add_action('wp_ajax_nopriv_list_item_post_type', array($this, 'list_item_post_type'));

        include_once $this->dir . '/custom-css-output.php';

    }

    function add_scripts()
    {

    }

    function list_item_post_type()
    {
        $post_type = STInput::request('post_type', 'location');
        $query = array(
            'post_type' => $post_type,
            'posts_per_page' => -1
        );
        query_posts($query);
        $result = array();
        while (have_posts()): the_post();
            $result[] = array(
                'title' => get_the_title(),
                'id' => get_the_ID()
            );
        endwhile;
        wp_reset_query();
        wp_reset_postdata();

        echo json_encode($result);
        die;

    }

    function ot_post_select_ajax_unit_types($array, $id)
    {
        return apply_filters('list_item_post_type', $array, $id);
    }

    function ot_add_custom_option_types($types)
    {
        $types['list_item_post_type'] = __('List Item Post Type', ST_TEXTDOMAIN);

        return $types;
    }

}


$a = new ST_List_Item_Post_Type();
$a->init();


if (!function_exists('ot_type_list_item_post_type')):
    function ot_type_list_item_post_type($args = array())
    {
        $st_custom_ot = new ST_List_Item_Post_Type();

        $url = $st_custom_ot->url;


        $default = array(

            'field_post_type' => 'location',
            'field_desc' => 'Location'
        );


        $args = wp_parse_args($args, $default);


        extract($args);

        $post_type = $field_post_type;

        /* verify a description */
        $has_desc = $field_desc ? true : false;

        echo '<div class="format-setting type-post_select_ajax ' . ($has_desc ? 'has-desc' : 'no-desc') . '">';

        echo balanceTags($has_desc ? '<div class="description">' . htmlspecialchars_decode($field_desc) . '</div>' : '');

        echo '<div class="format-setting-inner">';
        $pl_name = '';
        $pl_desc = '';
        if ($field_value) {
            $pl_name = get_the_title($field_value);
            $pl_desc = "ID: " . get_the_ID($field_value);
        }

        $post_type_json = $post_type;

        $html_location = TravelHelper::treeLocationHtml();
        $multi_location = get_post_meta(get_the_ID(), 'multi_location', true);
        if (!empty($multi_location) && !is_array($multi_location)) {
            $multi_location = explode(',', $multi_location);
        }
        if (empty($multi_location)) {
            $multi_location = array('');
        }
        ?>
        <div class="form-group st-select-loction">
            <input placeholder="<?php echo __('Type to search', ST_TEXTDOMAIN); ?>" type="text"
                   class="widefat form-control" name="search" value="">
            <div class="list-location-wrapper">
                <?php
                if (is_array($html_location) && count($html_location)):
                    foreach ($html_location as $key => $location):
                        ?>
                        <div data-name="<?php echo $location['parent_name']; ?>" class="item"
                             style="margin-left: <?php echo $location['level'] . 'px;'; ?> margin-bottom: 5px;">
                            <label for="<?php echo 'location-' . $location['ID']; ?>">
                                <input <?php if (in_array('_' . $location['ID'] . '_', $multi_location)) echo 'checked'; ?>
                                        id="<?php echo 'location-' . $location['ID']; ?>" type="checkbox"
                                        name="<?php echo esc_attr($field_name); ?>[]"
                                        value="<?php echo '_' . $location['ID'] . '_'; ?>"
                                        data-post-id="<?php echo $location['post_id']; ?>"
                                        data-parent="<?php echo $location['parent_id']; ?>">
                                <span><?php echo $location['post_title']; ?></span>
                            </label>
                        </div>
                    <?php endforeach; endif; ?>
            </div>
        </div>
        <?php
        echo '</div>';
        echo '</div>';
    }
endif;