<?php
/**
 * Demo Import.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @subpackage blogification 
 * @since blogification  1.0.0
 */

function blogification_ctdi_plugin_page_setup( $default_settings ) {
    $default_settings['menu_title']  = esc_html__( 'Theme Palace Demo Import' , 'blogification' );

    return $default_settings;
}
add_filter( 'cp-ctdi/plugin_page_setup', 'blogification_ctdi_plugin_page_setup' );


function blogification_ctdi_plugin_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Demo content files for Blogification Theme.', 'blogification' ),
    esc_url( 'https://themepalace.com/download/blogification' ), esc_html__( 'Click here for Demo File download', 'blogification' ) );
    return $default_text;
}
add_filter( 'cp-ctdi/plugin_intro_text', 'blogification_ctdi_plugin_intro_text' );