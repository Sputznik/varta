<?php

define( 'VARTA_VERSION', '1.0.6' );

add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('varta-style', get_stylesheet_directory_uri().'/assets/css/varta.css', array('sp-core-style'), VARTA_VERSION );
  wp_enqueue_script( 'soah-main', get_stylesheet_directory_uri().'/assets/js/form.js', array( 'jquery' ), VARTA_VERSION, true );
});

include('lib/cpt/cpt.php');

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
