<?php
/**
 * Recent Posts Section options
 *
 * @package Theme Palace
 * @subpackage Blogification
 * @since Blogification 1.0.0
 */

// Add Recent Posts section
$wp_customize->add_section( 'blogification_recent_post_section',
    array(
        'title'             => esc_html__( 'Recent Posts','blogification' ),
        'description'       => esc_html__( 'Recent Posts Section options.', 'blogification' ),
        'panel'             => 'blogification_front_page_panel',
    )
);

// Recent Posts content enable control and setting
$wp_customize->add_setting( 'blogification_theme_options[recent_post_section_enable]',
    array(
        'default'           =>  $options['recent_post_section_enable'],
        'sanitize_callback' => 'blogification_sanitize_switch_control',
    )
);

$wp_customize->add_control( new Blogification_Switch_Control( $wp_customize,
    'blogification_theme_options[recent_post_section_enable]',
        array(
            'label'             => esc_html__( 'Recent Posts Section Enable', 'blogification' ),
            'section'           => 'blogification_recent_post_section',
            'on_off_label'      => blogification_switch_options(),
        )
    )
);

// blog title setting and control
$wp_customize->add_setting( 'blogification_theme_options[recent_post_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => $options['recent_post_title'],
        'transport'         => 'postMessage',
    )
);

$wp_customize->add_control( 'blogification_theme_options[recent_post_title]',
    array(
        'label'             => esc_html__( 'Section Title', 'blogification' ),
        'section'           => 'blogification_recent_post_section',
        'active_callback'   => 'blogification_is_recent_post_section_enable',
        'type'              => 'text',
    ) 
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blogification_theme_options[recent_post_title]',
        array(
            'selector'            => '#recent-posts .section-header h2.section-title',
            'settings'            => 'blogification_theme_options[recent_post_title]',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'blogification_recent_post_title_partial',
        )
    );
}


// Add dropdown category setting and control.
$wp_customize->add_setting(  'blogification_theme_options[recent_post_content_category]', 
    array(
        'sanitize_callback' => 'blogification_sanitize_single_category',
    ) 
) ;

$wp_customize->add_control( new Blogification_Dropdown_Taxonomies_Control( $wp_customize,
    'blogification_theme_options[recent_post_content_category]',
        array(
            'label'             => esc_html__( 'Select Category', 'blogification' ),
            'description'       => esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'blogification' ),
            'section'           => 'blogification_recent_post_section',
            'type'              => 'dropdown-taxonomies',
            'active_callback'   => 'blogification_is_recent_post_section_enable'
        )
    )
);


//recent_post_btn_txt
$wp_customize->add_setting('blogification_theme_options[recent_post_btn_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['recent_post_btn_txt'],
    )
);

$wp_customize->add_control('blogification_theme_options[recent_post_btn_txt]',
    array(
        'section'			=> 'blogification_recent_post_section',
        'label'				=> esc_html__( 'Button Text:', 'blogification' ),
        'type'          	=>'text',
        'active_callback' 	=> 'blogification_is_recent_post_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blogification_theme_options[recent_post_btn_txt]',
		array(
			'selector'            => '#recent-posts article div.read-story a',
			'settings'            => 'blogification_theme_options[recent_post_btn_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'blogification_recent_post_btn_txt_partial',
		) 
	);
}
