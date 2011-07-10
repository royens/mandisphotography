<?php
/**
 * Makes a custom widget for displaying images with links
 * in any sidebar.
 *
 * @package MandisPhotography Theme
 * @version 0.0.2
 * @since 0.0.2
 */

add_action( 'widgets_init', create_function( '', 'return register_widget( "MandisPhotography_Widget" );' ) );

class MandisPhotography_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void 
     */
    function MandisPhotography_Widget() {
        /* Widget Settings */
        $widget_ops = array( 'classname' => 'mandisphotography-widget', 'description' => 'A widget that displays an image with a link in the sidebar.' );

        $control_ops = array( 'id_base' => 'mandis_widget' );

        $this->WP_Widget( 'mandisphotography-widget', 'Mandi\'s Photography Widget', $widget_ops, $control_ops );

        _log( $_GET['page'] );
    }

    /**
     * Outputs the HTML for the widget
     *
     * @param array An array of standard parameters for widgets in this theme
     * @param array An array of settings for this widget instance
     * @return void Echoes it's output
     */
    function widget( $args, $instance ) {

        extract( $args );

        /* User selected settings */
        $title = apply_filters( 'widget_title', $instance['title'] );
        $image_url = $instance['image_url'];
        $link = $instance['link'];
        $link_text = $instance['link_text'];

        /* Before widget defined by themes */
        print( $before_widget );

        /* Title, before and after defined by theme */
        if ( $title )
            echo $before_title . $title . $after_title;

        /* Display image from widget settings */
        if ( $image_url )
            printf( '<a href="%1$s" rel="bookmark"><img src="%2$s" alt="Widget Image" />', $link, $image_url );

        /* Display link text and link from widget settings */
        if ( $link_text )
            printf( '<a href="%1$s" rel="bookmark"><h4 class="widget-link-text">%2$s</h4></a>', $link, $link_text );

        echo $after_widget;
    }

    /*
     * Deals with settings when they are saved by the admin. All validation should take place here.
     *
     * @param array An array of values holding the new values
     * @param array An array holding all the old values
     * @return array The array of the new saved values.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        /* Strip tags if necessary and update the widget settings */
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['image_url'] = strip_tags( $new_instance['image_url'] );
        $instance['link'] = strip_tags( $new_instance['link'] );
        $instance['link_text'] = strip_tags( $new_instance['link_text'] );

        return $instance;
    }


    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array An array containing the widget settings.
     * @return void Echo's it's output
     */
    function form( $instance ) {

        $instance = wp_parse_args( (array) $instance, array(
            'title' => '',
            'image_url' => '',
            'link' => '',
            'link_text' => ''
        ) );
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'image_url' ); ?>">Image URL:</label>
                <input id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" value="<?php echo $instance['image_url']; ?>" class="widefat upload_image" type="text" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'link' ); ?>">Link:</label>
                <input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" class="widefat" type="text" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'link_text' ); ?>">Link Text:</label>
                <input id="<?php echo $this->get_field_id( 'link_text' ); ?>" name="<?php echo $this->get_field_name( 'link_text' ); ?>" value="<?php echo $instance['link_text']; ?>" class="widefat" type="text" />
            </p>

        <?php
    }
}
?>
