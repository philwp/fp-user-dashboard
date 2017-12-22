<?php
/**
 * Add menu for lab stats 
 */

add_action( 'admin_menu', 'tcsl_add_lab_stats_menu' );

function tcsl_add_lab_stats_menu() {
    add_menu_page( 'Lab Stats', 'Lab Stats', 'manage_categories', 'lab-stats', 'tcsl_lab_stats', 'dashicons-chart-line', 70 );
    add_submenu_page( 'lab-stats', 'Checkin', 'Checkin', 'manage_categories', 'checkin', 'tcsl_checkin' );
}

function tcsl_lab_stats(){
    echo '<h1>Lab Stats Main Menu</h1>';
    ?>
    <div id="app">
    <hello></hello>
  </div>
  <?php
    do_action( 'tcsl_lab_stats_main' );
}

function tcsl_checkin(){
    echo '<h1>Lab Checkin</h1>';
    do_action( 'tcsl_lab_checkin' );
}

