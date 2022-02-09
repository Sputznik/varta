<?php get_header();?>
<div class="container" style="padding-top: 80px; padding-bottom: 80px;">
  <div class="row">
    <div class="col-sm-8"><div class="paper-box">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1>
          <?php the_title();?>
        </h1>
        <p><i class="fa fa-map-marker"></i> <?php echo do_shortcode('[location_terms]'); ?></p>
        <p><i class="fa fa-users"></i> <?php echo do_shortcode('[orbit_terms taxonomy="communities"]'); ?></p>
        <!--div class="covid19-services"><i class="fa fa-briefcase"></i> <?php // echo do_shortcode('[orbit_terms taxonomy="covid19-services"]'); ?></div-->

        <hr>
        <h2>Services offered:</h2>
        <ul>
        <?php $term_list = wp_get_post_terms( $post->ID, 'services' );
          foreach ($term_list as $term) { ?>
            <li><?php echo $term->name; ?></li>
        <?php } ?>
        </ul>
        <hr>

        <?php the_content(); ?>

        <hr>

        <?php // $nature_of_org = get_post_meta(get_the_ID(), 'nature-of-organization', true); ?>

        <div class="covid19-resource-cf">
          <p><strong>Nature of organization:</strong> <?php echo do_shortcode('[orbit_cf id="nature-of-organization"]'); ?></p>
          <p><strong>Other support provided or planned to be provided:</strong> <?php echo do_shortcode('[orbit_cf id="other-support-provided"]'); ?></p>
        </div>

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
