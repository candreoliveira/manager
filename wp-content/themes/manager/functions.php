<?php
  require(get_theme_root() . '/manager/mustache.php');
  require(get_theme_root() . '/manager/custom-types/home.php');
  require(get_theme_root() . '/manager/custom-types/department.php');
  require(get_theme_root() . '/manager/custom-types/hotsite.php');
  require(get_theme_root() . '/manager/custom-types/line.php');
  require(get_theme_root() . '/manager/custom-types/subline.php');
  require(get_theme_root() . '/manager/custom-types/remover.php');

  add_action('init', 'custom_type_home');
  add_action('init', 'custom_type_department');
  add_action('init', 'custom_type_hotsite');
  add_action('init', 'custom_type_line');
  add_action('init', 'custom_type_subline');
  add_action('admin_menu','remove_default_post_type');
?>