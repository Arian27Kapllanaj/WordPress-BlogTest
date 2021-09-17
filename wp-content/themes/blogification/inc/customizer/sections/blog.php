<?php
/**
 * Blog Section options
 *
 * @package Theme Palace
 * @subpackage Blogification
 * @since Blogification 1.0.0
 */

// Add Blog section
$wp_customize->add_section( 'blogification_blog_section',
    array(
        'title'             => esc_html__( 'Blog','blogification' ),
        'description'       => esc_html__( 'Blog Section options.', 'blogification' ),
        'panel'             => 'blogification_front_page_panel',
    )
);

// Blog content enable control and setting
$wp_customize->add_setting( 'blogification_theme_options[blog_section_enable]',
    array(
        'default'           =>  $options['blog_section_enable'],
        'sanitize_callback' => 'blogification_sanitize_switch_control',
    )
);

$wp_customize->add_control( new Blogification_Switch_Control( $wp_customize, 'blogification_theme_options[blog_section_enable]',
    array(
        'label'             => esc_html__( 'Blog Section Enable', 'blogification' ),
        'section'           => 'blogification_blog_section',
        'on_off_label'      => blogification_switch_options(),
    ) 
) );

// blog title setting and control
$wp_customize->add_setting( 'blogification_theme_options[blog_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => $options['blog_title'],
        'transport'         => 'postMessage',
    )
);

$wp_customize->add_control( 'blogification_theme_options[blog_title]',
    array(
        'label'             => esc_html__( 'Section Title', 'blogification' ),
        'section'           => 'blogification_blog_section',
        'active_callback'   => 'blogification_is_blog_section_enable',
        'type'              => 'text',
    ) 
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blogification_theme_options[blog_title]',
        array(
            'selector'            => '#you-may-have-missed div.section-header h2',
            'settings'            => 'blogification_theme_options[blog_title]',
            'fallback_refresh'    => true,
            'container_inclusive' => false,
            'render_callback'     => 'blogification_blog_title_partial',
        ) 
    );
}

// Add dropdown category setting and control.
$wp_customize->add_setting(  'blogification_theme_options[blog_content_category]',
    array(
        'sanitize_callback' => 'blogification_sanitize_single_category',
    )
) ;

$wp_customize->add_control( new Blogification_Dropdown_Taxonomies_Control( $wp_customize,
    'blogification_theme_options[blog_content_category]',
        array(
            'label'             => esc_html__( 'Select Category', 'blogification' ),
            'description'       => esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'blogification' ),
            'section'           => 'blogification_blog_section',
            'type'              => 'dropdown-taxonomies',
            'active_callback'   => 'blogification_is_blog_section_enable'
        ) 
    )
);

// Blog content setting
$wp_customize->add_setting('blogification_theme_options[blog_read_more_btn_label]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['blog_read_more_btn_label']

    )
);

$wp_customize->add_control('blogification_theme_options[blog_read_more_btn_label]',
    array(
        'section'			=> 'blogification_blog_section',
        'label'				=> esc_html__( 'Read More Button Label', 'blogification' ),
        'type'          	=>'text',
        'active_callback'	=> 'blogification_is_blog_section_enable'
    )
);


// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blogification_theme_options[blog_read_more_btn_label]',
        array(
            'selector'            => '#you-may-have-missed div.read-story a',
            'settings'            => 'blogification_theme_options[blog_read_more_btn_label]',
            'fallback_refresh'    => true,
            'container_inclusive' => false,
            'render_callback'     => 'blogification_blog_read_more_btn_label_partial',
        ) 
    );
}
