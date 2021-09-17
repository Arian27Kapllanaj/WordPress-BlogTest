<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

$options = blogification_get_theme_options();  


if ( ! function_exists( 'blogification_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since  Blogification 1.0.0
	 */
	function blogification_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;
add_action( 'blogification_doctype', 'blogification_doctype', 10 );


if ( ! function_exists( 'blogification_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since  Blogification 1.0.0
	 *
	 */
	function blogification_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
		<?php endif;
	}
endif;
add_action( 'blogification_before_wp_head', 'blogification_head', 10 );

if ( ! function_exists( 'blogification_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since  Blogification 1.0.0
	 *
	 */
	function blogification_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blogification' ); ?></a>

		<?php
	}
endif;
add_action( 'blogification_page_start_action', 'blogification_page_start', 10 );

if ( ! function_exists( 'blogification_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since  Blogification 1.0.0
	 *
	 */
	function blogification_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'blogification_page_end_action', 'blogification_page_end', 10 );

if ( ! function_exists( 'blogification_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since  Blogification 1.0.0
	 *
	 */
	function blogification_site_branding() {
		$options  = blogification_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];	?>

		<div class="menu-overlay"></div>
			<header id="masthead" class="site-header" role="banner">
				<div class="site-branding-container">
					<div class="wrapper">
						<div class="site-branding">
							<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) ) && has_custom_logo()  ) : ?>
								<div class="site-logo">
									<?php the_custom_logo(); ?>
								</div>
							<?php endif; 
	
							if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
								<div id="site-identity">
									<?php
									if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) {
										if ( blogification_is_latest_posts() ) : ?>
											<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
										<?php else : ?>
											<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
										<?php
										endif;
									} 
									if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
										$description = get_bloginfo( 'description', 'display' );
										if ( $description || is_customize_preview() ) : ?>
											<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
										<?php
										endif; 
									}?>
								</div>
							<?php endif; ?>
						</div><!-- .site-branding -->
	
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" title="<?php esc_attr_e('Primary Menu', 'blogification'); ?>">
							<?php
							echo blogification_get_svg( array( 'icon' => 'menu', 'class' => 'icon-menu' ) );
							echo blogification_get_svg( array( 'icon' => 'close', 'class' => 'icon-menu' ) );
							?>	
							<span class="menu-label"><?php esc_html_e('Menu', 'blogification')?></span>		
						</button>

						<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
							<?php  
								wp_nav_menu( 
									array(
									'theme_location' => 'primary',
									'container' => 'div',
									'menu_class' => 'menu nav-menu',
									'menu_id' => 'primary-menu',
									'echo' => true,
									'fallback_cb' => 'blogification_menu_fallback_cb',
									'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									)
								);
							?>
						</nav><!-- #site-navigation -->

						<?php 
						$search_html= null;
						if(has_nav_menu( 'social' )):
							if($options['search_icon_in_social_menu_enable']){
								$search_html = sprintf(
												'<li class="search-menu"><a href="#" title="%1$s">%2$s%3$s</a><div id="search">%4$s</div>',
												esc_attr__('Search','blogification'),
												blogification_get_svg( array( 'icon' => 'search' ) ), 
												blogification_get_svg( array( 'icon' => 'close' ) ), 
												get_search_form( $echo = false )
											);
								
							}else{
								$search_html = '';
							}
							wp_nav_menu(  array(
								'theme_location' => 'social',
								'container' => 'div',
								'container_class' => 'social-icons',
								'echo' => true,
								'depth' => 1,
								'link_before' => '<span class="screen-reader-text">',
								'link_after' => '</span>',
								'items_wrap' => '<ul id="%1$s" class="%2$s">'.$search_html.'%3$s</ul>',
								'fallback_cb' => false,
							) );
							
						endif; ?>
					</div><!-- .wrapper -->
				</div>
			</header><!-- .header-->
		</div><!-- .header-menu -->
<?php 
	}
endif;
add_action( 'blogification_header_action', 'blogification_site_branding', 10 );

if ( ! function_exists( 'blogification_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since  Blogification 1.0.0
	 *
	 */
	function blogification_content_start() {
		?>
		<div id="content" class="site-content">
			<div class="wrapper">
		<?php
	}
endif;
add_action( 'blogification_content_start_action', 'blogification_content_start', 10 );

if ( ! function_exists( 'blogification_header_image' ) ) :
    /**
     * Header Image codes
     *
     * @since  Blogification 1.0.0
     *
     */
    function blogification_header_image() {
        if ( blogification_is_frontpage() )
            return;
        $header_image = get_header_image();
        ?>

        <div id="page-site-header" class="relative" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
                <header class="page-header">
                    <?php blogification_custom_header_banner_title(); ?>
                </header>
                <?php blogification_add_breadcrumb(); ?>
            </div>
        </div><!-- #page-site-header -->

        <?php
    }
endif;
add_action( 'blogification_header_image_action', 'blogification_header_image', 10 );

if ( ! function_exists( 'blogification_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since  Blogification 1.0.0
	 */
	function blogification_add_breadcrumb() {
		$options = blogification_get_theme_options();

		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		
		// Bail if Home Page.
		if ( blogification_is_frontpage() ) {
			return;
		}

		echo '<div id="breadcrumb-list" >';
				/**
				 * blogification_simple_breadcrumb hook
				 *
				 * @hooked blogification_simple_breadcrumb -  10
				 *
				 */
				do_action( 'blogification_simple_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
	}
endif;

if ( ! function_exists( 'blogification_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since  Blogification 1.0.0
	 *
	 */
	function blogification_content_end() {
		?>
			</div><!-- #wrapper -->
        </div><!-- #content -->
		<?php
	}
endif;
add_action( 'blogification_content_end_action', 'blogification_content_end', 10 );

if ( ! function_exists( 'blogification_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  Blogification 1.0.0
	 *
	 */
	function blogification_footer_start() {
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
	}
endif;
add_action( 'blogification_footer', 'blogification_footer_start', 10 );

if ( ! function_exists( 'blogification_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  Blogification 1.0.0
	 *
	 */
	function blogification_footer_site_info() {
		$options = blogification_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );

		$copyright_text = $options['copyright_text'];
		?>
		<div class="site-info">
			<div class="wrapper">
				<span>
				<?php 
					echo blogification_santize_allow_tag( $copyright_text ); 
					if ( function_exists( 'the_privacy_policy_link' ) ) {
						the_privacy_policy_link( ' | ' );
					}
				?>
				</span>
			</div><!-- .wrapper -->    
		</div><!-- .site-info -->
		</footer>
		<?php
	}
endif;
add_action( 'blogification_footer', 'blogification_footer_site_info', 40 );

if ( ! function_exists( 'blogification_footer_scroll_to_top' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  Blogification 1.0.0
	 *
	 */
	function blogification_footer_scroll_to_top() {
		$options  = blogification_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop"><?php echo blogification_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php endif;
	}
endif;
add_action( 'blogification_footer', 'blogification_footer_scroll_to_top', 40 );

