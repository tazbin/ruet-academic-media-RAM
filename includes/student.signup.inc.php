<?php
include 'dbh.inc.php';

if (isset($_POST['sign_up'])) {
  $name = $_POST['name'];
  $roll = $_POST['roll'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $pass_one = $_POST['pass_one'];
  $pass_two = $_POST['pass_two'];

  /*
  echo $name."<br>";
  echo $designation."<br>";
  echo $code."<br>";
  echo $department."<br>";
  echo $phone."<br>";
  echo $email."<br>";
  echo $pass_one."<br>";
  echo $pass_two."<br>";

  exit();
  */

  //name space replace
  $ln = strlen($name);

  for ($i=0; $i < $ln; $i++) {
    if ($name[$i]==" ") {
      $name[$i]="_";
    }
  }
  //name space replace

  //checking all inputs & form data

  //if all fields are empty
  if ( empty($name) || empty($roll) || empty($phone) || empty($email) || empty($pass_one) || empty($pass_two)  ) {
    header("Location: ../student-signup.php?signup=empty&name=$name&roll=$roll&phone=$phone&email=$email");
    exit();
  }

  //if same email id is used again
  $sql = "SELECT st_mail FROM student_data";
  $result = mysqli_query($conn, $sql);
  $resultcheck = mysqli_num_rows($result);

  if ($resultcheck>0) {
    while ($row = mysqli_fetch_assoc($result)) {

      if ($email == $row['st_mail']) {
        header("Location: ../student-signup.php?signup=again&name=$name&roll=$roll&phone=$phone&email=$email");
        exit();
      }

    }
  }

  //if password doesn't match
   if( $pass_one != $pass_two ) {
      header("Location: ../student-signup.php?signup=not_matched&name=$name&roll=$roll&phone=$phone&email=$email");
      exit();
    }

    //invalied roll
    $series = ($roll[0]*10)+$roll[1];
    $dept_code = ($roll[2]*10)+$roll[3];
    $st_roll = ($roll[4]*100)+($roll[5]*10)+$roll[6];

      $st_series = "series_".$series;

      $sql = "SELECT * FROM dept_series WHERE dept_code='$dept_code';";
      $result=mysqli_query($conn, $sql);
      $resultcheck=mysqli_num_rows($result);

      if ($resultcheck>0) {
        while ($row=mysqli_fetch_assoc($result)) {
            $total_roll = $row[$st_series];
        }
      }

      if ( strlen($roll)!=7 || $st_roll<1 || $st_roll>$total_roll ) {
        header("Location: ../student-signup.php?signup=invalied-roll&name=$name&roll=$roll&phone=$phone&email=$email");
        exit();
      }

      //duplicate roll
      $sql = "SELECT * FROM student_data WHERE st_roll='$roll';";
      $result=mysqli_query($conn, $sql);
      $resultcheck=mysqli_num_rows($result);

      if ($resultcheck>0) {
        header("Location: ../student-signup.php?signup=duplicate&name=$name&roll=$roll&phone=$phone&email=$email");
        exit();
      }

    //all okay to go
    //student signing in

      //name underline replace
      $ln = strlen($name);

      for ($i=0; $i < $ln; $i++) {
        if ($name[$i]=="_") {
          $name[$i]=" ";
        }
      }
      //name underline replace

      //encript pass
      $en_pass = MD5($pass_one);

      //getting dept name
      $sql = "SELECT * FROM dept_series;";
      $result=mysqli_query($conn, $sql);
      $resultcheck=mysqli_num_rows($result);

      if ($resultcheck>0) {
        while ($row=mysqli_fetch_assoc($result)) {
            if ($row['dept_code'] == $dept_code) {
              $dept_name = $row['dept'];
            }
        }
      }


      $sql = "INSERT INTO student_data(st_roll, st_name, st_pass, st_series, st_dept, is_pending, st_mail, st_phone) VALUES('$roll', '$name', '$en_pass', '$series', '$dept_name', 1, '$email', '$phone');";
      mysqli_query($conn, $sql);

      $_SESSION['user_name']=$name;
      $_SESSION['pending_user']=$name;
      $_SESSION['user_pass']=$pass_one;
      $_SESSION['status']="student";
      $_SESSION['user_designation']=$designation;
      $_SESSION['user_mail']=$email;
      $_SESSION['user_phone']=$phone;
      $_SESSION['user_dept_name']=$dept_name;
      $_SESSION['user_dept_code']=$dept_code;
      $_SESSION['user_roll']=$roll;

      header("Location: ../student_pending.php");
      exit();

    }

 ?>
