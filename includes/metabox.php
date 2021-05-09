<?php

/**
 * Register metabox to store the meta information of a book
 *
 * @return void
 */
function pt_create_meta_boxes() {

    // Add custom meta box to store the meta information of a book.
    add_meta_box( 'book_meta', 'Book Meta Information', 'pt_meta_box_html', array( 'book' ) );
}

// Register pt_create_meta_boxes using add_meta_boxes hook.
add_action( 'add_meta_boxes', 'pt_create_meta_boxes' );

/**
 * Save meta information entered by user
 *
 * @param int $post The post ID.
 * @return void
 */
function pt_save_book_metadata( $post ) {

    // Save/Update Author.
    if( array_key_exists('pt_author', $_POST) && is_string( $_POST['pt_author'] ) ) {

        update_post_meta( $post, 'pt_save_author', sanitize_text_field( $_POST['pt_author'] ) );
    }

    // Save/Update Book Name.
    if( array_key_exists('pt_book_name', $_POST) && is_string( $_POST['pt_book_name'] ) ) {

        update_post_meta( $post, 'pt_save_book_name', sanitize_text_field( $_POST['pt_book_name'] ) );
    }

    // Save/Update Book category.
    if( array_key_exists('pt_category', $_POST) && is_string( $_POST['pt_category'] ) ) {

        update_post_meta( $post, 'pt_save_category', sanitize_text_field( $_POST['pt_category'] ) );
    }

    // Save/Update Book Tag.
    if( array_key_exists('pt_tag', $_POST) && is_string( $_POST['pt_tag'] ) ) {

        update_post_meta( $post, 'pt_save_tag', sanitize_text_field( $_POST['pt_tag'] ) );
    }

    // Save/Update Book Price.
    if( array_key_exists( 'pt_price', $_POST ) && is_string( $_POST['pt_price'] ) ) {

        update_post_meta( $post, 'pt_save_price', sanitize_text_field( $_POST['pt_price'] ) );
    }

    // Save/Update Book Publisher.
    if( array_key_exists('pt_publisher', $_POST) && is_string( $_POST['pt_publisher'] ) ) {

        update_post_meta( $post, 'pt_save_publisher', sanitize_text_field( $_POST['pt_publisher'] ) );
    }

    // Save/Update Released year of book.
    if( array_key_exists('pt_year', $_POST) && is_string( $_POST['pt_year'] ) ) {

        update_post_meta( $post, 'pt_save_year', sanitize_text_field( $_POST['pt_year'] ) );
    }

    // Save/Update Book edition.
    if( array_key_exists('pt_edition', $_POST) && is_numeric( $_POST['pt_edition'] ) ) {

        update_post_meta( $post, 'pt_save_edition', sanitize_text_field( $_POST['pt_edition'] ) );
    }

    // Save/Update URL.
    if( array_key_exists('pt_url', $_POST) && filter_var( $_POST['pt_url'], FILTER_VALIDATE_URL ) ) {

        update_post_meta( $post, 'pt_save_url', esc_url_raw( $_POST['pt_url'] ) );
    }

}

// Register pt_save_book_metadata using save_post hook.
add_action( 'save_post', 'pt_save_book_metadata' );

/**
 * Display meta-boxes
 *
 * @param [type] $post
 * @return void
 */
function pt_meta_box_html( $post ) {

    $pt_author    = get_post_meta( $post->ID, 'pt_save_author', true );
    $pt_book_name = get_post_meta( $post->ID, 'pt_save_book_name', true );
    $pt_category  = get_post_meta( get_the_ID(), 'pt_save_category', true );
    $pt_tag       = get_post_meta( get_the_ID(), 'pt_save_tag', true );
    $pt_price     = get_post_meta( get_the_ID(), 'pt_save_price', true );
    $pt_publisher = get_post_meta( $post->ID, 'pt_save_publisher', true );
    $pt_year      = get_post_meta( $post->ID, 'pt_save_year', true );
    $pt_edition   = get_post_meta( $post->ID, 'pt_save_edition', true );
    $pt_url       = get_post_meta( $post->ID, 'pt_save_url', true );
    ob_start();
    ?>

    <p>
        <label for="pt_author"> <?php _e( 'Author', 'plugin-test'); ?> </label>
        <input name="pt_author" id="pt_author" type="text" value="<?php echo esc_attr( $pt_author ); ?>" />
    </p>

    <p>
        <label for="pt_book_name"> <?php _e( 'Book Name', 'plugin-test'); ?> </label>
        <input type="text" name="pt_book_name" id="pt_book_name" value="<?php echo esc_attr( $pt_book_name ); ?>" />
    </p>

    <p>
        <label for="pt_category"> <?php _e( 'Category', 'plugin-test'); ?> </label>
        <input type="text" name="pt_category" id="pt_category" value="<?php echo esc_attr( $pt_category ); ?>"/>
    </p>

    <p>
        <label for="pt_tag"> <?php _e( 'Tag', 'plugin-test'); ?> </label>
        <input type="text" name="pt_tag" id="pt_tag" value="<?php echo esc_attr( $pt_tag ); ?>"/>
    </p>

    <p>
        <label for="pt_price"> <?php _e( 'Price', 'plugin-test'); ?> </label>
        <input type="number" name="pt_price" id="pt_price" value="<?php echo esc_attr( $pt_price ); ?>"/>
    </p>

    <p>
        <label for="pt_publisher"> <?php _e( 'Publisher', 'plugin-test'); ?> </label>
        <input type="text" name="pt_publisher" id="pt_publisher" value="<?php echo esc_attr( $pt_publisher ); ?>"/>
    </p>

    <p>
        <label for="pt_year"> <?php _e( 'Year', 'plugin-test'); ?> </label>
        <input type="month" name="pt_year" id="pt_year" value="<?php echo esc_attr( $pt_year ); ?>"/>
    </p>

    <p>
        <label for="pt_edition"> <?php _e( 'Edition', 'plugin-test'); ?> </label>
        <input type="number" name="pt_edition" id="pt_edition" value="<?php echo esc_attr( $pt_edition ); ?>"/>
    </p>

    <p>
        <label for="pt_url"> <?php _e( 'URL', 'plugin-test'); ?> </label>
        <input type="url" name="pt_url" id="pt_url" value="<?php echo esc_attr( $pt_url ); ?>"/>
    </p>

    <?php
    echo ob_get_clean();
}
?>
