<?php

/**************************************************
    * creating the custom metabox
***************************************************/

function wpb_custom_metabox(){

    add_meta_box(
        'wpb_meta_box',
        __('Book Information', 'wp-book'),
        'wpb_meta_callback',
        'book'
    );

}

add_action( 'add_meta_boxes', 'wpb_custom_metabox' );

function wpb_meta_callback( $post ){

    /**************************************************
        * getting metadata from database
    ***************************************************/
    
    $wpb_author_name = get_metadata( 'book', $post->ID, 'author-name', $single=true );
    $wpb_price = get_metadata( 'book', $post->ID, 'price', $single = true );
    $wpb_publisher = get_metadata( 'book', $post->ID, 'publisher', $single = true );
    $wpb_year = get_metadata( 'book', $post->ID, 'year', $single = true );
    $wpb_edition = get_metadata( 'book', $post->ID, 'edition', $single = true );
    $wpb_url = get_metadata( 'book', $post->ID, 'url', $single = true );   
    ?>

    <div>
        <div class="meta-row">
            <div class="meta-th">
                <label for="author_name" class="wpb-row-title">Author Name: </label>
            </div>
            <div class="meta-td"> 
                <input type="text" name="author_name" id="author-name" value="<?php echo esc_attr( $wpb_author_name ); ?>"/>
            </div>
        </div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="price" class="wpb-row-title">Price: </label>
            </div>
            <div class="meta-td">
                <input type="number" name="price" id="price" value="<?php echo esc_attr( $wpb_price ); ?>"/>
            </div>
        </div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="publisher" class="wpb-row-title">Publisher: </label>
            </div>
            <div class="meta-td">
                <input type="text" name="publisher" id="publisher" value="<?php echo esc_attr( $wpb_publisher ); ?>"/>
            </div>
        </div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="year" class="wpb-row-title">Year: </label>
            </div>
            <div class="meta-td">
                <input type="number" name="year" id="year" value="<?php echo esc_attr( $wpb_year ); ?>"/>
            </div>
        </div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="edition" class="wpb-row-title">Edition: </label>
            </div>
            <div class="meta-td">
                <input type="text" name="edition" id="edition" value="<?php echo esc_attr( $wpb_edition ); ?>"/>
            </div>
        </div>

        <div class="meta-row">
            <div class="meta-th">
                <label for="url" class="wpb-row-title">URL: </label>
            </div>
            <div class="meta-td">
                <input type="url" name="url" id="url" value="<?php echo esc_attr( $wpb_url ); ?>"/>
            </div>
        </div>
    <?php wp_nonce_field( 'wpb_custom_book_info_nonce', 'wpb_book_info_nonce' ); ?>
    </div>
    <?php
}

/**************************************************
    * storing the metadata to the database
***************************************************/

function wpb_custom_book_info_nonce( $post_id ){
    
    if( ! isset( $_POST['wpb_book_info_nonce'] ) || ! wp_verify_nonce( $_POST['wpb_book_info_nonce'], 'wpb_custom_book_info_nonce' ) ){
        return $post_id;
    }

    if( isset( $_POST['author_name'] ) ){
        update_metadata('book', $post_id, 'author-name', sanitize_text_field($_POST['author_name']) );
    }

    if( isset( $_POST['price'] ) ){
        update_metadata('book', $post_id, 'price', sanitize_text_field($_POST['price']) );
    }

    if( isset( $_POST['publisher'] ) ){
        update_metadata('book', $post_id, 'publisher', sanitize_text_field($_POST['publisher']) );
    }

    if( isset( $_POST['year'] ) ){
        update_metadata('book', $post_id, 'year', sanitize_text_field($_POST['year']) );
    } 

    if( isset( $_POST['edition'] ) ){
        update_metadata('book', $post_id, 'edition', sanitize_text_field($_POST['edition']) );
    }

    if( isset( $_POST['url'] ) ){
        update_metadata('book', $post_id, 'url', sanitize_text_field($_POST['url']) );
    }
    
}
add_action( 'save_post', 'wpb_custom_book_info_nonce' );