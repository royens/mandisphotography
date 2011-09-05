<?php
/**
 * The template for displaying tag archive pages.
 *
 * @package mandisphotography
 * @version 1.0.2
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" role="main">
    <?php printf( '<h1 class="page-title">Tag Archives For</h1><h2 class="archive-for">%s</h2>', single_tag_title( '', false ) ); ?>

    <?php get_template_part( 'loop', 'tag' ); ?>
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
