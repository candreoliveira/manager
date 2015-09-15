<?php
  function custom_type_hotsite() {
    register_post_type( 'hotsite',
      array(
        'labels' => array(
          'name' => __( 'Hotsites' ),
          'singular_name' => __( 'Hotsite' )
        ),
        'public' => true,
        //'has_archive' => false,
        'rewrite' => array( 'slug' => 'hotsite' ),
        'menu_position' => 5,
        'supports' => array( 'title' )
      )
    );
  }
?>