<?php
  function custom_type_subline() {
    register_post_type( 'subline',
      array(
        'labels' => array(
          'name' => __( 'Sublinhas' ),
          'singular_name' => __( 'Sublinha' )
        ),
        'public' => true,
        //'has_archive' => false,
        'rewrite' => array( 'slug' => 'subline' ),
        'menu_position' => 5,
        'supports' => array( 'title' )
      )
    );
  }
?>