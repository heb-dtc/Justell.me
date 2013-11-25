<?php 

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
    
    echo '<p>SOON</p>';

    //load templateDown
    html_bodyDown();
  }

  //Include the bottom of the document, script & co
  html_foot('artwork', $mob);

?>