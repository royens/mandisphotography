<?php
/**
 * The template for displaying image attachments.
 *
 * @package mandisphotography
 * @version 1.0.2
 * @since 1.0.2
 */
?>

<?php get_header(); ?>

<div id="content" class="full-width" role="main">
    
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <?php if ( ! empty( $post->post_parent ) ) : ?>
            
            <p class="page-title"><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( 'Return to %s', get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php printf( 'Return to %s', get_the_title( $post->post_parent ) ); ?></a></p>

        <?php endif; ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2 class="entry-title"><?php the_title(); ?></h2>

            <div class="entry-content">
                <div class="entry-attachment">
                    <?php 
                        $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );

                        foreach ( $attachments as $k => $attachment ) {
                            if ( $attachment->ID == $post->ID )
                                break;
                        }

                        $k++;
                        // If there is more than 1 image attachment in a gallery
                        if ( count( $attachments ) > 1 ) {
                            if ( isset ( $attachments[ $k ] ) )
                                // get the URL of the next image attachment
                                $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                            else
                                // or get the URL of the first image
                                $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
                        } else {
                            // or if there's only 1 image attachment, get the URL of the image
                            $next_attachment_url = wp_get_attachment_url();
                        }
                    ?>
                    <p class="attachment"><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo wp_get_attachment_image( $post->ID, 'full' ); ?></a></p>

                </div><!-- .entry-attachment -->

                <div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>

                <?php the_content( 'Continue Reading <span class="meta-nav">&rarr;</span>' ); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">Pages:', 'after' => '</div>' ) ); ?>
                <div id="nav-below" class="navigation">
                    <div class="nav-previous"><?php previous_image_link( false ); ?></div>
                    <div class="nav-next"><?php next_image_link( false ); ?></div>
                </div><!-- #nav-below -->
            </div><!-- .entry-content -->
        </div><!-- #post-## -->

    <?php endwhile; ?>

</div><!-- #content -->

<?php get_footer(); ?>
