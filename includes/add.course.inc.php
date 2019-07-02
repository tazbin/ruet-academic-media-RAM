<?php

include 'dbh.inc.php';

$st_num;

if (isset($_POST['submit'])) {
  $c_name = $_POST['c_name']; //not selection button
  $c_series = $_POST['c_series'];
  $c_dept = $_POST['c_dept'];
  $c_section = $_POST['c_section'];
  $roll_st = $_POST['roll_st'];
  $roll_end = $_POST['roll_end'];

  if (isset($_POST['submit'])) {
    if (empty($c_name) || strpos($c_series, "one") || strpos($c_dept, "one") || strpos($c_section, "one") || empty($roll_st) || empty($roll_end) ) {
      header("Location: ../add_course.php?course=empty");
      exit();
    }
  }

  $sql = "SELECT * FROM dept_series";
  $result=mysqli_query($conn, $sql);
  $resultcheck = mysqli_num_rows($result);

  if ($resultcheck>0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['dept']==$c_dept) {
        $c_dept_code = $row['dept_code'];
      }
    }
  }

  //we got the dept code

  $st = $roll_st%1000;
  $end = $roll_end%1000;

  $sql = "INSERT INTO course_teacher(teacher, teacher_id, course_number, dept, dept_code, series, section, start_roll, end_roll) VALUES('{$_SESSION['user_name']}', '{$_SESSION['user_id']}', '$c_name', '$c_dept', $c_dept_code, $c_series, '$c_section', $st, $end);";

  mysqli_query($conn, $sql);

  //we added the course to course_teacher table

  $sql = "SELECT * FROM course_teacher";
  $result = mysqli_query($conn, $sql);
  $result_check = mysqli_num_rows($result);

  if( $result_check > 0 ){
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['teacher'] == $_SESSION['user_name'] && $row['course_number'] == $c_name)  {
        $cid = "_".$row['id'];

        $sql="CREATE TABLE $cid(
            	  roll int(10),
                tot_day int(5) DEFAULT 0,
                att_day int(5) DEFAULT 0,
                ct_1 int(2),
                ct_2 int(2),
                ct_3 int(2),
                ct_4 int(2),
                last_date varchar(30)
            	);";

        mysqli_query($conn, $sql);
    }
     }
     }

     //we created a separate table for the course

      $index_roll_start = ($c_series*100000)+($c_dept_code*1000)+($roll_st%1000);
      $index_roll_end = ($c_series*100000)+($c_dept_code*1000)+($roll_end%1000);

      for ($i=$index_roll_start; $i <=$index_roll_end ; $i++) {
        $sql = "INSERT INTO $cid(roll) VALUES($i);";
        echo $i."<br>";
        mysqli_query($conn, $sql);
            }

            header("Location: ../teacher_profile_edit.php?course=added");
            exit();

}

 ?>
