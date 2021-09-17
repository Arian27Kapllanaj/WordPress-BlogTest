<?php
/**
 * Must Read  section
 *
 * This is the template for the content of main_post section
 *
 * @package Theme Palace
 * @subpackage Blogification
 * @since Blogification 1.0.0
 */
if ( ! function_exists( 'blogification_add_main_post_section' ) ) :
    /**
    * Add main_post section
    *
    *@since Blogification 1.0.0
    */
    function blogification_add_main_post_section() { ?>



        <div id="popular-post-container">
            <section id="left-sidebar" class="content-area">
                <?php 
                $options = blogification_get_theme_options();
 
                add_action('blogification_main_post','blogification_add_editors_section'); 
                add_action('blogification_main_post','blogification_add_recent_post_section'); 

                do_action('blogification_main_post'); ?>

            
            </section><!-- #section -->

                <?php if(is_active_sidebar( 'main-section-sidebar' )) : ?>
                    <aside id="secondary" class="widget-area" role="complementary">
                        <?php  dynamic_sidebar( 'main-section-sidebar' ); ?>
                    </aside><!-- #secondary -->
                <?php endif ; ?>
        </div><!-- #primary -->
    <?php }

endif;