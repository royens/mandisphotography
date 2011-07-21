<?php
/**
 * The template for displaying category archive pages.
 *
 * @package mandisphotography
 * @version 0.0.2
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" role="main">
    <?php printf( '<h1 class="page-title">Category Archives For</h1><h2 class="archive-for">%s</h2>', single_cat_title( '', false ) ); ?>
    <?php
        $category_description = category_description();
        if ( ! empty( $category_desription ) )
            echo '<div class="archive-meta">' . $category_description . '</div>';
    ?>

    <?php get_template_part( 'loop', 'category' ); ?>

</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
