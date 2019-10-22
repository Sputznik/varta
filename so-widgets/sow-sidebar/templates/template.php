<?php
$sidebar_location = $instance['sidebar_type'];

if( is_active_sidebar( $sidebar_location ) ){
  dynamic_sidebar( $sidebar_location );
}
?>
