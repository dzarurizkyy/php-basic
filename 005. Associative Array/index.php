<?php 
  $page_title = "PHP Basic";
  
  // Associative Array
  $students = [
    [ 
      "name" => "Nrima Simanjuntak",
      "NPM" => "21962107187", 
      "major" => "Computer Science",
      "email" => "nrimasimanjuntak@gmail.com"
    ], 
    [
      "name" => "Raihan Wasita",
      "NPM" => "21099147249", 
      "major" => "Mechanical Engineering",
      "email" => "raihanwasita@gmail.com"
    ],
    [
      "name" => "Rachel Mandasari",
      "NPM" => "23791669127", 
      "major" => "Accounting",
      "email" => "rachelmandasari@gmail.com"
    ],
    [
      "name" => "Ira Wijayanti",
      "NPM" => "11315410821", 
      "major" => "Business Administrastion",
      "email" => "irawijayanti@gmail.com"
    ],
    [
      "name" => "Rudi Najmudin",
      "NPM" => "1652494275", 
      "major" => "Civil Engineering",
      "email" => "rudinajmudin@gmail.com"
    ],
  ];

  // Additional Tools
  $no = 1;

  function sortStudentsByMajor($data1, $data2) {
    return strcmp($data1["major"], $data2["major"]);
  };

  usort($students, "sortStudentsByMajor");
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
    <!-- Associative Array -->
    <div class="container">
      <table cellspacing="0" cellpadding="8">
        <thead>
          <th>No.</th>
          <th>Image</th>
          <!-- For Loop -->
          <?php for($i = 0; $i < count($students[0]); $i++) : ?>
            <th><?= ucfirst(array_keys($students[0])[$i]) ?></th>
          <?php endfor?>
        </thead>
        <tbody>
          <!-- For Each -->
          <?php foreach($students as $student) : ?>
            <tr>
              <td><div class="square"><?= $no ?>.</div></td>
              <td><img src="img/<?=$student["name"]?>.jpg" /></td>
              <td><?= $student["name"] ?></td>
              <td><?= $student["NPM"] ?></td>
              <td><?= $student["major"] ?></td>
              <td><?= $student["email"] ?></td>
            </tr>
          <?php $no++; endforeach?>
        </tbody>
      </table>
    </div>
  </body>
</html>

<style>
  * {
    color: #393E46;
  }
  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 97vh;
  }
  th {
    background-color: #F2E7D5;
    border-top: 1px solid black;
  }
  td:first-child {
    text-align: center;
  }
  th, td {
    border-bottom: 1px solid black;
  }  
  div .square {
    width: 34px;
    line-height: 34px;
    text-align: center;
    transition: 1s;
    cursor: pointer;
    background-color: #F2E7D5;
  }
  div .square:hover {
    transform: rotate(360deg);
    border-radius: 100%;
  }
  img {
    width: 64px;
  }
</style>