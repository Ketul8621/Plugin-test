<?php

/**
 * Displays the meta information of a book.
 * id, author_name, year, category, tag, and publisher.
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function pt_book_info( $atts ) {

    $category = wp_get_post_terms( get_the_ID(), 'Book Category', array( 'fields' => 'names' ) );

    $info = '
    <div>
        <pre>ID       : ' . get_the_ID() . '</pre>
        <pre>Author   : ' . get_post_meta( get_the_ID(), 'pt_save_author', true ) . '</pre>
        <pre>Category : ' . $category[0] . '</pre>
        <pre>Year     : ' . get_post_meta( get_the_ID(), 'pt_save_year', true ) . '</pre>
        <pre>Publisher: ' . get_post_meta( get_the_ID(), 'pt_save_publisher', true ) . '</pre>
        <pre>Edition  : ' . get_post_meta( get_the_ID(), 'pt_save_edition', true ) . '</pre>
    </div>
    ';

    return $info;
}

/**
 * Register pt_book_info using book shortcode.
 */
add_shortcode( 'book', 'pt_book_info' );
