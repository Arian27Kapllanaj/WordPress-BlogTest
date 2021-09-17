<?php
/**
 * Blog section
 *
 * This is the template for the content of recent_post section
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */
if ( ! function_exists( 'blogification_add_recent_post_section' ) ) :
    /**
    * Add recent_post section
    *
    *@since  Blogification 1.0.0
    */
    function blogification_add_recent_post_section() {
        $options = blogification_get_theme_options();
        // Check if recent_post is enabled on frontpage
        $recent_post_enable = apply_filters( 'blogification_section_status', true, 'recent_post_section_enable' );

        if ( true !== $recent_post_enable ) {
            return false;
        }
        // Get recent_post section details
        $section_details = array();
        $section_details = apply_filters( 'blogification_filter_recent_post_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }
        // Render recent_post section now.
        blogification_render_recent_post_section( $section_details );
    }
endif;

if ( ! function_exists( 'blogification_get_recent_post_section_details' ) ) :
    /**
    * recent_post section details.
    *
    * @since  Blogification 1.0.0
    * @param array $input recent_post section details.
    */
    function blogification_get_recent_post_section_details( $input ) {
        $options = blogification_get_theme_options();

        // Content type.
        $recent_post_count = ! empty( $options['recent_post_count'] ) ? $options['recent_post_count'] : 2;
        
        $content = array();

        $cat_id = ! empty( $options['recent_post_content_category'] ) ? $options['recent_post_content_category'] : '';
        $args = array(
            'post_type'             => 'post',
            'posts_per_page'        => absint( $recent_post_count ),
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
                $page_post['excerpt']   = blogification_trim_content( 30);
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
// recent_post section content details.
add_filter( 'blogification_filter_recent_post_section_details', 'blogification_get_recent_post_section_details' );


if ( ! function_exists( 'blogification_render_recent_post_section' ) ) :
  /**
   * Start recent_post section
   *
   * @return string recent_post content
   * @since  Blogification 1.0.0
   *
   */
   function blogification_render_recent_post_section( $content_details = array() ) {
        $options                = blogification_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="recent-posts" class="grid-layout">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html($options['recent_post_title']); ?></h2>
            </div><!-- .section-header -->

            <span class="border-line"></span>

            <?php foreach($content_details as $content) : ?>
                <article class="has-post-thumbnail">
                    <div class="featured-image" style="background-image: url('<?php echo esc_url($content['image']) ?>');">
                        <a href="<?php echo esc_url($content['url']) ?>" class="post-thumbnail-link" title="<?php echo esc_attr($content['title']); ?>"></a>
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
                            <h2 class="entry-title"><a href="<?php echo esc_url($content['url']);?>" tabindex="0"><?php echo esc_html($content['title']) ?></a></h2>
                        </header>

                        <div class="entry-content">
                            <p><?php echo wp_kses_post($content['excerpt']);?></p>
                        </div><!-- .entry-content -->

                        <?php if(!empty($options['recent_post_btn_txt'])): ?>
                            <div class="read-story">
                                <a href="<?php echo esc_url($content['url']);?>"><?php echo esc_html($options['recent_post_btn_txt']); ?></a>
                            </div>
                        <?php endif; ?>
                    </div><!-- .entry-container -->
                </article>

            <?php endforeach; ?>
        </div><!-- #recent-posts -->
   
    <?php }
endif;  ?>
