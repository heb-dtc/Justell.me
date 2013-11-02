<?php

  $res = array('errors' => array());
  $images = $_FILES['images'];
  
  if(isset($images) && $images['size'][0] < 100000 && ($images['type'][0] == 'image/png' || $images['type'][0] == 'image/jpeg') ) {
    $name = $images['name'][0];
    move_uploaded_file($images['tmp_name'][0],'/customers/4/0/2/justell.me/httpd.www/uploaded/'.$name);
    $res = array('image' => $name);
  }
  if($images['size'][0] >= 100000) {
    array_push($res['errors'],'file too big');
  }
  if($images['type'][0] != 'image/png' && $images['type'][0] != 'image/jpeg') {
    array_push($res['errors'],'wrong file type');
  }

  header('Content-type: application/json');
  echo json_encode($res);
?>