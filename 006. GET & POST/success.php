<?php  
  $page_title = "Basic PHP";
  if ($_POST["username"] === "" || $_POST["password"] === "" || empty($_POST["username"]) || empty($_POST["password"])) {
    echo "
      <script>
        alert('Please enter your username and password 😊');
        window.location.href='index.php';
      </script>
    ";
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link rel="icon" type="image/x-icon" href="../php-logo.svg" />
  </head>
  <body>
    <!-- Container -->
    <div class="card">
      <!-- Icon -->
      <div><img src="icon/success-icon.png" class="icon"/></div>
      <!-- Title -->
      <div class="card-title">
        <div class="title">Hey <?= ucfirst($_POST["username"]) ?>👋</div>
        <div class="sub-title">Welcome to our app</div>
      </div>
      <!-- Description -->
      <div class="desc">Let's start with a quick product tour and we will have you up and running in no time!</div>
      <!-- Button -->
      <div class="button"><a href="index.php">Logout</a></div>
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
    height: 97vh;
    justify-content: center;
    align-items: center;
  }
  .card {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 18px;
  }
  .icon {
    width: 120px;
    height: 120px;
  }
  .title, .sub-title {
    font-size: 26px;
    font-weight: 600;
    color: #242A35;
    text-align: center;
    line-height: 38px;
  }
  .desc {
    font-size: 14px;
    font-weight: 450;
    text-align: center;
    line-height: 24px;
    color: #3B4453;
    padding: 0px 18%;
  }
  .button {
    margin-top: 28px;
  }
  .button a {
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    padding: 12px 48px;
    color: #FFFFFF;
    background-color: #F94C4A;
    border-radius: 30px;
  }
  .button a:hover {
    opacity: 90%;
  }
  @media screen and (max-width: 600px) {
    .title, .sub-title {
      font-size: 22px;
      font-weight: 700;
    }
    .desc {
      font-size: 12px;
      padding: 0px 12%;
    }
  }
</style>