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
    <p><b><?php bloginfo( 'name' ); ?></b> &copy; 2010, 2011 all images | Follow us on <a href="<?php echo $facebook_link; ?>" title="Facebook Link"><img src="<?php echo get_template_directory_uri(); ?>/images/f_logo.jpg" width="22" height="22" alt="Facebook Logo" title="Facebook Logo" /></a></p>
</div><!-- #info-bar -->

<?php wp_footer(); ?>
</body>
</html>
