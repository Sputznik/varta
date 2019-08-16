<?php

define( 'VARTA_VERSION', '1.0.5' );

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

function nested_dropdown( $atts ){

  $terms = get_terms( array(
    'taxonomy'    => $atts['typeval'],
    'hide_empty'  => false,
    'orderby'     => 'term_id'
  ) );

  $cats = array();
  $subcats = array();
  foreach ( $terms as $term ) {
    if( $term->parent ){
      array_push( $subcats, array(
        'name'    => $term->name,
        'slug'    => $term->term_id,
        'parent'  => $term->parent
      ) );
    }
    else{
      array_push( $cats, array(
        'name'    => $term->name,
        'slug'    => $term->term_id,
        'parent'  => $term->parent
      ) );
    }
  }

  $orbit_form_field = ORBIT_FORM_FIELD::getInstance();

  $param = "tax_" . $atts['typeval'];
  $name_param = $param . "[]";
  $values = $_GET[ $param ];

  _e( "<div data-behaviour='orbit-nested-dropdown'>" );

  _e( "<div class='cats'>" );
  $orbit_form_field->display( array(
    'label'   => $atts['label'],
    'type'    => 'dropdown',
    'name'    => $name_param,
    'items'   => $cats,
    'value'   => is_array( $values ) ? $values[0] : ""
  ) );
  _e( "</div>" );

  _e( "<div class='subcats'>" );
  $orbit_form_field->display( array(
    'label'           => apply_filters( 'orbit-nested-dropdown-label', 'Select Sub', $atts ),
    'type'            => 'dropdown',
    'name'            => $name_param,
    'items'           => $subcats,
    'value'           => ( is_array( $values ) && count( $values ) > 1 ) ? $values[1] : ""
  ) );
  _e( "</div>" );

  _e( "</div>" );
}


add_filter( 'orbit-filter-field', function( $custom_function, $atts ){

  if( $atts['type'] == 'tax' && in_array( $atts['typeval'], array( 'services', 'locations' ) ) && $atts['form'] == 'dropdown' ){

    $custom_function = function( $atts ){
      nested_dropdown( $atts );
    };

  }

  return $custom_function;

}, 2, 10 );
