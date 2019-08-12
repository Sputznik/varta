<?php get_header();?>
<div class="container" style="max-width:800px;padding-top: 80px; padding-bottom: 80px;">
  <div class="row">
    <div class="col-sm-12"><div class="paper-box" style="border: #eee solid 1px;padding: 25px;margin-top:20px;box-shadow:#eee 4px 5px 5px 2px;">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h3><?php the_title();?></h3>
        <?php get_template_part("partials/content", "resource");?>
        <hr>
        <?php the_content('Read the rest of this entry »'); ?>
        <?php get_template_part("partials/content", "single");?>
      <?php endwhile; endif; ?>
    </div></div>
  </div>
</div>
<?php get_footer();?>
