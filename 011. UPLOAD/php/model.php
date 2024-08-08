<?php 
  require "conn.php";

  // READ ALL
  $students = AssocFetch("SELECT * FROM student ORDER BY major ASC");
      
  // READ BY ID
  {
    function ReadByID() {
      if(isset($_GET["update"])) {
        $student_id = $_GET["update"];
        $student    = NumericFetch("SELECT * FROM student WHERE id = $student_id")[0];
        
        return $student;
      }
    }

    $student = ReadByID();
  }

  // COLUMN TABLE
  {
    $columns = [];
  
    for ($i = 1; $i < count($students[0]); $i++) {
      $columns[] = array_keys($students[0])[$i]; 
    }
  }
  
  // CREATE
  function Create($columns) {
    if (isset($_POST["insert_submit"])) {
      $add_data = [];
  
      // Save Form Data
      for ($i = 0; $i < count($columns); $i++) {
        $add_data[] = htmlspecialchars($_POST[$columns[$i]]);
      }
  
      // Format Values SQL
      $values = "";
  
      for ($i = 0; $i < count($add_data); $i++) {
        $values .= "'" . $add_data[$i] . "'";
        if ($i < count($add_data) - 1) {
          $values .= ", ";
        }
      }
      
      // Execute Query SQL
      if(Upload()) {
        if (Execute("INSERT INTO student VALUES ('', $values)") > 0) {
          echo "
            <script>
              alert('Data was successfully added ✅');
              document.location.href = 'index.php';
            </script>";
        } else {
          echo "
            <script>
              alert('Failed to add data ❌');
            </script>";
        }
      }
    }
  }

  // UPDATE
  function Update($columns) {
    if(isset($_GET["update"])) {
      $student_id = $_GET["update"];
      
      echo "
        <script>
          document.location.href = '#modal-form-update';
        </script>";
      
      if(isset($_POST["update_submit"])) {
        $update_data = [];
  
        // Save Form Data
        for($i = 0; $i < count($columns); $i++) {
          $update_data[] = htmlspecialchars($_POST[$columns[$i]]);
        }
        
        // Format Values SQL
        $values = "";
    
        for($i = 0; $i < count($update_data); $i++) {
          $values .= strtolower($columns[$i]) . ' = ' . "'". $update_data[$i] . "'";
  
          if($i < count($update_data) - 1) {
            $values .= ", ";
          }
        }
  
        // Execute Query SQL
        if(Upload()) {
          if(Execute("UPDATE student SET $values WHERE id = $student_id")) {
            echo "
              <script>
                alert('Data was successfully updated ✅');
              </script>";
          }
          echo "
            <script>
              document.location.href = 'index.php';
            </script>";
        }
      }
    }
  }

  // DELETE
  function Delete() {
    if(isset($_GET["delete"])) {
      $student_id = $_GET["delete"];
  
      // Execute QUERY SQL
      if (Execute("DELETE FROM student WHERE id = $student_id") > 0) {
        echo "
          <script>
            alert('Data was successfully deleted ✅');
            document.location.href = 'index.php';
          </script>";
      }
      else {
        echo "
          <script>
            alert('Failed to delete data ❌');
          </script>";
      }
    }
  }

  // SEARCH
  function Search($columns) {
    $values = "";
    
    // Format Values SQL
    for($i = 0; $i < count($columns); $i++) {
      $values .= $columns[$i] . " LIKE '%" . $_POST["search"] . "%'";
      
      if ($i < count($columns) - 1) {
        $values .= " OR ";
      }
    }

    // Execute Query SQL
    $students = AssocFetch("SELECT * FROM student WHERE $values");

    return $students;
  }

  // UPLOAD
  function Upload() {
    if(isset($_FILES["image"])) {
      $fileName     = $_FILES["image"]["name"];
      $fileSize     = $_FILES["image"]["size"];
      $fileTmp      = $_FILES["image"]["tmp_name"];
      $error        = $_FILES["image"]["error"];
      $formatFile   = explode(".", $fileName);
      
      // Check Image Empty or Not
      if($error === 4) {
        return true;
      }

      // Check Format File
      if(strtolower(end($formatFile)) !== "jpg") {
        echo "
          <script>
            alert('This file format is not supported. You can only upload jpg files 😇.');
          </script>";
        return false;
      }

      // Check Size File
      if($fileSize > 200000) {
        echo "
          <script>
            alert('This file is too large to be uploaded. You can only upload file maximum 2 MB 😇.');
          </script>";
        return false;
      }

      // Upload File
      move_uploaded_file($fileTmp, "img/" . ucwords(htmlspecialchars($_POST["name"])) . "." . strtolower(end($formatFile)));
    }

    return true;
  }
?>