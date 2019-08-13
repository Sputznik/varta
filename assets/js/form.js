jQuery(document).ready(function(){

  // Clones all subservices from dropdown
  var $cloneSubServices = jQuery('.subservices select').clone();

  // change subservices when the main service is changed
  jQuery('.mainservices select').change( function( ev ){

    var $el = jQuery( ev.target );

    var currentService = $el.val();

    jQuery('.subservices select option').remove();

    var $options;

    if( currentService > 0 ){
      $options = $cloneSubServices.find('option[data-parent~="' + currentService + '"]').clone();

      var $defaultOption = jQuery( document.createElement( 'option' ) );
      $defaultOption.val( 0 );
      $defaultOption.html('Select');
      $defaultOption.appendTo('.subservices select');
    }
    else{
      $options = $cloneSubServices.find('option');
      $options.first().val(0);
    }

    $options.appendTo('.subservices select');

    jQuery('.subservices select').val(0);

  });

} );
