<?php 

/**************************************************
    * adding shortcode to custom posttype
***************************************************/

    function wpb_book_shortcode( $atts ){
        $atts = shortcode_atts(
            array(
                'book_id' => 'Undefined',
                'author_name' => 'Unknown',
                'year' => 'Undefined',
                'category' => 'Not choosen yet',
                'tag' => 'Not mentioned yet',
                'publisher' => 'Unknown'
            ),
            $atts
        );
            //return hii;
        //return '<div class="book" id="' . esc_attr( $atts['id'] ) . '"><div class="book" id="' . esc_attr( $atts['book_id'] ) . '"><h4>Book ID: ' . esc_attr( $atts['book_id'] ). '</h4></div><div class="book" id="' . esc_attr( $atts['author_name'] ) . '"><h4>Author Name: ' . esc_attr( $atts['author_name'] ). '</h4></div><div class="book" id="' . esc_attr( $atts['year'] ) . '"><h4>Year: ' . esc_attr( $atts['year'] ) . '</h4></div><div class="book" id="' . esc_attr( $atts['category'] ) . '"><h4>Category: ' . esc_attr( $atts['category'] ) . '</h4></div><div class="book" id="' . esc_attr( $atts['tag'] ) . '"><h4>Tag: ' . esc_attr( $atts['tag'] ) . '</h4></div><div class="book" id="' . esc_attr( $atts['publisher'] ) . '"><h4>Publisher: ' . esc_attr( $atts['publisher'] ) . '</h4></div></div>';
    
	}

    add_shortcode('book','wpb_book_shortcode'); 