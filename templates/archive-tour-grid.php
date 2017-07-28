<?php

/**
 * Template Name:Tour
 * 
 *
 * @package Texas Bike Tours
 * @since Texas Bike Tours 1.0
 */

get_header();

?>

<div id="primary-full" class="container-fluid content-area" >

  <main id="main" class="site-main" role="main">
    <div class="inner-wrap">

         <?php 
             
             //including page content before the loop
		          $page = get_page_by_path('tour'); //slug of desired page


      function buildSelect($tax){
      $terms = get_terms($tax);
      $x = '<select name="'. $tax .'">';
        $x .= '<option value="">Select '. ucfirst($tax) .'</option>';
        foreach ($terms as $term) {
        $x .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
        }
        $x .= '</select>';
      return $x;
      }


      
?>

      <div>
        <?php
        if( !empty( $page->post_content) ) {
        echo '<div id="tourserach2" class="container-fluid"><div id="customTours-gf" class="col-md-4"></div><div id="p_tours">' . apply_filters('the_content', $page->post_content) . '</div></div>';
              }
             
           ?>  

<div id="tourserach" class="archive-grid row">
        
        <?php

             // Start Tour page query
             $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

             query_posts( array( 'post_type' => 'tour', 'order_by' => 'meta_value&meta_key=date', 'order' => 'desc', 'paged' => $paged, 'posts_per_page' => 12)
             
             );
                while ( have_posts() ) : the_post(); 
                
                global $post;
                $tourID = $post->ID;
                
                ?>

              <!-- Tour Template html -->

              <div class="col-xs-12 col-sm-6 col-md-4 col-xl-3">
                <div class="card card-article">
                  <a 
                    href="<?php the_permalink(); ?>" 
                    title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>" 
                    class="card-img-top card-img-sizer" 
                    rel="bookmark"
                  >
                      <img class="card-img" src= "<?php the_post_thumbnail_url( 'tour_page' ); ?>"/>
                  </a>
                <div class="card-block">
                  <h4 class="card-title">
                    <a 
                      href="<?php the_permalink(); ?>" 
                      title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>" 
                      rel="bookmark"
                    >
                        <?php echo get_the_title( $tourID); ?>
                    </a>
                  </h4>
                  <div class="card-text"><?php the_excerpt(); ?></div>
                </div>
                <div class="card-footer p-0">
                  <a 
                    class="entry-read-more pull-right" 
                    title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'texas_bike_tours' ), the_title_attribute( 'echo=0' ) ) ); ?>"
                    href="<?php the_permalink(); ?>"
                  >
                    <i class="fa fa-chevron-circle-right"></i>
                  </a>
                </div>
              </div>
            </div>
        

            <?php endwhile; // end of the loop. ?>
              <!-- Add the pagination functions here. -->

              <?php // the_posts_navigation(); ?>

              <div class="col-12 mb-3 text-center">
                <?php if( get_previous_posts_link() ) : ?>
                  <span class="btn btn-secondary nav-next" style="padding-right:20px;">
                    <?php previous_posts_link( '&laquo; Previous'); ?>
                  </span>
                <?php endif; ?>
                <?php if( get_next_posts_link() ) : ?>
                  <span class="btn btn-secondary nav-previous">
                    <?php next_posts_link( 'Next &raquo;'); ?>
                  </span>
                <?php endif; ?>
              </div>

              </div> <!-- / serch end -->
              
        </div><!-- search -->

            </div><!-- inner-wrap -->
			</main><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_footer();?>