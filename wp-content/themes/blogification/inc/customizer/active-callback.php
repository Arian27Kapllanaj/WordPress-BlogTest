<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */


if ( ! function_exists( 'blogification_is_static_homepage_enable' ) ) :
	/**
	 * Check if static homepage is enabled.
	 *
	 * @since Blogification 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function blogification_is_static_homepage_enable( $control ) {
		return ( 'page' == $control->manager->get_setting( 'show_on_front' )->value() );
	}
endif;

if ( ! function_exists( 'blogification_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since  Blogification 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function blogification_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'blogification_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'blogification_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since  Blogification 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function blogification_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'blogification_theme_options[pagination_enable]' )->value();
	}
endif;

/**
 * Check if Hero section is enabled.
 *
 * @since  Blogification 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blogification_is_hero_section_enable( $control ) {
	return ( $control->manager->get_setting( 'blogification_theme_options[hero_section_enable]' )->value() );
}

/**
 * Check if editors section is enabled.
 *
 * @since  Blogification 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blogification_is_editors_section_enable( $control ) {
	return ( $control->manager->get_setting( 'blogification_theme_options[editors_section_enable]' )->value() );
}

/**
 * Check if blog section is enabled.
 *
 * @since  Blogification 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blogification_is_blog_section_enable( $control ) {
	return ( $control->manager->get_setting( 'blogification_theme_options[blog_section_enable]' )->value() );
}

/**
 * Check if today_highlight section is enabled.
 *
 * @since  Blogification 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blogification_is_today_highlight_section_enable( $control ) {
	return ( $control->manager->get_setting( 'blogification_theme_options[today_highlight_section_enable]' )->value() );
}

/**
 * Check if recent_post section is enabled.
 *
 * @since  Blogification 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blogification_is_recent_post_section_enable( $control ) {
	return ( $control->manager->get_setting( 'blogification_theme_options[recent_post_section_enable]' )->value() );
}
