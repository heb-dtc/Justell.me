<?php
  // Connect to db
  $dblink = mysql_connect("localhost", "root", "root"); 
  //$dblink = mysql_connect("justell.me.mysql", "justell_me", "bobcool87");
  $table  = mysql_select_db("justell_me", $dblink);
?>
