<?php
/*
Plugin Name: WooCommerce - Append cart icon and count to menu
Plugin URI: https://www.damiencarbery.com/2018/04/woocommerce-append-cart-icon-and-count-to-menu/
Description: Append a cart item to the main menu and show count of items in the cart.
Author: Damien Carbery
Version: 0.1
*/


// Add Font Awesome to site.
add_action( 'wp_enqueue_scripts', 'dcwd_include_font_awesome_css' );
function dcwd_include_font_awesome_css() {
	// Enqueue Font Awesome from a CDN.
	wp_enqueue_style( 'font-awesome-cdn', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}


// Style the cart count number.
add_action( 'wp_head', 'dcwd_cart_count_styles' );
function dcwd_cart_count_styles() {
?>
<style>
#menu-main-menu .cart { position: relative; }
#menu-main-menu .count { background: #666; color: #fff; border-radius: 2em; height: 18px; line-height: 18px; position: absolute; right: 5px; text-align: center; top: 90%; transform: translateY(-100%) translateX(15%); width: 18px; }
</style>
<?php
}


// Append cart item (and cart count) to end of main menu.
add_filter( 'wp_nav_menu_main-menu_items', 'am_append_cart_icon', 10, 2 );
function am_append_cart_icon( $items, $args ) {
	$cart_item_count = WC()->cart->get_cart_contents_count();
	$cart_count_span = '';
	if ( $cart_item_count ) {
		$cart_count_span = '<span class="count">'.$cart_item_count.'</span>';
	}
	$cart_link = '<li class="cart menu-item menu-item-type-post_type menu-item-object-page"><a href="' . get_permalink( wc_get_page_id( 'cart' ) ) . '"><i class="fa fa-shopping-bag"></i>'.$cart_count_span.'</a></li>';

	// Add the cart link to the end of the menu.
	$items = $items . $cart_link;

	return $items;
}
