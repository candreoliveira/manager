<?php
  header('Content-Type: application/json; charset=utf-8');

  if (have_posts()) : the_post();
    $title    = utf8_encode(get_the_title());
    $content  = utf8_encode(get_the_content());
    $url      = parse_url(get_permalink())['path'];
    $order_by = get_post_meta(get_the_ID(), 'order_by');
    $sort     = get_post_meta(get_the_ID(), 'sort');

    $data = array(
      'title'    => $title,
      'url'      => $url,
      'orderBy' => $order_by,
      'sort'     => $sort
    );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  else :
    echo 'Departamento não encontrado';
  endif;
?>