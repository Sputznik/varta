<?php get_header();?>
<?php global $wp_query;?>
	<div class="container" role="main">
		<div class="row">
			<div class="col-lg-12 search-content">
				<h1 class="page-title"><?php printf( __( 'Found %d Search Results for the term: %s' ), $wp_query->found_posts, get_search_query() ); ?></h1>
				<hr>
				<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
				<div class="search-item">
					<h2 class='orbit-title'><a href='<?php the_permalink();?>'><?php the_title();?></a></h2>
          <?php if ( get_post_type() == 'post' ) echo "<span class='search-post-type'>Webzine Article</span>";
            elseif (get_post_type() == 'resources' ) echo "<span class='search-post-type'>Service Provider</span>";
            else echo "<span class='search-post-type'>Website page</span>";?>
					<?php $excerpt = get_the_excerpt();?>
					<?php if( $excerpt ): ?><div class='orbit-excerpt'><?php _e( $excerpt );?> | <a class='search-post-link' href='<?php the_permalink();?>' aria-label="View <?php the_title();?>">View Result</a></div><?php endif;?>
				</div>
				<?php endwhile;?>
				<?php
					else :
			 			printf( __('Sorry, but nothing matched your search terms. Please try again with some different keywords.') );
					endif;
				?>
			</div>
		</div>
	</div>
	<?php if ( have_posts() ): ?>
	<!-- Previous/next page navigation. -->
	<div class="container-fluid search-pagination" role="navigation">
		<div class="container text-center">
			<?php
				the_posts_pagination(
					array(
						'mid_size' 	=> 1,
						'prev_text' => __( '&laquo;' ),
						'next_text' => __( '&raquo;' ),
						'screen_reader_text' => __( ' ' ),
					)
				);
			?>
		</div>
	</div>
	<?php endif;?>
  <style>
    .search-post-type {
      display: inline-block;
      margin:6px 0;
      padding:2px 6px;
      color:white;
      background:#222;
    }
    .search-post-link {
      border-bottom:1px solid;
    }
  </style>
<?php get_footer();?>
