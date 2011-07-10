<?php
/**
 * Template Name: Portfolio Pages
 *
 * One column template for pages that include a
 * jQuery Portfolio.
 *
 * @package mandisphotography
 * @version 0.0.2
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
    <div id="thumbs-container" style="visibility:hidden;">
        <?php re_get_images( 'full', '0', '0', 'full', "$post->ID", '0', 'portfolio-image', '0', '' ); ?>
    </div><!-- #thumbs-container -->
    <div class="infobar">
        <div id="info-left">
            <p><b><?php bloginfo( 'name' ); ?></b> &copy; 2010, 2011 all images.</p>
        </div><!-- #info-right -->
        <div id="info-right">
            <p>Follow us on <a href="<?php echo $facebook_link; ?>" title="Facebook Link"><img src="<?php echo get_template_directory_uri(); ?>/images/f_logo.jpg" width="30" height="30" alt="Facebook Logo" title="Facebook Logo" /></a></p>
        </div><!-- #info-right -->
    </div><!-- #info-bar -->
</div><!-- #thumbs-wrapper -->

<?php get_footer( 'portfolio' ); ?>
