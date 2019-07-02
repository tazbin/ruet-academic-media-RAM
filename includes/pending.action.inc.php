<?php

include 'dbh.inc.php';

if (isset($_POST['approve'])) {
  $roll = $_POST['roll'];

  $sql = "UPDATE student_data SET is_pending=0 WHERE st_roll=$roll;";
  mysqli_query($conn, $sql);

  header("Location: ../pending_list.php?$roll=approved");
  exit();
}

if (isset($_POST['remove'])) {
  $roll = $_POST['roll'];

  $sql = "DELETE FROM student_data WHERE st_roll=$roll;";
  mysqli_query($conn, $sql);

  header("Location: ../pending_list.php?$roll=removed");
  exit();
}

 ?>
