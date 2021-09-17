<?php
/**
 * Recent Posts Widget
 *
 * @package Theme Palace
 * @subpackage Blogification
 * @since Blogification 1.0.0
 */

if ( ! class_exists( 'Blogification_Recent_Post' ) ) :

     
    class Blogification_Recent_Post extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public $default_title   = '';

        public function __construct() {
            $tp_widget_recent_post = array(
                'description' => esc_html__( 'Retrive Recent posts.', 'blogification' ),
            );
            $this->default_title = __( 'Top Posts &amp; Pages', 'blogification' );

            parent::__construct( 'widget_trending_posts', esc_html__( 'TP : Recent Posts', 'blogification' ), $tp_widget_recent_post );
        }



        function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
    
            if ( false === $instance['title'] ) {
                $instance['title'] = $this->default_title;
            }
            $title = stripslashes( $instance['title'] );
            $ordering = isset( $instance['ordering'] ) && array('name', 'date') ?  $instance['ordering'] : 'date' ;
    
            $count = isset( $instance['count'] ) ? (int) $instance['count'] : 10;
            if ( $count < 1 || 10 < $count ) {
                $count = 10;
            }

            $allowed_post_types = ['post', 'page', 'category'];
            $tp_category        = isset( $instance['category'] ) ? absint( $instance['category'] ) : '';
            $types              = isset( $instance['types'] ) ? (array) $instance['types'] : 'post';
    
    
            if ( isset( $instance['display'] ) && in_array( $instance['display'], array( 'widget_most_read_posts', 'widget_recent_news', 'widget_trending_posts' ) ) ) {
                $display = $instance['display'];
            } else {
                $display = 'widget_most_read_posts';
            }
    
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'blogification' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
    
            <p>
                <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php esc_html_e( 'Maximum number of posts to show (no more than 10):', 'blogification' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="number" value="<?php echo (int) $count; ?>" min="1" max="10" />
            </p>
            <hr>
            <p>
                <label for="<?php echo $this->get_field_id( 'types' ); ?>"><?php esc_html_e( 'Types of content to display:', 'blogification' ); ?></label>
                <ul>
                    <?php
                    foreach ( $allowed_post_types as $key=>$type ) {
    
                        $checked = '';
                        if ( in_array( $type, $types ) ) {
                            $checked = 'checked="checked" ';
                        }
                        ?>
    
                        <li><label>
                            <input value="<?php echo esc_attr( $type ); ?>" name="<?php echo $this->get_field_name( 'types' ); ?>" type="radio" <?php echo $checked; ?> />
                            <?php echo esc_html( ucfirst($type) ); ?>
                        </label></li>
    
                    <?php } // End foreach ?>
                </ul>
            </p>
                <p id="select-category">
                    <label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Select the category to show posts:', 'blogification' ); ?></label>
                    <select id="<?php echo esc_attr( $this->get_field_id('category') ); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat" style="width:100%;">

                        <?php 
                        $categories = blogification_category_choices();
                        foreach($categories as $category => $value) { ?>
                        <option value="<?php echo absint( $category ); ?>" <?php selected( $tp_category, $category ); ?>><?php echo esc_html( $value ); ?></option>
                        <?php } ?>      
                    </select>
                </p>
            <hr>
            <p>
                <label><?php esc_html_e( 'Display as:', 'blogification' ); ?></label>
                <ul>
                    <li>
                        <label>
                            <input id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" type="radio" value="widget_recent_news" <?php checked( 'widget_recent_news', $display ); ?> /> 
                            <?php esc_html_e( 'Design 1', 'blogification' ); ?>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" type="radio" value="widget_most_read_posts" <?php checked( 'widget_most_read_posts', $display ); ?> />
                             <?php esc_html_e( 'Design 2', 'blogification' ); ?>
                            </label>
                        </li>
                    <li>
                        <label>
                            <input id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" type="radio" value="widget_trending_posts" <?php checked( 'widget_trending_posts', $display ); ?> /> 
                            <?php esc_html_e( 'Design 3', 'blogification' ); ?>
                        </label>
                    </li>
                </ul>
            </p>
            <hr>
            <p>
                <label><?php esc_html_e( 'Sort By:', 'blogification' ); ?></label>
                <ul>
                    <li>
                        <label>
                            <input id="<?php echo $this->get_field_id( 'ordering' ); ?>" name="<?php echo $this->get_field_name( 'ordering' ); ?>" type="radio" value="date" <?php checked( 'date', $ordering ); ?> /> 
                            <?php esc_html_e( 'Published Date', 'blogification' ); ?>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input id="<?php echo $this->get_field_id( 'ordering' ); ?>" name="<?php echo $this->get_field_name( 'ordering' ); ?>" type="radio" value="name" <?php checked( 'name', $ordering ); ?> /> 
                            <?php esc_html_e( 'Alphabetical ', 'blogification' ); ?>
                        </label>
                    </li>
                </ul>
            </p>
            <?php
    
        }

        function widget( $args, $instance ) {
    
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
    
            $title = isset( $instance['title'] ) ? $instance['title'] : false;
            if ( false === $title ) {
                $title = $this->default_title;
            }
            /** This filter is documented in core/src/wp-includes/default-widgets.php */
            $title = apply_filters( 'widget_title', $title );

            $count = isset( $instance['count'] ) ? (int) $instance['count'] : false;
            if ( $count < 1 || 10 < $count ) {
                $count = 5;
            }
            $ordering = isset( $instance['ordering'] ) && array('name', 'date') ?  $instance['ordering'] : 'date' ;
            $category = isset( $instance['category'] ) ? (int) $instance['category'] : 0;

            /**
             * Control the number of displayed posts.
             *
             * @module widgets
             *
             * @since 3.3.0
             *
             * @param string $count Number of Posts displayed in the Top Posts widget. Default is 10.
             */
    
            $types = isset( $instance['types'] ) ? (array) $instance['types'] : array( 'post', 'page', 'category' );

    
            if ( isset( $instance['display'] ) && in_array( $instance['display'], array( 'widget_most_read_posts', 'widget_recent_news', 'widget_trending_posts' ) ) ) {
                $display = $instance['display'];
             } else {
                $display = 'widget_most_read_posts';
            }
 
            echo $args['before_widget'];
            if ( ! empty( $title ) ) {
                echo "<div class='widget-header'>". $args['before_title'] . $title . $args['after_title'] . "</div>";
            } 
            $post_args = array(
                'numberposts' => $count,
                'post_type'   => $types,
                'category'    => 0,
                'orderby'     => $ordering,
                'order'       => 'ASC',
              );           

              if( $category != '0' && in_array('category', $types) ){
                $post_args = array(
                    'numberposts' => $count,
                    'post_type'   => 'post',
                    'category'    => (array) $category,
                    'orderby'     => $ordering,
                    'order'       => 'ASC',
                );           
            }  
              $posts = get_posts( $post_args ); ?>
                <?php if($display == "widget_trending_posts") :
                    $first_post = array_shift($posts); ?>
                    <article class="has-post-thumbnail widget_trending_posts">
                        <div class="featured-image" style="background-image: url('<?php echo has_post_thumbnail( $first_post->ID ) ? get_the_post_thumbnail_url( $first_post->ID, 'post-thumbnail') : get_template_directory_uri() .'/assets/uploads/no-featured-image-150x150.jpg'; ?>');">
                            <a href="<?php echo esc_url( get_permalink( $first_post->ID ) ); ?>" class="post-thumbnail-link" title="<?php echo esc_attr($first_post->post_title); ?>"></a>
                        </div><!-- .featured-image -->

                        <div class="entry-container">
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php echo esc_url( get_permalink($first_post->ID) );?>"><?php echo $first_post->post_title; ?></a></h2>
                            </header>
                            <div class="read-story">
                                <a href="<?php echo esc_url( get_permalink($first_post->ID) );?>"><?php esc_html_e('Read Story', 'blogification'); ?></a>
                            </div>
                        </div>
                    </article>
                <?php endif; ?>

                <ul class="<?php echo $instance['display']; ?>">
                    <?php foreach($posts as $index=>$post) : ?>
                        <li>
                            <?php if($display == "widget_most_read_posts") :?>
                                <div class="post-number">
                                    <span><?php echo sprintf("%02d", absint( $index+1 ));; ?></span>
                                </div>
                            <?php else: ?>
                                <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
                                    <img src="<?php echo has_post_thumbnail( $post->ID ) ? get_the_post_thumbnail_url( $post->ID, 'thumbnail') : get_template_directory_uri() .'/assets/uploads/no-featured-image-150x150.jpg'; ?>" alt="<?php echo esc_attr($post->post_title); ?>">
                                </a>
                            <?php endif; ?>

                            <div class="entry-container">
                                <div class="entry-meta">
                                    <span class="cat-links">
                                        <ul class="post-categories">
                                            <?php the_category(' ', '', $post->ID); ?>
                                        </ul>
                                    </span><!-- .cat-links -->
                                </div><!-- .entry-meta -->

                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( get_permalink($post->ID) );?>"><?php echo $post->post_title; ?></a></h2>
                                </header>
                                <div class="read-story">
                                    <a href="<?php echo esc_url( get_permalink($post->ID) );?>"><?php esc_html_e('Read Story', 'blogification'); ?></a>
                                </div>
                            </div><!-- .entry-container -->
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php wp_reset_postdata(); ?>

            <?php echo $args['after_widget'];
        }
    
     
        function update( $new_instance, $old_instance ) {
            // processes widget options to be saved
            $instance          = array();
            $instance['title'] = wp_kses( $new_instance['title'], array() );
            if ( $instance['title'] === $this->default_title ) {
                $instance['title'] = false; // Store as false in case of language change
            }
    
            $instance['count'] = (int) $new_instance['count'];
            if ( $instance['count'] < 1 || 10 < $instance['count'] ) {
                $instance['count'] = 10;
            }

            if ( isset( $new_instance['ordering'] ) && in_array( $new_instance['ordering'], array( 'date', 'name' ) ) ) {
                $instance['ordering'] =  $new_instance['ordering'];
            }else{
                $instance['ordering'] =  'date';
            }
            $instance['category'] = blogification_sanitize_single_category( $new_instance['category'] );
    
            $allowed_post_types =  get_post_types( array( 'public' => true ) );
            unset( $allowed_post_types['attachment'] );
            $allowed_post_types = array_values( $allowed_post_types );
            $instance['types']  = $new_instance['types'];
            foreach ( $new_instance['types'] as $key => $type ) {
                if ( ! in_array( $type, $allowed_post_types ) ) {
                    unset( $new_instance['types'][ $key ] );
                }
            }
            if ( isset( $new_instance['display'] ) && in_array( $new_instance['display'], array( 'widget_most_read_posts', 'widget_recent_news', 'widget_trending_posts' ) ) ) {
                $instance['display'] = $new_instance['display'];
            } else {
                $instance['display'] = 'widget_most_read_posts';
            }
            return $instance;
        } 
         
        public static function defaults() {
            return array(
                'title'    => esc_html__( 'Widget Title ', 'blogification' ),
                'count'    => absint( 4 ),
                'types'    => 'post',
                'ordering' => 'date',
                'display'  => 'widget_most_read_posts',
                'category'  => '0',

            );
        }
    
    }
endif;

function blogification_recent_post_script_enqueue( $hook ) {
	wp_enqueue_script( 'blogification-metabox', get_template_directory_uri() . '/assets/js/metabox'. blogification_min() .'.js', array( 'jquery', 'jquery-ui-tabs' ), '20151215', true );
  
  }
  add_action( 'admin_enqueue_scripts', 'blogification_recent_post_script_enqueue' );