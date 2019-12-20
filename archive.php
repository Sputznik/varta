<?php get_header();?>
<?php $term = $wp_query->get_queried_object();?>
<div class="container" style="padding-top: 35px; padding-bottom: 35px;">
  <div class="row">
    <div class="col-sm-8">
      <h1 style="text-transform: capitalize;margin-bottom: 30px;">
        <?php if( $term != null ): ?>
          Tagged Under: <?php echo $term->name; ?>
        <?php else: ?>
          Tagged Under: <?php echo single_month_title(' '); ?>
        <?php endif;?>
      </h1>
      <?php if (have_posts()) : ?>
      <ul class='article-list two-list' style='margin-bottom:50px; padding-left: 0;'>
        <?php while (have_posts()) : the_post(); ?>
        <li class="orbit-article-db orbit-list-db">
          <?php get_template_part('partials/content', 'archive');?>
        </li>
        <?php endwhile; ?>
      </ul>
      <?php endif; ?>
    </div>
    <div class="col-sm-4">
      <?php if( is_active_sidebar( 'single-post-sidebar' ) ){ dynamic_sidebar( 'single-post-sidebar' ); }?>
    </div>
  </div>
</div>
<?php get_footer();?>
