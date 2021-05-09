<?php

/**
 * Register hierarchical taxomomy for book post type
 *
 * @since 1.0.0
 *
 * @return void
 */
function pt_register_hierarchical_book_taxonomy() {

    $labels = array(
        'name'              => _x( 'Books', 'taxonomy general name', 'plugin-test' ),
        'singular_name'     => _x( 'Book', 'taxonomy singular name', 'plugin-test' ),
        'search_items'      => __( 'Search Books', 'plugin-test' ),
        'all_items'         => __( 'All Books', 'plugin-test' ),
        'view_item'         => __( 'View Book', 'plugin-test' ),
        'parent_item'       => __( 'Parent Book', 'plugin-test' ),
        'parent_item_colon' => __( 'Parent Book', 'plugin-test' ),
        'edit_item'         => __( 'Edit Book', 'plugin-test' ),
        'update_item'       => __( 'Update Book', 'plugin-test' ),
        'add_new_item'      => __( 'Add New Book', 'plugin-test' ),
        'new_item_name'     => __( 'New Book Name', 'plugin-test' ),
        'not_found'         => __( 'No Books Found', 'plugin-test' ),
        'back_to_items'     => __( 'Back to Books', 'plugin-test' ),
        'menu_name'         => _x( 'Book', 'plugin-test' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical'       => true,
        'public'             => true,
        'show_ui'            => true,
        'query_var'          => true,
        'show_admin_column'  => true,
        'show_in_rest'       => true,
        'publicly_queryable' => true,
        'show_in_menu'       => true,
    );

    // Register the heirarchical taxonomy Book Category for book post type.
    register_taxonomy( 'Book Category', 'book', $args );
}

// Register pt_register_hierarchical_book_taxonomy using init hook.
add_action( 'init', 'pt_register_hierarchical_book_taxonomy' );

/**
 * Register non-hierarchical taxomomy for book post type
 *
 * @since 1.0.0
 *
 * @return void
 */
function pt_register_non_hierarchical_book_taxonomy() {

    $labels = array(
        'name'              => _x( 'Books', 'taxonomy general name', 'plugin-test' ),
        'singular_name'     => _x( 'Book', 'taxonomy singular name', 'plugin-test' ),
        'search_items'      => __( 'Search Books', 'plugin-test' ),
        'all_items'         => __( 'All Books', 'plugin-test' ),
        'view_item'         => __( 'View Book', 'plugin-test' ),
        'parent_item'       => __( 'Parent Book', 'plugin-test' ),
        'parent_item_colon' => __( 'Parent Book', 'plugin-test' ),
        'edit_item'         => __( 'Edit Book', 'plugin-test' ),
        'update_item'       => __( 'Update Book', 'plugin-test' ),
        'add_new_item'      => __( 'Add New Book', 'plugin-test' ),
        'new_item_name'     => __( 'New Book Name', 'plugin-test' ),
        'not_found'         => __( 'No Books Found', 'plugin-test' ),
        'back_to_items'     => __( 'Back to Books', 'plugin-test' ),
        'menu_name'         => _x( 'Book Tag', 'plugin-test' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical'       => false,
        'public'             => true,
        'show_ui'            => true,
        'query_var'          => true,
        'show_admin_column'  => true,
        'show_in_rest'       => true,
        'publicly_queryable' => true,
        'show_in_menu'       => true,
    );

    // Register the non-heirarchical taxonomy Book Category for book post type.
    register_taxonomy( 'Book Tag', 'book', $args );
}

// Register pt_non_register_hierarchical_book_taxonomy using init hook.
add_action( 'init', 'pt_register_non_hierarchical_book_taxonomy' );
