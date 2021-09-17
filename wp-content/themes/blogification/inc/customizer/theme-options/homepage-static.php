<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Blogification
* @since Blogification 1.0.0
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'blogification_theme_options[enable_frontpage_content]',
	array(
		'sanitize_callback'   => 'blogification_sanitize_checkbox',
		'default'             => $options['enable_frontpage_content'],
	)
);

$wp_customize->add_control( 'blogification_theme_options[enable_frontpage_content]',
	array(
		'label'       	=> esc_html__( 'Enable Content', 'blogification' ),
		'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'blogification' ),
		'section'     	=> 'static_front_page',
		'type'        	=> 'checkbox',
		'active_callback' => 'blogification_is_static_homepage_enable',
	)
);