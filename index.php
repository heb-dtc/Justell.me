<?php

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();

  // Include top of the document
  html_head('home');
  
  $mob = $detect->isMobile();
  
  if($mob || isset($_GET['m'])) {
  
    // Generate the rest
    echo '<body class="bodymobile">
    <div class="wrapp">
      <div class="header">
	  </br>
        <input class="namebox" id="pseudo" maxlength="25"  type="text" placeholder="What\'s your name?" />
      </br>
	  </br>
	  </div>
      <div class="middle">
	  </br>
	  </br>
        <textarea class="messagebox" id="text" rows="7" maxlength="250" placeholder="Leave a message..." ></textarea>
	  </div>
	  </br>
	  </br>
      <div class="footer">
			<input class="button" type="submit" value="Tell Me!" id="send" />
      </div>
    </div>';
  } else {
    echo '<body class="bodydesktop">
			<div class="update">
      </div>
      <script type="text/javascript">window.fetch = true;</script>';
  }
  
  //Include the bottom of the document, script & co
  html_foot('index', $mob, true);
  
?>