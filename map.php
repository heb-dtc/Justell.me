<?php

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();

  // Include top of the document
  html_head('map');
 
  $mob = false;
 
  if($detect->isMobile()) {
    $mob = true;
    echo '';
  } else {
    echo '<body class="bodydesktop">
			<div id="map_canvas" class="update" ></div>
      <script type="text/javascript">window.messages = ';
      
      include('fetch-text.php');
      
    echo '</script>
      <script type="text/javascript">window.fetch = true;</script>';
  }

  //Include the bottom of the document, script & co
  html_foot('map', $mob ,true);

?>