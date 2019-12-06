<?php get_header();?>
<div class="container" style="padding-top: 35px; padding-bottom: 35px;">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <?php get_template_part("partials/content", "resource");?>
    <?php endwhile; endif; ?>
</div>
<?php get_footer();?>
