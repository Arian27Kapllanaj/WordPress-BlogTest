<?php
/**
 * Theme Palace options
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

/**
 * List of pages for page choices.
 * @return Array Array of page ids and name.
 */
function blogification_page_choices() {
    $pages = get_pages();
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'blogification' );
    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }
    return  $choices;
}

/**
 * List of posts for post choices.
 * @return Array Array of post ids and name.
 */
function blogification_post_choices() {
    $posts = get_posts( array( 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'blogification' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    wp_reset_postdata();
    return  $choices;
}


/**
 * List of category for category choices.
 * @return Array Array of post ids and name.
 */
function blogification_category_choices() {
    $tax_args = array(
        'hierarchical' => 0,
        'taxonomy'     => 'category',
    );
    $taxonomies = get_categories( $tax_args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'blogification' );
    foreach ( $taxonomies as $tax ) {
        $choices[ $tax->term_id ] = $tax->name;
    }
    return  $choices;
}


if ( ! function_exists( 'blogification_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function blogification_site_layout() {
        $blogification_site_layout = array(
            'wide'          => esc_url( get_template_directory_uri() . '/assets/images/full.png' ),
            'boxed-layout'  => esc_url( get_template_directory_uri() . '/assets/images/boxed.png' ),
        );

        $output = apply_filters( 'blogification_site_layout', $blogification_site_layout );
        return $output;
    }
endif;

if ( ! function_exists( 'blogification_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function blogification_selected_sidebar() {
        $blogification_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'blogification' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar 1', 'blogification' ),
            'optional-sidebar-2'    => esc_html__( 'Optional Sidebar 2', 'blogification' ),
        );

        $output = apply_filters( 'blogification_selected_sidebar', $blogification_selected_sidebar );

        return $output;
    }
endif;


if ( ! function_exists( 'blogification_global_sidebar_position' ) ) :
    /**
     * Global Sidebar position
     * @return array Global Sidebar positions
     */
    function blogification_global_sidebar_position() {
        $blogification_global_sidebar_position = array(
            'right-sidebar' => esc_url( get_template_directory_uri() . '/assets/images/right.png' ),
            'no-sidebar'    => esc_url( get_template_directory_uri() . '/assets/images/full.png' ),
        );

        $output = apply_filters( 'blogification_global_sidebar_position', $blogification_global_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'blogification_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function blogification_sidebar_position() {
        $blogification_sidebar_position = array(
            'right-sidebar'         => esc_url( get_template_directory_uri() . '/assets/images/right.png' ),
            'no-sidebar'            => esc_url( get_template_directory_uri() . '/assets/images/full.png' ),
        );

        $output = apply_filters( 'blogification_sidebar_position', $blogification_sidebar_position );

        return $output;
    }
endif;

if ( ! function_exists( 'blogification_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function blogification_pagination_options() {
        $blogification_pagination_options = array(
            'numeric'   => esc_html__( 'Numeric', 'blogification' ),
            'default'   => esc_html__( 'Default(Older/Newer)', 'blogification' ),
        );

        $output = apply_filters( 'blogification_pagination_options', $blogification_pagination_options );

        return $output;
    }
endif;


if ( ! function_exists( 'blogification_switch_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function blogification_switch_options() {
        $arr = array(
            'on'        => esc_html__( 'Enable', 'blogification' ),
            'off'       => esc_html__( 'Disable', 'blogification' )
        );
        return apply_filters( 'blogification_switch_options', $arr );
    }
endif;

if ( ! function_exists( 'blogification_hide_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function blogification_hide_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'blogification' ),
            'off'       => esc_html__( 'No', 'blogification' )
        );
        return apply_filters( 'blogification_hide_options', $arr );
    }
endif;
