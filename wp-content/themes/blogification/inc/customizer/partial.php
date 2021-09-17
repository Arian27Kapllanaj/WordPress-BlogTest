<?php
/**
* Partial functions
*
* @package Theme Palace
* @subpackage  Blogification
* @since  Blogification 1.0.0
*/

// blog btn title
if ( ! function_exists( 'blogification_copyright_text_partial' ) ) :
    function blogification_copyright_text_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['copyright_text'] );
    }
endif;

// editors_btn_txt
if ( ! function_exists( 'blogification_editors_btn_txt_partial' ) ) :
    function blogification_editors_btn_txt_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['editors_btn_txt'] );
    }
endif;

//editors section title selective refresh
if ( ! function_exists( 'blogification_editors_section_title_partial' ) ) :
    function blogification_editors_section_title_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['editors_section_title'] );
    }
endif;

// blog_title selective refresh
if ( ! function_exists( 'blogification_blog_title_partial' ) ) :
    function blogification_blog_title_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['blog_title'] );
    }
endif;

// blog_read_more_btn_label selective refresh
if ( ! function_exists( 'blogification_blog_read_more_btn_label_partial' ) ) :
    function blogification_blog_read_more_btn_label_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['blog_read_more_btn_label'] );
    }
endif;

// hero_read_more selective refresh
if ( ! function_exists( 'blogification_hero_read_more_partial' ) ) :
    function blogification_hero_read_more_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['hero_read_more'] );
    }
endif;

// today_highlight_title selective refresh
if ( ! function_exists( 'blogification_today_highlight_title_partial' ) ) :
    function blogification_today_highlight_title_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['today_highlight_title'] );
    }
endif;

// today_highlight_btn_txt selective refresh
if ( ! function_exists( 'blogification_today_highlight_btn_txt_partial' ) ) :
    function blogification_today_highlight_btn_txt_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['today_highlight_btn_txt'] );
    }
endif;



// recent_post_title selective refresh
if ( ! function_exists( 'blogification_recent_post_title_partial' ) ) :
    function blogification_recent_post_title_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['recent_post_title'] );
    }
endif;

// recent_post_btn_txt selective refresh
if ( ! function_exists( 'blogification_recent_post_btn_txt_partial' ) ) :
    function blogification_recent_post_btn_txt_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['recent_post_btn_txt'] );
    }
endif;

// popular_post_btn_txt selective refresh
if ( ! function_exists( 'blogification_popular_post_btn_txt_partial' ) ) :
    function blogification_popular_post_btn_txt_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['popular_post_btn_txt'] );
    }
endif;


// most_viewed_title selective refresh
if ( ! function_exists( 'blogification_most_viewed_title_partial' ) ) :
    function blogification_most_viewed_title_partial() {
        $options = blogification_get_theme_options();
        return esc_html( $options['most_viewed_title'] );
    }
endif;
