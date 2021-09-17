<?php
/**
 * Hero Section options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

// Add Hero section
$wp_customize->add_section( 'blogification_hero_section',
    array(
        'title'             => esc_html__( 'Hero','blogification' ),
        'description'       => esc_html__( 'Hero Section options.', 'blogification' ),
        'panel'             => 'blogification_front_page_panel',

    )
);

// Hero content enable control and setting
$wp_customize->add_setting( 'blogification_theme_options[hero_section_enable]',
    array(
        'default'			=> 	$options['hero_section_enable'],
        'sanitize_callback' => 'blogification_sanitize_switch_control',
    )
);

$wp_customize->add_control( new  Blogification_Switch_Control( $wp_customize,
    'blogification_theme_options[hero_section_enable]',
        array(
            'label'             => esc_html__( 'Hero Section Enable', 'blogification' ),
            'section'           => 'blogification_hero_section',
            'on_off_label' 		=> blogification_switch_options(),
        )
    )
);

// Hero posts drop down chooser control and setting
$wp_customize->add_setting( 'blogification_theme_options[hero_content_post]',
    array(
        'sanitize_callback' => 'blogification_sanitize_page',
    )
);

$wp_customize->add_control( new  Blogification_Dropdown_Chooser( $wp_customize,
    'blogification_theme_options[hero_content_post]',
        array(
            'label'             => esc_html__( 'Select posts', 'blogification' ),
            'section'           => 'blogification_hero_section',
            'choices'			=> blogification_post_choices(),
            'active_callback'	=> 'blogification_is_hero_section_enable',
        )
    ) 
);



// Hero read more setting and control
$wp_customize->add_setting( 'blogification_theme_options[hero_read_more]',
    array(
        'default'			=> $options['hero_read_more'],
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         =>'postMessage',
    )
);

$wp_customize->add_control( 'blogification_theme_options[hero_read_more]',
    array(
        'label'           	=> esc_html__( 'Read More Text', 'blogification' ),
        'section'        	=> 'blogification_hero_section',
        'active_callback' 	=> 'blogification_is_hero_section_enable',
        'type'				=> 'text',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blogification_theme_options[hero_read_more]',
        array(
            'selector'            => '#hero-posts .read-more a.btn',
            'settings'            => 'blogification_theme_options[hero_read_more]',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'blogification_hero_read_more_partial',
        )
    );
}


// blog btn url setting and control
$wp_customize->add_setting( 'blogification_theme_options[hero_excerpt]',
    array(
        'sanitize_callback' => 'absint',
        'default'			=> $options['hero_excerpt'],
        'transport'         =>'refresh',

    )
);

$wp_customize->add_control( 'blogification_theme_options[hero_excerpt]',
    array(
        'label'           	=> esc_html__( 'Hero Excerpt Length', 'blogification' ),
        'section'        	=> 'blogification_hero_section',
        'active_callback' 	=> 'blogification_is_hero_section_enable',
        'type'				=> 'number',
    )
);
