<?php
if (!class_exists("ST_Mega_Menu_Walker")) {
    class ST_Mega_Menu_Walker extends Walker_Nav_Menu
    {
        public function start_lvl(&$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"sub-menu\">\n";
        }

        public function end_lvl(&$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }

        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';
            $li_attributes = '';
            $class_names = $value = $class_name = '';

            $a_classes = '';
            if (isset($item->classes[0]) && strpos($item->classes[0], 'fa') >= 0) {
                $a_classes = $item->classes[0];
                unset($item->classes[0]);
            }

            $classes = empty($item->classes) ? array() : (array)$item->classes;
            $classes[] = ($args->has_children) ? '' : '';
            $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
            $classes[] = 'menu-item-' . $item->ID;
            $classes[] = 'level-' . $depth;
            if (isset($item->class_name) && !empty($item->class_name)) {
                $classes[] = $item->class_name;
            }

            if ($item->megamenu > 0 && $item->megamenu != '-1') {
                $classes[] = 'item-mega-menu has-mega-menu align-left';
            }else{
                $classes[] = 'item-mega-menu';
            }

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

            $megacontent = '';
            if ($this->hasMega($item, $depth)) {
                $megacontent = $this->genMegaMenuByConfig($item, $depth);
                //$class_names        .= ' aligned-' . $item->alignment;
                $args->has_children = true;
            }

            $class_names = ' class="' . esc_attr($class_names) . '"';
            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

            $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';
            //$attributes .= ($args->has_children) ? ' class="" ' : '';

            $hascaret = $this->hasMega($item, $depth);

            $item_output = $args->before;

            $item_output .= '<a class="fa ' . $a_classes . '"' . $attributes . '>';
			//$item_output .= $item->megamenu;
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= ($args->has_children) || $hascaret ? ' <span class="sub-toggle"><i class="fa fa-angle-down"></i></span></a>' : '</a>';

            $item_output .= $args->after;

            $item_output .= $megacontent;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }

        public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
        {
            if (!$element) {
                return;
            }

            $id_field = $this->db_fields['id'];

            if ($this->hasMega($element, $depth)) {
                $children_elements[$element->$id_field] = array();
            }

            if (is_array($args[0])) {
                $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
            } else if (is_object($args[0])) {
                $args[0]->has_children = !empty($children_elements[$element->$id_field]);
            }

            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'start_el'), $cb_args);

            if ($element->megamenu == '-1' || $element->megamenu == '') {
	        //if ($element->megamenu == '-1') {
                $id = $element->$id_field;

                if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {

                    foreach ($children_elements[$id] as $child) {

                        if (!isset($newlevel)) {
                            $newlevel = true;
                            $cb_args = array_merge(array(&$output, $depth), $args);
                            call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                        }
                        $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
                    }
                    unset($children_elements[$id]);
                }

                if (isset($newlevel) && $newlevel) {
                    $cb_args = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
                }
            }else{
                if($depth > 0){
                    $id = $element->$id_field;

                    if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {

                        foreach ($children_elements[$id] as $child) {

                            if (!isset($newlevel)) {
                                $newlevel = true;
                                $cb_args = array_merge(array(&$output, $depth), $args);
                                call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                            }
                            $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
                        }
                        unset($children_elements[$id]);
                    }

                    if (isset($newlevel) && $newlevel) {
                        $cb_args = array_merge(array(&$output, $depth), $args);
                        call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
                    }
                }
            }

            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'end_el'), $cb_args);
        }

        public function hasMega($item, $depth)
        {
            return isset($item->megamenu) && $item->megamenu && $depth == 0 && $item->megamenu != '-1';
        }

        public function genMegaMenuByConfig($item, $depth)
        {
            if($depth == 0){
                $post = get_post($item->megamenu);
                $content = '';
                if($post){
	                $content = do_shortcode($post->post_content);
	                wp_reset_postdata();
	                wp_reset_query();
                }
                return '<ul class="sub-menu mega-menu mega-'. $item->megamenu .'"><div class="dropdown-menu-inner">' . $content . '</div></ul>';
            }
        }
    }
}

