<?php
/**
 * The template for displaying author archive pages.
 *
 * @package mandisphotography
 * @subpackage theme
 * @version 1.0.1
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" role="main">

    <?php
        /* Queue the first post so we know who
         * the author is.
         *
         * Reset this later to run loop
         */
        if ( have_posts() )
            the_post(); 
    ?>

    <?php printf( '<h1 class="page-title">Author Archives For</h1><h2 class="archive-for">%s</h2>', '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?>

    <?php
        // If a user has filled out their description, show a bio on their entries
        if ( get_the_author_meta( 'description' ) ) : 
    ?>
        <div id="entry-author-info">
            <div id="author-avatar">
                <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'weddingswirl_author_bio_avatar_size', 60 ) ); ?>
            </div><!-- #author-avatar -->
            <div id="author-description">
                <h2>About <?php the_author(); ?></h2>
                <?php the_author_meta( 'description' ); ?>
            </div><!-- #author-description -->
        </div><!-- #entry-author-info -->
    <?php endif; ?>

    <?php
        /* Resetting the loop here
         * Rewind to beginning
         */
        rewind_posts();

        get_template_part( 'loop', 'author' );
    ?>

</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
