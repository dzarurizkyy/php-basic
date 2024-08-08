<?php  
  // Dynamic Variable
  $title  = "Register";
  $input  = ["name", "email", "password", "confirm"];
  $icon   = ["user", "google", "lock", "lock"];

  // Increment Variable
  $index  = 0;

  // Import File
  require("model.php");

  // Function
  Registration($input);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta Tag -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Page Title -->
    <title>PHP Basic</title>
    <!-- Page Icon -->
    <link rel="icon" type="image/x-icon" href="../../php-logo.svg" />
    <!-- External CSS -->
    <link rel="stylesheet" href="../css/auth.css" />
    <!-- External Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  </head>
  <body>
    <!-- Card -->
    <div class="card">
      <!-- Title -->
      <div class="card-title"><?= $title ?></div>
      <!-- Form -->
      <form action="" method="post" class="card-form">
        <!-- Input Form Box -->
        <?php foreach($input as $data) : ?>
          <div class="card-form-input">
            <!-- Label -->
            <label for="<?= $data ?>"><?= $index !== (count($input) - 1) ? ucfirst($data) : ucfirst($data) . ' Password' ?></label>
            <!-- Input Box -->
            <div class="card-form-input-text">
              <!-- Icon -->
              <i class="fa fa-<?= $icon[$index]?>"></i>
              <!-- Input -->
              <input 
                type="<?= $index !== (count($input) - 1) && $index !== (count($input) - 2) ? 'text' : 'password'?>" 
                name="<?= $data ?>" 
                id="<?= $data ?>" 
                placeholder="Type your <?= $index !== (count($input) - 1) ? $data : $data . ' password' ?>"
                autocomplete="off"
                required />
            </div>
          </div>
        <?php $index++; endforeach ?>
        <!-- Button Box -->
        <div class="card-form-button">
          <!-- Button -->
          <button type="submit" name="registration_submit"><?= strtoupper($title) ?></button>
        </div>
      </form>
    </div>
  </body>
</html>