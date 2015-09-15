<?php
  function custom_type_department() {
    register_post_type( 'department',
      array(
        'labels' => array(
          'name' => __( 'Departamentos' ),
          'singular_name' => __( 'Departamento' )
        ),
        'public' => true,
        //'has_archive' => false,
        'rewrite' => array('slug' => 'department'),
        'menu_position' => 5,
        'supports' => array('title')
      )
    );
  }
?>