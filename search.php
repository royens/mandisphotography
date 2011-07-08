<?php
/**
 * The template for displaying search results pages.
 *
 * @package mandisphotography
 * @subpackage theme
 * @version 0.0.2
 * @since 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" role="main">
    <?php if ( have_posts() ) : ?>
        <?php printf( '<h1 class="page-title">Search Results For</h1><h2 class="archive-for">%s</h2>', get_search_query() ); ?>
        <?php get_template_part( 'loop', 'search' ); ?>
    <?php else : ?>
        <div id="post-0" class="post no-results not-found">
            <h2 class="entry-title">Nothing Found</h2>

            <div class="entry-content">
                <p>Sorry but nothing matched your search criteria. Maybe try again with some different search terms.</p>
                <?php get_search_form(); ?>
            </div><!-- .entry-content -->
        </div><!-- #post-0 -->
    <?php endif; ?>
</div><!-- #content -->

<script type="text/javascript">
// focuse on search field after it has loaded
document.getElementById('s') && document.getElementById('s').focus();
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
