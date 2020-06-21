<?php

include 'dbh.inc.php';

if (isset($_POST['save-change'])) {
  $new_name = $_POST['user-name'];
  $new_designation = $_POST['user-designation'];
  $new_dept = $_POST['user-dept'];
  $new_mail = $_POST['user-mail'];
  $new_phone = $_POST['user-phone'];
  $new_pass = $_POST['user-new-pass'];
  $old_pass = $_POST['user-old-pass'];

  if (empty($new_name)) {
    $new_name = $_SESSION['user_name'];
  }
  if (empty($new_designation)) {
    $new_designation = $_SESSION['user_designation'];
  }
  if (empty($new_sept)) {
    $new_dept = $_SESSION['user_dept'];
  }
  if (empty($new_mail)) {
    $new_mail = $_SESSION['user_mail'];
  }
  if (empty($new_phone)) {
    $new_phone = $_SESSION['user_phone'];
  }

  $t_id = $_SESSION['user_id'];

  //getting old password
  $sql = "SELECT * FROM teacher_data";
  $result = mysqli_query($conn, $sql);
  $resultcheck = mysqli_num_rows($result);

  if ($resultcheck>0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['teacher_id']==$t_id) {
        $t_pass = $row['teacher_pass'];
      }
    }
  }


  if (empty($new_pass)) {

    $input_pass = md5($old_pass);

    if ($input_pass == $t_pass) {
      $sql="UPDATE teacher_data SET teacher_name='$new_name', teacher_designation='$new_designation', teacher_dept='$new_dept', teacher_mail='$new_mail', teacher_phone='$new_phone' WHERE teacher_id='$t_id';";
      mysqli_query($conn, $sql);


      //log out
      session_start();
      session_unset();
      session_destroy();

      header("Location:../index.php");
      exit();
    } else{
      header("Location:../teacher-data-edit.php?data=wrong-pass");
      exit();
    }

  } else{

    $input_pass = md5($old_pass);

    $new_pass = MD5($new_pass);

    if ($input_pass == $t_pass) {
      $sql="UPDATE teacher_data SET teacher_name='$new_name', teacher_pass='$new_pass', teacher_designation='$new_designation', teacher_dept='$new_dept', teacher_mail='$new_mail', teacher_phone='$new_phone' WHERE teacher_id='$t_id';";
      mysqli_query($conn, $sql);


      //log out
      session_start();
      session_unset();
      session_destroy();

      header("Location:../index.php");
      exit();
    } else{
      header("Location:../teacher-data-edit.php?data=wrong-pass");
      exit();
    }
  }
}

 ?>
