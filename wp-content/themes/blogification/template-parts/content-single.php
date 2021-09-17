<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */
$options = blogification_get_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear has-post-thumbnail' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured-image">
			<a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url( 'post-thumbnail' ) ?>" alt="<?php the_title_attribute(); ?>"></a>
		</div><!-- .featured-image -->
	<?php endif; ?>

	<div class="entry-container">
		<?php blogification_single_categories(); ?>

		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'blogification' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogification' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>


	<div class="entry-meta">
		<?php if(! $options['single_post_hide_author']):
			echo blogification_author();
		endif; 
		if (! $options['single_post_hide_date'] ) :
			blogification_posted_on();
		endif; 

		blogification_entry_footer(); ?>
	</div>

</article><!-- #post-## -->
