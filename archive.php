<?php
/**
 * The template for displaying archive pages.
 *
 * @package mandisphotography
 * @version 1.0.2
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" role="main">
    <?php
        /*
         * Queue the first post, so we know
         * what date we're dealing with.
         *
         * Gets reset later to run loop properly.
         */
        if ( have_posts() )
            the_post();
    ?>

    <h1 class="page-title">
        <?php if ( is_day() ) : ?>
            <?php printf( 'Daily Archives For</h1><h2 class="archive-for">%s</h2>', get_the_date() ); ?>
        <?php elseif ( is_month() ) : ?>
            <?php printf( 'Monthly Archives For</h1> <h2 class="archive-for">%s</h2>', get_the_date( 'F Y' ) ); ?>
        <?php elseif ( is_year() ) : ?>
            <?php printf( 'Yearly Archives For</h1> <h2 class="archive-for">%s</h2>', get_the_Date( 'Y' ) ); ?>
        <?php else : ?>
            Blog Archives
        <?php endif; ?>
    </h1>

    <?php
    /*
     * Since we called the_post() above, we need to rewind
     * the loop back to the beginning so it can run properly
     * and in full.
     */
    rewind_posts();

    /*
     * Run the loop for the archives page to output posts.
     */
    get_template_part( 'loop', 'archive' );
    ?>

</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
