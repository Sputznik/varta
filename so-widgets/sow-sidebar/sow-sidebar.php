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

  public $sidebar_details = array();

  function __construct(){

    $form_options = array(
      'sidebar_type' => array(
        'type' => 'select',
        'label' => __( 'Choose a Sidebar', 'siteorigin-widgets' ),
        'default' => 'single-post-sidebar',
        'options' => $this->get_sidebar_list()
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


  function get_sidebar_list(){

    $sidebar_list = array();
    // global $wp_registered_sidebars;

    foreach ( get_option( 'sidebars_widgets' ) as $key => $value) {
      // $sidebar_list[$key] = $wp_registered_sidebars[$key]['name'];
      $sidebar_list[$key] = $key;
    }
    unset( $sidebar_list['wp_inactive_widgets'], $sidebar_list['array_version']  );

    // print_r($sidebar_list);

    return $sidebar_list;
  }

}
siteorigin_widget_register( 'sow-sidebar', __FILE__, 'SOW_SIDEBAR' );
