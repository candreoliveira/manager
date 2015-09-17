<?php
  header('Content-Type: application/json; charset=utf-8');

  if (have_posts()) {
    $title      = utf8_encode(get_the_title());
    $content    = utf8_encode(get_the_content());
    $url        = parse_url(get_permalink())['path'];
    $template   = get_post_meta(get_the_ID(), 'template', true);

    //$hasTemplate = $_GET['template'];

    $data = array(
      'title'     => $title,
      'content'   => $content,
      'url'       =>  $url,
      'template'  => $template
      //'temp' => $hasTemplate
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  } else {
    echo 'Departamento não encontrado';
  }
?>