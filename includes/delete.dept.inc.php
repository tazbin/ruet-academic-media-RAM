<?php
include 'dbh.inc.php';

if (isset($_POST['dd'])) {
  $delete_dept = $_POST['del_dept'];

  if (isset($_SESSION['admin'])) {

    $sql = "SELECT * FROM course_teacher";
    $result = mysqli_query($conn, $sql);
    $checkresult = mysqli_num_rows($result);

    if ($checkresult>0) {
        while ($row=mysqli_fetch_assoc($result)) {
          if ($row['dept']==$delete_dept) {
            //deleting each table for selected series
            $del_ttb = "_".$row['id'];

            $ttb = "DROP TABLE '$del_ttb';";
            mysqli_query($conn, $ttb);
            //deleted each table for selected series

            $del_ttb = $row['id'];

            $ttb = "DELETE FROM course_teacher WHERE id='$del_ttb';";
            mysqli_query($conn, $ttb);
            //deleted from course_teacher
          }
        }
    }

    $sql="DELETE FROM dept_series WHERE dept='$delete_dept';";
    mysqli_query($conn, $sql);

    header("Location: ../admin_page.php?dept=deleted");
    exit();
  }
}
 ?>
