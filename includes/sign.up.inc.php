<?php
include 'dbh.inc.php';

if (isset($_POST['sign_up'])) {
  $name = $_POST['name'];
  $designation = $_POST['designation'];
  $code = $_POST['code'];
  $department = $_POST['department'];
  $email = $_POST['email'];
  $pass_one = $_POST['pass_one'];
  $pass_two = $_POST['pass_two'];

  /*
  echo $name;
  echo $designation;
  echo $code;
  echo $department;
  echo $email;
  echo $pass_one;
  echo $pass_two;

  exit();
  */


  $teacher_code = 321;

  if ( empty($name) || empty($designation) || empty($code) || empty($department) || empty($email) || empty($pass_one) || empty($pass_two)  ) {
    header("Location: ../sign_up.php?signup=empty&name=$name&designation=$designation&code=$code&department=$department&email=$email");
    exit();
  } elseif( $pass_one != $pass_two ) {
      header("Location: ../sign_up.php?signup=not_matched&name=$name&designation=$designation&code=$code&department=$department&email=$email");
      exit();
    } elseif( $designation=="student" || $designation=="Student" || $designation=="STUDENT" ){

      $checkroll = $code;

      $digit=0;
      while ($checkroll!=0) {
        $checkroll/=10;
        $checkroll=floor($checkroll);
        $digit++;
      }

      if ($digit!=7) {
        header("Location: ../sign_up.php?signup=roll_invalied&name=$name&designation=$designation&code=&department=$department&email=$email");
        exit();
      }

      //student sign_up
      $series = $code[0].$code[1];
      $dept = $code[2].$code[3];
      $roll = $code[4].$code[5].$code[6];

      $sql = "SELECT * FROM dept_series";
      $result = mysqli_query($conn, $sql);
      $resultcheck = mysqli_num_rows($result);

      if ($resultcheck>0) {
        while ($row = mysqli_fetch_assoc($result)) {
          if ( $row['dept_code']==$dept ) {
              $dept_name = $row['dept'];
              echo $dept_name;
          }
        }
      }

      $hashedpass = MD5($pass_one);

      $sql = "INSERT INTO student_data(st_roll, st_name, st_pass, st_series, st_dept, st_mail) VALUES($code, '$name', '$hashedpass', $series, '$dept_name', '$email');";
      mysqli_query($conn, $sql);

      //student logging in

      /*
      $_SESSION['user_name']=$name;
      $_SESSION['user_roll']=$code;
      $_SESSION['user_pass']=$pass_one;
      $_SESSION['status']="student";
      $_SESSION['user_series']=$series;
      $_SESSION['user_dept']=$dept_name;
      */

      $_SESSION['pending_user']=$name;


        header("Location: ../student_pending.php");
        exit();

      //student logged in

    } elseif( $code!=$teacher_code ) {
      header("Location: ../sign_up.php?signup=teacher_code&name=$name&designation=$designation&code=&department=$department&email=$email");
      exit();
    } else {

      //teacher logging in

      $sql = "INSERT INTO teacher_data(teacher_name, teacher_pass, teacher_designation, teacher_dept, teacher_mail) VALUES('$name', '$hashedpass', '$designation', '$department', '$email' );";
      mysqli_query($conn, $sql);

      $_SESSION['user_name']=$name;
      $_SESSION['user_pass']=$pass_one;
      $_SESSION['status']="teacher";
      $_SESSION['user_designation']=$designation;
      $_SESSION['user_dept']=$department;

      $sql = "SELECT * FROM teacher_data";
      $result=mysqli_query($conn, $sql);
      $resultcheck=mysqli_num_rows($result);

      if ($resultcheck>0) {
        while ($row=mysqli_fetch_assoc($result)) {
          if ( $row['teacher_name']==$name && $row['teacher_designation']==$designation && $row['teacher_dept']==$department ) {
            $_SESSION['user_id']=$row['teacher_id'];
          }
        }
      }

      header("Location: ../teacher_profile.php");
      exit();

      //teacher logged in

    }
  }

 ?>
