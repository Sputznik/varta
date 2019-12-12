<?php
	global $post;
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' );
?>

<div class='orbit-thumbnail-bg' style='background-image: url( "<?php _e( $thumbnail[0] );?> ");position: relative;'>
	<a href='<?php the_permalink();?>' style="position: absolute; top:0;left:0;width:100%;height: 100%;"></a>
</div>
<div class="orbit-content">
	<h1 class='orbit-title'><a href='<?php the_permalink();?>'><?php the_title();?></a></h1>
	<hr>
	<p>By <?php the_author();?> on <?php the_time( 'F jS Y' );?></p>
	<div class='orbit-excerpt'><?php the_excerpt();?></div>
</div>
<a class='orbit-btn' href='<?php the_permalink();?>'>Continue Reading</a>
