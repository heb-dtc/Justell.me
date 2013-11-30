<?php

function html_head($section) {
  echo '<!DOCTYPE html>
        <html>
          <head>
            <meta http-equiv="content-type" content="text/html; charset=UTF-8">
            <title>Just Tell Me! - '.ucfirst($section).'</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <meta charset="utf-8">
							<link href="http://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet" type="text/css">
							<link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
              <link rel="stylesheet" href="style/style_common.css" />
              <link rel="stylesheet" href="style/style_'.$section.'.css" />
              <link rel="icon" type="image/png" href="./favicon/fav3.png" />
          </head>';
}

function html_bodyUp($mobile = false) {
  if(!$mobile){
    echo '<body class="bodydesktop">
      <div class="update" id="updt">
        <div class="fakepadding_top"></div>
        <div class="wrapperContent" id="wrpCtt">
          <div class="content" id="ctt">';
  }
}

function html_bodyDown(){
  echo '</div>
        </div>
        <div class="fakepadding_bottom"></div>
        <div class="menufooter">
          <span class="textmenufooter">
            <a href="/" class="customlink">Home</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <a href="/map" class="customlink">Sticker Map</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <a href="/artwork" class="customlink">Artwork</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <a href="/info" class="customlink">Info</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <a href="http://prjctcld.com" class="customlink" target="_blank">Project Cloud</a>
          </span>
          </div>
      </div>';
}

function html_foot($section, $mobile = false,  $map = false) {
  if(!$mobile) {  
    function underline($section,$current) {
      if($section == $current) {
        return 'underlined';
      }
      return '';
    }
  }

  //add JQuery and page scripts
  echo '  <script type="text/javascript" src="script/jquery.js"></script>
          <script type="text/javascript" src="script/app-'.$section.'.js"></script>';
  
  //add GMAP scripts if needed
  if($map) {
    echo "<script type=\"text/javascript\" src=\"http://maps.googleapis.com/maps/api/js?libraries=visualization&sensor=true\"></script>
          <script type=\"text/javascript\" src=\"script/gmap3.min.js\"></script>"; 
  }

  //add Google Analytics and close body,html tags
  echo " <script type=\"text/javascript\">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-39461066-1']);
            _gaq.push(['_trackPageview']);
            (function() {
              var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
              ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
          </script>
        </body>
        </html>";
}
?>
