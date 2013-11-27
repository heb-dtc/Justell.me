<?php

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();  
  
  // Include top of the document
  html_head('message');

  $mob = $detect->isMobile();  
    
  if($mob || isset($_GET['m'])) {
    echo '<body class="bodymobile">
          <div class="update" id="updt">
          </div>';

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