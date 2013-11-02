<?php 

  include_once('includes/db-connect.php');
  
  // Fetch 10 last
  $query = "SELECT * FROM messages ORDER BY timestamp DESC";
  $result = mysql_query($query,$dblink);
  
  $rows = array();
  while($r = mysql_fetch_assoc($result)) {
      $rows[] = $r;
  }
  
  echo json_encode($rows);

 // Do some cleanup if needed
  mysql_close($dblink);
  
?>