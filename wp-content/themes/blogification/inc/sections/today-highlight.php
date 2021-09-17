<?php
/**
 * Features section
 *
 * This is the template for the content of today_highlight section
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */
if ( ! function_exists( 'blogification_add_today_highlight_section' ) ) :
    /**
    * Add today_highlight section
    *
    *@since  Blogification 1.0.0
    */
    function blogification_add_today_highlight_section() {
    	$options = blogification_get_theme_options();
        // Check if today_highlight is enabled on frontpage
        $today_highlight_enable = apply_filters( 'blogification_section_status', true, 'today_highlight_section_enable' );

        if ( true !== $today_highlight_enable ) {
            return false;
        }
        // Get today_highlight section details
        $section_details = array();
        $section_details = apply_filters( 'blogification_filter_today_highlight_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render today_highlight section now.
        blogification_render_today_highlight_section( $section_details );
    }
endif;

if ( ! function_exists( 'blogification_get_today_highlight_section_details' ) ) :
    /**
    * today_highlight section details.
    *
    * @since  Blogification 1.0.0
    * @param array $input today_highlight section details.
    */
    function blogification_get_today_highlight_section_details( $input ) {
        $options = blogification_get_theme_options();

        // Content type.
        $today_highlight_count = ! empty( $options['today_highlight_count'] ) ? $options['today_highlight_count'] : 3;
        
        $content = array();
       
        $cat_id = ! empty( $options['today_highlight_content_category'] ) ? $options['today_highlight_content_category'] : '';
        $args = array(
            'post_type'             => 'post',
            'posts_per_page'        => absint( $today_highlight_count ),
            'cat'                   => absint( $cat_id ),
            'ignore_sticky_posts'   => true,
        );                    
    
        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            $i = 0;
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_ID();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x450.jpg';

                // Push to the main array.
                array_push( $content, $page_post );
                $i++;
            endwhile;
        endif;
        wp_reset_postdata();
            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// today_highlight section content details.
add_filter( 'blogification_filter_today_highlight_section_details', 'blogification_get_today_highlight_section_details' );


if ( ! function_exists( 'blogification_render_today_highlight_section' ) ) :
  /**
   * Start today_highlight section
   *
   * @return string today_highlight content
   * @since  Blogification 1.0.0
   *
   */
   function blogification_render_today_highlight_section( $content_details = array() ) {
        $options = blogification_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
       
        <div id="todays-highlight" class="grid-layout">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html($options['today_highlight_title']); ?></h2>
            </div><!-- .section-header -->

            <span class="border-line"></span>

            <div class="section-content col-3 clear">
                <?php foreach ( $content_details as $content ) : ?>
                <article class="has-post-thumbnail">
                    <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] )?>');">
                        <a href="<?php echo esc_url( $content['url'] )?>" class="post-thumbnail-link" title="<?php echo esc_attr($content['title']);?>"></a>
                    </div><!-- .featured-image -->

                    <div class="entry-container">
                        <div class="entry-meta">
                            <span class="cat-links">
                                <ul class="post-categories">
                                    <?php the_category(' ', '',  $content['id']); ?>
                                </ul>
                            </span><!-- .cat-links -->
                        </div><!-- .entry-meta -->

                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] )?>"><?php echo esc_html( $content['title'] )?></a></h2>
                        </header>
                    
                        <?php if(!empty($options['today_highlight_btn_txt'])): ?>
                            <div class="read-story">
                                <a href="<?php echo esc_url( $content['url'] )?>"><?php echo esc_html($options['today_highlight_btn_txt']); ?></a>
                            </div>
                        <?php endif; ?>

                    </div><!-- .entry-container -->
                </article>

                <?php endforeach; ?>
            </div><!-- .section-content -->

        </div><!-- #todays-highlight -->

    <?php 
    }
endif;