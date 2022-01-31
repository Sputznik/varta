<ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.orbit-article');?>" data-url="<?php _e( $atts['url'] );?>" class="list-unstyled">
  <?php while( $this->query->have_posts() ) : $this->query->the_post();?>
	<li class="orbit-article" style="margin-bottom:30px;">
    <h2>
      <a href="<?php the_permalink();?>"><?php the_title();?></a>
    </h2>
    <p><i class="fa fa-map-marker"></i> <?php echo do_shortcode('[location_terms]'); ?></p>
    <p><i class="fa fa-users"></i> <?php echo do_shortcode('[orbit_terms taxonomy="communities"]'); ?></p>
    <div class="covid19-services" style="margin-bottom:40px;"><i class="fa fa-briefcase"></i> <?php echo do_shortcode('[orbit_terms taxonomy="covid19-services"]'); ?></div>
  </li>
  <?php endwhile;?>
</ul>
