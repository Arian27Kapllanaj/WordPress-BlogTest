<?php
/**
 * Theme Palace widgets inclusion
 *
 * This is the template that includes all custom widgets of Legit News Pro
 *
 * @package Theme Palace
 * @subpackage Legit News Pro
 * @since Legit News Pro 1.0.0
 */

/*

/*
 * Add popular post widget
 */
require get_template_directory() . '/inc/widgets/recent-post-widget.php';
/*

/**
 * Register widgets
 */
function blogification_register_widgets() {

	register_widget( 'Blogification_Recent_Post' );

}
add_action( 'widgets_init', 'blogification_register_widgets' );