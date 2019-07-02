<?php
include 'dbh.inc.php';

if (isset($_POST['submit'])) {
  if ( strpos($_POST['sta_course'], "one") ) {
    header("Location: ../view_statistics.php?course=empty");
    exit();
  }
  $_SESSION['sta_course'] = $_POST['sta_course'];
  $_SESSION['sta_table'] = "_".$_POST['sta_course'];
  header("Location: ../show_statistics.php");
  exit();
}

 ?>
