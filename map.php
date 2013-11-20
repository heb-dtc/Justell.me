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
      <div class="update" id="updt">
			<div id="map_canvas" class="update" ></div>
			<div class="menufooter With_Font_Menu">
      <span class="textmenufooter">
      <a href="/"        class="customlink \'.underline($section,\'index\').\'">Home</a>&nbsp;/&nbsp;
      <a href="/map"     class="customlink \'.underline($section,\'map\').\'">Sticker Map</a>&nbsp;/&nbsp;
      <a href="/artwork" class="customlink \'.underline($section,\'artwork\').\'">Artwork</a>&nbsp;/&nbsp;
      <a href="/info"    class="customlink \'.underline($section,\'info\').\'">Info</a>&nbsp;/&nbsp;
      <a href="http://prjctcld.com" class="customlink \'.underline($section,\'cloud\').\'" target="_blank">Project Cloud</a></span>
      </div>
      </div>
      <script type="text/javascript">window.messages = ';
      
      include('fetch-text.php');
      
    echo '</script>
      <script type="text/javascript">window.fetch = true;</script>';
  }

  //Include the bottom of the document, script & co
  html_foot('map', $mob ,true);

?>
