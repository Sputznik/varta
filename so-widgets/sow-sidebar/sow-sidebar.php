<?php
/*
Widget Name: Sidebar Widget
Description: Sidebar widget
Author: Sputznik
Author URI: https://www.sputznik.com
Widget URI:
Video URI:
*/
class SOW_SIDEBAR extends SiteOrigin_Widget{
  function __construct(){

    $form_options = array(
      'sidebar_type' => array(
        'type' => 'select',
        'label' => __( 'Choose a Sidebar', 'siteorigin-widgets' ),
        'default' => 'single-post-sidebar',
        'options' => array(
          'single-post-sidebar' => __( 'Sidebar for Single Post', 'siteorigin-widgets' ),
          'single-page-sidebar' => __( 'Sidebar for Single Page', 'siteorigin-widgets' ),
          'homepage-sidebar'    => __( 'Sidebar for Homepage', 'siteorigin-widgets' ),
        )
      ),
    );

    parent::__construct(
      'sow-sidebar',
      __( 'Sidebar', 'siteorigin-widgets' ),
      array(
        'description' =>  __( 'Sidebar Widget', 'siteorigin-widgets' ),
        'help'        =>  ''
      ),
      array(),
      $form_options,
      plugin_dir_path(__FILE__).'/so-widgets/sow-sidebar'
    );
  }//construct function ends here

  function get_template_name($instance){
    return 'template';
  }
  function get_template_dir($instance) {
    return 'templates';
  }
  function get_style_name($instance){
    return '';
    }
}
siteorigin_widget_register( 'sow-sidebar', __FILE__, 'SOW_SIDEBAR' );
