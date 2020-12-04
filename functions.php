<?php

define( 'VARTA_VERSION', '1.3.3' );

add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('varta-style', get_stylesheet_directory_uri().'/assets/css/varta.css', array('sp-core-style'), VARTA_VERSION );
  wp_enqueue_script( 'soah-main', get_stylesheet_directory_uri().'/assets/js/form.js', array( 'jquery' ), VARTA_VERSION, true );
});

include('lib/cpt/cpt.php');

//Sidebar widget for single-resource posts
add_action( 'widgets_init', function(){
  register_sidebar( array(
    'name' 			    => 'Single Resource Sidebar',
    'id' 			      => 'single-resource-sidebar',
    'description' 	=> 'Sidebar appears in the single resources post',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' 	=> '</aside>',
    'before_title' 	=> '<h3 class="widget-title">',
    'after_title' 	=> '</h3>',
  ) );

  // Sidebar widget for single posts
  register_sidebar( array(
    'name' 			    => 'Sidebar for Single Post',
    'id' 			      => 'single-post-sidebar',
    'description' 	=> 'Sidebar appears in the single posts page',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' 	=> '</aside>',
    'before_title' 	=> '<h3 class="widget-title">',
    'after_title' 	=> '</h3>',
  ) );

  // Sidebar widget for pages
  register_sidebar( array(
    'name' 			    => 'Sidebar for Pages',
    'id' 			      => 'single-page-sidebar',
    'description' 	=> 'Sidebar appears in the pages',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' 	=> '</aside>',
    'before_title' 	=> '<h3 class="widget-title">',
    'after_title' 	=> '</h3>',
  ) );

  // Sidebar widget for homepage
  register_sidebar( array(
    'name' 			    => 'Sidebar for Homepage',
    'id' 			      => 'homepage-sidebar',
    'description' 	=> 'Sidebar appears in the homepage',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' 	=> '</aside>',
    'before_title' 	=> '<h3 class="widget-title">',
    'after_title' 	=> '</h3>',
  ) );


});

add_filter( 'orbit_search_template', function( $template ){
  $template = get_stylesheet_directory()."/partials/new-orbit-search.php";
  return $template;
});

/*
add_filter( 'orbit-nested-dropdown-label', function( $label, $atts ){

  if( $atts['typeval'] == 'locations' ){ $label = "Select City"; }
  if( $atts['typeval'] == 'services' ){ $label = "Select Specific Service"; }

  return $label;

}, 2, 10 );


add_filter( 'orbit-filter-field', function( $custom_function, $atts ){

  if( $atts['type'] == 'tax' && in_array( $atts['typeval'], array( 'services', 'locations' ) ) && $atts['form'] == 'dropdown' ){

    $custom_function = function( $atts ){
      $orbit_form_field = ORBIT_FORM_FIELD::getInstance();
      $orbit_form_field->nested_dropdown( $atts );
    };

  }

  return $custom_function;

}, 2, 10 );


/* ADD SOW FROM THE THEME */
add_action('siteorigin_widgets_widget_folders', function( $folders ){
	$folders[] = get_stylesheet_directory() . '/so-widgets/';
	return $folders;
});

//Excerpt
function excerpt( $limit ) {

	global $post;

	$excerpt = $post->post_excerpt;

	if( !$excerpt && !strlen( $excerpt ) ){

    $excerpt = $post->post_content;
		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = excerpt_remove_blocks( $excerpt );
		$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );

	}

	$excerpt = wp_trim_words( $excerpt, $limit, '...' );

	return $excerpt;
}

// Get all the author names from Co-Authors plugin
function displayAuthor(){
	$author_name = get_the_author();
	if( function_exists( 'get_coauthors' ) ){
		$coauthors = get_coauthors();
	  $authors_list = array();
	  foreach( $coauthors as $coauthor ){
	    array_push( $authors_list, $coauthor->display_name );
	  }
	  $author_name = implode( ', ', $authors_list );
	}
	return $author_name;
}

// SERVICE TAXONOMIES

