<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <ul class="list-unstyled">
      <?php foreach ( $this->query->results as $user ):?>
      	<li>
          <h3><a href="<?php _e( get_author_posts_url( $user->ID ) );?>"><?php _e( ucwords( $user->display_name ) );?></a></h3>
          <p><?php _e( get_the_author_meta('description', $user->ID) );?></p>
        </li>
      <?php endforeach;?>
      </ul>
    </div>
    <div class="col-sm-4">
      <?php if( is_active_sidebar( 'single-page-sidebar' ) ){ dynamic_sidebar( 'single-page-sidebar' ); }?>
    </div>
  </div>
</div>
