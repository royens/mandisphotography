<?php
/**
 * @package mandisphotography
 * @subpackage theme
 * @version 0.0.1
 * @since 0.0.1
 */

/**
 * Tell WordPress to run mandisphotography_setup() when the
 * 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'mandisphotography_setup' );

if ( ! function_exists( 'mandisphotography_setup' ) ) :
    /**
     * Sets theme defaults and registers support for WordPress features
     */
    function mandisphotography_setup() {

        // Add default posts and comments RSS feed links to head
        add_theme_support( 'automatic-feed-links' );

        register_nav_menus( array(
            'primary' => 'Primary Navigation',
        ) );
    }
endif;

/**
 * For the sake of security lets remove the WordPress
 * version number from feeds and the generator tag
 */
function mandisphotography_remove_version() {
    return '';
}
add_filter( 'the_generator', 'mandisphotography_remove_version' );

if ( ! function_exists( 'mandisphotography_posted_on' ) ) :
    /** Prints HTML with meta infomration for the current post.
     *
     * @since 0.0.1
     */
    function mandisphotography_posted_on() {
        printf( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 
            'meta-prep meta-prep-author',
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr( get_the_time() ),
                get_the_date()
            ),
            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                sprintf( esc_attr( 'View all posts by %s' ), get_the_author() ),
                get_the_author()
            )
        );
    }
endif;
?>
