<?php

/**
 * Adds a dashboard widget to count the top 5 books based on category
 */
function pt_book_dashboard_widget() {

    // Add dashboard widget.
    wp_add_dashboard_widget( 'top 5 category', 'Top 5 book category', 'pt_top_five_book_category' );
}

// Register pt_book_dashboard_widget using wp_dashboard_setup.
add_action( 'wp_dashboard_setup', 'pt_book_dashboard_widget' );

/**
 * Compares the values of the particular key.
 *
 * @param object $object1 An object.
 * @param object $object2 An object.
 * @return bool
 */
function comparator( $object1, $object2 ) {
    return $object1->count < $object2->count;
}

/**
 * Call back function of dashboard widget.
 *
 * Displays the top five book categories
 *
 * @return void
 */
function pt_top_five_book_category() {

    $terms = get_terms( array(
        'taxonomy'   => 'Book Category',
        'hide_empty' => false,
    ) );

    // Sort the array on basis of count key.
    usort( $terms, 'comparator' );
    $counter = 0;

    foreach ( $terms as $term ) {
        $counter++;
        if ($counter > 5) break;
        echo esc_html( $term->name ) . ' = ' . esc_html( $term->count );
        echo '<br>';
    }

}
