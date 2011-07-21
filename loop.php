<?php
/**
 * The loop displays posts.
 *
 * @package mandisphotography
 * @version 0.0.2
 * @since 0.0.1
 */
?>

<?php /* If there are no posts to display */
if ( ! have_posts() ) : ?>
    <div id="post-0" class="post error404 not-found">
        <h1 class="entry-title">Not Found</h1>
        <div class="entry-content">
            <p>Please accept our apologies, but no results were found for the requested archive. Maybe searching will help you find what you're looking for or you're just really lost.</p>
            <?php get_search_form(); ?>
        </div><!-- .entry-content -->
    </div><!-- #post-0 -->
<?php endif; ?>

<?php
    /* Start the loop
     *
     * Much of this code is taken from the default WordPress Twenty-Ten theme.
     */
?>

<?php while ( have_posts() ) : the_post(); ?>
    
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <div class="entry-meta">
            <?php mandisphotography_posted_on(); ?>
        </div><!-- .entry-meta -->

        <?php if ( is_archive() || is_search() ) : // Only dipslay excerpts for archives and search ?>
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
        <?php else: ?>
            <div class="entry-content">
                <?php the_content( 'Continue reading <span class="meta-nav">&rarr;</span>' ); ?>
            </div><!-- .entry-content -->
        <?php endif; ?>

        <div class="entry-utility">
            <?php if ( count( get_the_category() ) ) : ?>
                <span class="cat-links">
                    <?php printf( '<span class="%1$s">Posted in</span> %2$s', 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
                </span>
                <span class="meta-sep">|</span>
            <?php endif; ?>
            <?php 
                $tags_list = get_the_tag_list( '', ', ');
                if ( $tags_list ) :
            ?>
                <span class="tag-links">
                    <?php printf( '<span class="%1$s">Tagged</span>  %2$s', 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
                </span>
                <span class="meta-sep">|</span>
            <?php endif; ?>
            <span class="comments-link"><?php comments_popup_link( 'Leave a comment', '1 Comment', '% Comments' ); ?></span>
        </div><!-- .entry-utility -->
    </div><!-- #post-## -->

    <?php comments_template( '', true ); ?>

<?php endwhile; /* End the loop */ ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
    <div id="nav-below" class="navigation">
        <div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> Older Posts' ); ?></div>
        <div class="nav-next"><?php previous_posts_link( 'Newer Posts <span class="meta-nav">&rarr;</span>' ); ?></div>
    </div><!-- #nav-below -->
<?php endif; ?>
