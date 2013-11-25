<?php

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();

  // Include top of the document
  html_head('test');
  
  echo '<body class="bodydesktop">
	<div class="update" id="updt">
    <div class="fakepadding_top"></div>
    <div class="wrapperContent" id="wrpCtt">
      <div class="content" id="ctt">
      </div>
    </div>
    <div class="fakepadding_bottom"></div>
    <div class="menufooter With_Font_Menu">
      <span class="textmenufooter">
        <a href="/" class="customlink">Home</a>&nbsp;/&nbsp
        <a href="/map" class="customlink">Sticker Map</a>&nbsp;/&nbsp
        <a href="/artwork" class="customlink">Artwork</a>&nbsp;/&nbsp
        <a href="/info" class="customlink">Info</a>&nbsp;/&nbsp
        <a href="http://prjctcld.com" class="customlink" target="_blank">Project Cloud</a>
      </span>
      </div>

  </div>
  <script type="text/javascript">window.fetch = true;
  </script>';
  
  //Include the bottom of the document, script & co
  html_foot('test', $mob, true);
  
?>
