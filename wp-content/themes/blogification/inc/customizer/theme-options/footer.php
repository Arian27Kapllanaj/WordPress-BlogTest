<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

// Footer Section
$wp_customize->add_section( 'blogification_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'blogification' ),
		'priority'   			=> 900,
		'panel'      			=> 'blogification_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'blogification_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'blogification_santize_allow_tag',
		'transport'				=> 'postMessage',
	)
);

$wp_customize->add_control( 'blogification_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'blogification' ),
		'section'    			=> 'blogification_section_footer',
		'type'		 			=> 'textarea',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blogification_theme_options[copyright_text]',
		array(
			'selector'            => '.site-info .wrapper',
			'settings'            => 'blogification_theme_options[copyright_text]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'blogification_copyright_text_partial',
		)
	);
}

// scroll top visible
$wp_customize->add_setting( 'blogification_theme_options[scroll_top_visible]',
	array(
		'default'       	=> $options['scroll_top_visible'],
		'sanitize_callback' => 'blogification_sanitize_switch_control',
	)
);
$wp_customize->add_control( new  Blogification_Switch_Control( $wp_customize,
	'blogification_theme_options[scroll_top_visible]',
		array(
			'label'      		=> esc_html__( 'Display Scroll Top Button', 'blogification' ),
			'section'    		=> 'blogification_section_footer',
			'on_off_label' 		=> blogification_switch_options(),
		)
	)
);
