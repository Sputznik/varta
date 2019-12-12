<?php get_header();?>
<?php $term = $wp_query->get_queried_object();?>
<div class="container" style="padding-top: 35px; padding-bottom: 35px;">
  <div class="row">
    <div class="col-sm-8">
      <h1 class="text-center" style="text-transform: capitalize;margin-bottom: 30px;">
        <?php if( $term != null ): ?>
          Tagged Under: <?php echo $term->name; ?>
        <?php else: ?>
          Tagged Under: <?php echo single_month_title(' '); ?>
        <?php endif;?>
      </h1>
      <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
        <div class="orbit-content">
        	<h2 class='orbit-title'><a href='<?php the_permalink();?>'><?php the_title();?></a></h2>
        	<p style="color: grey;"><?php the_time( 'F jS Y' );?></p>
        	<div class='orbit-excerpt'><?php the_excerpt();?></div>
        </div>
        <a class='orbit-btn' href='<?php the_permalink();?>'>Continue Reading</a>
        <hr>
        <?php endwhile; endif; ?>
    </div>
    <div class="col-sm-4">
      <?php if( is_active_sidebar( 'single-post-sidebar' ) ){ dynamic_sidebar( 'single-post-sidebar' ); }?>
    </div>
  </div>
</div>
<?php get_footer();?>
