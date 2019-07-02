<?php

include 'dbh.inc.php';

$ex = $_SESSION['insert_exam'];
$table = $_SESSION['exam_table'];

$sql = "SELECT * FROM $table;";
$result = mysqli_query($conn, $sql);
$result_check = mysqli_num_rows($result);

/*  if ( $_SESSION['exam'] = "Class test 1") {
    $exam == "ct_1";
} elseif ( $_SESSION['exam'] = "Class test 2") {
    $exam == "ct_2";
} elseif ( $_SESSION['exam'] = "Class test 3") {
    $exam == "ct_3";
} elseif ( $_SESSION['exam'] = "Class test 4") {
    $exam == "ct_4";
} */

if( $result_check > 0 ){
  while ($row = mysqli_fetch_assoc($result)){
  //  if ($row['section'] == $_SESSION['section']) {
      $my_roll = $row['roll'];
      $mark = $_POST[$row['roll']];
      $tazbinur = "UPDATE $table SET $ex=$mark WHERE roll=$my_roll";
      mysqli_query($conn, $tazbinur);
  //  }

  }
  header("Location: ../teacher_profile.php?result=inserted");
}

 ?>
