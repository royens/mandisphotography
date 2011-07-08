<?php
/**
 * The template for displaying 404 pages.
 *
 * @package mandisphotography
 * @subpackage theme
 * @version 0.0.2
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" role="main">
    <div id="post-0" class="post error404 not-found">
        <h1 class="entry-title">Not Found</h1>
        <div class="entry-content">
            <p>Apologies but the page you requested could not be found or the server ate it. Perhaps searching will help?? Or maybe not.</p>
            <?php get_search_form(); ?>
        </div><!-- .entry-content -->
    </div><!-- #post-0 -->
</div><!-- #content -->

<script type="text/javascript">
// focus on search field after it has loaded
document.getElementById('s') && document.getElementById('s').focus();
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
