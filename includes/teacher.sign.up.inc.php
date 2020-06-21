<?php
include 'dbh.inc.php';

if (isset($_POST['sign_up'])) {
  $name = $_POST['name'];
  $designation = $_POST['designation'];
  $code = $_POST['code'];
  $department = $_POST['department'];
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

  //getting teacher code from database
  $sql = "SELECT teacher_code FROM teacher_data";
  $result = mysqli_query($conn, $sql);
  $resultcheck = mysqli_num_rows($result);

  if ($resultcheck>0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $teacher_code = $row['teacher_code'];
    }
  }

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
  if ( empty($name) || empty($designation) || empty($code) || empty($department) || empty($phone) || empty($email) || empty($pass_one) || empty($pass_two)  ) {
    header("Location: ../teacher-signup.php?signup=empty&name=$name&designation=$designation&code=$code&department=$department&phone=$phone&email=$email");
    exit();
  }

  //if same email id is used again
  $sql = "SELECT teacher_mail FROM teacher_data";
  $result = mysqli_query($conn, $sql);
  $resultcheck = mysqli_num_rows($result);

  if ($resultcheck>0) {
    while ($row = mysqli_fetch_assoc($result)) {

      if ($email == $row['teacher_mail']) {
        header("Location: ../teacher-signup.php?signup=again&name=$name&designation=$designation&code=$code&department=$department&phone=$phone&email=$email");
        exit();
      }

    }
  }

  //if password doesn't match
   if( $pass_one != $pass_two ) {
      header("Location: ../teacher-signup.php?signup=not_matched&name=$name&designation=$designation&code=$code&department=$department&phone=$phone&email=$email");
      exit();
    }

    //if teacher code doesn't match
    elseif( $code!=$teacher_code ) {
      header("Location: ../teacher-signup.php?signup=teacher_code&name=$name&designation=$designation&code=&department=$department&phone=$phone&email=$email");
      exit();
    }

    //all okay to go
    //teacher signing in
    else {

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

      $sql = "INSERT INTO teacher_data(teacher_name, teacher_pass, teacher_designation, teacher_dept, teacher_mail, teacher_phone, teacher_code) VALUES('$name', '$en_pass', '$designation', '$department', '$email', '$phone', '$teacher_code' );";
      mysqli_query($conn, $sql);

      $_SESSION['user_name']=$name;
      $_SESSION['user_pass']=$pass_one;
      $_SESSION['status']="teacher";
      $_SESSION['user_designation']=$designation;
      $_SESSION['user_mail']=$email;
      $_SESSION['user_phone']=$phone;
      $_SESSION['user_dept']=$department;

      $sql = "SELECT * FROM teacher_data";
      $result=mysqli_query($conn, $sql);
      $resultcheck=mysqli_num_rows($result);

      if ($resultcheck>0) {
        while ($row=mysqli_fetch_assoc($result)) {
          if ( $row['teacher_name']==$name && $row['teacher_mail']==$email && $row['teacher_pass']==md5($pass_one) ) {
            $_SESSION['user_id']=$row['teacher_id'];
          }
        }
      }

      echo $_SESSION['user_id'];
      
      ?>
<script type="text/javascript">
  window.location.href = "../teacher_profile.php"
</script>
<?php

    //   header("Location: ../teacher_profile.php");
      exit();

      //teacher logged in

    }
  }

 ?>
