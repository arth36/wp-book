<?php

/**************************************************
    * registering the custom category sidebar
***************************************************/

function wpb_category_sidebar(){

    register_sidebar(
        array(
            'name' => __('Category Sidebar', 'wpb'),
            'id' => 'category-sidebar',
            'class' => 'categoty',
            'description' => __('custom widget to display books of selected category in the sidebar', 'wpb'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        )
    );

}
add_action('widgets_init','wpb_category_sidebar');