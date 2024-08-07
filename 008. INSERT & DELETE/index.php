<?php
  $page_title   = "PHP Basic";
  $index_add    = 0;
  $index_column = 0;
  $index_row    = 1;

  require "function.php";

  $students = query("SELECT * FROM student");
  $columns = [];

  for ($i = 1; $i < count($students[0]); $i++) {
    $columns[] = array_keys($students[0])[$i]; 
  }

  $addData = [];

  if (isset($_POST["submit"])) {
    for ($i = 0; $i < count($columns); $i++) {
      $addData[] = htmlspecialchars($_POST[$columns[$i]]);
    }

    $values = "";

    for ($i = 0; $i < count($addData); $i++) {
      $values .= "'" . $addData[$i] . "'";
      if ($i < count($addData) - 1) {
        $values .= ", ";
      }
    }

    if (execute("INSERT INTO student VALUES ('', $values)") > 0) {
      echo "
        <script>
          alert('Data was successfully added ✅');
          document.location.href = 'index.php';
        </script>";
      $modal_add = 1;
    } else {
      echo "
        <>
          alert('Failed to add data ❌');
        </script>";
    }

  }

  if(isset($_GET["id"])) {
    $student_id = $_GET["id"];

    if (execute("DELETE FROM student WHERE id = $student_id") > 0) {
      echo "
        <script>
          alert('Data was successfully deleted ✅');
          document.location.href = 'index.php';
        </script>";
    }
    else {
      echo "
        <script>
          alert('Failed to data ❌');
        </script>";
    }
  }
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
    <div class="navbar">
      <div class="navbar-grid-1">
        <div class="navbar-grid-1-text-1">Dashboard</div>
        <div class="navbar-grid-1-text-2">Student</div>
      </div>
      <a href="#modal-form" class="modal-form-add">
        <div class="navbar-grid-2">Add Student</div>
      </a>
    </div>
    <div class="modal" id="modal-form">
      <div class="modal-form">
        <div class="modal-form-title">
          <div>Add Student Data</div>
          <a href="#">
            <div>&times;</div>
          </a>
        </div>
        <div class="modal-form-card">
          <form action="" method="post">
            <div class="modal-form-card-input">
              <?php foreach($columns as $column) : ?>
                <label for="<?= $column ?>">
                  <?= $index_add !== 1 ? ucfirst($column) : strtoupper($column) ?>
                </label>
                <input 
                  type="text" 
                  id="<?= $column ?>" 
                  name="<?= $column ?>" 
                  placeholder="Enter <?= $index_add !== 1 ? ucfirst($column) : strtoupper($column) ?>"
                  required 
                />
              <?php $index_add++; endforeach ?>
            </div>  
            <div class="modal-form-button">
              <a href="#">
                <div class="modal-form-button-close">Close</div>
              </a>
              <button class="modal-form-button-save" name="submit">Save Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="table">
      <table border="1" cellspacing="0" cellpadding="16">
        <thead>
          <th>No</th>
          <th>Image</th>
          <?php foreach($columns as $column) : ?>
            <th><?= $index_column !==  1 ? ucfirst($column) : strtoupper($column)?></th>
          <?php $index_column++; endforeach ?>
          <th>Action</th>
        </thead>
        <tbody>
          <?php foreach($students as $student) : ?>
            <tr>
              <td><?= $index_row ?></td>
              <td><img src="img/<?= $student["name"]?>.jpg" width="60"/></td>
              <?php foreach($columns as $column) : ?>
                <td><?= $student[$column] ?></td>
              <?php endforeach ?>
              <td>
                <button class="table-button-edit">Update</button>
                <a href="index.php?id=<?= $student["id"]?>">
                  <button class="table-button-delete" onclick="return confirm('Are you sure want to delete?')">
                    Delete
                  </button>
                </a>
              </td>
            </tr>
            <?php $index_row++; endforeach ?>
        </tbody>
      </table>
    </div>
  </body>
</html>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
  * {
    font-family: "Montserrat", sans-serif;
  }
  body {
    margin: 0;
  }
  a {
    text-decoration: none;
  }
  .navbar {
    background-color: #34495E;
    color: #FFFFFF;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 14px;
  }
  .navbar-grid-1 {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 18px;
    cursor: pointer;
  }
  .navbar-grid-1-text-1 {
    font-size: 18px;
    font-weight: 700;
    border-right: 1.4px solid #FFFFFF;
    padding-right: 14px;
  }
  .navbar-grid-1-text-2 {
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
  }
  .navbar-grid-1-text-2:hover, .navbar-grid-2:hover {
    opacity: 92%;
  }
  .navbar-grid-2 {
    display: flex;
    align-items: center;
    font-size: 12px;
    font-weight: 700;
    padding: 8px 12px;
    border-radius: 6px;
    background-color: #059862;
    cursor: pointer;
  }
  .modal {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    visibility: hidden;
    opacity: 0;
    transition: all 0.4s;
  }
  .modal:target {
    visibility: visible;
    opacity: 1;
  }
  .modal-form {
    width: 34%;
    padding: 30px 20px;
    border-radius: 20px;
    background-color: #FFFFFF;
  }
  .modal-form-add {
    color: #FFFFFF;
  }
  .modal-form-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 12px;
    border-bottom: 1.4px solid rgba(144, 144, 144, 0.4);
    margin-bottom: 22px;
  }
  .modal-form-title > div {
    font-size: 20px;
    font-weight: 700;
  }
  .modal-form-title > a {
    font-size: 30px;
    color: rgba(144, 144, 144, 0.6);
    font-weight: 500;
    transition: all 0.4s;
  }
  .modal-form-title > a:hover {
    color: rgba(144, 144, 144, 1);
  }
  .modal-form-card-input {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .modal-form-card-input > label {
    font-size: 13px;
    font-weight: 550;
    color: #171717;
    cursor: pointer;
  }
  .modal-form-card-input > input {
    border: 1px solid rgba(144, 144, 144, 0.6);
    border-radius: 4px;
    padding: 8px 10px;
    margin-bottom: 8px;
  }
  .modal-form-button {
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
    margin-top: 30px;
    gap: 10px;
  }
  .modal-form-button-close {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .modal-form-button-close, .modal-form-button-save {
    width: 88px;
    height: 32px;
    color: #FFFFFF;
    font-weight: 600;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
  }
  .modal-form-button-close:hover, .modal-form-button-save:hover {
    opacity: 92%;
  }
  .modal-form-button-close {
    background-color: #6C757E;
  }
  .modal-form-button-save {
    background-color: #0778F7;
  }
  table {
    border: 1px solid #EAEAEA;
    border-collapse: collapse;
  }
  .table {
    display: flex;
    justify-content: center;
    align-items: center;
    height: auto;  
    font-size: 12px;
    margin-top: 40px;
    margin-bottom: 30px;
  }
  td:first-child {
    text-align: center;
  }
  tr:nth-child(even) {
    background-color: #F9F9F9;
  }
  .table-button-edit, .table-button-delete {
    width: 80px;
    height: 30px;
    font-size: 12px;
    font-weight: 600;
    color: #FFFFFF;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 4px;
  }
  .table-button-edit:hover, .table-button-delete:hover {
    opacity: 90%;
  }
  .table-button-edit {
    background-color: #F0A945;
  }
  .table-button-delete {
    background-color: #D44947;
  }
</style>  