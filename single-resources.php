<?php get_header();?>
<div class="container" style="padding-top: 80px; padding-bottom: 80px;">
  <div class="row">
    <div class="col-sm-8"><div class="paper-box">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1>
          <?php the_title();?>
          <?php echo showVerifiedIcon( get_the_ID() ); ?>
        </h1>
        <?php get_template_part("partials/content", "resource");?>
        <hr>
        <label><?php _e('Contact Information'); ?>:</label>
        <?php the_content('Read the rest of this entry »'); ?>
        <?php get_template_part("partials/content", "single");?>
        <?php get_template_part("partials/content", "services-accordian");?>
      <?php endwhile; endif; ?>
    </div></div>
    <div class="col-sm-4">
      <?php if( is_active_sidebar( 'single-resource-sidebar' ) ){
        dynamic_sidebar( 'single-resource-sidebar' );
      }?>
    </div>
  </div>
</div>
<?php get_footer();?>
