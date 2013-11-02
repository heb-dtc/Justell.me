<?php 

  include_once('includes/db-connect.php');
  
  $limit = 1000;
  if(isset($_GET['limit']) && intval($_GET['limit'])) {
    $limit = min($limit,intval($_GET['limit']));
  }
  
  // Fetch all messages
  $query = "SELECT * FROM messages ORDER BY timestamp DESC LIMIT ".$limit;
  $result = mysql_query($query,$dblink);
  
  $rows = array();
  while($r = mysql_fetch_assoc($result)) {
      $rows[] = $r;
  }
  
  header('Content-type: application/json');
  echo json_encode($rows);

 // Do some cleanup if needed
  mysql_close($dblink);
  
?>