<?php
// // navwalker registration for navbar
function register_navwalker()
{
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

// support menu 
add_theme_support('menus');

// style used 

if (!function_exists('theme_enquee_scripts')) {
    function theme_enquee_scripts()
    {
        //css
        wp_enqueue_style('css', get_template_directory_uri() . '/style.css');
        wp_enqueue_style('css', get_template_directory_uri() . '/css/responsive.css');
        wp_enqueue_style('fonts', get_template_directory_uri() . '/fonts/css/all.css');
        wp_enqueue_style('fonts', get_template_directory_uri() . '/fonts/css/regular.min.css');

        wp_enqueue_style('css', get_template_directory_uri() . '/css/boxicons.min.css');
        wp_enqueue_style('css', get_template_directory_uri() . '/css/boxicons.css');

        wp_enqueue_style('js', get_template_directory_uri() . '/script.js');
        wp_enqueue_style('bootstrap', get_template_directory_uri() .'/css/bootstrap.min.css');

        //functions to link booktstrap,JS and jquery
        wp_enqueue_script('jquery',get_template_directory_uri().'/js/jquery.min.js');
        wp_enqueue_script('jquery',get_template_directory_uri().'/js/jquery-min.js');
        wp_enqueue_script('jquery',get_template_directory_uri().'/js/bootstrap.bundle.min.js');

        wp_enqueue_script('javascript',get_template_directory_uri(). '/js/slim.min.js');
        wp_enqueue_script('javascript',get_template_directory_uri(). '/js/popper.min.js');
        wp_enqueue_script('javascript', get_template_directory_uri() .'/js/bootstrap.min.js');
    }
}
add_action('wp_enqueue_scripts', 'theme_enquee_scripts');

//Functions for creating menus 
add_theme_support('menus');
function wp_theme_setup()
{

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'primary menu'),
    ));
}
add_action('after_setup_theme', 'wp_theme_setup');
//post thumbnail support
add_theme_support('post-thumbnails');

//theme logo 
function themename_custom_logo_setup()
{
    $defaults = array(
        'height'      => 80,
        'width'       => 80,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'themename_custom_logo_setup');
//excerpt
function custom_excerpt()
{
    $excerpt = get_the_content();
    $excerpt = preg_replace(" ([.*?])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, 450);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    $excerpt = $excerpt . '... <a href="' . get_the_permalink() . '"></a>';
    return $excerpt;
}
add_filter( 'jetpack_offline_mode', '__return_true' );

function my_widgets()
{

    //Register Sidebar #1
    register_sidebar(
        array(
            'name' => __('Footer menu', 'textdomain'),
            'id' => 'footer-1',
            'description' => __('Add widgets here to appear Advertisement', 'textdomain'),
        )
    );
    register_sidebar(
        array(
            'name' => __('Header Banner Ads', 'textdomain'),
            'id' => 'banner',
            'description' => __('Add widgets here to appear Advertisement', 'textdomain'),
        )
    );
    // category page ads
    register_sidebar(
        array(
            'name' => __('Category page Ads', 'textdomain'),
            'id' => 'cat-ads',
            'description' => __('Add widgets here to appear Advertisement', 'textdomain'),
        )
    );

    //Register Sidebar #2

    register_sidebar(
        array(
            'name' => __('Single page Banner Ads top', 'textdomain'),
            'id' => 'banner-1',
            'description' => __('Add widgets here to appear Advertisement', 'textdomain'),
        )
    );
    //single page ads after contact form


    register_sidebar(
        array(
            'name' => __('Single Page Ads after comment form ', 'textdomain'),
            'id' => 'ads-banner',
            'description' => __('Add widgets here to appear Advertisement', 'textdomain'),
        )
    );
    //Register Sidebar #3

    register_sidebar(
        array(
            'name' => __('Single Page Banner Ads Center ', 'textdomain'),
            'id' => 'banner-2',
            'description' => __('Add widgets here to appear Advertisement', 'textdomain'),
        )
    );
    register_sidebar(
        array(
            'name' => __('Single page Banner Ads Bottom', 'textdomain'),
            'id' => 'banner-3',
            'description' => __('Add widgets here to appear Advertisement', 'textdomain'),
        )
    );
    //front page ads
    register_sidebar(
        array(
            'name' => __('Front Page ads after news', 'textdomain'),
            'id' => 'front-page-ads',
            'description' => __('Add widgets here to appear Advertisement', 'textdomain'),
        )
    );
    register_sidebar(
        array(
            'name' => __('Front Page Banner Ads 1', 'textdomain'),
            'id' => 'front-1',
            'description' => __('Add widgets here to appear Advertisement', 'textdomain'),
        )
    );
    register_sidebar(
        array(
            'name' => __('Front Page Banner Ads 2', 'textdomain'),
            'id' => 'front-2',
            'description' => __('Add widgets here to appear Advertisement', 'textdomain'),
        )
    );
    register_sidebar(
        array(
            'name' => __('Front Page Banner Ads 3', 'textdomain'),
            'id' => 'front-3',
            'description' => __('Add widgets here to appear Advertisement', 'textdomain'),
        )
    );
}
add_action('widgets_init', 'my_widgets');
