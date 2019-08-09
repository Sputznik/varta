<?php

add_action('wp_enqueue_scripts',function(){
  wp_enqueue_style('varta-style', get_stylesheet_directory_uri().'/assets/css/varta.css', array('sp-core-style'), '1.0.0' );
});

include('lib/cpt/cpt.php');

// add_filter('manage_edit-laws_columns', function( $columns ){
//
//   $remove_taxonomies = array( 'machine-readable', 'gazetted-copy', 'lang', 'source', 'status', 'nature' );
//   foreach( $remove_taxonomies as $tax ){
//     unset( $columns[ 'taxonomy-'. $tax ] ); // prepend taxonomy name with 'taxonomy-'
//   }
//
//   return $columns;
// } );
