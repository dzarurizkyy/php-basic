<?php 
  $page_title = "PHP Basic";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $page_title ?></title>
    <link rel="icon" type="image/x-icon" href="../php-logo.svg" />
  </head>
  <body>
    <table border="1" cellpadding="6" cellspacing="0" >
      <!-- First Looping -->
      <?php for($i = 1; $i <= 5; $i++) : ?>
        <!-- First Conditional -->
        <?php if($i % 2 === 0) : ?>
          <tr class="even-cell">
        <?php else : ?>
          <tr>
        <?php endif?>
            <!-- Second Looping -->
            <?php for($j = 1; $j <= 4; $j++) : ?>
              <td>
                <!-- Second Conditional -->
                <?php if($i % 2 === 0) : ?>
                  <strong><?= "$i,$j" ?></strong>
                <?php else : ?>
                  <?= "$i,$j" ?>
                <?php endif ?>
              </td>
            <?php endfor?>
          </tr>
      <?php endfor?>
    </table>
  </body>
</html>

<style>
  .even-cell {
    background-color: LightGray;
  } 
</style>