<ul class="article-list two-list list-unstyled">
  <?php while( $this->query->have_posts() ) : $this->query->the_post();?>
	<li><?php get_template_part( 'partials/content', 'article' );?></li>
  <?php endwhile;?>
</ul>
