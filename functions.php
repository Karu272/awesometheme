<?php
/*
	==========================================
	 Include scripts
	==========================================
*/
/* linking the CSS and JS file */
function awesome_script_enqueue() {
    // css
	/* for wp to find path use funktion get_template_directory_uri() */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all');
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/awesome.css', array(), '1.0.1', 'all');
    // js
    wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.4', true);
    wp_enqueue_script('customjs', get_template_directory_uri() . '/js/awesome.js', array(), '1.0.0', true);
}
/* adding the CSS and JS */
add_action('wp_enqueue_scripts', 'awesome_script_enqueue');


/*
	==========================================
	 Activate menus
	==========================================
*/
/* adding menus and the chance to create different nav bars for header and footer */
function awesome_theme_setup() {

    add_theme_support('menus');
	/* first option needs to be lowercase single word(primary or secondary) cuz its SLUG. second is just a description of the menu */
    register_nav_menu( 'primary', 'Primary Header Navigation' );
    register_nav_menu( 'secondary', 'Secondary Footer Navigation' );
}
add_action('init', 'awesome_theme_setup');

/*
	==========================================
	 Theme support function
	==========================================
*/

/* adding costum scripts for apperance outside of WP option in WP */
/* adding custom background */
add_theme_support( 'custom-background' );
/* adding custom header - continue in header.php */
add_theme_support( 'custom-header' );
/* adding thumbnails - continu in index.php */
add_theme_support( 'post-thumbnails' );
/* adding formats to the blog posts. more tags of what format to activate are at !!wordpress.org!! at theme support */
add_theme_support( 'post-formats', array('aside','image','video') );
// 2023 and this still change. need to look up newer tutorials. look at searchform.php to continue.
add_theme_support('html5', array('search-form'));

/*
	==========================================
	Sidebar function
	==========================================
*/

/* In WordPress, template tags like this are often used to dynamically generate HTML markup based on contextual
information. The values that replace the placeholders could come from various sources, such as theme options,
template parameters, or WordPress functions. These placeholders ensure that the generated HTML remains consistent
and can adapt to different scenarios within the theme. */
/* %1$s is a placeholder that will be replaced with an actual
value when the code is generated. In this context, it's probably
intended to be replaced with a unique identifier for the widget.
This identifier might be important for styling or JavaScript interactions. */
/* %2$s This sets the CSS classes for the <aside> element. %2$s is another
placeholder that will be replaced with a value. */

function awesome_widget_setup() {

	register_sidebar(
		array(
		'name' => 'Sidebar',
		'id' => 'sidebar-1',
		'class' => 'custom',
		'description' => 'Standard Sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	)
);

	register_sidebar(
		array(
		'name' => 'Sidebar2',
		'id' => 'sidebar-2',
		'class' => 'custom',
		'description' => 'Standard Sidebar2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	)
);

}
/* add_action need 2 string parameters. first is WHEN its called second the name of the function.
because this handle the widget we use widgets initialization(diagnostic tests are run and the operating system is loaded.) */
/* If you want to create more siderbars inside the function like SIDEBAR2 just create another hook
with different name and ID  */
add_action('widgets_init','awesome_widget_setup');


/*
	==========================================
	Include Walker file
	==========================================
*/

// This grabs the walker.php for submenus setup

require get_template_directory(  ) . '/inc/walker.php';

/*
	==========================================
	Head function
	==========================================
*/

function awesome_remove_version() {
	return '';
}
add_filter('the_generator','awesome_remove_version');

/*
	==========================================
	Custom Post Type
	==========================================
*/
// create a custume page that will be standing alone from the other pages
// in this case a portfolio page
function awesome_custome_post_type () {
	// add own names to to setup the page
	$labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio',
		'add_new' => 'Add Portfolio Work',
		'all_items' => 'All Items',
		'add_new_item' => 'Add Item',
		'edit_item' => 'Edit Item',
		'new_item' => 'New Item',
		'view-item' => 'View Item',
		'search_item' => 'Search Portfolio',
		'not_found' => 'No items found',
		'not_found_in_trash' => 'No items found in trash',
		'parent_item_colon' => 'Parent Item',
	);
	// all this activate the different typ of edit settings when creating a post
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		//'taxonomies' => array('category','post_tag'), We dont want the same catagories/tags as the blog post for the portfolio post
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type( 'portfolio', $args);
}
add_action('init', 'awesome_custome_post_type');

// Creates new catagories/tags for our custome page

function awesome_custom_taxonomies() {

    // add new taxonomy hierarchical
    $labels = array(
        'name' => 'Fields', // should be plural
        'singular_name' => 'Field',
        'search_items' => 'Search Fields',
        'all_items' => 'All Fields',
        'parent_item' => 'Parent Field',
        'parent_item_colon' => 'Parent Field: ',
        'edit_item' => 'Edit Field',
        'update_item' => 'Update Field',
        'add_new_item' => 'Add New Field',
        'new_item_name' => 'New Field Name',
        'menu_name' => 'Fields',
    );
			// OBS! if change names!! all the tags will disappear!!!
    $args = array(
        'hierarchical' => true, // Typo: 'hierachical' should be 'hierarchical'
        'labels' => $labels, // Typo: $lavels should be $labels
        'show_ui' => true,
        'show_admin_column' => true, // filter the column after tag name
        'query_var' => true,
        'rewrite' => array( 'slug' => 'field' ), // NEVER USE "type" cuz it crashes the bootstrap
        // rewrite is changing the slug to a better SEO friendly link
    );

    // use the first parameter as the name of the taxonomy, in this case 'field'
    register_taxonomy( 'field', array('portfolio'), $args ); // Typo: $ars should be $args

    // add new taxonomy NOT hierarchical
	register_taxonomy( 'software', 'portfolio', array(
		'label' => 'Software',
		'rewrtite' => array( 'slug' => 'software' ),
		'hierarchical' => false,
	));
}

add_action('init', 'awesome_custom_taxonomies');

/*
	==========================================
	Custom Term Function
	==========================================
*/

function awesome_get_terms( $postID, $term) {

	$terms_list = wp_get_post_terms($postID, $term);
	$output = '';

        $i = 0;
            foreach($terms_list as $term){
                $i++;
					// to put a space and a , after each tag in taxonomy
                    if($i > 1 ) { $output .= ', '; }
					// store the taxonomy tag plus a space in $output.
					// .= is not replacing its addin the data on the existing data.
					// taxonomy + , ' = bajs, etc, etc,
					$output .= '<a href="' . get_term_link( $term ) . '">'. $term->name .'</a>';
					// to make the tags in the post clickable and linked to the tags in same catagorie
					// we use get_term_link() and just add the varible with stored data from erlier
            }
	return $output;
} // if this not works. remember to refresh the permalinks in settings.

// try to push this to github