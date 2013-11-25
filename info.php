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
      <div class="info">
        <span class="c1">Justell.me</span> <span class="c2">is</span> <span class="c3">an</span> <span class="c4">open</span> <span class="c5">sharing</span> <span class="c6">platform</span>
        <span class="c1">for</span> <span class="c2">free</span> <span class="c3">thinkers,</span> <span class="c4">dreamers,</span> <span class="c5">passers</span> <span class="c6">by</span>,
        <span class="c1">stumblers,</span> <span class="c2">poets,</span> <span class="c3">adventurers,</span> <span class="c4">explorers,</span>
        <span class="c5">singers,</span> <span class="c6">shouters,</span> <span class="c1">countrymen</span> <span class="c2">and</span> <span class="c3">nomads.</span>
        <span class="c4">Justell.me</span> <span class="c5">is</span> <span class="c6">here</span> <span class="c1">for</span> <span class="c2">you,</span> <span class="c3">and</span> <span class="c4">you</span> <span class="c5">are</span>
        <span class="c6">here</span> <span class="c1">for</span> <span class="c2">everyone!</span>
      </div>
      <div class="stickers">
        <div class="centered">Share your tought with us at:<br/>
          <a href="mailto:info@justell.me">info@justell.me</a>
        </div>
      </div>';

    //load templateDown
    html_bodyDown();
  }

  //Include the bottom of the document, script & co
  html_foot('info', $mob);

?>