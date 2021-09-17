<?php
/**
 * Menu options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'blogification_menu',
	array(
		'title'             => esc_html__('Header Menu','blogification'),
		'description'       => esc_html__( 'Header Menu options.', 'blogification' ),
		'panel'             => 'nav_menus',
	)
);

$wp_customize->add_setting( 'blogification_theme_options[search_icon_in_social_menu_enable]',
	array(
		'sanitize_callback' => 'blogification_sanitize_switch_control',
		'default'           => $options['search_icon_in_social_menu_enable'],
	)
);

$wp_customize->add_control( new  Blogification_Switch_Control( $wp_customize,
	'blogification_theme_options[search_icon_in_social_menu_enable]',
		array(
			'label'             => esc_html__( 'Show Search Icon in Primary menu', 'blogification' ),
			'section'           => 'blogification_menu',
			'on_off_label' 		=> blogification_switch_options(),
		)
	)
);
