jQuery(document).ready(function(){

  jQuery( '[data-behaviour~="orbit-nested-dropdown"]' ).each( function(){

    var $el             = jQuery( this ),
      $cats_dropdown    = $el.find( '.cats select' ),
      $subcats_dropdown = $el.find( '.subcats select' ),
      $cloneSubDropdown = $el.find( '.subcats select' ).clone();  // Clones all subcats from dropdown

    function updateSubDropdown(){

      var currentCategoryValue = $cats_dropdown.val();

      $subcats_dropdown.find( 'option' ).remove();

      var $options;

      if( currentCategoryValue > 0 ){
        $options = $cloneSubDropdown.find( 'option[data-parent~="' + currentCategoryValue + '"]' ).clone();

        var $defaultOption = jQuery( document.createElement( 'option' ) );
        $defaultOption.val( 0 );
        $defaultOption.html('Select');
        $defaultOption.appendTo( $subcats_dropdown );
      }
      else{
        $options = $cloneSubDropdown.find('option').clone();
        $options.first().val(0);
      }

      $options.appendTo( $subcats_dropdown );

      $subcats_dropdown.val(0);

    }

    // change subservices when the main service is changed
    $cats_dropdown.change( function( ev ){

      updateSubDropdown();

    });

  });




} );
