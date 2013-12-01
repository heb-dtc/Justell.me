<?php

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();

  // Include top of the document
  html_head('test');
  
  //inlude bodyUp template 
  html_bodyUp();

  //get the list of artworks and display them
    $images_dir = './uploads/';
    $image_files = scandir($images_dir);
    $ignore = Array(".", "..");
    $valid_ext = Array("jpg", "png", "gif");
    
    if(count($image_files) > 2) {
      echo '<figure>';

      foreach($image_files as $img){
        $ext = pathinfo($img, PATHINFO_EXTENSION);
        if(!in_array($img, $ignore) && in_array($ext, $valid_ext)) {
          echo "<img class=\"artworktest\" src='$images_dir$img' />";
        }
      }
    }
    echo '</figure>';

  //inlude bodyDown template 
  html_bodyDown();
  
  //Include the bottom of the document, script & co
  html_foot('test', false, false);
  
?>
