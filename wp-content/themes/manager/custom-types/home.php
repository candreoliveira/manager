<?php
  function custom_type_home() {
    register_post_type( 'home',
      array(
        'labels' => array(
          'name' => __( 'Homes' ),
          'singular_name' => __( 'Home' )
        ),
        'public' => true,
        //'has_archive' => false,
        'rewrite' => array('slug' => 'home'),
        'menu_position' => 5,
        'supports' => array('title')
      )
    );
  }
?>