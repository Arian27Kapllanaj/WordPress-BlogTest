<?php
/**
 * Hero section
 *
 * This is the template for the content of Hero section
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */
if ( ! function_exists( 'blogification_add_hero_section' ) ) :
    /**
    * Add Hero section
    *
    *@since  Blogification 1.0.0
    */
    function blogification_add_hero_section() {
        $options = blogification_get_theme_options();
        
        // Check if Hero is enabled on frontpage
        $hero_enable = apply_filters( 'blogification_section_status', true, 'hero_section_enable' );

        if ( true !== $hero_enable ) {
            return false;
        }

        // Get Hero section details
        $section_details = array();
        $section_details = apply_filters( 'blogification_filter_hero_section_details', $section_details );
        if ( empty( $section_details ) ) {
            return;
        }

        // Render Hero section now.
        blogification_render_hero_section( $section_details[0] );
    }
endif;

if ( ! function_exists( 'blogification_get_hero_section_details' ) ) :
    /**
    * Hero section details.
    *
    * @since  Blogification 1.0.0
    * @param array $input Hero section details.
    */
    function blogification_get_hero_section_details( $input ) {
        $options = blogification_get_theme_options();

        
        $content = array();
 
        $post_id = ! empty( $options['hero_content_post'] ) ? $options['hero_content_post'] : '';
        $args = array(
            'post_type'             => 'post',
            'p'                     => $post_id,
            'posts_per_page'        => 1,
            'ignore_sticky_posts'   => true,
        );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = blogification_trim_content( $options['hero_excerpt'] );
                $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : get_template_directory_uri().'/assets/uploads/no-featured-image-600x450.jpg';

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;

// Hero section content details.
add_filter( 'blogification_filter_hero_section_details', 'blogification_get_hero_section_details' );


if ( ! function_exists( 'blogification_render_hero_section' ) ) :
  /**
   * Start Hero section
   *
   * @return string Hero content
   * @since  Blogification 1.0.0
   *
   */
   function blogification_render_hero_section( $content_details = array() ) {
        $options    = blogification_get_theme_options();
        $hero_read_more  = $options['hero_read_more'];

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="hero-posts">
            <div id="primary" class="content-area">
                <div id="main-posts" class="relative">
                    <div class="section-content clear">
                        <div class="full-width grid-layout">
                            <article class="has-post-thumbnail">
                                <div class="featured-image" style="background-image: url('<?php echo esc_url($content_details['image']); ?>');">
                                    <a href="<?php echo esc_url($content_details['url']); ?>" class="post-thumbnail-link" title="<?php echo esc_attr($content_details['title']); ?>"></a>
                                </div><!-- .featured-image -->

                                <div class="entry-container">
                                    <div class="entry-meta">
                                        <span class="cat-links">
                                            <ul class="post-categories">
                                                <?php the_category(', ', '',  $content_details['id']); ?>
                                            </ul>
                                        </span><!-- .cat-links -->
                                    </div><!-- .entry-meta -->

                                    <header class="entry-header">
                                        <h2 class="entry-title"><?php echo esc_html($content_details['title']); ?></h2>
                                    </header>

                                    <div class="entry-content">
                                        <p><?php echo wp_kses_post($content_details['excerpt']); ?></p>
                                    </div><!-- .entry-content -->


                                    <?php if ( !empty( $hero_read_more ) ): ?>
                                        <div class="read-more">
                                            <a href="<?php echo esc_url($content_details['url']); ?>" class="btn"><?php echo esc_html($hero_read_more); ?></a>
                                        </div>
                                    <?php endif; ?>

                                </div><!-- .entry-container -->
                            </article>
                        </div><!-- .full-width -->
                    </div><!-- .section-content -->
                </div><!-- main-posts -->
            </div><!-- #primary -->

            <?php if(is_active_sidebar( 'hero-section-sidebar' )) : ?>
                <aside id="secondary" class="widget-area" role="complementary">
                    <?php  dynamic_sidebar( 'hero-section-sidebar' ); ?>
                </aside><!-- #secondary -->
            <?php endif ; ?>
        </div><!-- #hero-post -->
     
    <?php }
endif;