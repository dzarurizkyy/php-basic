<?php 
  // Import File
  require "model.php";

  // Function
  $students     = Search($columns, $_GET["search"]);
  $students     = Pagination($students);

  // Variable
  $index_column = 0;
  $index_row    = $formula + 1;
?>

<!-- Table Box -->
<div class="table" id="table" style="margin: 0;">
  <?php if($total_row !== 0 ) : ?>
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
       <a onclick="changePage(<?= $active_page != 1 ? $active_page - 1 : 1 ?>)" class="pagination-direction">
        <i class="fa fa-angle-left"></i> 
      </a>
      <!-- Page Number -->
      <?php for($i = 1; $i <= $total_page; $i++) : ?>
        <a onclick="changePage(<?= $i ?>)" class="<?= $i == $active_page ? 'pagination-active' : ''?>">
          <?= $i ?>
        </a>
      <?php endfor ?>
      <!-- Next -->
      <a onclick="changePage(<?= $active_page != $total_page ? $active_page + 1  :  $active_page ?>)" class="pagination-direction">
        <i class="fa fa-angle-right"></i> 
      </a>
    </div>
  <?php else : ?>
    <img src="img/assets/Not Found.gif" width="700" >
  <?php endif ?>
</div>