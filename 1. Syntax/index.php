<?php
  $first_name  = "Dzaru ";
  $last_name   = "Rizky";
  $current_age = date("Y") - 2003; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP Basic</title>
    <link rel="icon" type="image/x-icon" href="../php-logo.svg" />
  </head>
  <body>
    <!-- Container -->
    <div class="container">
      <!-- Title -->
      <div class="title">
          Hello, <?php echo $first_name.$last_name?>
        </div>
      <!-- Description -->
      <div class="desc">
        Your current age is <?php echo $current_age?>
      </div>
    </div>
  </body>
</html>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
  * {
    font-family: "Montserrat", sans-serif;
  }
  .container {
    margin: 40px 20px;
    display: flex;
    flex-direction: column;
    gap: 14px;
  }
  .title {
    font-size: 32px;
    font-weight: 700;
  }
  .desc {
    font-size: 16px;
    font-weight: 500;
  }
</style>