<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

/**
 * blogification_footer_primary_content hook
 *
 * @hooked blogification_add_subscribe_section -  10
 *
 */
do_action( 'blogification_footer_primary_content' );

/**
 * blogification_content_end_action hook
 *
 * @hooked blogification_content_end -  10
 *
 */
do_action( 'blogification_content_end_action' );

/**
 * blogification_content_end_action hook
 *
 * @hooked blogification_footer_start -  10
 * @hooked  Blogification_Footer_Widgets->add_footer_widgets -  20
 * @hooked blogification_footer_site_info -  40
 * @hooked blogification_footer_end -  100
 *
 */
do_action( 'blogification_footer' );

/**
 * blogification_page_end_action hook
 *
 * @hooked blogification_page_end -  10
 *
 */
do_action( 'blogification_page_end_action' ); 

?>

<?php wp_footer(); ?>

</body>
</html>
