<?php
  function remove_default_post_type() {
    remove_menu_page('edit.php');
    remove_menu_page('edit.php?post_type=page');
    remove_menu_page('upload.php');
    remove_menu_page('edit-comments.php');
  }
?>