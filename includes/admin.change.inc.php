<?php
include 'dbh.inc.php';

$old_pass=$_POST['old_pass'];
$new_pass=$_POST['new_pass'];
$new_pass2=$_POST['new_pass_again'];

if (empty($old_pass) || empty($new_pass) || empty($new_pass2)) {
  header("Location: ../admin-change.php?pass=empty");
  exit();
}

$sql = "SELECT * FROM admin_info;";
$result = mysqli_query($conn, $sql);
$result_check = mysqli_num_rows($result);

$old_pass = md5($old_pass);

if( $result_check > 0 ){
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row['pass'] != $old_pass)  {
      header("Location: ../admin-change.php?pass=wrong");
      exit();
    }
  }
}


if ($new_pass!=$new_pass2) {
  header("Location: ../admin-change.php?pass=not-matched");
  exit();
} elseif ($new_pass!=$new_pass2) {
  header("Location: ../admin-change.php?pass=not-matched");
  exit();
} else {
  $pass = MD5($new_pass);
  $sql = "UPDATE admin_info SET pass='$pass' WHERE name='admin';";
  mysqli_query($conn, $sql);

  session_start();
  session_unset();
  session_destroy();

  header("Location:../admin_login.php");
  exit();
}

 ?>
