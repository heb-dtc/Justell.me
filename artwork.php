<?php 
  ini_set('display_errors', 'On');
  error_reporting(E_ALL);

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();
  $mob = $detect->isMobile();

  // Include top of the document
  html_head('artwork');
  
  //if mobile display nothing...
  if($mob) {
    echo '';
  } else {
    //load templateUp
    html_bodyUp();

    //echo '<p>SOON</p>';
    echo '<div class="gallery">';

    //get the list of artworks and display them
    $images_dir = './uploads/';
    $image_files = scandir($images_dir);
    $ignore = Array(".", "..");
    $valid_ext = Array("jpg", "png", "gif");
    
    if(count($image_files)) {
      foreach($image_files as $img){
        $ext = pathinfo($img, PATHINFO_EXTENSION);
        if(!in_array($img, $ignore) && in_array($ext, $valid_ext)) {
          echo "<img class=\"artwork\" src='$images_dir$img' />";
        }
      }
    }
    else {
      echo '<p>There are no artwork in this gallery.</p>';
    }

    echo '</div>';

    //load templateDown
    html_bodyDown();
  }

  //Include the bottom of the document, script & co
  html_foot('artwork', $mob);

?>