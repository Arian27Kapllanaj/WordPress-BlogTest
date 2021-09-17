<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

// Add archive section
$wp_customize->add_section( 'blogification_archive_section',
	array(
		'title'             => esc_html__( 'Blog/Archive','blogification' ),
		'description'       => esc_html__( 'Archive section options.', 'blogification' ),
		'panel'             => 'blogification_theme_options_panel',
	)
);

// Your latest posts title setting and control.
$wp_customize->add_setting( 'blogification_theme_options[your_latest_posts_title]',
	array(
		'default'           => $options['your_latest_posts_title'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 'blogification_theme_options[your_latest_posts_title]',
	array(
		'label'             => esc_html__( 'Your Latest Posts Title', 'blogification' ),
		'description'       => esc_html__( 'This option only works if Static Front Page is set to "Your latest posts."', 'blogification' ),
		'section'           => 'blogification_archive_section',
		'type'				=> 'text',
		'active_callback'   => 'blogification_is_latest_posts'
	)
);


// features content type control and setting
$wp_customize->add_setting( 'blogification_theme_options[blog_column]',
	array(
		'default'          	=> $options['blog_column'],
		'sanitize_callback' => 'blogification_sanitize_select',
	)
);

$wp_customize->add_control( 'blogification_theme_options[blog_column]',
	array(
		'label'             => esc_html__( 'Column Layout', 'blogification' ),
		'section'           => 'blogification_archive_section',
		'type'				=> 'select',
		'choices'			=> array( 
			'col-1'		=> esc_html__( 'One Column', 'blogification' ),
			'col-2'		=> esc_html__( 'Two Column', 'blogification' ),
			'col-3'		=> esc_html__( 'Three Column', 'blogification' ),
		),
	)
);

// read more text setting and control
$wp_customize->add_setting( 'blogification_theme_options[read_more_text]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> $options['read_more_text'],
	)
);

$wp_customize->add_control( 'blogification_theme_options[read_more_text]',
	array(
		'label'           	=> esc_html__( 'Read More Text Label', 'blogification' ),
		'section'        	=> 'blogification_archive_section',
		'type'				=> 'text',
	)
);

