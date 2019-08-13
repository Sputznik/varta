<?php

define( 'VARTA_VERSION', '1.0.3' );

add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('varta-style', get_stylesheet_directory_uri().'/assets/css/varta.css', array('sp-core-style'), VARTA_VERSION );
  wp_enqueue_script( 'soah-main', get_stylesheet_directory_uri().'/assets/js/form.js', array( 'jquery' ), VARTA_VERSION, true );
});

include('lib/cpt/cpt.php');

add_filter( 'orbit-filter-field', function( $custom_function, $atts ){

  if( $atts['type'] == 'tax' && $atts['typeval'] == 'services' && $atts['form'] == 'dropdown' ){

    $custom_function = function(){

      $terms = get_terms( array(
        'taxonomy'  => 'services',
        'hide_empty' => false,
        'orderby' => 'term_id'
      ) );

      $services = array();
      $subservices = array();
      foreach ( $terms as $term ) {
        if( $term->parent ){
          array_push( $subservices, array(
            'name'   => $term->name,
            'slug'    => $term->term_id,
            'parent'  => $term->parent
          ) );
        }
        else{
          array_push( $services, array(
            'name'   => $term->name,
            'slug'    => $term->term_id,
            'parent'  => $term->parent
          ) );
        }
      }

      $orbit_form_field = ORBIT_FORM_FIELD::getInstance();


      _e( "<div data-behaviour='varta-services'>" );

      _e( "<div class='mainservices'>" );
      $orbit_form_field->display( array(
        'label'   => 'Choose Service',
        'type'    => 'dropdown',
        'name'    => 'tax_services[]',
        'items' => $services
      ) );
      _e( "</div>" );

      _e( "<div class='subservices'>" );
      $orbit_form_field->display( array(
        'label'   => 'Choose Specific Service',
        'type'    => 'dropdown',
        'name'    => 'tax_services[]',
        'items' => $subservices
      ) );
      _e( "</div>" );

      _e( "</div>" );

    };

  }

  return $custom_function;

}, 2, 10 );
