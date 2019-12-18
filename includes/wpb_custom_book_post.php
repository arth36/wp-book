<?php

/**************************************************
    * creating the custom posttype
***************************************************/

function wpb_register_book_custom_post_type() {
 
	$labels = array(
		'name'               => __('Books', 'wp-book'),
		'singular_name'      => __('Book', 'wp-book') ,
		'add_new'            => __('Add New', 'wp-book'),
		'add_new_item'       => __('Add New Book', 'wp-book'),
		'edit_item'          => __('Edit Book', 'wp-book'),
		'new_item'           => __('New Book', 'wp-book'),
		'all_items'          => __('All Books', 'wp-book'),
		'view_item'          => __('View Book', 'wp-book'),
		'search_items'       => __('Search Books', 'wp-book'),
		'not_found'          =>  __('No books found','wp-book'),
		'not_found_in_trash' => __('No books found in Trash', 'wp-book'),
		'parent_item_colon'  => __('', 'wp-book'),
		'menu_name'          => __('Books', 'wp-book'),
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