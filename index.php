<?php
/**
 * The main template file.
 *
 * Calls the loop to display posts.
 *
 * @package mandisphotography
 * @version 1.0.1
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" role="main">
    <?php get_template_part( 'loop', 'index' ); ?>
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
