<?php 
  $page_title = "PHP Basic";
  $table_title = "List of Students"; 
  $static_data = ["No.", "Photo"];
  $index = 1;

  // Connect to RDBMS
  require 'function.php';
  $students = query("SELECT * FROM student");

  // Sort Data
  function sortStudents($data1, $data2) {
    return strcmp($data1["major"], $data2["major"]);
  }

  usort($students, "sortStudents")
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
    <!-- Card -->
    <div>
      <!-- Title -->
      <div class="title"><?= strtoupper($table_title) ?></div>
      <!-- Table -->
      <table border="1" cellspacing="0" cellpadding="6">
        <!-- Column Title -->
        <thead>
          <?php foreach($static_data as $column) :?>
            <th><?= strtoupper($column) ?></th>
          <?php endforeach ?>
          <?php for($i = 1; $i < count($students[0]); $i++) : ?>
            <th><?= strtoupper(array_keys($students[0])[$i]) ?></th>
          <?php endfor ?>
        </thead>
        <!-- Column Data -->
        <tbody>
          <?php foreach($students as $student) : ?>
            <tr>
              <td><?= $index ?>.</td>
              <td><img src="img/<?=$student["name"]?>.jpg" width="60"/></td>
              <?php for($i = 1; $i < count($student); $i++) : ?>
                <td><?= $student[array_keys($student)[$i]] ?></td>
              <?php endfor?>
            </tr>
          <?php $index++; endforeach ?>
        </tbody>
      </table>
    </div>
  </body>
</html>

<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 97vh;
  }
  div .title {
    font-size: 24px;
    font-weight: 700;
    text-align: center;
    margin-top: 6px;
    margin-bottom: 26px;
  }
  th {
    background-color: #F7DCB9;
  }
  td:first-child {
    text-align: center;
  }
</style>