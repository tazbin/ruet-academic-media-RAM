<?php

//session_start();

include_once 'dbh.inc.php';

$user_name = $_POST['user_name'];
$user_pass = $_POST['user_pass'];

$pass =md5($user_pass);

if (isset($_POST['login'])) {
  if (empty($user_name) || empty($user_pass)) {
    header("location: ../index.php?empty_fields");
    exit();
  }
  else{
    //matching data

    //for teachers
        $sql = "SELECT * FROM teacher_data;";
        $result = mysqli_query($conn, $sql);
        $result_check = mysqli_num_rows($result);

        if( $result_check > 0 ){
          while ($row = mysqli_fetch_assoc($result)) {
            if ($row['teacher_mail'] == $user_name && $row['teacher_pass'] == $pass)  {
              //logged in

              $_SESSION['user_name']=$row['teacher_name'];
              $_SESSION['user_pass']=$row['teacher_pass'];
              $_SESSION['status']=$row['status'];
              $_SESSION['user_designation']=$row['teacher_designation'];
              $_SESSION['user_mail']=$row['teacher_mail'];
              $_SESSION['user_phone']=$row['teacher_phone'];
              $_SESSION['user_dept']=$row['teacher_dept'];
              $_SESSION['user_id']=$row['teacher_id'];

              //header("location: ../teacher_profile.php?login_success");
              //exit();
              //header page
              if (strpos($_SESSION['status'], "dent")) {
                header("Location: ../student_profile.php");
                exit();
              }

              else {
                header("Location: ../teacher_profile.php");
                exit();
              }
            }
          }
        }

        //for students

                      $sql = "SELECT * FROM student_data;";
                      $result = mysqli_query($conn, $sql);
                      $result_check = mysqli_num_rows($result);

                      if( $result_check > 0 ){
                        while ($row = mysqli_fetch_assoc($result)) {
                          if ($row['st_roll'] == $user_name && $row['st_pass'] == $pass)  {
                            //logged in

                            $_SESSION['pending_user']=$row['st_name'];
                            if ($row['is_pending']==1) {
                              header("Location: ../student_pending.php");
                              exit();
                            }

                            $_SESSION['user_name']=$row['st_name'];
                            $_SESSION['user_roll']=$row['st_roll'];
                            $_SESSION['user_pass']=$row['st_pass'];
                            $_SESSION['status']=$row['status'];
                            $_SESSION['user_series']=$row['st_series'];
                            $_SESSION['user_dept']=$row['st_dept'];


                            //header("location: ../student_profile.php?login_success");
                            //exit();
                            //header page
                            if (strpos($_SESSION['status'], "dent")) {
                              header("Location: ../student_profile.php");
                              exit();
                            }

                            else {
                              header("Location: ../teacher_profile.php");
                              exit();
                            }
                          }
                        }
                      }

       // invalied login
       header("location: ../index.php?login_wrong_data");
       exit();
  }
}


 ?>
