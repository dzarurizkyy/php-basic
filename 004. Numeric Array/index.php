<?php
  $page_title = "PHP Basic";

  // Array
  $column_title = ["No.", "Name", "Class", "Gender"];

  // Numeric Array
  $students = [
    [1, "Noah", "5", "Male"],
    [2, "Oliver", "6", "Female"],
    [3, "George", "6", "Male"]
  ];
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
    <table border="1" cellspacing="0" cellpadding="8">
      <thead>
        <!-- Foreach -->
        <?php foreach($column_title as $title) : ?>
          <th><?= $title ?></th>
        <?php endforeach ?>
      </thead>
      <tbody>
        <!-- Nested Foreach -->
        <?php foreach($students as $student) : ?>
          <tr>
            <?php foreach($student as $data) : ?>
              <td><?= $data ?></td>
            <?php endforeach ?>
          </tr>
        <?php endforeach ?> 
      </tbody>
    </table>
  </body>
</html>

<style>
  td {
    text-align: center;
  }
</style>