<?php
/**
 * Template Name: Slideshow Page
 *
 * One column template for pages that include a
 * rotating slideshow using JQuery Cycle plugin.
 * 
 * @package mandisphotography
 * @version 1.0.2
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" class="one-column" role="main">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        
        <div id="post-<?php the_ID(); ?>" <?php post_class( 'slideshow' ); ?>>
            <div id="slideshow">
                <?php re_get_images( 'full', '0', '0', 'full', "$post->ID", '0', 'attachment-image', '0', 'small-thumb' ); ?>
            </div><!-- #slideshow -->
        </div><!-- #post-## -->

    <?php endwhile; ?>

    <?php get_sidebar( 'horizontal' ); ?>

</div><!-- #content .one-column -->

<?php get_footer(); ?>
