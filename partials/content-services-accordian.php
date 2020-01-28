
<label class="view-services">View Services:</label>
<?php


  global $post;

  $term_list = wp_get_post_terms( $post->ID, 'services' );

  $final_terms = array();

  // ITERATING THE LIST TO FIND ONLY PARENT TERMS
  foreach( $term_list as $term ){
    if( $term->parent == 0 ){
      $final_terms[$term->term_id] = array(
        'parent' => $term->name,
        'slug'  => $term->slug,
        'parent_id' => $term->term_id,
        'children_id' => 'child-'.$term->term_id,
        'sub'    => array()
      );
    }
  }

  // ITERATING THE LIST TO FIND ONLY CHILD TERMS
  foreach( $term_list as $term ){
    if( $term->parent != 0 && isset( $final_terms[$term->parent] ) && isset( $final_terms[$term->parent]['sub'] ) ){
      array_push( $final_terms[$term->parent]['sub'], $term->name );
    }
  }
  ?>
  <div class='panel-group' id='accordian' role='tablist' aria-multiselectable='true'>
    <?php $i = 0; foreach( $final_terms as $term ): if( isset($term['parent']) && is_array( $term['sub'] ) && count( $term['sub'] ) ): ?>
    <?php $panel_class = 'panel-collapse collapse'; if( $i == 0 ){ $panel_class = 'panel-collapse collapse in'; } ?>
    <div class='panel panel-default'>
      <div class='panel-heading' role='tab' id='<?php _e( $term['children_id'] );?>'>
        <h4 class='panel-title'>
          <button class='btn btn-accord' type='button' data-toggle='collapse' data-parent='#accordian' data-target='<?php _e( "#" . $term['parent_id']) ;?>' aria-expanded='true' aria-controls='<?php _e( $term['parent_id'] );?>'>
            <?php _e( $term['parent'] );?>
          </button>
        </h4>
      </div>
      <div id='<?php _e( $term['parent_id'] );?>' class='<?php _e( $panel_class );?>' role='tabpanel' aria-labelledby='<?php _e( $term['children_id'] );?>'>
        <div class='panel-body'>
          <ul>
            <li><?php _e( implode("</li><li>", $term['sub'] ) ); ?></li>
          </ul>
          <!-- Custom Field Info-->
          <?php
            $metafield = 'services_other';
            if( $term['slug'] == 'mental-health' ){ $metafield = 'services_mental_other'; }
            elseif( $term['slug'] == 'sexual-health' ){ $metafield = 'services_sexual_other'; }

            $other_services_text = get_post_meta( $post->ID, $metafield, true );
            if( $other_services_text ){
              echo "<div class='cf-other-title'><h4>Other services provided:</h4>";
              echo $other_services_text ."</div>";
            }
          ?>
          <!-- Custom Field Info-->
        </div>
      </div>
    </div>
    <?php $i++;?>
  <?php endif; endforeach; ?>
  </div>
