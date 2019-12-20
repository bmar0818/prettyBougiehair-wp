<?php

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

function prettyBougie_setup() {
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme' , 'prettyBougie_setup' );

// Include custom navwalker
require_once('bs4navwalker.php');

// Register WordPress nav menu
register_nav_menu('top', 'Top menu');


function prettyBougie_styles() {
  // adding stylesheets
  wp_register_style('googlefont', 'https://fonts.googleapis.com/css?family=Actor|Comfortaa:400,700|Monoton', array(), '1.0.0');
  wp_register_style('normalize',get_template_directory_uri() . '/css/normalize.css', array(), '8.0.0');
  wp_register_style('font-awesome','https://use.fontawesome.com/releases/v5.8.2/css/all.css', array(),'5.8.2' );
  wp_register_style('bs_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), '4.3.1' );
	wp_register_style( 'animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' );
	wp_register_style('scroll', 'https://unpkg.com/aos@next/dist/aos.css', array() );
  wp_register_style( 'style',  get_template_directory_uri()  . '/style.css', array(), '1.0'  );

  //Enqueue the style
  wp_enqueue_style('normalize');
  wp_enqueue_style('font-awesome');
  wp_enqueue_style('googlefont');
  wp_enqueue_style('bs_css');
	wp_enqueue_style('animate-css');
	wp_enqueue_style('scroll');
  wp_enqueue_style('style');

	wp_register_script('bs_js', get_template_directory_uri() . '/js/vendor/bootstrap.bundle.min.js', array('jquery') );
	wp_register_script('scroll_js', 'https://unpkg.com/aos@next/dist/aos.js', array('jquery') );
	wp_register_script('respnsive', get_template_directory_uri() . '/js/bigSlide.js', array(), true );
  wp_register_script('script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0');

  //Add JavaScript files
	wp_enqueue_script('jquery');
  wp_enqueue_script('bs_js');
	wp_enqueue_script('scroll_js');
	wp_enqueue_script( 'responsive');
  wp_enqueue_script('script');

}
add_action( 'wp_enqueue_scripts', 'prettyBougie_styles' );



//Add Menus
function prettyBougie_menus() {
  register_nav_menus(array(
    'header-menu' => __('Header Menu', 'prettyBougie'),
    'social-menu' => __('Social Menu', 'prettyBougie'),
    'shop'        => __('Shop', 'prettyBougie'),
    'more'        => __('More', 'prettyBougie')
  ) );
}
add_action('init', 'prettyBougie_menus');


//Add Sidebar
function prettyBougie_sidebar() {
	register_sidebar(array(
		'id'            => ('sidebar-1'),
		'name'          => __('Shop Side Bar',  'prettybougiehair'),
		'description'   => __('Appears on the side of the shop page'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	  => '</h3>'
	) );
}
add_action('widgets_init', 'prettyBougie_sidebar');

 ?>
