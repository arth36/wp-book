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
    'name' => __('Book Tags', 'wpb'),
    'singular_name' => __('Book Tag', 'wpb'),
    'search_items' =>  __('Search Book Tag', 'wpb'),
    'all_items' => __('All Book Tags', 'wpb'),
    'parent_item' => __('Parent Book Tag', 'wpb'),
    'parent_item_colon' => __('Parent Book Tag:', 'wpb'),
    'edit_item' => __('Edit Book Tag', 'wpb'),
    'update_item' => __('Update Book Tag', 'wpb'),
    'add_new_item' => __('Add New Book Tag', 'wpb'),
    'new_item_name' => __('New Book Tag Name', 'wpb'),
    'menu_name' => __('Book Tags', 'wpb'),
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
