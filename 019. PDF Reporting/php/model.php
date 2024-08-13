<?php 
  require "conn.php";

  // READ ALL (PAGINATION)
  {
    $students = AssocFetch("SELECT * FROM student ORDER BY major");
  }
      
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
  function Create() {
    if (isset($_POST["insert_submit"])) {
      global $columns;

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
  function Update() {
    if(isset($_GET["update"])) {
      global $columns;
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
  function Search() {
    global $columns;

    $values = "";
    
    // Format Values SQL
    for($i = 0; $i < count($columns); $i++) {
      $values .= $columns[$i] . " LIKE '%" . $_GET["search"] . "%'";
      
      if ($i < count($columns) - 1) {
        $values .= " OR ";
      }
    }

    // Execute Query SQL
    $students   = AssocFetch("SELECT * FROM student WHERE $values");

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

  // REGISTRATION
  function Registration() {
    if(isset($_POST["registration_submit"])) {
      global $conn;

      $add_data = [];

      // Save Form Data
      $add_data[0] = htmlspecialchars(stripslashes($_POST["name"]));
      $add_data[1] = htmlspecialchars(strtolower(stripslashes($_POST["email"])));
      $add_data[2] = mysqli_real_escape_string($conn, $_POST["password"]);
      $add_data[3] = mysqli_real_escape_string($conn, $_POST["confirm"]);

      // Verify Password and Confirmation Password
      if ($add_data[2] !== $add_data[3]) {
        echo "
          <script>
            alert('Password and confirm password does not match 😇.');
          </script>
        ";
        return;
      }

      // Verify Email
      if(NumericFetch("SELECT * FROM users WHERE email = '$add_data[1]'")) {
        echo "
          <script>
            alert('Email address is already exist 😇.');
          </script>
        ";
        return;
      }

      $add_data[2] = password_hash($add_data[2], PASSWORD_DEFAULT);

      // Format Values SQL
      $values = "";

      for ($i = 0; $i < count($add_data) - 1; $i++) {
        $values .= "'" . $add_data[$i] . "'";

        if ($i < count($add_data) - 2) {
          $values .= ", ";
        }
      }

      if(Execute("INSERT INTO users VALUES ('', $values)")) {
        echo "
          <script>
            alert('Success, your account has been created ✅.');
            document.location.href = 'login.php';
          </script>
        ";
      }
      else {
        echo "
          <script>
            alert('Failed to register account ❌.');
            document.location.href = 'registration.php';
          </script>
        ";
      }

      return;
    }
  }

  // LOGIN
  function Login($columns) {
    if(isset($_POST["login_submit"])) {
      $verify = [];
      
      // Save Form Data
      for($i = 0; $i < count($columns); $i++) {
        $verify[] = htmlspecialchars($_POST[$columns[$i]]);
      }

      // Execute Query SQL
      if(AssocFetch("SELECT * FROM users WHERE email = '$verify[0]'")) {
        $user = AssocFetch("SELECT * FROM users WHERE email = '$verify[0]'")[0];
        
        // Authentication
        if(password_verify($verify[1], $user["password"])) {
          // Authorization
          MakeCookie($user);
          MakeSession();
          echo "
            <script>
              alert('Login Success ✅');
              window.location.href='../index.php';
            </script>";
        }
        else {
          echo "
            <script>
              alert('Incorrect password. Please try again later ❌.');
            </script>";
        }
      }
      else {
        echo "
            <script>
              alert('Email not found. Please registration your account first ❌.');
            </script>";
      }
    }
  }

  // SESSION 
  function MakeSession() {
    $_SESSION["login"] = true;
  }

  function VerifySession($option = "Home") {
    // Login Page
    if ($option === "Login") {
      if (isset($_SESSION["login"])) {
        if($_SESSION["login"]) {
          echo "<script>window.location.href='../index.php'</script>";
        }
      }
    }
    // Home Page 
    else {
      // Logout
      session_start();
      if (isset($_GET["logout"])) {
        if ($_GET["logout"]) {
          // Remove Cookie
          {
            setcookie("id", "", time() - 120, "/");
            setcookie("key", "", time() - 120, "/");
          }
          // Remove Session
          {
            session_unset();
            session_destroy();
          }
          echo "<script>window.location.href='php/login.php'</script>";
        }
      } 
      // Forbidden
      else {
        if (!isset($_SESSION["login"])) {
          echo "<script>window.location.href='php/login.php'</script>";
        }
      }
    }
  }

  // COOKIE
  function MakeCookie($user) {
    if (isset($_POST["remember"])) {
      setcookie("id", $user["id"], time() + 120, "/");
      setcookie("key", hash('sha256', $user["email"]), time() + 120, "/");
    }
  }
  
  function VerifyCookie() {
    session_start();
    if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
      $id = $_COOKIE["id"];
      $user = AssocFetch("SELECT * FROM users WHERE id = $id")[0];

      if(hash('sha256', $user["email"]) === $_COOKIE["key"]) {
        $_SESSION["login"] = true;
      }
    }
  }

  // PAGINATION
  function Pagination($students) {
    global $columns;

    $total_data   = 3;
    $total_row    = count($students);
    $total_page   = ceil($total_row / $total_data);
    $active_page  = isset($_GET["page"]) ? $_GET["page"] : 1;
    $formula      = ($total_data * $active_page) - $total_data;
    $values       = "";
    
    // Format Values SQL
    if(isset($_GET["search"])) {
      for($i = 0; $i < count($columns); $i++) {
        $values .= $columns[$i] . " LIKE '%" . $_GET["search"] . "%'";
        
        if ($i < count($columns) - 1) {
          $values .= " OR ";
        }
      }
      $students = AssocFetch("SELECT * FROM student WHERE $values ORDER BY major ASC LIMIT $formula, $total_data");
    } else {
      $students = AssocFetch("SELECT * FROM student ORDER BY major ASC LIMIT $formula, $total_data");
    }

    // Local to Global Variable
    $GLOBALS["total_data"]  = $total_data;
    $GLOBALS["total_row"]   = $total_row;
    $GLOBALS["total_page"]  = $total_page;
    $GLOBALS["active_page"] = $active_page;
    $GLOBALS["formula"]     = $formula;

    return $students;
  }
?>  