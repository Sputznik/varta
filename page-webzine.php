<?php get_header();?>
	<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="webzine-headline">
          <h1>'Varta' Webzine</h1>
          <p>Bioscope of your intimate dreams!</p>
        </div>
      </div>
    </div>
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
  		<div class="row">
  			<div class="col-sm-12 col-md-8">
          <?php echo do_shortcode('[orbit_query style="grid2" posts_per_page="16" pagination="1"]');?>
        </div>
        <div class="col-sm-12 col-md-4">
          <?php if( is_active_sidebar( 'single-post-sidebar' ) ){
            dynamic_sidebar( 'single-post-sidebar' );
          }?>
        </div>
  		</div>
    <?php endwhile; endif; ?>
	</div>
<?php get_footer();?>
