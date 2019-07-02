<?php

include 'dbh.inc.php';

date_default_timezone_set('Asia/Dhaka');

$time = date('h').":".date('i')." ".date('a');

$date = date('D').", ".date('d')." ".date('M')." ".date('Y');

$fulldate= $date." - ".$time;

if (isset($_POST['add_note'])) {

  $title = $_POST['title'];
  $text = $_POST['text'];

  if ( empty($title) || empty($text) ) {
    header('Location: ../add_student_note.php?note=empty');
    exit();
  } else{

    $roll = $_SESSION['user_roll'];

    $sql = "INSERT INTO student_note(title, text, date, roll) VALUES('$title', '$text', '$fulldate', $roll);";
    mysqli_query($conn, $sql);

    header("Location: ../student_note.php?note=success");
    exit();

  }
}

if (isset($_POST['delete'])) {

  $del_id = $_POST['id'];

  $sql = "DELETE FROM student_note WHERE id=$del_id";
  mysqli_query($conn, $sql);

  header("Location: ../student_note.php?note=deleted");
  exit();

}

 ?>
