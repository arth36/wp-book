<?php
 
/**************************************************
    * create a custom taxonomy name it topics for your posts
***************************************************/
 
function wpb_category_non_hierarchical_taxonomy() {
 
/**************************************************
    * Add new taxonomy, and set hierarchical=>false to make it non-hierarchical
    * first do the translations part for GUI
***************************************************/
  $labels = array(
    'name' => __('Book Tags', 'wp-book'),
    'singular_name' => __('Book Tag', 'wp-book'),
    'search_items' =>  __('Search Book Tag', 'wp-book'),
    'all_items' => __('All Book Tags', 'wp-book'),
    'parent_item' => __('Parent Book Tag', 'wp-book'),
    'parent_item_colon' => __('Parent Book Tag:', 'wp-book'),
    'edit_item' => __('Edit Book Tag', 'wp-book'),
    'update_item' => __('Update Book Tag', 'wp-book'),
    'add_new_item' => __('Add New Book Tag', 'wp-book'),
    'new_item_name' => __('New Book Tag Name', 'wp-book'),
    'menu_name' => __('Book Tags', 'wp-book'),
  );    

  $args = array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'book_tags' ),
  );
 
/**************************************************
    * Now register the taxonomy
***************************************************/
 
  register_taxonomy('book_tags',array('book'), $args);
 
}

/**************************************************
    * hook into the init action and call create_book_taxonomies when it fires
***************************************************/
add_action( 'init', 'wpb_category_non_hierarchical_taxonomy' );
