<?php

  $title = get_the_title();
  $title_length = strlen( $title );
  $excerpt_length = 0;
  if( $title_length < 120 ){
    $excerpt_length = 120 - $title_length;

    if( $excerpt_length < 15 ){
      $excerpt_length = 15;
    }
    if( $excerpt_length > 30 ){
      $excerpt_length = 30;
    }
  }
?>
<a href = "<?php the_permalink(); ?>">
  <div class='article-featured-image'><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); }?></div>
</a>
<div class="article-content">
  <div class="categories">
    <?php the_category(', '); ?> <?php the_date('M \'y');?>
  </div>
  <a href = "<?php the_permalink(); ?>" class="<?php _e( $post_type );?>">
    <h4><strong><?php echo $title; ?></strong></h4>
  </a>
  <p><strong>By <?php echo displayAuthor();?></strong></p>
  <?php if( $excerpt_length ):?>
  <p class="narrow-text"><?php echo excerpt( $excerpt_length ); ?></p>
  <?php endif;?>
</div>
