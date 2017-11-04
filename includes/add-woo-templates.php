<?php
/**
 * Add the plugin to override Woocommerce templates
 */

add_filter( 'woocommerce_locate_template', 'tcsl_member_woocommerce_locate_template', 10, 3 );



function tcsl_member_woocommerce_locate_template( $template, $template_name, $template_path ) {

  global $woocommerce;



  $_template = $template;

  if ( ! $template_path ) $template_path = $woocommerce->template_url;

  $plugin_path  = FP_USER_DASHBOARD_PATH . '/templates/woocommerce/';


  // Look within passed path within the theme - this is priority

  $template = locate_template(

    array(

      $template_path . $template_name,

      $template_name

    )

  );



  // Modification: Get the template from this plugin, if it exists

  if ( ! $template && file_exists( $plugin_path . $template_name ) )

    $template = $plugin_path . $template_name;



  // Use default template

  if ( ! $template )

    $template = $_template;



  // Return what we found
	//die(var_dump($template));
  return $template;

}
