<?php
/**
 * Service Section options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

// Add Service section
$wp_customize->add_section( 'blogification_editors_section', 
	array(
		'title'             => esc_html__( 'Editor\'s Picked','blogification' ),
		'description'       => esc_html__( 'Editor\'s Picked Section options.', 'blogification' ),
		'panel'             => 'blogification_front_page_panel',
	) 
);

// Service content enable control and setting
$wp_customize->add_setting( 'blogification_theme_options[editors_section_enable]', 
	array(
		'default'			=> 	$options['editors_section_enable'],
		'sanitize_callback' => 'blogification_sanitize_switch_control',
	) 
);

$wp_customize->add_control( new  Blogification_Switch_Control( $wp_customize,
	'blogification_theme_options[editors_section_enable]', 
		array(
			'label'             => esc_html__( 'Editor\'s Section Enable', 'blogification' ),
			'section'           => 'blogification_editors_section',
			'on_off_label' 		=> blogification_switch_options(),
		) 
	)
);

// Service section title control and setting
$wp_customize->add_setting( 'blogification_theme_options[editors_section_title]', 
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'transport'			=>'postMessage',
		'default'           => $options['editors_section_title'],
		
	) 
);

$wp_customize->add_control('blogification_theme_options[editors_section_title]', 
	array(
		'label'             => esc_html__( 'Section Title', 'blogification' ),
		'section'           => 'blogification_editors_section',
		'type'              =>'text',
		'active_callback'	=> 'blogification_is_editors_section_enable',
	)
);
	
	// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'blogification_theme_options[editors_section_title]',
		array(
			'selector'            => '#editors-picked div.section-header h2',
			'settings'            => 'blogification_theme_options[editors_section_title]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'blogification_editors_section_title_partial',
		) 
	);
}

// editors category drop down chooser control and setting
$wp_customize->add_setting( 'blogification_theme_options[editors_category]', 
	array(
		'sanitize_callback' => 'blogification_sanitize_single_category',
	)
);

$wp_customize->add_control( new  Blogification_Dropdown_Taxonomies_Control( $wp_customize,
	'blogification_theme_options[editors_category]',
		array(
			'label'             => esc_html__( 'Select Categories', 'blogification' ),
			'description'       => esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'blogification' ),
			'type'           	=> 'dropdown-taxonomies',
			'section'           => 'blogification_editors_section',
			'active_callback'	=> 'blogification_is_editors_section_enable',
		) 
	)
);


//editors_btn_txt
$wp_customize->add_setting('blogification_theme_options[editors_btn_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['editors_btn_txt'],
    )
);

$wp_customize->add_control('blogification_theme_options[editors_btn_txt]',
    array(
        'section'			=> 'blogification_editors_section',
        'label'				=> esc_html__( 'Button Text:', 'blogification' ),
        'type'          	=>'text',
        'active_callback' 	=> 'blogification_is_editors_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blogification_theme_options[editors_btn_txt]',
		array(
			'selector'            => '#editors-picked article div.read-story a',
			'settings'            => 'blogification_theme_options[editors_btn_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'blogification_editors_btn_txt_partial',
		) 
	);
}
