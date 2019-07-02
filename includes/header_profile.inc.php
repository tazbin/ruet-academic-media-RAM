<?php

include 'login.inc.php';

if (strpos($_SESSION['status'], "dent")) {
  header("Location: ../student_profile.php");
  exit();
}

else {
  header("Location: ../teacher_profile.php");
  exit();
}




 ?>
