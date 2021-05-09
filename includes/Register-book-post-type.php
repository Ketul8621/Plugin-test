<?php

/**
 * Register a book post type
 *
 * @since 1.0.0
 *
 * @return void
 */
function pt_register_book_post_type() {

    $labels = array(
        'name'               => _x( 'Books', 'Post type general name', 'plugin-test' ),
        'singular_name'      => _x( 'Book', 'Post type singular name', 'plugin-test' ),
        'menu_name'          => _x( 'Books', 'Admin menu text', 'plugin-test' ),
        'name_admin_bar'     => _x( 'Book', 'Add new on toolbar', 'plugin-test' ),
        'add_new'            => __( 'Add New', 'plugin-test' ),
        'add_new_item'       => __( 'Add New Book', 'plugin-test' ),
        'new_item'           => __( 'New Book', 'plugin-test' ),
        'edit_item'          => __( 'Edit Book', 'plugin-test' ),
        'view_item'          => __( 'View Book', 'plugin-test' ),
        'all_items'          => __( 'All Books', 'plugin-test' ),
        'search_items'       => __( 'Search Books', 'plugin-test' ),
        'parent_item_colon'  => '',
        'not_found'          => __( 'No books found.', 'plugin-test' ),
        'not_found_in_trash' => __( 'No books found in Trash.', 'plugin-test' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    // Register the custom post type book.
    register_post_type( 'book', $args );
}

// Register pt_register_book_post_type using init hook.
add_action( 'init', 'pt_register_book_post_type' );
