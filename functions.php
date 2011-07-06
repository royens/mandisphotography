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
 * Register widgetized areas, including sidebar
 */
function mandisphotography_widgets_init() {
    // Area 1, default sidebar
    register_sidebar( array(
        'name' => 'Default Widget Area',
        'id' => 'default-widget-area',
        'description' => 'Default widget area to be used with blog',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'mandisphotography_widgets_init' );

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

if ( ! function_exists( 'mandisphotography_posted_in' ) ) :
    /**
     * Prints HTML with meta information for the current post.
     */
    function mandisphotography_posted_in() {
        // Retrieve tag list of current post
        $tag_list = get_the_tag_list( '', ', ' );
        if ( $tag_list ) {
            $posted_in = 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
        } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
            $posted_in = 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
        } else {
            $posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
        }

        // Prints the string.
        printf(
            $posted_in,
            get_the_category_list( ', ' ),
            $tag_list,
            get_permalink(),
            the_title_attribute( 'echo=0' )
        );
    }
endif;

if ( ! function_exists( 'mandisphotography_comment' ) ) :
    /**
     * Template for comments and pingbacks.
     */
    function mandisphotography_comment( $comment, $args, $depth ) {
        $GLOBALS[ 'comment' ] = $comment;
        switch ( $comment->comment_type ) :
            case '' :
?>
    <li <?php comment_class(); ?> id="li_comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>">
            <div class="comment-author vcard">
                <?php echo get_avatar( $comment, 40 ); ?>
                <?php printf( '%s <span class="says">says:</span>', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
            </div><!-- .comment-author .vcard -->
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em>Your comment is awaiting moderation.</em>
                <br />
            <?php endif; ?>

            <div class="comment-meta commentmetadata">
                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( '%1$s at %2$s', get_comment_date(), get_comment_time() ); ?></a> <?php edit_comment_link( '(Edit)' ); ?>
            </div><!-- .comment-meta .commentmetadata -->

            <div class="comment-body">
                <?php comment_text(); ?>
            </div>

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ) ); ?>
            </div><!-- .reply -->
        </div><!-- #comment-## -->
<?php
                break;
            case 'pingback' :
            case 'trackback' :
?>
    <li class="post pingback">
        <p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( '(Edit)' ); ?></p>
<?php
                break;
        endswitch;
    }
endif;
?>
