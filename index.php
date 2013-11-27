<?php

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();

  // Include top of the document
  html_head('home');
  
  $mob = $detect->isMobile();
  
  if($mob || isset($_GET['m'])) {
  
    //load mobile interface
    echo '<body class="bodymobile">
            <div class="wrapp">

              <div class="header">
                <div class="headerTitle">
                  <span>NOW THAT YOU SCANNED ME </span> </br>
                  <span> TELL ME SOMETHING </span>
                </div>
                <textarea class="customInput" id="pseudo" rows="1" maxlength="25"  type="text" placeholder="Your name..." ></textarea>
        	    </div>

              <div class="middle">
                <textarea class="customInput" id="text" rows="5" maxlength="250" placeholder="Your message..." ></textarea>
        	    </div>
              
              <div class="footer">
        			  <input class="button" type="submit" value="Tell Me!" id="send" />
              </div>
                <div class="slider"><img src="../img/squares_loader_black.gif"></div>
            </div>';

    //Include the bottom of the document, script & co
    html_foot('mobile', $mob, true);
  } 
  else {
    //load templateUp
    html_bodyUp();
    //load templateDown
    html_bodyDown();
    //kick off the JS
    echo '<script type="text/javascript">window.fetch = true;</script>';


    //Include the bottom of the document, script & co
    html_foot('index', $mob, true);
  }
?>
