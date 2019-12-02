<?php

/**************************************************
    * creating the custom posttype
***************************************************/

function wpb_register_book_custom_post_type() {
 
	$labels = array(
		'name'               => __('Books', 'wpb'),
		'singular_name'      => __('Book', 'wpb') ,
		'add_new'            => __('Add New', 'wpb'),
		'add_new_item'       => __('Add New Book', 'wpb'),
		'edit_item'          => __('Edit Book', 'wpb'),
		'new_item'           => __('New Book', 'wpb'),
		'all_items'          => __('All Books', 'wpb'),
		'view_item'          => __('View Book', 'wpb'),
		'search_items'       => __('Search Books', 'wpb'),
		'not_found'          =>  __('No books found','wpb'),
		'not_found_in_trash' => __('No books found in Trash', 'wpb'),
		'parent_item_colon'  => __('', 'wpb'),
		'menu_name'          => __('Books', 'wpb'),
	);
 
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'excerpt', 'comments', 'editor' ),
	);

/**************************************************
    * registering the custom book post type
***************************************************/
	register_post_type( 'book', $args );
 
}
add_action( 'init', 'wpb_register_book_custom_post_type' );