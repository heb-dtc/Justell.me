<?php 

  include_once('includes/db-connect.php');
  
  function visitor_country()
  {
      $client  = @$_SERVER['HTTP_CLIENT_IP'];
      $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
      $remote  = $_SERVER['REMOTE_ADDR'];
      $result  = "Unknown";
      if(filter_var($client, FILTER_VALIDATE_IP))
      {
          $ip = $client;
      }
      elseif(filter_var($forward, FILTER_VALIDATE_IP))
      {
          $ip = $forward;
      }
      else
      {
          $ip = $remote;
      }

      $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

      if($ip_data && $ip_data->geoplugin_countryName != null)
      {
          $result = $ip_data->geoplugin_countryName;
      }

      return $result;
  }
 
  $to_add = array('location'=>visitor_country());
  
  foreach($_POST as $k => $p) {
  
    if(!trim($p) == false) {
      $to_add[$k] = mysql_real_escape_string($p);
    }
  }
  
  // Insert
  $query = 'INSERT INTO messages(pseudo,message,location,coords,timestamp) VALUES ("'.$to_add['pseudo'].'","'.$to_add['message'].'","'.$to_add['location'].'","'.$to_add['coords'].'","'.$to_add['timestamp'].'")';
  mysql_query($query,$dblink);
  
  include_once('fetch.php');
  
?>