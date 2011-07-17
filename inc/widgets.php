<?php
/**
 * Makes a custom widget for displaying images with links
 * in any sidebar.
 *
 * @package MandisPhotography Theme
 * @version 0.0.2
 * @since 0.0.2
 */

class MandisPhotography_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void 
     */
    function MandisPhotography_Widget() {
        /* Widget Settings */
        $widget_ops = array( 'classname' => 'widget_mandisphotography', 'description' => 'A widget that displays an image with a link in the sidebar.' );
        $this->WP_Widget( 'widget_mandisphotography', 'Mandi\'s Photography Widget', $widget_ops );
        $this->alt_option_name = 'widget_mandisphotography';

        add_action( 'switch_theme', array(&$this, 'flush_widget_cache' ) );
    }

    /**
     * Outputs the HTML for the widget
     *
     * @param array An array of standard parameters for widgets in this theme
     * @param array An array of settings for this widget instance
     * @return void Echoes it's output
     */
    function widget( $args, $instance ) {
        $cache = wp_cache_get( 'widget_mandisphotography', 'widget' );

        if ( !is_array( $cache ) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = null;

        if ( isset( $cache[$args['widget_id']] ) ) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();
        extract( $args );

        /* User selected settings */
        $image_url = $instance['image_url'];
        $link = $instance['link'];
        $link_text = $instance['link_text'];

        /* Before widget defined by themes */
        print( $before_widget );

        /* Display image from widget settings */
        if ( $image_url )
            printf( '<a href="%1$s" rel="bookmark"><img src="%2$s" alt="Widget Image" />', $link, $image_url );

        /* Display link text and link from widget settings */
        if ( $link_text )
            printf( '<a href="%1$s" rel="bookmark"><h4 class="widget-link-text">%2$s</h4></a>', $link, $link_text );

        echo $after_widget;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set( 'widget_mandisphotography', $cache, 'widget' );
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
        $instance['image_url'] = strip_tags( $new_instance['image_url'] );
        $instance['link'] = strip_tags( $new_instance['link'] );
        $instance['link_text'] = strip_tags( $new_instance['link_text'] );
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'option' );
        if ( isset( $alloptions['widget_mandisphotography'] ) )
            delete_option( 'widget_mandisphotography' );

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete( 'widget_mandisphotography', 'widget' );
    }


    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array An array containing the widget settings.
     * @return void Echo's it's output
     */
    function form( $instance ) {

        $instance = wp_parse_args( (array) $instance, array(
            'image_url' => '',
            'link' => '',
            'link_text' => ''
        ) );
        ?>
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

class MandisPhotography_Page_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     */
    function MandisPhotography_Page_Widget() {
        /* Widget Settings */
        $widget_ops = array( 'classname' => 'page_widget_mandisphotography', 'description' => 'Widgets that can be used on banner pages that include logic on which page to display them.' );
        $this->WP_Widget( 'page_widget_mandisphotography', 'Mandi\'s Photography Page Widget', $widget_ops );
        $this->alt_option_name = 'page_widget_mandisphotography';

        add_action( 'switch_theme' array( &$this, 'flush_widget_cache' ) );
    }

    /**
     * Outputs the HTML for the widget
     *
     * @param array An array of standard parameters for widgets in this theme
     * @param array An array of settings for this widget instance
     * @return void Echoes it's output
     */
    function widget( $args, $instance ) {

    }

    /**
     * Deals with settings when they are saved by the admin. All validation takes place here.
     *
     * @param array An array of values holding the new values
     * @param array An array holding all the old values
     * @return array The array of the new saved values.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        /* Strip tags if necessary and update widget settings */
        $instance['image_url'] = strip_tags( $new_instance['image_url'] );
        $instance['link'] = strip_tags( $new_instance['link'] );
        $instance['link_text'] = strip_tags( $new_instance['link_text'] );
        $instance['page'] = strip_tags( $new_instance['page'] );
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'option' );
        if ( isset( $alloptions['page_widget_mandisphotography'] ) )
            delete_option( 'page_widget_mandisphotography' );

        return $instance;
    }

    /**
     * Flushes all data in the cache pertaining to this widget.
     *
     * @return void
     */
    function flush_widget_cache() {
        wp_cache_delete( 'page_widget_mandisphotography', 'widget' );
    }

    /**
     * Displays the form for this widget on the Widgets page of the 
     * WP Admin area.
     *
     * @param array An array containing the widget settings
     * @return void Echoes it's output.
     */
    function form( $instance ) {

    }
?>
