<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'blogification_excerpt_section',
	array(
		'title'             => esc_html__( 'Excerpt','blogification' ),
		'description'       => esc_html__( 'Excerpt section options.', 'blogification' ),
		'panel'             => 'blogification_theme_options_panel',
	)
);

// long Excerpt length setting and control.
$wp_customize->add_setting( 'blogification_theme_options[long_excerpt_length]',
	array(
		'sanitize_callback' => 'blogification_sanitize_number_range',
		'validate_callback' => 'blogification_validate_long_excerpt',
		'default'			=> $options['long_excerpt_length'],
	)
);

$wp_customize->add_control( 'blogification_theme_options[long_excerpt_length]',
	array(
		'label'       		=> esc_html__( 'Blog Page Excerpt Length', 'blogification' ),
		'description' 		=> esc_html__( 'Total words to be displayed in archive page/search page.', 'blogification' ),
		'section'     		=> 'blogification_excerpt_section',
		'type'        		=> 'number',
		'input_attrs' 		=> array(
			'style'       => 'width: 80px;',
			'max'         => 100,
			'min'         => 5,
		),
	)
);
