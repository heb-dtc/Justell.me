<?php

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();
  $mob = $detect->isMobile();
  // Include top of the document
  html_head('map');
 
  $mob = false;
 
  //if accessed from mobile, do nothing...
  if($mob) {
    echo '';
  } else {
    //load templateUP
    html_bodyUP();

    //add the map
    echo '
			<div id="map_canvas" class="update" ></div></div>';

    //get messages from DB
    include('fetch-text.php');
    
    //kick off JS
    echo '
        <script type="text/javascript">window.fetch = true;</script>';

    //load templateDown
    html_bodyDown();
  }

  //Include the bottom of the document, script & co
  html_foot('map', $mob ,true);

?>
