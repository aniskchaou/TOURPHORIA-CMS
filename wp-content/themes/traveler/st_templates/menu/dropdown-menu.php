<?php 
if (empty($menu)) return ; 
 
if(!class_exists('Bootstrap_Walker_Nav_Menu')){
    class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul role = \"menu\" class=\"dropdown-menu\">\n";
        }
        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) { 
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID; 
            $classes[]= ($args->walker->has_children)?  " dropdown " : " " ;
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : ' ';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
            $output .= $indent . '<li' . $id . $class_names .'>';
            $atts = array();
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
            $atts['class']  ='';
            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
            if(!isset($atts['class'])) $class='';
            else
                $class=$atts['class'];
                $menu_items_with_children = array();
            $atts['class']=$class ; 
            $atts['class'] .= ($args->walker->has_children) ? '  dropdown-toggle ' : '';
            $atts['data-toggle'] = "";
            $atts['data-toggle'] .= ($args->walker->has_children) ? '  dropdown ' : '';
            $attributes = '';

            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            $item_output = $args->before;
            $item_output .= '<a'. $attributes  .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            if (in_array('menu-item-has-children' , $item->classes) and !$item->menu_item_parent){               
                $item_output .= ' <span class="caret"></span></a>'; 
            }else {
                $item_output .= '</a>';
            }

            $item_output .= $args->after;
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
        public function end_el( &$output, $item, $depth = 0, $args = array() ) {
            if($depth>=1)
            {
                $output .= "</li>\n";
            }else
            {
                $output .= "</li>\n";
            }
        }
        function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) { 
            if ( $element->current )
            $element->classes[] = 'active';

            $element->is_dropdown = !empty( $children_elements[$element->ID] );

            if ( $element->is_dropdown ) {
                if ( $depth === 0 ) {
                    $element->classes[] = 'dropdown';
                } elseif ( $depth === 1 ) { 
                    $element->classes[] = 'dropdown-submenu';
                }
            }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }

    } // Walker_Nav_Menu
}
$defaults = array(
	'theme_location'  => '',
	'menu'            => $menu,
	'container'       => 'div',
	'container_class' => 'top_toolbar_menu',
	'container_id'    => '',
	'menu_class'      => 'nav navbar-nav',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s navbar topbar_nav" role="navigation">%3$s</ul>',
	'depth'           => 0,
	'walker'          => new Bootstrap_Walker_Nav_Menu()
);
wp_nav_menu( $defaults );
?>
    	