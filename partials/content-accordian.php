<?php
// ACCORDIAN TEMPLATE FOR SERVICES
$metainfo = array(
  array(
    'icon'      => '',
    'label'     => '',
    'shortcode' => '[service_terms taxonomy="services"]'
  ),
);

?>
<label class="view-services">View Services:</label>
<?php
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
