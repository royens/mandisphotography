<?php
/**
 * The main template file.
 *
 * Calls the loop to display posts.
 *
 * @version 0.0.1
 * @package mandisphotography
 * @subpackage theme
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" role="main">
    <?php get_template_part( 'loop', 'index' ); ?>
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