/* CREATE ATTS ARRAY FROM DEFAULT AND USER PARAMETERS IN THE SHORTCODE */
add_shortcode( 'service_parent_terms', function( $atts ){
  $atts = shortcode_atts( array(
    'taxonomy' 	=> '',
  ), $atts, 'service_parent_terms' );

  global $post;

  $term_list = wp_get_post_terms( $post->ID, $atts['taxonomy']);

  $final_terms = array();

  $parent_terms = array();

  // ITERATING THE LIST TO FIND ONLY PARENT TERMS
  foreach( $term_list as $term ){
    if( $term->parent == 0 ){
      $final_terms[$term->term_id] = "<a href='".get_term_link( $term )."'>" . $term->name . "</a>";
    }
  }

  foreach( $final_terms as $final_term ){
    array_push( $parent_terms, $final_term );
  }

  $html = "<ul class='list-unstyled'>";
  $html .= "<li>";
  $html .= "<i class='fa fa-briefcase'></i>&nbsp;";
  $html .= "<strong>".implode( ', ', $parent_terms )." </strong>";
  $html .= "</li>";
  $html .= "</ul>";

  return $html;
});



/* CREATE ATTS ARRAY FROM DEFAULT AND USER PARAMETERS IN THE SHORTCODE */
add_shortcode( 'service_terms', function( $atts ){

$atts = shortcode_atts( array(
  'taxonomy' 	=> '',
), $atts, 'service_terms' );

global $post;

$term_list = wp_get_post_terms( $post->ID, $atts['taxonomy']);

$final_terms = array();

// ITERATING THE LIST TO FIND ONLY PARENT TERMS
foreach( $term_list as $term ){
  if( $term->parent == 0 ){
    $final_terms[$term->term_id] = array(
      'parent' => $term->name,
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

  $html .= "<div class='panel-group' id='accordian' role='tablist' aria-multiselectable='true'>";
  $i = 0;
  foreach( $final_terms as $term ){
    if( isset($term['parent']) && is_array( $term['sub'] ) && count( $term['sub'] ) ){
      $html .= "<div class='panel panel-default'>";
      $html .=  "<div class='panel-heading' role='tab' id='".$term['children_id']."'>";
      $html .=    "<h4 class='panel-title'>";
      $html .=     "<button class='btn btn-accord' type='button' data-toggle='collapse' data-parent='#accordian' data-target='#".$term['parent_id']."' aria-expanded='true' aria-controls='".$term['parent_id']."'>";
      $html .=       $term['parent'];
      $html .=      "</button>";
      $html .=     "</h4></div>";

      $panel_class = 'panel-collapse collapse';
      if( $i == 0 ){ $panel_class = 'panel-collapse collapse in'; }

      $html .=  "<div id='".$term['parent_id']."' class='".$panel_class."' role='tabpanel' aria-labelledby='".$term['children_id']."'>";
      $html .=  "<div class='panel-body'>";
      $html .= "<ul><li>".implode("</li><li>", $term['sub'] )."</li></ul>";
      $html .= "</div></div></div>";
      $i++;
    }
  }

  $html .= "</div>";

  return $html;

});


// Returns parent and child term associated to a post with taxonomy -> locations
add_shortcode( 'location_terms', function( $atts ){

  $atts = shortcode_atts( array(
    'taxonomy' 	=> 'locations',
  ), $atts, 'location_terms' );

  global $post;

  $term_list = wp_get_post_terms( $post->ID, $atts['taxonomy'] );

  $final_terms = array(
    'parent'  => '',
    'child'   => ''
  );

  // ITERATING THE LIST TO FIND ONLY PARENT TERMS
  foreach( $term_list as $term ){
    if( $term->parent == 0 ){
      $final_terms['parent'] = "<a href='".get_term_link( $term )."'>" . $term->name . "</a>";
    }
    else{
      $final_terms['child'] = "<a href='".get_term_link( $term )."'>" . $term->name . "</a>";
    }
  }

  ob_start();

  echo $final_terms['child'];
  if( $final_terms['child'] && $final_terms['parent'] ){
    echo ", ";
  }
  echo $final_terms['parent'];

  return ob_get_clean();

} );




// Returns fa fa-check-circle icon if the cf-verified is yes or no
function showVerifiedIcon( $post_id ){
  $verifiedField = get_post_meta( $post_id , 'verified' , true );
  // Checks whether the verified field is yes or no
  if( $verifiedField == "yes" ){
    return _e("<i class='fa fa-check-circle' style='color: #45b6fe;'></i>");
  }
  return "";
}

add_action( 'pre_get_posts', function( $query ){
  if( (is_post_type_archive('resources') && $query->is_main_query()) || (is_tax('locations') && $query->is_main_query()) || (is_tax('services') && $query->is_main_query()) ){
    $query->query_vars['orderby'] = 'name';
    $query->query_vars['order'] = 'ASC';
  }
} );
