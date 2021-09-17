<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage  Blogification
	 * @since  Blogification 1.0.0
	 */

	/**
	 * blogification_doctype hook
	 *
	 * @hooked blogification_doctype -  10
	 *
	 */
	do_action( 'blogification_doctype' );

?>
<head>
<?php
	/**
	 * blogification_before_wp_head hook
	 *
	 * @hooked blogification_head -  10
	 *
	 */
	do_action( 'blogification_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>
<?php
	/**
	 * blogification_page_start_action hook
	 *
	 * @hooked blogification_page_start -  10
	 *
	 */
	do_action( 'blogification_page_start_action' ); 

	/**
	 * blogification_loader_action hook
	 *
	 * @hooked blogification_loader -  10
	 *
	 */
	do_action( 'blogification_before_header' );

	/**
	 * blogification_header_action hook
	 *
	 * @hooked blogification_site_branding -  10
	 * @hooked blogification_header_start -  20
	 * @hooked blogification_site_navigation -  30
	 * @hooked blogification_header_end -  50
	 *
	 */
	do_action( 'blogification_header_action' );

	/**
	 * blogification_content_start_action hook
	 *
	 * @hooked blogification_content_start -  10
	 *
	 */
	do_action( 'blogification_content_start_action' );

    /**
     * blogification_header_image_action hook
     *
     * @hooked blogification_header_image -  10
     *
     */
    if(has_header_image()) do_action( 'blogification_header_image_action' );
	
