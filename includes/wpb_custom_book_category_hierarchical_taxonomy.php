<?php
 
/**************************************************
    * create a custom taxonomy name it topics for your posts
***************************************************/
 
function wpb_category_hierarchical_taxonomy() {
 
/**************************************************
    * Add new taxonomy, make it hierarchical like categories
    * first do the translations part for GUI
***************************************************/
  $labels = array(
    'name' => __('Book Categories', 'wpb'),
    'singular_name' => __('Book Category', 'wpb'),
    'search_items' =>  __('Search Book Category', 'wpb'),
    'all_items' => __('All Book Categories', 'wpb'),
    'parent_item' => __('Parent Book Category','wpb'),
    'parent_item_colon' => __('Parent Book Category:', 'wpb'),
    'edit_item' => __('Edit Book Category', 'wpb'),
    'update_item' => __('Update Book Category', 'wpb'),
    'add_new_item' => __('Add New Book Category', 'wpb'),
    'new_item_name' => __('New Book Category Name', 'wpb'),
    'menu_name' => __('Book Categories', 'wpb'),
    'orderby' => 'count',
  );   

  $args = array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'book_category' ),
  ); 
 
/**************************************************
    * Now register the taxonomy
***************************************************/

  register_taxonomy('book_category',array('book'), $args);
 
}

/**************************************************
    * hook into the init action and call create_book_taxonomies when it fires
***************************************************/

add_action( 'init', 'wpb_category_hierarchical_taxonomy' );

  add_filter( 'get_terms_args', 'wpb_sort_get_terms_args', 10, 2 );
function wpb_sort_get_terms_args( $args, $taxonomies ) 
{

    $args['orderby'] = 'count';
    $args['order'] = 'DESC';

    return $args; 
}