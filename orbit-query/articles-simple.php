<ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.orbit-article');?>" data-url="<?php _e( $atts['url'] );?>" class="list-unstyled">
  <?php while( $this->query->have_posts() ) : $this->query->the_post();?>
	<li class="orbit-article" style="margin-bottom:25px;">
    <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
    <p class="small">
      <i class='fa fa-map-marker'></i> &nbsp; <?php _e( do_shortcode( '[orbit_terms taxonomy="locations"]' ) ); ?>
    </p>
  </li>
  <?php endwhile;?>
</ul>
