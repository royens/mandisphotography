<?php
/**
 * The template for displaying comments.
 *
 * @package mandisphotography
 * @version 1.0
 * @since 0.0.1
 */
?>

<div id="comments">
    <?php if ( post_password_required() ) : ?>
        <p class="nopassword">This post is password protected. Enter the password to view any comments.</p>
</div><!-- #comments -->
    <?php /* Stop the rest of comments.php from being processed */
            return;
        endif;
    ?>

    <?php if ( have_comments() ) : ?>
        <h3 id="comments-title">Comments</h3>
        <h4 id="comments-to"><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'mandisphotography' ), number_format_i18n( get_comments_number() ), '<em>"' . get_the_title() . '"</em>' ); ?></h4>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&larr;</span> Older Comments' ); ?></div>
                <div class="nav-next"><?php next_comments_link( 'Newer Comments <span class="meta-nav">&rarr;</span>' ); ?></div>
            </div><!-- .navigation -->
        <?php endif; ?>

        <ol class="commentlist">
            <?php 
            /* Loop through and list the comments. Tell wp_list_comments() to
             * use mandisphotography_comment() to format the comments.
             */
                wp_list_comments( array( 'callback' => 'mandisphotography_comment' ) );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&larr;</span> Older Comments' ); ?></div>
                <div class="nav-next"><?php next_comments_link( 'Newer Comments <span class="meta-nav">&rarr;</span>' ); ?></div>
            </div><!-- .navigation -->
        <?php endif; ?>

    <?php else : /* We don't have any comments */

        /* If there are no comments and comments are closed let visitor know.
         */
        if ( ! comments_open() ) :
    ?>
            <p class="nocomments">Comments are closed.</p>
        <?php endif; ?>
    <?php endif; ?>

    <?php comment_form( array( 'comment_notes_after' => '', 'label_submit' => __( 'Submit Comment' ) ) ); ?>

</div><!-- #comments -->
