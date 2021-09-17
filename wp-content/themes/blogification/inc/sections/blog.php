<?php
/**
 * Blog section
 *
 * This is the template for the content of blog section
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */
if ( ! function_exists( 'blogification_add_blog_section' ) ) :
    /**
    * Add blog section
    *
    *@since  Blogification 1.0.0
    */
    function blogification_add_blog_section() {
        $options = blogification_get_theme_options();
        // Check if blog is enabled on frontpage
        $blog_enable = apply_filters( 'blogification_section_status', true, 'blog_section_enable' );

        if ( true !== $blog_enable ) {
            return false;
        }
        // Get blog section details
        $section_details = array();
        $section_details = apply_filters( 'blogification_filter_blog_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }
        // Render blog section now.
        blogification_render_blog_section( $section_details );
    }
endif;

if ( ! function_exists( 'blogification_get_blog_section_details' ) ) :
    /**
    * blog section details.
    *
    * @since  Blogification 1.0.0
    * @param array $input blog section details.
    */
    function blogification_get_blog_section_details( $input ) {
        $options = blogification_get_theme_options();

        // Content type.
        $blog_count = ! empty( $options['blog_count'] ) ? $options['blog_count'] : 3;
        
        
        $content = array();
        $cat_id = ! empty( $options['blog_content_category'] ) ? $options['blog_content_category'] : '';
        $args = array(
            'post_type'             => 'post',
            'posts_per_page'        => absint( $blog_count ),
            'cat'                   => absint( $cat_id ),
            'ignore_sticky_posts'   => true,
        );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
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
// blog section content details.
add_filter( 'blogification_filter_blog_section_details', 'blogification_get_blog_section_details' );


if ( ! function_exists( 'blogification_render_blog_section' ) ) :
  /**
   * Start blog section
   *
   * @return string blog content
   * @since  Blogification 1.0.0
   *
   */
   function blogification_render_blog_section( $content_details = array() ) {
        $options                = blogification_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>


        <div id="you-may-have-missed" class="grid-layout">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html($options['blog_title']); ?></h2>
            </div><!-- .section-header -->

            <span class="border-line"></span>

            <div class="section-content col-3 clear">
                <?php foreach ($content_details as $content):?>
                    <article class="has-post-thumbnail">
                        <div class="featured-image" style="background-image: url('<?php echo esc_url($content['image']);?>');">
                            <a href="<?php echo esc_url($content['image']);?>" class="post-thumbnail-link" title="<?php echo esc_html($content['title']);?>"></a>
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
                                <h2 class="entry-title"><a href="<?php echo esc_url($content['url']); ?>" tabindex="0"><?php echo esc_html($content['title']); ?></a></h2>
                            </header>

                            <?php if(!empty($options['blog_read_more_btn_label'])): ?>
                                <div class="read-story">
                                    <a href="<?php echo esc_url($content['url']);?>"><?php echo esc_html($options['blog_read_more_btn_label']); ?></a>
                                </div>
                            <?php endif; ?>
                        </div><!-- .entry-container -->
                    </article>
                <?php endforeach; ?>

            </div><!-- .section-content -->
        </div><!-- #you-may-have-missed -->  
      
<?php }
endif;  ?>