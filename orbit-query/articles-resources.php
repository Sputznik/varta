<ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.orbit-article');?>" data-url="<?php _e( $atts['url'] );?>" class="list-unstyled">
  <?php while( $this->query->have_posts() ) : $this->query->the_post();?>
	<li class="orbit-article" style="margin-bottom:30px;">
    <h2>
      <a href="<?php the_permalink();?>">
        <?php the_title();?>
      </a>
      <?php echo showVerifiedIcon( get_the_ID() ); ?>
    </h2>
    <?php get_template_part("partials/content", "resource");?>
    <p style="margin-bottom:40px;"></p>
  </li>
  <?php endwhile;?>
</ul>
