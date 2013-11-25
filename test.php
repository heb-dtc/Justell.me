<?php

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();

  // Include top of the document
  html_head('test');
  
  //inlude bodyUp template 
  html_bodyUp();

  //inlude bodyDown template 
  html_bodyDown();
  
  //kick off JS
  echo'
    <script type="text/javascript">window.fetch = true;
    </script>';
  
  //Include the bottom of the document, script & co
  html_foot('test', false, false);
  
?>
