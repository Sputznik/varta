<?php

$metainfo = array(
  // array(
  //   'icon'      => 'fa fa-calendar',
  //   'label'     => '',
  //   'shortcode' => '[orbit_date]'
  // ),
  array(
    'icon'      => 'fa fa-map-marker',
    'label'     => '',
    'shortcode' => '[location_terms taxonomy="locations"]'
  ),
  array(
    'icon'      => '',
    'label'     => '',
    'shortcode' => '[service_parent_terms taxonomy="services"]'
  ),
);


foreach ($metainfo as $meta) {

  if( $meta['shortcode'] ){

    $value = do_shortcode( $meta['shortcode'] );

    if( $value ){
      _e("<p>");
      if( $meta['icon'] ){ _e( "<i class='". $meta['icon'] ."'></i> &nbsp; " ); }
      if( $meta['label'] ){ _e( "<label>". $meta['label'] ."</label>" ); }
      echo $value;
      _e("</p>");
    }
  }
}
