<?php
/**
 * Displays the code for the footer.
 *
 * File: footer.php
 * Added: July 5, 2011
 * Copyright 2011, Roy Ens <roy@royens.com>
 */
?>
</div><!-- #main -->
<div id="footer" role="contentinfo">
    <div id="footer-left">
        <p><b><?php bloginfo( 'name' ); ?></b> &copy; 2010, 2011 all images and content.</p>
        <p>Theme design by <a href="http://www.royens.com">Roy Ens</a>.
    </div><!-- #footer-left -->
    <div id="footer-right">
        <p>Follow us on <a href="<?php echo $facebook_link; ?>" title="Facebook Link"><img src="images/f_logo.jpg" width="30" height="30" alt="Facebook Logo" title="Facebook Logo" /></a></p>
    </div><!-- #footer-right -->
</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
