<?php

include 'dbh.inc.php';

$id = $_POST['course'];
$exam = $_POST['exam'];
$_SESSION['insert_exam'] = $_POST['exam'];
//$_SESSION['section'] = $_POST['section'];


if (isset($_POST['submit'])) {
  if (strpos($id, "one") || strpos($exam, "one") || strpos($_SESSION['section'], "one") ) {
    header('Location: ../result_fields.php?form=empty');
    exit();
  } else{

    if ($exam == "ct_1") {
      $_SESSION['exam'] = "Class test 1";
    } elseif ($exam == "ct_2") {
      $_SESSION['exam'] = "Class test 2";
    }elseif ($exam == "ct_3") {
      $_SESSION['exam'] = "Class test 3";
    }elseif ($exam == "ct_4") {
      $_SESSION['exam'] = "Class test 4";
    }

    $sql = "SELECT * FROM course_teacher;";
    $result = mysqli_query($conn, $sql);
    $result_check = mysqli_num_rows($result);

    if( $result_check > 0 ){
      while ($row = mysqli_fetch_assoc($result)) {
        if ($row['id'] == $id)  {
          //logged in

          $_SESSION['course_number']=$row['course_number'];
          $_SESSION['exam_dept']=$row['dept'];
          $_SESSION['exam_series']=$row['series'];

    header('Location: ../result_input.php');

  }
}
}
}
}


 ?>
