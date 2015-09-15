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
        'supports' => array( 'title' ),
        /*'capabilities' => array(
          'edit_post' => 'edit_hotsite',
          'edit_posts' => 'edit_hotsites',
          'edit_others_posts' => 'edit_other_hotsites',
          'publish_posts' => 'publish_hotsites',
          'read_post' => 'read_hotsite',
          'read_private_posts' => 'read_private_hotsites',
          'delete_post' => 'delete_hotsite'
        ),*/
        'register_meta_box_cb' => 'add_hotsites_metaboxes'
      )
    );

    function add_hotsites_metaboxes() {
      add_meta_box('wp_hotsites_templates', 'Template', 'wp_hotsites_templates', 'hotsite', 'normal', 'default');
    }

    function wp_hotsites_templates_options($qtd) {
      global $post;
      $options = array();

      for ($i=1; $i<=$qtd; $i++) {
        array_push($options, array(
          'id' => "{$i}",
          'name' => 'template',
          'image' => get_template_directory_uri() . "/images/template-{$i}.png",
          'checked' => get_post_meta($post->ID, 'template', true) == $i
        ));
      }

      return $options;
    }

    function wp_hotsites_templates() {
      $view = new Mustache_Engine;
      echo $view->render(
        file_get_contents(get_theme_root() . '/manager/views/wp_hotsites_templates.html', TRUE),
        array(
          'crsf'            => wp_create_nonce(plugin_basename(__FILE__)),
          'templateOptions' => wp_hotsites_templates_options(3)
        )
      );
    }

    function wp_save_hotsites_data($post_id) {
      /*
       * We need to verify this came from our screen and with proper authorization,
       * because the save_post action can be triggered at other times.
       */

      // Check if our nonce is set.
      if (!isset($_POST['crsf'])) {
        return;
      }

      // Verify that the nonce is valid.
      if (!wp_verify_nonce($_POST['crsf'], plugin_basename(__FILE__))) {
        return;
      }

      // If this is an autosave, our form has not been submitted, so we don't want to do anything.
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
      }

      // Check the user's permissions.
     /* if (isset($_POST['post_type']) && 'hotsite' == $_POST['post_type']) {
        if (!current_user_can( 'edit_hotsites', $post_id)) {
          return;
        }
      } else {
        if (!current_user_can('edit_post', $post_id)) {
          return;
        }
      }*/

      /* OK, it's safe for us to save the data now. */
      // Make sure that it is set.
      if (!isset($_POST['template'])) {
        return;
      }

      // Sanitize user input.
      $my_data = sanitize_text_field($_POST['template']);

      // Update the meta field in the database.
      update_post_meta($post_id, 'template', $my_data);
    }

    add_action('save_post', 'wp_save_hotsites_data');
  }
?>