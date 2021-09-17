<?php
/**
 * Services section
 *
 * This is the template for the content of editors section
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */
if ( ! function_exists( 'blogification_add_editors_section' ) ) :
    /**
    * Add editors section
    *
    *@since  Blogification 1.0.0
    */
    function blogification_add_editors_section() {
    	$options = blogification_get_theme_options();
        // Check if editors is enabled on frontpage
        $editors_enable = apply_filters( 'blogification_section_status', true, 'editors_section_enable' );

        if ( true !== $editors_enable ) {
            return false;
        }
        // Get editors section details
        $section_details = array();
        $section_details = apply_filters( 'blogification_filter_editors_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render editors section now.
        blogification_render_editors_section( $section_details );
    }
endif;

if ( ! function_exists( 'blogification_get_editors_section_details' ) ) :
    /**
    * editors section details.
    *
    * @since  Blogification 1.0.0
    * @param array $input editors section details.
    */
    function blogification_get_editors_section_details( $input ) {
        $options = blogification_get_theme_options();

        // Content type.
        $editors_posts_count = ! empty( $options['editors_posts_count'] ) ? $options['editors_posts_count'] : 4;
        
        $content = array();
      
        $cat_id = ! empty( $options['editors_category'] ) ? $options['editors_category'] : '';
        $args = array(
            'post_type'             => 'post',
            'posts_per_page'        => absint( $editors_posts_count ),
            'cat'                   => absint( $cat_id ),
            'ignore_sticky_posts'   => true,
        );                    
        
        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['content']   = blogification_trim_content(20);
                $page_post['url']       = get_the_permalink();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x450.jpg';

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
// editors section content details.
add_filter( 'blogification_filter_editors_section_details', 'blogification_get_editors_section_details' );


if ( ! function_exists( 'blogification_render_editors_section' ) ) :
  /**
   * Start editors section
   *
   * @return string editors content
   * @since  Blogification 1.0.0
   *
   */
   function blogification_render_editors_section( $content_details = array() ) {
        $options    = blogification_get_theme_options();
        $editors_title      = isset($options['editors_section_title']) ? $options['editors_section_title']: '';

        if ( empty( $content_details ) ) {
            return;
        } ?>
        
        <div id="editors-picked" class="grid-layout">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html($editors_title); ?></h2>
            </div><!-- .section-header -->

            <span class="border-line"></span>

            <div class="section-content col-4 clear">
                <?php foreach ( $content_details as $i=>$content ) : ?>
                <article class="has-post-thumbnail">
                    <div class="featured-image" style="background-image: url('<?php echo esc_url($content['image']); ?>');">
                        <a href="<?php echo esc_url($content['url']); ?>" class="post-thumbnail-link" title="<?php echo esc_attr($content['title']);?>"></a>
                    </div><!-- .featured-image -->

                    <div class="entry-container">
                        <div class="entry-meta">
                            <span class="cat-links">
                                <ul class="post-categories">
                                    <?php the_category(' ', '', $content['id'])?>
                                </ul>
                            </span><!-- .cat-links -->

                        </div><!-- .entry-meta -->

                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php echo esc_url($content['url']); ?>"><?php echo esc_html($content['title']); ?></a></h2>
                        </header>

                        <?php if(!empty($options['editors_btn_txt'])): ?>
                            <div class="read-story">
                                <a href="<?php echo esc_url($content['url']);?>"><?php echo esc_html($options['editors_btn_txt']); ?></a>
                            </div>
                        <?php endif; ?>
                    </div><!-- .entry-container -->
                </article>
                <?php endforeach; ?>

            </div><!-- .section-content -->
        </div><!-- #editors-picked -->

    <?php
    }    
endif; ?>
