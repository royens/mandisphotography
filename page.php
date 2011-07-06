<?php
/**
 * The template for displaying pages.
 *
 * @package mandisphotography
 * @subpackage theme
 * @version 0.0.1
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" role="main">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if ( is_front_page() ) : ?>
                <h2 class="entry-title"><?php the_title(); ?></h2>
            <?php else : ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">Pages:', 'after' => '</div>' ) ); ?>
            </div><!-- .entry-content -->
        </div><!-- #post-## -->

        <?php comments_template( '', true ); ?>
    
    <?php endwhile; ?>

</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>