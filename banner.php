<?php
/**
 * Template Name: Banner Page
 *
 * Two column page with a large banner
 * at the top.
 *
 * @package mandisphotography
 * @version 1.0.1
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="banner-image">
    <?php re_get_images( 'full', '0', '0', 'full', "$post->ID", '0', 'attachment-banner', '0', 'small-thumb' ); ?>
</div><!-- #banner-image -->

<div id="content" role="main">
    
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class( 'banner' ); ?>>
            <h1 class="entry-title"><?php the_title(); ?></h1>

            <div class="entry-content">
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">Pages:', 'after' => '</div>' ) ); ?>
            </div><!-- .entry-content -->
        </div><!-- #post-## -->

    <?php endwhile; ?>

</div><!-- #content -->

<?php get_sidebar( 'banner' ); ?>
<?php get_footer(); ?>
