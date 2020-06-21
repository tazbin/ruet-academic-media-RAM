<?php

include 'dbh.inc.php';

if (isset($_POST['admin'])) {
  $name = $_POST['name'];
  $pass = $_POST['pass'];

  if ( empty($name) || empty($pass) ) {
    header("Location: ../admin_login.php?form=empty");
    exit();
  } else{

    $sql = "SELECT * FROM admin_info;";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    $pass = md5($pass);

    if ($resultcheck>0) {
      while ($row = mysqli_fetch_assoc($result)) {
        if ($row['name']==$name && $row['pass']==$pass ) {
          $_SESSION['admin']=$name;
          //$_SESSION['user_name']="admin";
          $_SESSION['status']="admin";
          header("Location: ../admin_page.php");
          exit();
        }
      }
    }
    header("Location: ../admin_login.php?form=invalied");
    exit();
  }
}

 ?>
