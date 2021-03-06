<?php
/**
 * Displays the HTML for the horizontal sidebar.
 *
 * @package mandisphotography
 * @version 1.0.2
 * @since 0.0.1
 */
?>

<div id="horizontal-sidebar">
    <h3>Specialty Designs...</h3>
    <div id="wb-one">
        <?php dynamic_sidebar( 'horizontal-bottom-left' ); ?>
    </div><!-- #wb-one -->

    <div id="wb-two">
        <?php dynamic_sidebar( 'horizontal-bottom-left-centre' ); ?>
    </div><!-- #wb-two -->

    <div id="wb-three">
        <?php dynamic_sidebar( 'horizontal-bottom-right-centre' ); ?>
    </div><!-- #wb-three -->

    <div id="wb-four">
        <?php dynamic_sidebar( 'horizontal-bottom-right' ); ?>
    </div><!-- #wb-four -->
</div><!-- #horizontal-sidebar -->
