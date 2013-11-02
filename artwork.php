<?php 

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();

  // Include top of the document
  html_head('artwork');
  
  $mob = false;
 
  if($detect->isMobile()) {
    $mob = true; 
    echo '';
  } else {
    /*echo '<body class="bodydesktop">
      <div class="wrapper">
        <div class="info no-border">Submit your own sticker artwork and share the message:</div>
        <div class="upload">
          <form enctype="multipart/form-data" action="upload" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
            <input name="stickers" type="file" />
          </form>
          <div class="success">
             	&#10003; Uploaded with success !
          </div>
          <div class="error">
          </div>
        </div>
        <div class="info">Use the QR code provided to create a unique logo
                          artwork or send us your images of found justell.me
                          stickers, we would love to see where you found it!
        </div>
        <div class="stickers">
          <img class="centered" src="http://justell.me/img/qr.png" alt="" />
        </div>
      </div>';*/
      echo '<body class="bodydesktop">
      <div class="wrapper">
        <div style="color:#ec008c" class="info no-border">Soon ...
        </div>
      </div>';
  }

  //Include the bottom of the document, script & co
  html_foot('artwork', $mob);

?>