<div class='orbit-search-form'>
	<div class="orbit-search-form-box">
		<div class="orbit-search-form-title">
			<span class='fa-icon'><i class="fa fa-search"></i></span>
			<span>Search Form</span>
			<span class="arrow-down"></span>
		</div>
		<?php $this->filters_form( $form );?>
	</div>
</div>
<?php if( count($_GET) ):?>
<div class='orbit-search-results'>
  <div class='orbit-results-header <?php if( $this->has_sorting( $form->ID ) ) _e( 'has-sorting' );?>'>
    <div class='orbit-results-header-top'>
      <h3 class='orbit-results-heading'><?php _e( $this->results_title( $filter_header, $total_posts ) );?></h3>
      <?php echo $this->results_inline_terms( $filter_header, $posts ); ?>
    </div>
    <?php $this->sorting_dropdown( $form->ID ); ?>
  </div>
  <?php echo $results_html;?>
</div>
<?php endif;?>
