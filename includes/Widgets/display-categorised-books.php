<?php

/**
 * Adds a custom Display_Categorised_Books widget to display the books of a particular category
 */
class Display_Categorised_Books extends WP_Widget {

    /**
     * Register the widget with WordPress
     */
    public function __construct() {

        parent::__construct(
            'categorised_book_widget',
            esc_html__( 'Display the books of a particular category', 'plugin test' ),
            array( 'description' => esc_html__( 'Display the books', 'text_domain' ), )
        );

    }

    /**
     * Frontend display of widget
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     * @return void
     */
    public function widget( $args, $instance ) {

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {

            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];

            // Converts the string to lower character.
            $pt_lower = strtolower( $instance['title'] );

            $query = new WP_Query(
                array(
                    'post_type'   => 'book',
                    'post_status' => 'publish',
                    'tax_query'   => array(
                        array(
                            'taxonomy' => 'Book Category',
                            'field'    => 'slug',
                            'terms'    => $pt_lower,
                        ),
                    ),
                )
            );

            while ( $query->have_posts() ) {
                $query->the_post();
                $post_title = get_the_title( get_the_ID() );
                echo esc_html( $post_title );
                echo '<br>';
            }

            wp_reset_postdata();
        }

        echo $args['after_widget'];
    }

    /**
     * Backend widget
     *
     * @param array $instance Previously saves values from database.
     * @return void
     */
    public function form( $instance ) {

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html_e( 'Custom Text', 'plugin test' );
        $titleID = esc_attr( $this->get_field_ID( 'title' ) );
        ?>

        <p>
            <label for="<?php echo $titleID; ?>">Title</label>
            <input type="text" id="<?php echo $titleID; ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
            value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values to be saved.
     * @param array $old_instance Previously saves values from database.
     * @return array Updated safe values.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        return $instance;
    }

}

/**
 * Register custom widget Display_Categorised_Books
 *
 * @return void
 */
function register_display_widget() {
    register_widget( 'Display_Categorised_Books' );
}

// Register register_display_widget using widgets_init hook.
add_action( 'widgets_init', 'register_display_widget' );
