<?php
class Wpb_Book_Widget extends WP_Widget {
    
    /**************************************************
        * setup the widget name, description, etc..
    ***************************************************/
    public function __construct() {
        $widget_options = array(
            'classname' => 'wpb-book-widget', // html class name
            'description' => __( 'Custom Book Widget to show books based on their category', 'wp-book' ),
        );
        parent::__construct( 'wpb_book', __('Books', 'wp-book'), $widget_options );
    }
    
    /** WP_Widget::form */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = 'Selected Books';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title' ); ?>:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <?php
        $categories = get_terms( array(
            'taxonomy'   => 'book_category',
            'hide_empty' => false,
        ) );
        ?>
        
        <p><?php esc_html_e('Choose categories to show', 'wp-book' ); ?>: </p>
        
        <?php
	        if ( isset( $instance[ 'selected_categories' ] ) ) {
                $selected_categories = $instance[ 'selected_categories' ];
            } else {
                $selected_categories = array();
            }
	    ?>
	<ul>
	<?php foreach ( $categories as $category ) { ?>

		<li>
            <input 
                type="checkbox" 
                id="<?php echo $this->get_field_id( 'selected_categories' ); ?>[<?php echo $category->term_id; ?>]"
                name="<?php echo esc_attr( $this->get_field_name( 'selected_categories' ) ); ?>[]" 
                value="<?php echo $category->term_id; ?>" 
                <?php checked( ( in_array( $category->term_id, $selected_categories ) ) ? $category->term_id : '', $category->term_id ); ?> />
            
            <label for="<?php echo $this->get_field_id( 'selected_categories' ); ?>[<?php echo $category->term_id; ?>]"><?php echo $category->name; ?> (<?php echo $category->count; ?>)</label>
	    </li>

	<?php } ?>
	</ul>
        <?php
    }
    /** WP_Widget::update */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = (! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
            
        $selected_categories = (! empty( $new_instance[ 'selected_categories' ] ) ) ? (array) $new_instance['selected_categories'] : array();
        $instance[ 'selected_categories' ] = array_map( 'sanitize_text_field', $selected_categories );
    
        return $instance;
    }
    
    /**************************************************
        * front-end display of widget
    ***************************************************/

    public function widget( $args, $instance ) {
        echo $args[ 'before_widget' ];?>

        <h2 class="widget-title">
                <?php
                    if ( isset( $instance[ 'title' ] ) ) {
                        $title = $instance[ 'title' ];
                    } else {
                        $title = 'Book';
                    }
                    echo $title;
                ?>
        </h2>

        <?php
        if ( ! empty( $instance[ 'selected_categories' ] ) && is_array( $instance[ 'selected_categories' ] ) ){ 
            global $book_options; // to get max number of books to show
            if ( $book_options[ 'num_of_books' ] == '0' ) {
                return; // 0 will show all books if not returned
            }
            
            $posts = get_posts( array( 
                'post_type'   => 'book',
                'post_status' => 'publish',
                'numberposts' => $book_options[ 'num_of_books' ],
                'tax_query'   => array(
                    array(
                      'taxonomy' => 'book_category',
                      'field'    => 'term_id', 
                      'terms'    => $instance[ 'selected_categories' ],
                    )
                  )
            ) );
            
            /**************************************************
                * retrieves books
            ***************************************************/
            ?>
            
            <ul>
                <?php foreach ( $posts as $post ) { ?>
                    <li><a href="<?php echo get_permalink( $post->ID ); ?>">
                            <?php echo $post->post_title; ?>
                        </a>
                    </li>		
                <?php } ?>
            </ul>
            <?php 
            
        }else{
            echo esc_html__( 'No posts selected!', 'text_domain' );	
        }
        
        
        echo $args[ 'after_widget' ];
    }
}
add_action('widgets_init', function(){
    register_widget('Wpb_Book_Widget');
});