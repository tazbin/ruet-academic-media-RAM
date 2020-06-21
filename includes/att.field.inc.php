<?php

include 'dbh.inc.php';

$_SESSION['att_course'] = $_POST['course'];
//$_SESSION['att_section'] = $_POST['section'];
$att_course = $_POST['course'];
//$att_section = $_POST['section'];


if (isset($_POST['submit'])) {
  if ( strpos($_SESSION['att_course'], "one") ) {
    header("Location: ../att_field.php?form=empty");
    exit();
  } else{

    $sql = "SELECT * FROM course_teacher WHERE id=$att_course";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);


    $_SESSION['att_table'] = "_".$att_course;

    $_SESSION['tazbinur_att_dept'] = $row['dept'];
    $_SESSION['tazbinur_att_series'] = $row['series'];
    $_SESSION['tazbinur_att_course'] = $row['course_number'];

    header("Location: ../att_input.php");
    exit();
  }
}

 ?>
