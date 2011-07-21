<?php
/**
 * The template for displaying single posts.
 *
 * @package mandisphotography
 * @version 0.0.2
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" role="main">
    
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-meta">
                <?php mandisphotography_posted_on(); ?>
            </div><!-- .entry-meta -->

            <div class="entry-content">
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">Pages:', 'after' => '</div>' ) ); ?>
            </div><!-- .entry-content -->

            <div class="entry-utility">
                <?php mandisphotography_posted_in(); ?>
                <?php edit_post_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
            </div><!-- .entry-utility -->
        </div><!-- #post-## -->

        <div id="nav-below" class="navigation">
            <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ); ?></div>
            <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ); ?></div>
        </div><!-- #nav-below -->

        <?php comments_template( '', true ); ?>

    <?php endwhile; /* End of the loop */ ?>

</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
