<?php
add_action('after_setup_theme', 'matysanchez_setup');
function matysanchez_setup()
{
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form'));
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1920;
    }
    register_nav_menus(array('main-menu' => esc_html__('Main Menu', 'matysanchez')));
}

add_filter('document_title_separator', 'matysanchez_document_title_separator');
function matysanchez_document_title_separator($sep)
{
    $sep = '|';
    return $sep;
}

add_filter('the_title', 'matysanchez_title');
function matysanchez_title($title)
{
    if ($title == '') {
        return '...';
    } else {
        return $title;
    }
}

add_filter('the_content_more_link', 'matysanchez_read_more_link');
function matysanchez_read_more_link()
{
    if (!is_admin()) {
        return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">...</a>';
    }
}

add_filter('excerpt_more', 'matysanchez_excerpt_read_more_link');
function matysanchez_excerpt_read_more_link($more)
{
    if (!is_admin()) {
        global $post;
        return ' <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">...</a>';
    }
}

add_filter('intermediate_image_sizes_advanced', 'matysanchez_image_insert_override');
function matysanchez_image_insert_override($sizes)
{
    unset($sizes['medium_large']);
    return $sizes;
}

add_action('widgets_init', 'matysanchez_widgets_init');
function matysanchez_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar Widget Area', 'matysanchez'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('wp_head', 'matysanchez_pingback_header');
function matysanchez_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('comment_form_before', 'matysanchez_enqueue_comment_reply_script');
function matysanchez_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}


add_filter('get_comments_number', 'matysanchez_comment_count', 0);
function matysanchez_comment_count($count)
{
    if (!is_admin()) {
        global $id;
        $get_comments = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}


// Load the theme stylesheets
function theme_styles()  
{ 
	wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css' );
	if(is_page('home')) {
		wp_enqueue_style('flexslider');
	}

}
add_action('wp_enqueue_scripts', 'theme_styles');



// Hooking up our function to theme setup
add_action('init', 'create_posttype');
// Our custom post type function
function create_posttype()
{
    register_post_type(
        'portfolios',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Portfolios'),
                'singular_name' => __('Portfolio')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'portfolio'),
        )
    );
}



function custom_post_type()
{
    $labels = array(
        'name'                => _x('Portfolios', 'Post Type General Name', 'matysanchez'),
        'singular_name'       => _x('Portfolio', 'Post Type Singular Name', 'matysanchez'),
        'menu_name'           => __('Portfolios', 'matysanchez'),
        'parent_item_colon'   => __('Parent Portfolio', 'matysanchez'),
        'all_items'           => __('All Portfolios', 'matysanchez'),
        'view_item'           => __('View Portfolio', 'matysanchez'),
        'add_new_item'        => __('Add New Portfolio', 'matysanchez'),
        'add_new'             => __('Add New', 'matysanchez'),
        'edit_item'           => __('Edit Portfolio', 'matysanchez'),
        'update_item'         => __('Update Portfolio', 'matysanchez'),
        'search_items'        => __('Search Portfolio', 'matysanchez'),
        'not_found'           => __('Not Found', 'matysanchez'),
        'not_found_in_trash'  => __('Not found in Trash', 'matysanchez'),
    );

    $args = array(
        'label'               => __('portfolio', 'matysanchez'),
        'description'         => __('Portfolio', 'matysanchez'),
        'labels'              => $labels,
        'supports'            => array('title', 'excerpt', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'editor'),
        'show_in_rest'        => true,
        'taxonomies'          => array('genres'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'menu_icon'           => 'dashicons-portfolio',
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'rewrite'             => array('slug' => 'portfolio')
    );

    // Registering your Custom Post Type
    register_post_type('portfolios', $args);
}
add_action( 'init', 'custom_post_type');

// CUSTOM LOGO
add_theme_support( 'custom-logo', array(
	'height'      => 100,
	'width'       => 400,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
) );

// WIDGETS
if ( function_exists('register_sidebar') ) {
    // From 1 to 3 :: widgets for 3 columns of the footer
    for ($i=1; $i < 4; $i++) { 
        register_sidebar(array(
            'name' => 'Footer Col '.$i,
            'before_widget' => '<div class="third col">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
          )
        );
    }
    // Home Page: photo + text
    register_sidebar(array(
        'name' => 'Home About',
        'before_widget' => '<div class="about-matias">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="title">',
        'after_title' => '</h1>',
      )
    );

    // What I Love Doing section at home page
    register_sidebar(array(
        'name' => 'Skills',
        'before_widget' => '<div class="third col skill">',
        'after_widget' => '</div>',
    ));
}


// FUNCTIONS USED INSIDE THE TEMPLATE
function monthName($number, $format = 'F') {
    $dateObj   = DateTime::createFromFormat('!m', $number);
    return $dateObj->format($format);
}

function returnFromTo($id) {
    $field_from_month = get_post_meta($id, 'from_month', true);
    $field_from_year = get_post_meta($id, 'from_year', true);
    $field_to_month = get_post_meta($id, 'to_month', true);
    $field_to_year = get_post_meta($id, 'to_year', true);
    $from = monthName($field_from_month, 'M') . " $field_from_year";
    if ($field_to_month == "Current" || !is_numeric($field_to_month))
        $to = "Present";
    else
        $to = monthName($field_to_month, 'M') . " $field_to_year";
    return "$from – $to";
}

/*add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);
function add_search_form($items, $args) {
if( $args->theme_location == 'main-menu' )
        $items .= get_search_form(array('bool' => false));
        //'<li class="search"><form role="search" method="get" id="searchform" action="'.home_url( '/' ).'"><input type="text" value="search" name="s" id="s" /><input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" /></form></li>';
        return $items;
}*/

add_action( 'init', 'matysanchez_pagination' ); // Add our HTML5 Pagination
function matysanchez_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links( array(
        'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'format'  => '?paged=%#%',
        'current' => max( 1, get_query_var( 'paged' ) ),
        'total'   => $wp_query->max_num_pages,
    ) );
}

add_theme_support( 'responsive-embeds' );



// This function will add ?ver=XXXX at the end of the file
function AddTimestampToAssets( $assetURI ) {
    // Get the FULL Relative URL
    $relativeURL = getcwd() . '/' . ltrim( (str_replace( home_url(), '', $assetURI )), '/' );
    
    // Check if the $relativeURL contains "?ver=", if so remove it
    if ( strpos ($relativeURL, "?ver=") )
        $relativeURL = explode("?ver=", $relativeURL)[0];

	if ( $relativeURL ) {
        // Get the timestamp using PHP native function
		$timestamp = filemtime( $relativeURL );
        // Add ?ver= parameter with value to the URI
        $assetURI = add_query_arg( 'ver', $timestamp, $assetURI );
        // Return the final URL
		return esc_url( $assetURI );
	}
}

// This function is going to add two WP filters to pass all the files to the AddTimestampToAssets function
function LoadAssetsWithVersioning() {
    // CSS's
    add_filter( 'style_loader_src', 'AddTimestampToAssets' );
    // JS's
    add_filter( 'script_loader_src', 'AddTimestampToAssets' );
}
// Let's force WP to run LoadAssetsWithVersioning when initialazing the site
if ( !is_admin() )
    add_action('init', 'LoadAssetsWithVersioning');