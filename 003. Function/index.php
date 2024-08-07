<?php
  date_default_timezone_set('Asia/Jakarta');
  $page_title = "PHP Basic";

  // Built-in function
  function current_time() {
    return date("h:i A");
  };

  // User-defined function
  function greeting($name = "Buddy") {
    $current_hour = (int)date("h");
    $current_ampm = date("A");

    if ($current_ampm === "AM") {
      if ($current_hour <= 4) {
        return "Night, $name";
      } else {
        return "Morning, $name";
      }
    } else {
      if ($current_hour <= 2) {
        return "Afternoon, $name";
      } else if ($current_hour <= 6) {
        return "Evening, $name";
      } else {
        return "Night, $name";
      } 
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $page_title ?></title>
    <link rel="icon" type="image/x-icon" href="../php-logo.svg" />
  </head>
  <body>
    <!-- Container -->
    <div class="container" onmousedown="return false;" onselectstart="return false;">
      <!-- Time -->
      <div class="time"><?= current_time() ?></div>
      <!-- Greeting -->
      <div class="greeting">Good <?= greeting("Dzaru") ?>!</div>
    </div>
  </body>
</html>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
  * {
    font-family: "Montserrat", sans-serif;
  }
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 90vh;
    background-color: #2F3645;
  }
  .container {
    text-align: center;
    color: #EEEDEB;
  }
  .time {
    font-size: 400%;
    font-weight: 600;
    margin-bottom: 14px;
  }
  .greeting {
    font-size: 130%;
  }
</style>