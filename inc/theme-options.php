<?php
/**
 * Theme options. These functions create a theme options page and allows a 
 * user to set certain options.
 *
 * @package mandisphotography_theme
 * @version 0.2
 * @since 0.2
 */

/**
 * Initializes the theme options.
 *
 * @return void
 */
function mandisphotography_theme_options_init() {

    if( false === mandisphotography_get_theme_options() ) 
        add_option( 'mandisphotography_theme_options', mandisphotography_get_default_theme_options() );

    register_setting(
        'mandisphotography_options',
        'mandisphotography_theme_options',
        'mandisphotography_theme_options_validate'
    );
}
add_action( 'admin_init', 'mandisphotography_theme_options_init' );

/** Allow finer grained control of capability
 *
 * @param string $capability THe capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function mandisphotography_option_page_capability( $capability ) {
    return 'edit_theme_options';
}
add_filter( 'option_page_capability_mandisphotography_options', 'mandisphotography_option_page_capability' );

/**
 * Add the theme options page to the admin menu.
 *
 * Function attached to the admin_menu action hook.
 */
function mandisphotography_theme_options_add_page() {
    $theme_page = add_theme_page(
        'Theme Options',    // Name of Page
        'Theme Options',    // Label in menu
        'edit_theme_options',   // Capability required
        'theme_options',        // Menu slug, used to uniquely identify the page
        'theme_options_render_page' // Function that renders the option page
    );

    if ( ! $theme_page )
        return;

    $help = '<p>Some themes provide customization options that are grouped together on a Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, Mandi\'s Photography, provides the following Theme Options:"</p>' .
        '<ol>' .
        '<li><strong>Facebook Link</strong>: You can add your Facebook page link and have the Facebook icon in the footer link to it.</li>' .
        '</ol>' .
        '<p>Remember to clic "Save Changes" to save any changes you have made to the theme options.</p>';

    add_contextual_help( $theme_page, $help );
}
add_action( 'admin_menu', 'mandisphotography_theme_options_add_page' );

/**
 * Returns the default theme options.
 *
 * @return array The default theme options.
 */
function mandisphotography_get_default_theme_options() {
    $default_theme_options = array(
        'fb_link' => '',
    );

    return apply_filters( 'mandisphotography_default_theme_options', $default_theme_options );
}


/**
 * Return the options array for mandisphotography-theme.
 *
 * @return array The array of options
 */
function mandisphotography_get_theme_options() {
    return get_option( 'mandisphotography_theme_options', mandisphotography_get_default_theme_options() );
}

/**
 * Outputs the HTML of the options page.
 *
 * @return void Echoes it's output
 */
function theme_options_render_page() {
?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php printf( '%s Theme Options', get_current_theme() ); ?></h2>
        <?php settings_errors(); ?>

        <form method="post" action="options.php">
            <?php
                settings_fields( 'mandisphotography_options' );
                $options = mandisphotography_get_theme_options(); 
                $default_options = mandisphotography_get_default_theme_options();
            ?>

            <table class="form-table">
            
                <tr valign="top" class="">
                    <td>
                        <fieldset><legend class="screen-reader-text"><span>Facebook Link</span></legend>
                            <div class="layout">
                                <label for="mandisphotography_theme_options[fb-link]">Facebook Link:</label>
                                <input type="text" name="mandisphotography_theme_options[fb_link]" id="mandisphotography_theme_options[fb_link]" value="<?php echo esc_attr( $options['fb_link'] ); ?>" />
                            </div>
                        </fieldset>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Validate and sanitizes the input of the user entered options.
 *
 * @param array An array of options.
 * @return array The sanitized array of options.
 */
function mandisphotography_theme_options_validate( $input ) {
    $output = $defaults = mandisphotography_get_default_theme_options();

    if ( isset( $input['fb_link'] ) ) 
        $output['fb_link'] = strip_tags( $input['fb_link'] );

    return apply_filters( 'mandisphotography_theme_options_validate', $output, $input, $defaults );
}

/**
 * Get the fb link for use in themes.
 *
 * @return string Link that the user set in the options page.
 */
function get_fb_link() {
    $options = mandisphotography_get_theme_options();

    return $options['fb_link'];
}
