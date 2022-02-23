<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.author');?>" data-url="<?php _e( $atts['url'] );?>" class="list-unstyled users">
      <?php foreach ( $this->query->results as $user ):?>
      	<li class="author">
          <div class="author-info-section">
            <div class="author-avatar">
              <img src="<?php _e( get_avatar_url( $user->ID ) );?>" alt="<?php _e( $user->display_name );?>" />
            </div>
            <div class="author-desc" style="padding-right:0;">
              <h3><a href="<?php _e( get_author_posts_url( $user->ID, $user->user_nicename ) );?>"><?php _e( $user->display_name );?></a></h3>
              <p><?php _e( $user->description );?>
            </div>
          </div>
        </li>
      <?php endforeach;?>
      </ul>
    </div>
    <div class="col-sm-4">
      <?php if( is_active_sidebar( 'single-page-sidebar' ) ){ dynamic_sidebar( 'single-page-sidebar' ); }?>
    </div>
  </div>
</div>
