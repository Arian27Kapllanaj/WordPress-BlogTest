<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'blogification_pagination',
	array(
		'title'               	=> esc_html__('Pagination','blogification'),
		'description'         	=> esc_html__( 'Pagination section options.', 'blogification' ),
		'panel'               	=> 'blogification_theme_options_panel',
	) 
);

// Sidebar position setting and control.
$wp_customize->add_setting( 'blogification_theme_options[pagination_enable]',
	array(
		'sanitize_callback' 	=> 'blogification_sanitize_switch_control',
		'default'             	=> $options['pagination_enable'],
	)
);

$wp_customize->add_control( new  Blogification_Switch_Control( $wp_customize,
	'blogification_theme_options[pagination_enable]',
		array(
			'label'               	=> esc_html__( 'Pagination Enable', 'blogification' ),
			'section'             	=> 'blogification_pagination',
			'on_off_label' 			=> blogification_switch_options(),
		)
	)
);

// Site layout setting and control.
$wp_customize->add_setting( 'blogification_theme_options[pagination_type]',
	array(
		'sanitize_callback'   	=> 'blogification_sanitize_select',
		'default'             	=> $options['pagination_type'],
	)
);

$wp_customize->add_control( 'blogification_theme_options[pagination_type]',
	array(
		'label'               	=> esc_html__( 'Pagination Type', 'blogification' ),
		'section'             	=> 'blogification_pagination',
		'type'                	=> 'select',
		'choices'			  	=> blogification_pagination_options(),
		'active_callback'	  	=> 'blogification_is_pagination_enable',
	)
);
