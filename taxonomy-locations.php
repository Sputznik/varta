<?php get_header();?>
<?php $term = $wp_query->get_queried_object();?>
<div class="container" style="padding-top: 35px; padding-bottom: 35px;">
  <div class="row">
    <div class="col-sm-8">
      <h1>Service Providers for: <?php echo $term->name;?></h1>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        <?php get_template_part("partials/content", "resource");?>
        <?php endwhile; endif; ?>
        <!-- Pagination -->
        <?php
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
