<?php

// NON-HIERARCHICAL TERMS
add_filter('orbit_filter_terms', function( $terms, $args, $post_type ){
  if( $args['taxonomy'] == 'locations' ){
    $args['post_types'] = $post_type;
    $terms = get_vgs_terms( $args['taxonomy'], $args );
  }
  return $terms;
}, 10, 3 );

// HIERARCHICAL TERMS
add_filter('orbit_filter_nested_terms', function( $terms, $args, $post_type ){
  if( $args['taxonomy'] == 'locations' ){
    $args['post_types'] = $post_type;
    $terms = get_vgs_terms( $args['taxonomy'], $args );
  }
  return $terms;
}, 10, 3 );


if( !function_exists( 'get_vgs_terms' ) ){
  function get_vgs_terms( $taxonomies, $args = array() ){
    //Parse $args in case its a query string.
    $args = wp_parse_args($args);

    if( !empty( $args['post_types'] ) ){
      add_filter( 'terms_clauses','filter_vgs_terms_by_cpt', 10, 3 );
    }

    return get_terms( $taxonomies, $args );
  }
}

if( !function_exists( 'filter_vgs_terms_by_cpt' ) ){
  function filter_vgs_terms_by_cpt( $pieces, $tax, $args){
    global $wpdb;

    $args['post_types'] = (array) $args['post_types'];

    // Don't use db count
    $pieces['fields'] .=", COUNT(*) " ;

    //Join extra tables to restrict by post type.
    $pieces['join'] .=" INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id
                        INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id ";

    // Restrict by post type and Group by term_id for COUNTing.
    $post_types_str = implode(',',$args['post_types']);

    $pieces['where'].= $wpdb->prepare(" AND p.post_type IN(%s) GROUP BY t.term_id", $post_types_str);

    remove_filter( current_filter(), __FUNCTION__ );

    return $pieces;
  }
}
