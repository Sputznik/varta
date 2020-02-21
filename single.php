<?php get_header();?>
<?php $coauthors = get_coauthors(); ?>
<div id="single-post" class="container" style="padding-top: 80px; padding-bottom: 80px;">
  <div class="row">
    <div class="col-sm-8">
      <div class="paper-box">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="featured-image-container" style="margin-bottom: 30px;">
            <?php the_post_thumbnail();?>
          </div>
          <div class="categories">
            <?php the_category()?>, <?php echo get_the_date('M \'y');?>
          </div>
          <h1 title="<?php the_title();?>"><?php the_title();?></h1>
          <p><strong>By&nbsp;<?php
            foreach( $coauthors as $coauthor) {
              echo $coauthor->display_name;
              if ($coauthor != end($coauthors)) echo ", ";
            }
          ?>&nbsp;|&nbsp;<?php echo get_the_date();?></strong></p>
          <p><strong><?php echo excerpt(60);?></strong></p>
          <div class="post-content">
            <?php the_content();?>
          </div>
          <div class="post-tags"><?php the_tags( '', '', '' ); ?></div>
          <div class="under"></div>
          <!-- <p style="margin-top: 15px;">About Author:</p> -->
          <div class="authors-section">
            <?php foreach( $coauthors as $coauthor ): ?>
              <div class="author-body col-sm-12">
                <div class="author-avatar col-md-2 col-xs-12">
                  <?php echo coauthors_get_avatar( $coauthor, 100 ) ?>
                </div>
                <div class="author-desc col-md-10 col-xs-12" style="padding-right:0;">
                  <h3 class="author-name" style="display:inline-block"><?php echo $coauthor->display_name; ?></h3>
                  <?php $userdata = get_userdata($coauthor->ID); ?>
                  <?php if ( $userdata->user_description ):?><p><?php echo $userdata->user_description; ?></p><?php endif;?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="under"></div>
          <div class="post-nav">
            <span class="pull-left"><?php previous_post_link("%link", "&laquo; Read Previous Article"); ?></span>
            <span class="pull-right"><?php next_post_link("%link", "Read Next Article &raquo;"); ?></span>
          </div>
          <div style="clear:both;"><?php if ( comments_open() || have_comments() ) : comments_template(); endif;?></div>
        <?php endwhile; endif; ?>
      </div>
    </div>
    <div class="col-sm-4">
      <?php if( is_active_sidebar( 'single-post-sidebar' ) ){ dynamic_sidebar( 'single-post-sidebar' ); }?>
    </div>
  </div>
</div>
<?php get_footer();?>
