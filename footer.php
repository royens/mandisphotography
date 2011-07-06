<?php
/**
 * Displays the code for the footer.
 *
 * @version 0.0.1
 * @package mandisphotography
 * @subpackage theme
 * @since 0.0.1
 */
?>
</div><!-- #main -->
<div id="footer" role="contentinfo">
    <div id="footer-left">
        <p><b><?php bloginfo( 'name' ); ?></b> &copy; 2010, 2011 all images and content.</p>
        <p>Theme design by <a href="http://www.royens.com">Roy Ens</a>.
    </div><!-- #footer-left -->
    <div id="footer-right">
        <p>Follow us on <a href="<?php echo $facebook_link; ?>" title="Facebook Link"><img src="<?php echo get_template_directory_uri(); ?>/images/f_logo.jpg" width="30" height="30" alt="Facebook Logo" title="Facebook Logo" /></a></p>
    </div><!-- #footer-right -->
</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
