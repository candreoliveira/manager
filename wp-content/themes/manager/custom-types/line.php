<?php
  function custom_type_line() {
    register_post_type( 'line',
      array(
        'labels' => array(
          'name' => __( 'Linhas' ),
          'singular_name' => __( 'Linha' )
        ),
        'public' => true,
        //'has_archive' => false,
        'rewrite' => array( 'slug' => 'line' ),
        'menu_position' => 5,
        'supports' => array( 'title' )
      )
    );
  }
?>