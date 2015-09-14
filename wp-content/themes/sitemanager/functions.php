<?php
  /* ==========================================
  Custom Post Types
  ========================================== */

  // create department post type
  add_action( 'init', 'post_type_department' );
  function post_type_department() {
    register_post_type( 'department',
      array(
        'labels' => array(
          'name' => __( 'Departamentos' ),
          'singular_name' => __( 'Departamento' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'department'),
        'menu_position' => 5,
        'supports' => array( 'title', 'custom-fields' )
      )
    );
  }

  // create hotsite post type
  add_action( 'init', 'post_type_hotsite' );
  function post_type_hotsite() {
    register_post_type( 'hotsite',
      array(
        'labels' => array(
          'name' => __( 'Hotsite' ),
          'singular_name' => __( 'Hotsite' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'hotsite'),
        'menu_position' => 5,
        'supports' => array( 'title')
      )
    );
  }

  /* ==========================================
  Custom Meta Boxes
  ========================================== */
  function adding_hotsite_meta_boxes() {
    add_meta_box(
        'hotsite_config',
        __( 'Configurações do Hotsite' ),
        'render_hotsite_config',
        'hotsite',
        'side',
        'default'
    );
  }
  add_action( 'add_meta_boxes', 'adding_hotsite_meta_boxes', 10, 2 );

  function render_hotsite_config($post) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'myplugin_save_meta_box_data', 'myplugin_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, '_my_meta_value_key', true );

    echo '<label for="myplugin_new_field">';
    _e( 'Description for this field', 'myplugin_textdomain' );
    echo '</label> ';
    echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr( $value ) . '" size="25" />';
  }

  function myplugin_save_meta_box_data( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
      return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_save_meta_box_data' ) ) {
      return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

      if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
      }

    } else {

      if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
      }
    }

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if ( ! isset( $_POST['myplugin_new_field'] ) ) {
      return;
    }

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['myplugin_new_field'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_my_meta_value_key', $my_data );
  }
  add_action( 'save_post', 'myplugin_save_meta_box_data' );
?>