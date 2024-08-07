<?php  
  $index = 0;
  $page_title = "Basic PHP";
  $login_text = "login";
  $text_input = ["username", "password"];
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
      <!-- Title -->
      <div class="title"><?= ucfirst($login_text) ?></div>
      <!-- Login -->
      <form action="success.php" method="post">
        <!-- Text Input -->
        <?php foreach($text_input as $data) : ?>
          <div class="input-card">
            <!-- Title -->
            <label for="<?= $data ?>" class="input-title"><?= ucfirst($data) ?></label>
            <!-- Card -->
            <div class="text-input-card">
              <!-- Icon -->
              <div class="text-input-icon-card">
                <img src="icon/<?= $data ?>-icon.png" class="text-input-icon" />
              </div>
              <!-- Input -->
              <input 
                type="<?= $index === 0 ? 'text' : 'password'?>" 
                id="<?= $data ?>"
                class="text-input" 
                name="<?= $data ?>"
                placeholder="Type your <?= $data ?>" 
              />
            </div>
          </div>
        <?php $index++; endforeach ?>
        <!-- Submit -->
        <div>
          <button type="submit" name="submit" class="submit-button"><?= strtoupper($login_text) ?></button>        
        </div>
      </form>
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
    height: 97vh;
    background-color: #F8F8F8;
  }
  .card {
    box-sizing: border-box;
    width: 32%;
    height: 370px;
    padding: 36px;
    border-radius: 14px;
    background-color: #FFFFFF;
    box-shadow: rgba(14, 63, 126, 0.06) 0px 0px 0px 1px, rgba(42, 51, 70, 0.03) 0px 1px 1px -0.5px, rgba(42, 51, 70, 0.04) 0px 2px 2px -1px, rgba(42, 51, 70, 0.04) 0px 3px 3px -1.5px, rgba(42, 51, 70, 0.03) 0px 5px 5px -2.5px, rgba(42, 51, 70, 0.03) 0px 10px 10px -5px, rgba(42, 51, 70, 0.03) 0px 24px 24px -8px;
  }
  .title {
    font-size: 28px;
    font-weight: 800;
    color: #353534;
    text-align: center;
    margin-bottom: 36px;
  }
  .input-card {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 20px;
  }
  .input-title {
    font-size: 12px;
    font-weight: 500;
    color: #626165;
    cursor: pointer;
  }
  .text-input-card {
    display: flex;
    align-items: center;
    padding-bottom: 4px;
    border-bottom: 1.2px solid #C1C1C1;
  }
  .text-input-icon-card {
    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .text-input-icon {
    width: 14px;
    height: 14px;
  }
  .text-input {
    border: none;
    width: 100%;
  }
  .text-input:focus {
    outline: none;
  }
  .submit-button {
    width: 100%;
    height: 42px;
    margin-top: 20px;
    font-size: 13px;
    font-weight: 600;
    color: #FFFFFF;
    border: none;
    border-radius: 20px;
    background-color: #1B75D0;
    cursor: pointer;
  }
  .submit-button:hover {
    opacity: 90%;
  }
  @media screen and (max-width: 900px) {
    .card {
      width : 56%;
    }
  }
  @media screen and (max-width: 600px) {
    .card {
      width : 88%;
    }
  }
</style>