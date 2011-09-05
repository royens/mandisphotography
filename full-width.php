<?php
/**
 * Template Name: Full-Width
 *
 * One column template for pages that include an
 * image on the right side.
 *
 * @package mandisphotography
 * @version 1.0.2
 * @since 1.0.2
 */
?>

<?php get_header(); ?>

<div id="content" class="full-width" role="main">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class( 'full-width' ); ?>>
            <h1 class="entry-title"><?php the_title(); ?></h1>

            <div class="entry-content">
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">Pages:' , 'after' => '</div>' ) ); ?>
            </div><!-- .entry-content -->
        </div><!-- #post-## -->

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>      
