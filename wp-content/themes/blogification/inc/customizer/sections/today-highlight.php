<?php
/**
 * Featured Post Section options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

// Add Featured Post section
$wp_customize->add_section( 'blogification_today_highlight_section',
	array(
		'title'             => esc_html__( 'Today Highlight\'s','blogification' ),
		'description'       => esc_html__( 'Today Highlight\'s Section options.', 'blogification' ),
		'panel'             => 'blogification_front_page_panel',
	)
);

// Featured Post content enable control and setting
$wp_customize->add_setting( 'blogification_theme_options[today_highlight_section_enable]',
	array(
		'default'			=> 	$options['today_highlight_section_enable'],
		'sanitize_callback' => 'blogification_sanitize_switch_control',
	)
);

$wp_customize->add_control( new  Blogification_Switch_Control( $wp_customize,
	'blogification_theme_options[today_highlight_section_enable]',
		array(
			'label'             => esc_html__( 'Today Highlight\'s Section Enable', 'blogification' ),
			'section'           => 'blogification_today_highlight_section',
			'on_off_label' 		=> blogification_switch_options(),
		)
	)
);

// Service section title control and setting
$wp_customize->add_setting( 'blogification_theme_options[today_highlight_title]', 
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'transport'			=>'postMessage',
		'default'           => $options['today_highlight_title'],
		
	) 
);

$wp_customize->add_control('blogification_theme_options[today_highlight_title]', 
	array(
		'label'             => esc_html__( 'Section Title', 'blogification' ),
		'section'           => 'blogification_today_highlight_section',
		'type'              =>'text',
		'active_callback'	=> 'blogification_is_today_highlight_section_enable',
	)
);
	
	// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'blogification_theme_options[today_highlight_title]',
		array(
			'selector'            => '#todays-highlight .section-header h2.section-title',
			'settings'            => 'blogification_theme_options[today_highlight_title]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'blogification_today_highlight_title_partial',
		) 
	);
}


// Add dropdown category setting and control.
$wp_customize->add_setting(  'blogification_theme_options[today_highlight_content_category]',
	array(
		'sanitize_callback' => 'blogification_sanitize_single_category',
	)
) ;

$wp_customize->add_control( new  Blogification_Dropdown_Taxonomies_Control( $wp_customize,
	'blogification_theme_options[today_highlight_content_category]',
		array(
			'label'             => esc_html__( 'Select Category', 'blogification' ),
			'description'      	=> esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'blogification' ),
			'section'           => 'blogification_today_highlight_section',
			'type'              => 'dropdown-taxonomies',
			'active_callback'	=> 'blogification_is_today_highlight_section_enable'
		)
	)
);


//today_highlight_btn_txt
$wp_customize->add_setting('blogification_theme_options[today_highlight_btn_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['today_highlight_btn_txt'],
    )
);

$wp_customize->add_control('blogification_theme_options[today_highlight_btn_txt]',
    array(
        'section'			=> 'blogification_today_highlight_section',
        'label'				=> esc_html__( 'Button Text:', 'blogification' ),
        'type'          	=>'text',
        'active_callback' 	=> 'blogification_is_today_highlight_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blogification_theme_options[today_highlight_btn_txt]',
		array(
			'selector'            => '#todays-highlight article div.read-story a',
			'settings'            => 'blogification_theme_options[today_highlight_btn_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'blogification_today_highlight_btn_txt_partial',
		) 
	);
}
