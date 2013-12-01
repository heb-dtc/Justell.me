<?php

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();  
  
  // Include top of the document
  html_headMobile('message');

  $mob = $detect->isMobile();  
    
  if($mob || isset($_GET['m'])) {

    //load templateUp
    html_bodyUp(true);
    //load templateDown
    html_bodyDown(true);    
    //Include the bottom of the document, script & co
    html_foot('mobile', $mob, true);

    //kick off JS
    echo '
      <script type="text/javascript">window.fetch = true;</script>';
  } 
  else {
    echo '';
  }
?>