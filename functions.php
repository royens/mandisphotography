<?php
/**
 * @package mandisphotography
 * @version 1.0
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

        // Enable post thumbnail support
        add_theme_support( 'post_thumbnails' );
        // New Image size
        if ( function_exists( 'add_image_size' ) ) {
            add_image_size( 'slideshow', 900, 450, true );
            add_image_size( 'portfolio-thumb', 75, 75, true );
        }

        register_nav_menus( array(
            'primary' => 'Primary Navigation',
        ) );

        require( dirname( __FILE__ ) . '/inc/widgets.php' );
        require( dirname( __FILE__ ) . '/inc/theme-options.php' );
    }
endif;

/**
 * Register widgetized areas, including sidebar
 */
function mandisphotography_widgets_init() {

    // Register our widget
    register_widget( 'MandisPhotography_Widget' );
    // Register our sidebar page logic widget
    register_widget( 'MandisPhotography_Page_Widget' );

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

    // Area 2, on banner pages
    register_sidebar( array(
        'name' => 'Banner Page Widget Area',
        'id' => 'banner-widget-area',
        'description' => 'Widget are on pages using the banner template.',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array( 
        'name' => 'Horizontal Row Left',
        'id' => 'horizontal-bottom-left',
        'description' => 'Widget area on slideshow template. Left.',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="horizontal-widget-title">',
        'after_title' => '</h3>'
    ) );
    register_sidebar( array(
        'name' => 'Horizontal Row Left of Centre',
        'id' => 'horizontal-bottom-left-centre',
        'description' => 'Widget are on slideshow template. Left of centre.',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="horizontal-widget-title">',
        'after_title' => '</h3>'
    ) );
    register_sidebar( array(
        'name' => 'Horizontal Row Right of Centre',
        'id' => 'horizontal-bottom-right-centre',
        'description' => 'Widget are on slideshow template. Right of centre.',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="horizontal-widget-title">',
        'after_title' => '</h3>'
    ) );
    register_sidebar( array(
        'name' => 'Horizontal Row Right',
        'id' => 'horizontal-bottom-right',
        'description' => 'Widget are on slideshow template. Right.',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="horizontal-widget-title">',
        'after_title' => '</h3>'
    ) );
}
add_action( 'widgets_init', 'mandisphotography_widgets_init' );

if ( !function_exists( 'mandisphotography_get_submenu' ) ) :
    /**
     * Function creates the submenu on pages that have children
     */
    function mandisphotography_get_submenu() {
        global $post;
        if ( $post->post_parent ) {
            $children = wp_list_pages( 'title_li=&child_of=' . $post->post_parent . '&echo=0' );
        } else {
            $children = wp_list_pages( 'title_li=&child_of=' . $post->ID . '&echo=0' );
        }

        if ( $children ) {
            echo '<ul class="sub-menu">' . "\n" . $children . "\n" . '</ul>';
        }
    }
endif;

function re_load_slideshow_js() {
    if ( ! is_admin() ) {
        if ( is_page_template( 'slideshow.php' ) ) {
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'jquery-cycle', get_bloginfo( 'template_url' ) . '/js/jquery.cycle.all.min.js', array( 'jquery' ) );
            wp_enqueue_script( 'slideshow', get_bloginfo( 'template_url' ) . '/js/jquery.slideshow.js', array( 'jquery-cycle' ) );
        }
    }
}
add_action( 'template_redirect', 're_load_slideshow_js' );

function re_load_portfolio_js() {
    if ( ! is_admin() ) {
        if ( is_page_template( 'portfolio.php' ) ) {
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'jquery-gallery', get_bloginfo( 'template_url' ) . '/js/jquery.gallery.js', array( 'jquery' ) );
        }
    }
}
add_action( 'template_redirect', 're_load_portfolio_js' );

/**
 * For the sake of security lets remove the WordPress
 * version number from feeds and the generator tag
 */
function mandisphotography_remove_version() {
    return '';
}
add_filter( 'the_generator', 'mandisphotography_remove_version' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 */
function mandisphotography_remove_gallery_css( $css ) {
    return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'mandisphotography_remove_gallery_css' );

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

function re_get_images( $size = 'thumbnail', $limit = '0', $offset = '0', $big = 'large', $post_id = '$post->ID', $link = '1', $img_class = 'attachment-image', $wrapper = 'div', $wrapper_class = 'attachment-image-wrapper', $output_type = 'default' ) {

    global $post;

    $images = get_children( array ( 
        'post_parent' => $post->ID,
        'post_status' => 'inherit',
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'order' => 'ASC',
        'orderby' => 'menu_order ID'
    ) );


    if ( $images ) {
        $num_of_images = count( $images );

        if ( $offset > 0 )
            $start = $offset--;
        else 
            $start = 0;

        if ( $limit > 0 )
            $stop = $limit + $start;
        else
            $stop = $num_of_images;

        $i = 0;

        foreach ( $images as $attachment_id => $image ) {
            if ( $start <= $i && $i < $stop ) {
                $img_title = $image->post_title;
                $img_description = $image->post_content;
                $img_caption = $image->post_excerpt;
                $img_alt = get_post_meta( $attachment_id, '_wp_get_attachment_image_alt', true );
                if ( $img_alt == '' )
                    $img_alt = $img_title;
                if ( $big == 'large' ) {
                    $big_array = image_downsize( $image->ID, $big );
                    $img_url = $big_array[0];
                } else {
                    $img_url = wp_get_attachment_url( $image->ID );
                }

                $preview_array = image_downsize( $image->ID, $size );
                if ( $preview_array[ 3 ] != 'true' && $size != 'full' ) {
                    $preview_array = image_downsize( $image->ID, 'thumbnail' );
                    $img_preview = $preview_array[ 0 ];
                    if ( $size == 'portfolio-thumb' )
                        $img_preview = preg_replace('/-150x150/', '-75x75', $img_preview );
                    $img_width = $preview_array[ 1 ];
                    $img_heigth = $preview_array[ 2 ];
                } else {
                    $img_preview = $preview_array[ 0 ];
                    if ( $size == 'portfolio-thumb' )
                        $img_preview = preg_replace( '/-150x150/', '-75x75', $img_preview );
                    $img_width = $preview_array[ 1 ];
                    $img_width = $preview_array[ 2 ];
                }

                

                $output = '';
                if ( $wrapper != '0' )
                    $output .= '<' . $wrapper . ' class="' . $wrapper_class . '">';
                if ( $link == '1' )
                    $output .= '<a href="' . $img_url . '" title="' . $img_title . '">';
                $output .= '<img class="' . $img_class . '" src="' . $img_preview . '" alt="' . $img_url . '" title="' . $img_title . '" />';
                if ( $link  == '1' )
                    $output .= '</a>';
                if ( $img_caption != '' )
                    $output .= '<div class="attachment-caption">' . $img_caption . '</div>';
                if ( $img_description != '' )
                    $output .= '<div class="attachment-description">' . $img_description . '</div>';
                if ( $wrapper != '0' )
                    $output .= '</' . $wrapper . '>';
                $output .= "\n";
                    print( $output );
            }
            $i++;
        }
    }
}

if ( !function_exists( '_log' ) ) {
    function _log( $message ) {
        if ( WP_DEBUG === true ) {
            if ( is_array( $message ) || is_object( $message ) ) {
                error_log( print_r( $message, true ) );
            } else {
                error_log( $message ) ;
            }
        }
    }
}
?>
