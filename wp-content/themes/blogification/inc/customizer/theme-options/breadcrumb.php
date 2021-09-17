<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

$wp_customize->add_section( 'blogification_breadcrumb',
	array(
		'title'             => esc_html__( 'Breadcrumb','blogification' ),
		'description'       => esc_html__( 'Breadcrumb section options.', 'blogification' ),
		'panel'             => 'blogification_theme_options_panel',
	)
);

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'blogification_theme_options[breadcrumb_enable]',
	array(
		'sanitize_callback' => 'blogification_sanitize_switch_control',
		'default'          	=> $options['breadcrumb_enable'],
	)
);

$wp_customize->add_control( new  Blogification_Switch_Control( $wp_customize,
	'blogification_theme_options[breadcrumb_enable]',
		array(
			'label'            	=> esc_html__( 'Enable Breadcrumb', 'blogification' ),
			'section'          	=> 'blogification_breadcrumb',
			'on_off_label' 		=> blogification_switch_options(),
		)
	)
);

// Breadcrumb separator setting and control.
$wp_customize->add_setting( 'blogification_theme_options[breadcrumb_separator]',
	array(
		'sanitize_callback'	=> 'sanitize_text_field',
		'default'          	=> $options['breadcrumb_separator'],
	)
);

$wp_customize->add_control( 'blogification_theme_options[breadcrumb_separator]',
	array(
		'label'            	=> esc_html__( 'Separator', 'blogification' ),
		'active_callback' 	=> 'blogification_is_breadcrumb_enable',
		'section'          	=> 'blogification_breadcrumb',
	)
);
