<?php
  header('Content-Type: application/json; charset=utf-8');

  if (have_posts()) : the_post();
    $title   = utf8_encode(get_the_title());
    $content = utf8_encode(get_the_content());
    $url     = parse_url(get_permalink())['path'];

    $data = array(
      'title'   => $title,
      'content' => $content,
      'url'     =>  $url
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  else :
    echo 'Departamento não encontrado';
  endif;
?>