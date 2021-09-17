<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'blogification_reset_section',
	array(
		'title'             => esc_html__('Reset all settings','blogification'),
		'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'blogification' ),
	)
);

// Add reset enable setting and control.
$wp_customize->add_setting( 'blogification_theme_options[reset_options]',
	array(
		'default'           => $options['reset_options'],
		'sanitize_callback' => 'blogification_sanitize_checkbox',
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'blogification_theme_options[reset_options]',
	array(
		'label'             => esc_html__( 'Check to reset all settings', 'blogification' ),
		'section'           => 'blogification_reset_section',
		'type'              => 'checkbox',
	) 
);
