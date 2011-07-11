<?php
/**
 * Displays the HTML for the portfolio footer.
 *
 * @package mandisphotography
 * @version 0.0.2
 * @since 0.0.2
 */
?>

</div><!-- #main-portfolio -->
<div class="infobar">
    <div id="info-left">
        <p><b><?php bloginfo( 'name' ); ?></b> &copy; 2010, 2011 all images.</p>
    </div><!-- #info-right -->
    <div id="info-right">
        <p>Follow us on <a href="<?php echo $facebook_link; ?>" title="Facebook Link"><img src="<?php echo get_template_directory_uri(); ?>/images/f_logo.jpg" width="30" height="30" alt="Facebook Logo" title="Facebook Logo" /></a></p>
    </div><!-- #info-right -->
</div><!-- #info-bar -->

<?php wp_footer(); ?>
</body>
</html>
