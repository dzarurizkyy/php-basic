<?php  
  $conn = mysqli_connect("localhost", "root", "", "php_basic");

  function AssocFetch($query) {
    global $conn;
    $result = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }

    return $rows;
  }

  function NumericFetch($query) {
    global $conn;
    
    $result = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_row($result)) {
      $rows[] = $row;
    }

    return $rows;
  }

  function Execute($query) {
    global $conn;
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
  }
?>