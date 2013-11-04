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
              <link href="http://fonts.googleapis.com/css?family=Sue+Ellen+Francisco" rel="stylesheet" type="text/css">
              <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
						  <link href="http://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet" type="text/css">
							<link href="http://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet" type="text/css">
							<link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
              <link rel="stylesheet" href="style/style_common.css" />
              <link rel="stylesheet" href="style/style_'.$section.'.css" />
              <link rel="icon" type="image/png" href="http://justell.me/favicon/1.png" />
          </head>';
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
  echo '  <script type="text/javascript" src="script/jquery.js"></script>';
  if($map) {
    echo '<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=visualization&sensor=true"></script>
          <script type="text/javascript" src="script/gmap3.min.js"></script>';
  } 
  echo "  <script type=\"text/javascript\" src=\"script/app-".$section.".js\"></script>
          <script type=\"text/javascript\">
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
