<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 4/20/2017
     * Time: 3:19 PM
     */
    class st_menu_walker extends Walker_Nav_Menu{
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

            $item_output = $args->before;
            $item_output .= '<a class="fa '. $a_classes .'"'. $attributes .'>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

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
    }
    class st_menu_walker_new extends Walker_Nav_Menu{
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

            $item_output = $args->before;
            $item_output .= '<a class="'. $a_classes .'"'. $attributes .'>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

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
    }

if (!class_exists("Single_Nav_Mainmenu")) {
    class Single_Nav_Mainmenu extends Walker_Nav_menu{
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
            $display_depth = ( $depth + 1); // because it counts the first submenu as 0
            $classes = array(
                'menu-dropdown',
                ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
                ( $display_depth >=2 ? 'submenu menu-dropdown' : '' ),
                'menu-depth-' . $display_depth
            );
            $class_names = implode( ' ', $classes );
     
            // Build HTML for output.
            $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
        }

        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $wp_query;
            $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
     
            // Depth-dependent classes.
            if($args->walker->has_children){
                $depth_class_names = 'menu-dropdown menu-item-depth-' . $depth;
            }else{
                $depth_class_names = 'menu-item-depth-' . $depth;
            }
            
     
            // Passed classes.
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $class_names = esc_attr( implode( ' ', apply_filters( 'sub-menu mega-sub-menu mega-md', array_filter( $classes ), $item ) ) );
     
            // Build HTML.
            $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
     
            // Link attributes.
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
     
            // Build HTML output and pass through the proper filter.
            if($args->walker->has_children){
                $item_output = sprintf( '%1$s<a%2$s >%3$s%4$s%5$s<i class="fa fa-angle-down"></i></a>%6$s',
                $args->before,
                $attributes,
                $args->link_before,
                apply_filters( 'the_title', $item->title, $item->ID ),
                $args->link_after,
                $args->after
            );
            } else {
                $item_output = sprintf( '%1$s<a%2$s">%3$s%4$s%5$s</a>%6$s',
                $args->before,
                $attributes,
                $args->link_before,
                apply_filters( 'the_title', $item->title, $item->ID ),
                $args->link_after,
                $args->after
            );
            } 
            
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }
}?>