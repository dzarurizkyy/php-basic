<?php
  // Import File
  require "php/model.php";

  // Functions
  VerifySession();
  Create();
  Update();
  Delete();
  
  $students = Pagination($students);
  
  // Increment Variable
  $index_add    = 0;
  $index_update = 1;
  $index_column = 0;
  $index_row    = $formula + 1;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta Tag -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Page Title -->
    <title>PHP Basic</title>
    <!-- Page Icon -->
    <link rel="icon" type="image/x-icon" href="../php-logo.svg" />
    <!-- External CSS -->
    <link type="text/css" rel="stylesheet" href="css/index.css?ver=1.0.0" />
    <!-- External Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Jquery -->
    <script src="javascript/jquery-3.7.1.min.js"></script>
    <!-- External Javascript -->
    <script src="javascript/script.js"></script>
  </head>
  <body>
    <!-- Navbar -->
    <div class="navbar">
      <!-- Left Box -->
      <div class="navbar-grid-1">
        <div class="navbar-grid-1-text-1">Dashboard</div>
        <div class="navbar-grid-1-text-2"><a href="index.php">Student</a></div>
      </div>
      <!-- Center Box -->
      <div class="navbar-grid-2">
        <form action="" method="post">
          <input type="text" placeholder="Search..." name="search" id="search" autofocus autocomplete="off" />
          <button name="search_submit" id="search_submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
      <!-- Right Box -->
      <a href="#modal-form-add" class="modal-form-add">
        <div class="navbar-grid-3">Add Student</div>
      </a>
    </div>
    <!-- Modal Insert -->
    <div class="modal" id="modal-form-add">
      <!-- Card -->
      <div class="modal-form">
        <!-- Title Box -->
        <div class="modal-form-title">
          <!-- Title -->
          <div>Add Student Data</div>
          <!-- Close Button -->
          <a href="index.php"><div>&times;</div></a>
        </div>
        <!-- Form Box -->
        <div class="modal-form-card">
          <!-- Form -->
          <form action="" method="post" enctype="multipart/form-data">
            <!-- Input Form Box -->
            <div class="modal-form-card-input">
              <?php foreach($columns as $column) : ?>
                <!-- Label -->
                <label for="<?= $column ?>">
                  <?= $index_add !== 1 ? ucfirst($column) : strtoupper($column) ?>
                </label>
                <!-- Input -->
                <input 
                  type="text" 
                  id="<?= $column ?>" 
                  name="<?= $column ?>" 
                  placeholder="Enter <?= $index_add !== 1 ? ucfirst($column) : strtoupper($column) ?>"
                  required 
                />
              <?php $index_add++; endforeach ?>
              <!-- Image -->
              <label for="image">Image</label>
              <input type="file" name="image" id="image" required />
            </div>  
            <!-- Button Box -->
            <div class="modal-form-button">
              <!-- Close Button -->
              <a href="index.php"><div class="modal-form-button-close">Close</div></a>
              <!-- Save Button -->
              <button class="modal-form-button-save" name="insert_submit">Save Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal Update -->
    <div class="modal" id="modal-form-update">
      <!-- Card -->
      <div class="modal-form">
        <!-- Title Box -->
        <div class="modal-form-title">
          <!-- Title -->
          <div>Update Student Data</div>
          <!-- Close Button -->
          <a href="index.php"><div>&times;</div></a>
        </div>
        <!-- Form Box -->
        <div class="modal-form-card">
          <!-- Form -->
          <form action="" method="post" enctype="multipart/form-data">
            <!-- Input Form Box -->
            <div class="modal-form-card-input">
              <?php foreach($columns as $column) : ?>
                <!-- Label -->
                <label for="<?= $column ?>">
                  <?= $index_update !== 2 ? ucfirst($column) : strtoupper($column) ?>
                </label>
                <!-- Input -->
                <input 
                  type="text" 
                  id="<?= $column ?>" 
                  name="<?= $column ?>" 
                  value="<?= $student[$index_update] ?>"
                />
              <?php $index_update++; endforeach ?>
              <!-- Image -->
              <label for="image">Image</label>
              <input type="file" name="image" id="image" />  
            </div>
            <!-- Box Button -->
            <div class="modal-form-button">
              <!-- Close Button -->
              <a href="index.php"><div class="modal-form-button-close">Close</div></a>
              <!-- Save Button -->
              <button class="modal-form-button-save" name="update_submit">Edit Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Loading -->
    <div class="loading">
      <img src="img/assets/Loader.gif" width="400" />
    </div>
    <!-- Table Box -->
    <div class="table" id="table">
      <!-- Table -->
      <table border="1" cellspacing="0" cellpadding="16">
        <!-- Column Title -->
        <thead>
          <th>No</th>
          <th>Image</th>
          <?php foreach($columns as $column) : ?>
            <th><?= $index_column !==  1 ? ucfirst($column) : strtoupper($column)?></th>
          <?php $index_column++; endforeach ?>
          <th>Action</th>
        </thead>
        <!-- Column Data -->
        <tbody>
          <?php foreach($students as $student) : ?>
            <tr>
              <!-- No -->
              <td><?= $index_row ?></td>
              <!-- Image -->
              <td><img src="img/<?= $student["name"] ?>.jpg" width="60" /></td>
              <!-- Student Data -->
              <?php foreach($columns as $column) : ?>
                <td><?= $student[$column] ?></td>
              <?php endforeach ?>
              <!-- Action -->
              <td>
                <!-- Update -->
                <a href="index.php?update=<?= $student["id"]?>">
                  <button class="table-button-edit">
                    Update
                  </button>
                </a>
                <!-- Delete -->
                <a href="index.php?delete=<?= $student["id"]?>">
                  <button class="table-button-delete" onclick="return confirm('Are you sure want to delete?')">
                    Delete
                  </button>
                </a>
              </td>
            </tr>
            <?php $index_row++; endforeach;?>
        </tbody>
      </table>
      <!-- Pagination -->
      <div class="pagination">
        <!-- Back -->
        <a href="index.php?page=<?= $active_page != 1 ? $active_page - 1 : 1 ?>" class="pagination-direction">
          <i class="fa fa-angle-left"></i> 
        </a>
        <!-- Page Number -->
        <?php for($i = 1; $i <= $total_page; $i++) : ?>
          <a href="index.php?page=<?= $i ?>" class="<?= $i == $active_page ? 'pagination-active' : ''?>">
            <?= $i ?>
          </a>
        <?php endfor ?>
        <!-- Next -->
        <a href="index.php?page=<?= $active_page != $total_page ? $active_page + 1 : $total_page ?>" class="pagination-direction">
          <i class="fa fa-angle-right"></i>
        </a>
      </div>
    </div>
    <!-- Logout -->
    <a href="index.php?logout=true" class="logout">  
      <i class='fa fa-sign-out'></i>
    </a>
    </div>
  </body>
</html>