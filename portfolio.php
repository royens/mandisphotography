<?php
/**
 * Template Name: Portfolio Pages
 *
 * One column template for pages that include a
 * jQuery Portfolio.
 *
 * @package mandisphotography
 * @version 1.0.2
 * @since 0.0.2 
 */
?>

<?php get_header( 'portfolio' ); ?>

<div id="loading"></div>

<div id="preview">
    <div id="image-wrapper">
    </div><!-- #image-wrapper -->
</div><!-- #preview -->

<div id="thumbs-wrapper">
    <div id="thumbs-container" style="/*visibility:hidden;*/">
        <?php re_get_images( 'portfolio-thumb', '0', '0', 'full', "$post->ID", '0', 'portfolio-image', '0', '' ); ?>
    </div><!-- #thumbs-container -->
</div><!-- #thumbs-wrapper -->

<?php get_footer( 'portfolio' ); ?>
