<?php
/**
 * The main template file.
 *
 * Calls the loop to display posts.
 *
 * File: index.php
 * Added: July 5, 2011
 * Copyright 2011, Roy Ens <roy@royens.com>
 */
?>

<?php get_header(); ?>

<div id="content" role="main">
    <?php get_template_part( 'loop', 'index' ); ?>
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
