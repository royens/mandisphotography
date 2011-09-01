<?php
/**
 * Theme header for portfolio pages.
 *
 * @package mandisphotography
 * @version 1.0
 * @since 0.0.1
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title>
            <?php
                /*
                 * Print the <title> tag based on what's being viewed.
                 */
                global $page, $paged;

                wp_title( '|', true, 'right' );

                // Add the blog name
                bloginfo( 'name' );

                // Add the blog description for home/front page.
                $site_description = get_bloginfo( 'description', 'display' );
                if ( $site_description && ( is_home() || is_front_page() ) )
                    echo " | $site_description";

                // Add a page number if necessary
                if ( $paged >= 2 || $page >= 2 )
                    echo ' | ' . sprintf( 'Page %s', max( $paged, $page ) );
            ?>
        </title>

        <link rel="profile" href="http:/gmpgs.org/xfn/11" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

        <?php 
            if ( is_singular() && get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );
            wp_head();
        ?>
    </head>

    <body <?php body_class( 'portfolio' ); ?> oncontextmenu="return false;">

        <img class="background-left" src="<?php echo get_template_directory_uri(); ?>/images/swirl-left.png" alt="Background Image" />
        <img class="background-right" src="<?php echo get_template_directory_uri(); ?>/images/swirl-right.png" alt="Background Image" />

        <div id="portfolio-header">
            <div id="header-wrapper">
                <div id="branding" role="banner">
                    <div id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
                    <div id="tag-line"><?php bloginfo( 'description' ); ?></div>
                </div><!-- #branding -->
            
                <div id="main-nav" class="nav" role="navigation">
                    <div class="skip-link screen-reader-text"><a href="#main-portfolio" title="Skip to content">Skip to content</a></div>
                    <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
                    <?php mandisphotography_get_submenu(); ?>
                </div><!-- #main-nav -->
            </div><!-- #header-wrapper -->
        </div><!-- #header -->

        <div id="main-portfolio">
