<?php 
  require "conn.php";

  // READ ALL
  $students = AssocFetch("SELECT * FROM student");
  
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
        if(Execute("UPDATE student SET $values WHERE id = $student_id")) {
          echo "
            <script>
              alert('Data was successfully updated ✅');
              document.location.href = 'index.php';
            </script>";
        }
        else {
          echo "
            <script>
              alert('Failed to update data ❌');
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
?>