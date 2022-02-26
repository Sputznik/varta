<?php get_header();?>
<?php
  // Get current Author data
  // $current_author = get_user_by( 'slug', get_query_var( 'author_name' ) );
  // Current Author Name
  // $current_author_name = ucwords( $current_author->display_name );
  global $wp_query;
  $current_author = $wp_query->get_queried_object();
?>
<div id="author-page" class="container" style="padding-top: 80px; padding-bottom: 80px;">
  <div class="row">
    <div class="col-sm-8">
      <div class="author-info-section">
        <div class="author-avatar">
          <!-- img src="<?php // _e( get_avatar_ur( $current_author->ID ) );?>" alt="<?php // _e( $current_author_name );?>" /-->
          <?php echo get_avatar( $current_author->ID, '80', '', $current_author->display_name ); ?>
        </div>
        <div class="author-desc" style="padding-right:0;">
          <h3 class="author-name" style="display:inline-block"><?php _e( $current_author->display_name );?></h3>
          <p><?php _e( $current_author->description );?>
        </div>
      </div>
      <div class="paper-box">
        <ul class="article-list two-list list-unstyled">
          <?php while( have_posts() ) : the_post();?>
        	<li><?php get_template_part( 'partials/content', 'article' );?></li>
          <?php endwhile;?>
        </ul>
      </div>
      <!-- Pagination -->
      <?php
        if( $wp_query->max_num_pages > 1 ){
          the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => __( 'Previous', 'textdomain' ),
            'next_text' => __( 'Next', 'textdomain' ),
          ) );
        }
      ?>
    </div>
    <div class="col-sm-4">
      <?php if( is_active_sidebar( 'single-page-sidebar' ) ){ dynamic_sidebar( 'single-page-sidebar' ); }?>
    </div>
  </div>
</div>
<?php get_footer();?>
