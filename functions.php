<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action('wp_enqueue_scripts', 'add_google_fonts');
function add_google_fonts() {
    wp_enqueue_style('add_google_fonts', "https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,700,700i,800i,900i", false);
}

add_action( 'after_setup_theme', 'register_footer_menu' );

function register_footer_menu() {
    register_nav_menu(  'secondary', __('Footer Menu', 'understrap-child')  );
}

//Debug
function dump($var) {
    ob_start();
    var_dump($var);
    $output = ob_get_clean();
    echo preg_replace("/=>(\s+)/m", ' => ', $output);
}

add_action('pre_get_posts','shop_filter_cat');

 function shop_filter_cat($query) {
    if (!is_admin() && is_post_type_archive( 'product' ) && $query->is_main_query()) {
       $query->set('tax_query', array(
                    array ('taxonomy' => 'tag_id',
                                       'field' => 'slug',
                                        'terms' => 'road'
                                 )
                     )
       );   
    }
 }

 add_theme_support('post-thumbnails');
 
 add_image_size( 'slide', 500, 350, true);