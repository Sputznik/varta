<?php

// CREATES CUSTOM POST TYPE
add_filter( 'orbit_post_type_vars', function( $orbit_types ){

	$orbit_types['resources'] = array(
		'slug' 		=> 'resources',
		'labels'	=> array(
			'name' 					=> 'Resources',
			'singular_name' => 'Resource',
      'add_new'       => 'Add New',
      'add_new_item'  => 'Add New Resource',
      'all_items'     =>  'All Resources'
		),
		'public'		=> true,
		'supports'	=> array( 'title', 'editor','thumbnail' )
	);
	return $orbit_types;
} );

//Creates a meta field for citation information
add_filter( 'orbit_meta_box_vars', function( $meta_box ){
	$meta_box['resources'] = array(
		array(
			'id'			=> 'resources-meta-fields',
			'title'		=> 'Additional Information',
			'fields'	=> array(
				'qualifications'	=> array(
					'type' => 'text',
					'text' => 'Qualifications'
				),
				'affiliations'	=> array(
					'type' => 'text',
					'text' => 'Affiliations'
				),
				'linkages'	=> array(
					'type' => 'text',
					'text' => 'Linkages'
				),
				'timings'	=> array(
					'type' => 'text',
					'text' => 'Timings'
				),
				'consultation_mode'	=> array(
					'type' => 'text',
					'text' => 'Consultation Mode'
				),
				'consultation_charges'	=> array(
					'type' => 'text',
					'text' => 'Consultation Charges'
				),
				'concessions'	=> array(
					'type' => 'text',
					'text' => 'Concessions'
				),
			)
		)
	);
	return $meta_box;
});

/* PUSH INTO THE GLOBAL VARS OF ORBIT TAXNOMIES */
add_filter( 'orbit_taxonomy_vars', function( $orbit_tax ){

  $resources_taxonomies = array(
    'locations'       => 'Locations',
    'services'        => 'Services'
  );

  foreach( $resources_taxonomies as $slug => $label ){
    $orbit_tax[ $slug ]	= array(
      'label'			  => $label,
      'slug' 			  => $slug,
      'post_types'	=> array( 'resources' )
    );
  }

  return $orbit_tax;

} );
