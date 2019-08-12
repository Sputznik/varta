<?php

$metainfo = array(
  array(
    'icon'      => 'fa fa-calendar',
    'label'     => '',
    'shortcode' => '[orbit_date]'
  ),
  array(
    'icon'      => 'fa fa-map-marker',
    'label'     => '',
    'shortcode' => '[orbit_terms taxonomy="locations"]'
  ),
  array(
    'icon'      => 'fa fa-tag',
    'label'     => 'Services: &nbsp;',
    'shortcode' => '[orbit_terms taxonomy="services"]'
  ),
);

foreach ($metainfo as $meta) {
  if( $meta['shortcode'] ){

    $value = do_shortcode( $meta['shortcode'] );

    if( $value ){
      _e("<p class='small'>");
      if( $meta['icon'] ){ _e( "<i class='". $meta['icon'] ."'></i> &nbsp; " ); }
      if( $meta['label'] ){ _e( "<label>". $meta['label'] ."</label>" ); }
      echo $value;
      _e("</p>");
    }

  }

}
