<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 * @return array An array of default values
 */

function blogification_get_default_theme_options() {
	$theme_data = wp_get_theme();
	$blogification_default_options = array(
		// Color Options
		'header_title_color'			    => '#000',
		'header_tagline_color'			    => '#000',
		'header_txt_logo_extra'			    => 'show-all',

		// breadcrumb
		'breadcrumb_enable'				    => (bool) true,
		'breadcrumb_separator'			    => '/',
				
		// homepage options
		'enable_frontpage_content' 			=> false,

		// layout 
		'site_layout'         			    => 'wide',
		'sidebar_position'         		    => 'right-sidebar',
		'post_sidebar_position' 		    => 'right-sidebar',
		'page_sidebar_position' 		    => 'right-sidebar',
		'search_icon_in_social_menu_enable'	=> (bool) true,

		// excerpt options
		'long_excerpt_length'               => 25,
		'read_more_text'           		    => esc_html__( 'Read More', 'blogification' ),

		// pagination options
		'pagination_enable'         	    => (bool) true,
		'pagination_type'         		    => 'default',

		// footer options
		'copyright_text'           		    => sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s. ', '1: Year, 2: Site Title with home URL', 'blogification' ), '[the-year]', '[site-link]' ) . esc_html__( 'All Rights Reserved | ', 'blogification' ) . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'blogification' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( ucwords( $theme_data->get( 'Author' ) ) ) .'</a>',
		'scroll_top_visible'        	    => (bool) true,

		// reset options
		'reset_options'      			    => (bool) false,
		
		// homepage sections sortable
		'sortable' 						    => 'hero,today_highlight,main_post,blog',

		// blog/archive options
		'your_latest_posts_title' 		    => esc_html__( 'Blogs', 'blogification' ),
		'blog_column'						=> 'col-2',


		// single post theme options
		'single_post_hide_date' 		    => (bool) false,
		'single_post_hide_author'		    => (bool) false,
		'single_post_hide_category'		    => (bool) false,
		'single_post_hide_tags'			    => (bool) false,

		/* Front Page */
		'main_post_section_enable' 		=> true,

		//hero
		'hero_section_enable' 					=> false,
		'hero_read_more'						=>	esc_html__('Read More', 'blogification'),
		'hero_excerpt'							=> 30,

		// today_highlight
		'today_highlight_section_enable'		=> (bool) false,
		'today_highlight_count'					=> 3,
		'today_highlight_title'					=> esc_html__( 'Today\'s Highlights', 'blogification' ),
		'today_highlight_btn_txt'               => esc_html__('Read Story','blogification'),
		
		//popular_post 
		'popular_post_section_enable'		   => (bool) false,
		'popular_post_section_title'		   => esc_html__( 'Popular Posts', 'blogification' ),
		'popular_post_count'				   => 4,
		'popular_post_btn_txt'                 => esc_html__('Read More','blogification'),
		
		//recent_post 
		'recent_post_section_enable'		   => (bool) false,
		'recent_post_content_type'			   => 'post',
		'recent_post_count'					   => 3,
		'recent_post_title'					   => esc_html__( 'Recent\'s Article', 'blogification' ),
		'recent_post_btn_txt'                  => esc_html__('Read Story','blogification'),
		
		//editors
		'editors_section_enable'		    => (bool) false,
		'editors_posts_count'			    => 4,
		'editors_section_title'			    => esc_html__( 'Editor\'s Picked', 'blogification' ),
		'editors_btn_txt'                   => esc_html__('Read More','blogification'),

		// blog
		'blog_section_enable'			    => (bool) false,
		'blog_title'					    => esc_html__( 'You May Have Missed', 'blogification' ),
		'blog_count'					    => 3,
		'blog_read_more_btn_label'	 	    => esc_html__( 'Read More', 'blogification' ),
	
	);

	$output = apply_filters( 'blogification_default_theme_options', $blogification_default_options );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}