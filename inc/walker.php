<?php

/* Collection of Walker classes */

	/* wp generates a simple nav menu. To manipulate it we need to target specific tag with functions()

		wp_nav_menu()

		<div class="menu-container">
			<ul> // start_lvl()
				<li><a><span> // start_el()

                    "About me"

					</a></span>
                    <ul> "$submenu = ($depth..." makes a new list if there is a submenu
                        </li> // end_el()

				<li><a>Link</a></li>
				<li><a>Link</a></li>
				<li><a>Link</a></li>

			</ul> // end_lvl()
		</div>

	*/

        // start with creating a class. Then extend it to a existing pre-existing class.
    class Walker_Nav_Primary extends Walker_Nav_menu{

            // & say to WP; Maintain all DATA/INFO thats inside like "Home" "Contact" etc
        function start_lvl( &$output, $depth = 0, $args = null ){ //ul
                // Code repeat string to make a space before the submenu txt
            $indent = str_repeat("\t",$depth);
                // Create a new ul if there is a submenu <- defult class in WP
            $submenu = ($depth > 0) ? ' sub-menu' : '';
                // Put . before = tells PHP to merge whats inside of $output aka "About me"
                // Code adding class tags to the existing ul to transform it into a submenu with depth to make room/space
                // "\n": A newline character that adds a line break, moving the cursor to the next line.
            $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
        }
                // $item keeps the tags inside. $args handle the data inside the array. ID gives a defult id to the tag
        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ // 1. li a span
                // To not make submenu =null we need to populate it
            $indent = ($depth) ? str_repeat("\t",$depth) : '';
 
            $li_attributes = '';

            $class_names = $value = '';
                // use empty() PHP code to make sure the class value is never empty
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
                // the [] merge the array in classes with an another array
                // to see if there a sub-sub-menu we add the bootstrap class 'dropdown' to the code
            $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
                // need to check if there is children in different corner of the webbpage. Home = none, Contact = yes, About us = yes etc
                // also checks side menus etc
            $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
                // add the new bootstrap/html tags to the ID
            $classes[] = 'menu-item-' . $item->ID;
                // check if the item has a depth cuz the admin can always change and update the menu/sub-menu apperance from the admin panel
                // this if checks how many submenus there are and add if its needed with bootstraps 'dropdown-submenu'
            if( $depth && $args->walker->has_children ){
                $classes[] = 'dropdown-submenu';
            }
                // merge all arrays after they checked what apperance the manu has with PHP code join()
                // PHP code array_filter() takes the arrays that has data and display them as classes inside the html tag
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
            /* esc_attr(), it will escape characters that have special meaning in HTML, such as angle brackets
            ("<" and ">"), double quotes ("), single quotes ('), and ampersands (&), by converting them into
            their respective HTML entities. This ensures that the string is treated as data and not code when
            rendered in HTML, preventing potential security issues. */
            $class_names = ' class="' . esc_attr($class_names) . '"';

                // ID inside the HTML tags turn
            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->object_id, $args);
                // strlen() PHP code checks if the $id has some sort of length
                // check with if loop and put and id there or leave it ''
            $id = strlen($id) ? ' id="' . esc_attr($id) . '" ' : '';
                // at last megre everything with the already populated string like class="pull-left ->[Here]" id="button ->[Here]" that exist in $indent
            $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

                // always check if the attribute is empty or not
            $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
                // need to merge every indipendent attribute with anoter .= means the previus data will not be overwritten
            $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
                // rel= attribute as a way to specify a wide range of link relationships, including "author," "me," "nofollow," and more. BUT WP USES xfn
            $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
                // checking and adding sub menu
            $attributes .= ( $args->walker->has_children ) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

            // we add everything to our menu and print it out
            // always use before and after to wrap around the code that adds things so WP understands
            $item_output = $args->before;
                $item_output .= '<a' . $attributes . '>';
                    // The link tittle is the same as haveing a submenu Food->pizza, desert. klicking either one jump us to pizza OR desert.
                    // depending on how the admin build the menu in admin panel
                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                    // check if there is a sub sub menu
                $item_output .= ( $depth == 0 && $args->walker->has_children ) ? ' <b class="caret"></b></a>' : '</a>';
            $item_output .= $args->after;

            // At the very last MERGE EVERYTHING
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        }

/*
    	function end_el(){ // closing li a span

	    }

    	function end_lvl(){ // closing ul

	    }
*/

    }
