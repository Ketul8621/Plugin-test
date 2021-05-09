<?php

/**
 * Create a settings page for book post type
 */
function pt_create_settings() {

    add_submenu_page(
        'edit.php?post_type=book',
        __( 'Book settings', 'plugin test' ),
        __( 'Settings', 'plugin test' ),
        'manage_options',
        'pt-book-settings-group',
        'pt_settings_callback'
    );
}

/**
 * Register our pt_create_settings with admin_menu action hook.
 */
add_action( 'admin_menu', 'pt_create_settings' );

/**
 * Callback function for Settings submenu
 *
 * @return void
 */
function pt_settings_callback() {

    // check user capabilities.
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // check if the user have submitted the settings.
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'pt_messages', 'pt_message', __( 'Settings Saved', 'plugin test' ), 'updated' );
    }

    // show error/update messages.
    settings_errors( 'pt_messages' );

    ?>

    <div class="wrap">

        <h1> <?php esc_html_e( get_admin_page_title(), 'plugin test' ); ?></h1>

        <form action="options.php" method="post">

            <?php

            settings_fields( 'pt-book-settings-group' );

            // output setting sections and their fields.
            do_settings_sections( 'pt-book-settings-group' );

            // outputs the submit button to save settings.
            submit_button( 'Save Settings' );
            ?>

        </form>

    </div>

<?php

}

/**
 * Registers the setting options for book page
 *
 * @return void
 */
function pt_settings_init() {

    // Register our custom setting for book post type.
    register_setting( 'pt-book-settings-group', 'pt_book_settings' );

    // Register a new section in book setting page.
    add_settings_section(
        'pt_book_section',
        __( 'Book Settings Section', 'plugin test' ),
        '',
        'pt-book-settings-group'
    );

    // Register a new field for changing the currency in book setting page.
    add_settings_field(
        'pt_currency',
        __( 'Currency', 'plugin test' ),
        'pt_currency_change',
        'pt-book-settings-group',
        'pt_book_section'
    );

    // Register the new field for displaying books per page.
    add_settings_field(
        'pt_books_per_page',
        __( 'Books Per Page', 'plugin test' ),
        'pt_books_per_page',
        'pt-book-settings-group',
        'pt_book_section'
    );
}

/**
 * Registers the pt_settings_init using admin_init action hook.
 */
add_action( 'admin_init', 'pt_settings_init' );

/**
 * Callback functioon for currency setting field
 *
 * @param array $args
 * @return void
 */
function pt_currency_change( $args ) {

    // Get the global variable that we have defined in our main plugin file which retrieves the value of the
    // settings that we have registered using register_settings().
    global $pt_options;
    ?>

    <input id="pt_book_settings[pt_currency]" name="pt_book_settings[pt_currency]" type="text"
    value="<?php echo isset( $pt_options['pt_currency'] ) ? esc_attr( $pt_options['pt_currency'] ) : ''; ?>"/>
    <?php
}

/**
 * Callback function for books per page setting field
 *
 * @param array $args
 * @return void
 */
function pt_books_per_page() {

    // Get the global variable that we have defined in our main plugin file which retrieves the value of the
    // settings that we have registered using register_settings().
    global $pt_options;
    ?>

    <input type="number" id="pt_book_settings[pt_books_per_page]" name="pt_book_settings[pt_books_per_page]"
    value="<?php echo isset( $pt_options['pt_books_per_page'] ) ? esc_attr( $pt_options['pt_books_per_page'] ) : ''; ?>" />
    <?php
}
?>
