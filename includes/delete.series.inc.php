<?php
include 'dbh.inc.php';

if (isset($_POST['ds'])) {
  $d_series = $_POST['del_series'];

  if (isset($_SESSION['admin'])) {

    $series = $d_series[7].$d_series[8];

    $sql = "SELECT * FROM course_teacher";
    $result = mysqli_query($conn, $sql);
    $checkresult = mysqli_num_rows($result);

    if ($checkresult>0) {
        while ($row=mysqli_fetch_assoc($result)) {
          if ($row['series']==$series) {
            //deleting each table for selected series
            $del_ttb = "_".$row['id'];
            //echo $del_ttb." ";

            $ttb = "DROP TABLE $del_ttb;";
            mysqli_query($conn, $ttb);
            //deleted each table for selected series

            $del_ttb = $row['id'];
            //echo $del_ttb;

            $ttb = "DELETE FROM course_teacher WHERE id='$del_ttb';";
            mysqli_query($conn, $ttb);
            //deleted from course_teacher
          }
        }
    }


    $sql="ALTER TABLE dept_series DROP COLUMN $d_series;";
    mysqli_query($conn, $sql);

    header("Location: ../admin_page.php?series=deleted");
    exit();
  }
}

 ?>
