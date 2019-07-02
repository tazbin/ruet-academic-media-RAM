<?php

include 'dbh.inc.php';

if (isset($_POST['submit'])) {
  //echo $_POST['delete_course'];

  $course = $_POST['delete_course'];

  if (strpos($course, "one")) {
    header('Location: ../delete_course.php?course=empty');
    exit();
  }

  $sql = "DELETE FROM course_teacher WHERE id=$course;";
  mysqli_query($conn, $sql);

  $sql = "DELETE FROM notice WHERE receiver=$course;";
  mysqli_query($conn, $sql);

  $table_name = "_".$_POST['delete_course'];

  $sql = "DROP TABLE $table_name;";
  mysqli_query($conn, $sql);

  header("Location: ../teacher_profile_edit.php?course=deleted");
}

 ?>
