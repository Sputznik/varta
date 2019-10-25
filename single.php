<?php get_header();?>
<div id="single-post" class="container" style="padding-top: 80px; padding-bottom: 80px;">
  <div class="row">
    <div class="col-sm-8">
      <div class="paper-box">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="featured-image-container" style="margin-bottom: 30px;">
            <?php the_post_thumbnail();?>
          </div>
          <p style="color: #771a45;"><span style="text-decoration: underline;"><strong>Happenings, Dec '16</strong></span></p>
          <h1 title="<?php the_title();?>"><?php the_title();?></h1>
          <p><strong>By&nbsp;<?php the_author();?>&nbsp;|&nbsp;<?php the_date();?></strong></p>
          <?php the_content();?>
          <div class="post-tags"><?php the_tags( '', '', '' ); ?></div>
          <div class="under"></div>
          <div class="post-nav">
            <span class="pull-left"><?php previous_post_link("%link", "&laquo; Read Previous Article"); ?></span>
            <span class="pull-right"><?php next_post_link("%link", "Read Next Article &raquo;"); ?></span>
          </div>
          <div style="clear:both;"><?php if ( comments_open() || has_comments() ) : comments_template(); endif;?></div>
        <?php endwhile; endif; ?>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="authors-section">
        <p>About Author:</p>
        <?php $coauthors = get_coauthors(); ?>
        <?php foreach( $coauthors as $coauthor ): ?>
          <div class="author-body">
            <div class="author-avatar">
              <?php echo coauthors_get_avatar( $coauthor, 80 ) ?>
            </div>
            <h3><?php echo $coauthor->display_name; ?></h3>
            <?php $userdata = get_userdata($coauthor->ID); ?>
            <?php if ( $userdata->user_description ):?><p><?php echo $userdata->user_description; ?></p><?php endif;?>
          </div>
        <?php endforeach; ?>
      </div>
      <?php if( is_active_sidebar( 'single-post-sidebar' ) ){ dynamic_sidebar( 'single-post-sidebar' ); }?>
    </div>
  </div>
</div>
<?php get_footer();?>
