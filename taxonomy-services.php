<?php get_header();?>
<?php $term = $wp_query->get_queried_object();?>
<div class="container" style="padding-top: 35px; padding-bottom: 35px;">
  <h1>Service Providers for: <?php echo $term->name; ?></h1>
  <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
    <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
    <?php get_template_part("partials/content", "resource");?>
    <?php endwhile; endif; ?>
</div>
<?php get_footer();?>