class ST_Mega_Menu_Walker_New extends Walker_Nav_Menu{
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );

        // Default class.
        $classes = array( 'menu-dropdown' );

        /**
         * Filters the CSS class(es) applied to a menu list element.
         *
         * @since 4.8.0
         *
         * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
         * @param stdClass $args    An object of `wp_nav_menu()` arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        if($depth == 0){
            $output .= "{$n}{$indent}<i class='fa fa-angle-down'></i><ul$class_names>{$n}";
        }else{
            $output .= "{$n}{$indent}<i class='fa fa-angle-right'></i><ul$class_names>{$n}";
        }

    }
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';
        $a_classes = '';
        if(isset($item->classes[0]) && strpos($item->classes[0], 'fa') >=0){
            $a_classes = $item->classes[0];
            unset($item->classes[0]);
        }
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        if ($item->megamenu > 0) {
            $classes[] = 'menu-item-has-children has-mega-menu';
        }
        /**
         * Filters the arguments for a single nav menu item.
         *
         * @since 4.4.0
         *
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param WP_Post  $item  Menu item data object.
         * @param int      $depth Depth of menu item. Used for padding.
         */
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        /**
         * Filters the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param WP_Post  $item    The current menu item.
         * @param stdClass $args    An object of wp_nav_menu() arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );

        $megacontent = '';
        if ($this->hasMega($item, $depth)) {
            $megacontent = $this->genMegaMenuByConfig($item, $depth);
            //$class_names        .= ' aligned-' . $item->alignment;
            $args->has_children = true;
        }

        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        /**
         * Filters the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param WP_Post  $item    The current menu item.
         * @param stdClass $args    An object of wp_nav_menu() arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $title  Title attribute.
         *     @type string $target Target attribute.
         *     @type string $rel    The rel attribute.
         *     @type string $href   The href attribute.
         * }
         * @param WP_Post  $item  The current menu item.
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param int      $depth Depth of menu item. Used for padding.
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = $item->title;

        $hascaret = $this->hasMega($item, $depth);

        $item_output = $args->before;
        $item_output .= '<a class="'. $a_classes .'"'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= $hascaret ? ' <i class="fa fa-angle-down"></i></a>' : '</a>';
        $item_output .= $args->after;
        $item_output .= $megacontent;

        /**
         * Filters a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string   $item_output The menu item's starting HTML output.
         * @param WP_Post  $item        Menu item data object.
         * @param int      $depth       Depth of menu item. Used for padding.
         * @param stdClass $args        An object of wp_nav_menu() arguments.
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        if (!$element) {
            return;
        }

        $id_field = $this->db_fields['id'];

        if ($this->hasMega($element, $depth)) {
            $children_elements[$element->$id_field] = array();
        }

        if (is_array($args[0])) {
            $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
        } else if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }

        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        if ($element->megamenu == '-1' || $element->megamenu == '') {
            //if ($element->megamenu == '-1') {
            $id = $element->$id_field;

            if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {

                foreach ($children_elements[$id] as $child) {

                    if (!isset($newlevel)) {
                        $newlevel = true;
                        $cb_args = array_merge(array(&$output, $depth), $args);
                        call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                    }
                    $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
                }
                unset($children_elements[$id]);
            }

            if (isset($newlevel) && $newlevel) {
                $cb_args = array_merge(array(&$output, $depth), $args);
                call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
            }
        }else{
            if($depth > 0){
                $id = $element->$id_field;

                if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {

                    foreach ($children_elements[$id] as $child) {

                        if (!isset($newlevel)) {
                            $newlevel = true;
                            $cb_args = array_merge(array(&$output, $depth), $args);
                            call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                        }
                        $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
                    }
                    unset($children_elements[$id]);
                }

                if (isset($newlevel) && $newlevel) {
                    $cb_args = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
                }
            }
        }

        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }

    public function hasMega($item, $depth)
    {
        return isset($item->megamenu) && $item->megamenu && $depth == 0 && $item->megamenu != '-1';
    }

    public function genMegaMenuByConfig($item, $depth)
    {
        if($depth == 0){
            $content = STTemplate::get_vc_pagecontent($item->megamenu);
            return '<ul class="sub-menu mega-menu mega-'. $item->megamenu .'"><div class="dropdown-menu-inner">' . $content . '</div></ul>';
        }
    }
}

