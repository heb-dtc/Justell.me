<?php 
  ini_set('display_errors', 'On');
  error_reporting(E_ALL);

  include_once('includes/Mobile_Detect.php');
  include_once('includes/utils.php');
  
  $detect = new Mobile_Detect();
  $mob = $detect->isMobile();

  // Include top of the document
  html_head('artwork');
  
  //if mobile display nothing...
  if($mob) {
    echo '';
  } else {
    //load templateUp
    html_bodyUp();

    //get the list of artworks and display them
    $images_dir = './uploads/';
    $image_files = scandir($images_dir);
    $images_tn_dir = './uploads/thumbnails/';
    $image_tn_files = scandir($images_tn_dir);
    $ignore = Array(".", "..", "thumbnails");
    $valid_ext = Array("jpeg", "jpg", "png");
    $valid_jpeg = Array("jpeg", "jpg");
    $valid_png = Array("png");

    if(count($image_files) > 3) {
      echo '<div class="gallery">';

      foreach($image_files as $imgName){
        //get file extension
        $ext = pathinfo($imgName, PATHINFO_EXTENSION);
        if(!in_array($imgName, $ignore) && in_array($ext, $valid_ext)) {
          
          //check if thumbnail already exists, if no creates it
          if(!in_array($imgName, $image_tn_files)){
            $img = null;
            
            //load the image
            if(in_array($ext, $valid_jpeg)) {
              $img = imagecreatefromjpeg("{$images_dir}{$imgName}");
            }
            else if(in_array($ext, $valid_png)) {
              $img = imagecreatefrompng("{$images_dir}{$imgName}");
            }

            if($img != null){
              $width = imagesx($img);
              $height = imagesy($img);

              $tmp_img = null;

              //only resize if needed...
              if($width > 400){
                $new_width = 400;
                $new_height = floor( $height * ( 400 / $width ) );
                $tmp_img = imagecreatetruecolor( $new_width, $new_height );

                // copy and resize old image into new image 
                imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
              }
              //if no resize is needed, just copy to thumbnail dir
              else{
                $tmp_img = imagecreatetruecolor( $width, $height );
                imagecopy($tmp_img, $img, 0, 0, 0, 0, $width, $height); 
              }

              // save thumbnail into a file
              if(in_array($ext, $valid_jpeg)){
                imagejpeg($tmp_img, "{$images_tn_dir}{$imgName}");
              }
              else if(in_array($ext, $valid_png)){
                imagepng($tmp_img, "{$images_tn_dir}{$imgName}");
              }
            }
          }

          //display thumbnail
          echo "<img class=\"artwork\" src='$images_tn_dir$imgName' />";
        }
      }
    }
    else {
      echo '<div class="wrapperInfoText">
              <div class="infoText">
                <p>There is no artwork (yet) in this gallery.</p>
              </div>';
    }

    echo '</div>';

    //load templateDown
    html_bodyDown();
  }

  //Include the bottom of the document, script & co
  html_foot('artwork', $mob);

?>