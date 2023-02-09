<?php get_header();?>
<?php $term = $wp_query->get_queried_object();?>


<?php

  if( $term->term_id == 51 ){

    global $wp_query;

    //$wp_query->set( 'post_type', array( 'resources' ) );
    //print_r( $term );

    echo "<!--";
    print_r( $wp_query );
    echo "-->";

  }


?>

<div class="container" style="padding-top: 35px; padding-bottom: 35px;">
  <div class="row">
    <div class="col-sm-8">
      <h1>Service Providers for: <?php echo $term->name;?></h1>
      <hr>
      <?php
      /*
      //Sort the posts alphabetically orderby Post Title
      $args = array(
        'orderby'=> 'title',
        'order' => 'ASC',
        'post_status' => 'publish',
        'tax_query' => array(
          array(
              'taxonomy' => 'locations',
              'field' => 'slug',
              'terms' => array( $term->name ),
              'operator' => 'IN'
          )
        ),
      );

      //$query = new WP_Query( $args );
      */

      if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="varta-cpt-entry">

          <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

          <?php $cp_type = get_post_type();
          if ( $cp_type == 'resources' ) {
            ?><p class="cp_type">Queery friendy service provider</p> <?php
            get_template_part("partials/content", "resource");
          }
          else {
            ?><p class="cp_type">COVID-19 Services</p>
            <p><i class="fa fa-map-marker"></i> <?php echo do_shortcode('[location_terms]'); ?></p>
            <p><i class="fa fa-users"></i> <?php echo do_shortcode('[orbit_terms taxonomy="communities"]'); ?></p>
            <!--div class="covid19-services"><i class="fa fa-briefcase"></i> <?php // echo do_shortcode('[orbit_terms taxonomy="covid19-services"]'); ?></div-->
            <?php
          }
          ?>

        </div>
      <?php endwhile; endif; ?>

        <!-- Pagination -->
        <?php
          global $wp_query;
          if( $wp_query->max_num_pages > 1 ){
            the_posts_pagination( array(
              'mid_size'  => 2,
              'prev_text' => __( 'Previous', 'textdomain' ),
              'next_text' => __( 'Next', 'textdomain' ),
            ) );
          }
        ?>
    </div>
    <div class="col-sm-4">
      <?php if( is_active_sidebar( 'single-resource-sidebar' ) ){
        dynamic_sidebar( 'single-resource-sidebar' );
      }?>
    </div>
  </div>
</div>
<?php get_footer();?>
