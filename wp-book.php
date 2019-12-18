<?php

/*
    Plugin Name: WP Book
    Plugin URI: http://mydailyblogs.epizy.com/wp-book
    Description: This Plugin has features like create custom type book, custom hierarchical taxonomy Book Category, custom non-hierarchical taxonomy Book Tag, ustom meta table and save all book meta information in that table, custom admin settings page for Book, shortcode [book] to display the book(s) information, custom widget to display books of selected category in the sidebar, custom dashboard widget which shows the top 5 book categories.
    Author: Arth Modi
    Author URI : http://mydailyblogs.epizy.com/
    Version : 1.0
*/

/**************************************************
    * global variables
***************************************************/

$mpb_prefix = 'wpb_';
$mpb_plugin_name = 'Wp Book';

// retreiving our plugin settings from the options table
$wpb_settings = get_option('wpb_settings');

load_plugin_textdomain('wp-book', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );

/**************************************************
    * includes
***************************************************/

include(plugin_dir_path( dirname( __FILE__ ) ).'wp-book/includes/wpb_custom_book_post.php');   // this controls custom post type book
include(plugin_dir_path( dirname( __FILE__ ) ).'wp-book/includes/wpb_custom_book_category_hierarchical_taxonomy.php'); // this controls custom book category hierarchical taxonomy
include(plugin_dir_path( dirname( __FILE__ ) ).'wp-book/includes/wpb_custom_book_category_non_hierarchical_taxonomy.php'); // this controls custom book tag non hierarchical taxonomy
include(plugin_dir_path( dirname( __FILE__ ) ).'wp-book/includes/wpb_custom_metabox.php'); // this controls custom meta box
include(plugin_dir_path( dirname( __FILE__ ) ).'wp-book/includes/wpb_settings_page.php'); // this controls settings page
include(plugin_dir_path( dirname( __FILE__ ) ).'wp-book/includes/wpb_book_shortcode.php'); // this controls book shortcode
include(plugin_dir_path( dirname( __FILE__ ) ).'wp-book/includes/wpb_bookcategory_widget.php'); // this controls custom widget
include(plugin_dir_path( dirname( __FILE__ ) ).'wp-book/includes/wpb_book_dashboard_widget.php'); // this control custom dashboard widget
include(plugin_dir_path( dirname( __FILE__ ) ).'wp-book/includes/wpb_selected_book_category_display_widget.php'); // this control widget to display selected category books
 

/**************************************************
    * creating custom table
***************************************************/

function wpb_custom_table(){ 

    global $wpdb;
    $table_name = $wpdb->prefix.'bookmeta';

    if( $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name){

        $sql = "CREATE TABLE  $table_name (
            meta_id INTEGER (10) UNSIGNED AUTO_INCREMENT,
            info_id bigint(20) NOT NULL DEFAULT '0',
            meta_key varchar(255) DEFAULT NULL,
            meta_value longtext,
            PRIMARY KEY  (meta_id),
            KEY info_id (info_id),
            KEY meta_key(meta_key)
        )";

    require_once(ABSPATH.'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    }
}

/**************************************************
    * registering the custom table
***************************************************/

register_activation_hook( __FILE__, 'wpb_custom_table' );

function wpb_book_register_custom_table() {

    global $wpdb;

    $wpdb->bookmeta = $wpdb->prefix . 'bookmeta';
    $wpdb->tables[] = 'bookmeta';
    
    return;
}

add_action( 'init', 'wpb_book_register_custom_table' );
add_action( 'switch_blog', 'wpb_book_register_custom_table' );