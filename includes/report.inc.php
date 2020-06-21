<?php

include_once 'dbh.inc.php';

if (isset($_POST['submit'])) {
  $report_user_name = $_POST['user_name'];
  $report_user_mail = $_POST['user_mail'];
  $report_user_phone = $_POST['user_phone'];
  $report_user_report = $_POST['user_report'];
  if ( empty($report_user_name) || empty($report_user_mail) || empty($report_user_phone) || empty($report_user_report) ) {
    header("Location: ../report.php?report=empty");
    exit();
  }
  else{
    $sql = "INSERT INTO report(report_date, report_text, user_name, user_mail, user_phone) VALUES(CURDATE(), '$report_user_report', '$report_user_name', '$report_user_mail', '$report_user_phone');";
    mysqli_query($conn, $sql);

    header("Location: ../report.php?report=received");
    exit();

  }
}


 ?>
