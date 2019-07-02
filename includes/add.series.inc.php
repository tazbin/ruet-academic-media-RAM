<?php

include 'dbh.inc.php';

if (isset($_POST['submit'])) {
  $series_name = "series_".$_POST['series_name'];

  $sql = "ALTER TABLE dept_series ADD COLUMN $series_name int(3);";
  mysqli_query($conn, $sql);

  $sql = "SELECT * FROM dept_series";
  $result = mysqli_query($conn, $sql);
  $checkresult = mysqli_num_rows($result);

  if ($checkresult>0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $st_num = $_POST[$row['dept_code']];
      $code = $row['dept_code'];
      $sql = "UPDATE dept_series SET $series_name=$st_num WHERE dept_code=$code;";
      mysqli_query($conn, $sql);
    }
  }

  header("Location: ../admin_page.php?seried=added");
  exit();
}

 ?>
