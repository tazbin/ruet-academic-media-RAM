<?php
include 'dbh.inc.php';

if (isset($_POST['button'])) {
  $delete = $_POST['report_id'];

  $sql = "DELETE FROM report WHERE report_num=$delete";

  if (isset($_SESSION['admin'])) {
    mysqli_query($conn, $sql);

    header("Location: ../view_report.php?report=deleted");
    exit();
  }

  header("Location: ../view_report.php?admin=invalied");
  exit();
}
 ?>
