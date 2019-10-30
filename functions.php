<?php

define( 'VARTA_VERSION', '1.1.2' );

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
