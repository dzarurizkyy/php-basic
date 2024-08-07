<?php 
  // Initial Confiquration
  $conn = mysqli_connect("localhost", "root", "", "php_basic");

  // Send Query SQL to RDBMS
  function query($query) {
    global $conn;  
    $result = mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }

    return $rows;
  }
?>