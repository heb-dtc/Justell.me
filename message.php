<?php

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();  
  
  // Include top of the document
  html_head('message');

  $mob = false;  
  
  if($detect->isMobile()) {
    $mob = true;
  }
  
  if($mob || isset($_GET['m'])) {
    echo '<body class="bodymobile">
          <div class="update">
          </div>
          <script type="text/javascript">window.fetch = true;</script>';
  } else {
    echo '<body class="bodydesktop">
          <div class="update">
          </div>
          <script type="text/javascript">window.fetch = true;</script>';
  }
  //Include the bottom of the document, script & co
  html_foot('index', true, true);
  
?>