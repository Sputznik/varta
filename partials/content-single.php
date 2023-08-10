<?php
//Get the data from the custom fields
$cf_fields = array(
      'contact_info'          => 'Contact Information',
      'qualifications'        => 'Qualifications',
      'affiliations'          =>  'Affiliations',
      'linkages'              =>  'Linkages',
      'timings'               =>    'Timings',
      'consultation_mode'     => 'Consultation Mode',
      'consultation_charges'  => 'Consultation Charges',
      'concessions'           =>  'Concessions'

);
echo '<div class="custom-field-info">';
foreach ( $cf_fields as $key => $field ) {
  $data = get_post_meta( $post->ID , $key , true );
    if( !empty( $data ) ){
      echo '<label>';
      _e($field);
      echo (':</label><p>'.$data.'</p>' );
    }
}
echo "</div>";
