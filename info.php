<?php 

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();

  // Include top of the document
  html_head('info');
  
  $mob = $detect->isMobile();
 
  //if accessed from mobile, do nothing...for now...
  if($mob) {
    echo '';
  }
  else {
    //load templateUp
    html_bodyUp();
    
    echo '
    <div class="infoText">
      <div class="info">
        <span class="c0">Justell.me is an open sharing platform for free thinkers, dreamers, passers by, stumblers, poets, adventurers, explorers, singers, shouters, countrymen and nomads. Justell.me is here for you, and you are here for everyone!</span>
      </div>
      <div class="stickers">
          Share your tought with us at:<br/>
          <a href="mailto:info@justell.me">info@justell.me</a>
      </div>
    </div>';

    //load templateDown
    html_bodyDown();
  }

  //Include the bottom of the document, script & co
  html_foot('info', $mob);

?>