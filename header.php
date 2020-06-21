<?php
date_default_timezone_set('Asia/Dhaka');

//   session_start();
  include_once 'includes/dbh.inc.php';
  $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="image/ram_fav.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  </head>
  <style media="screen">
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }

  .tazbinur-font{
    font-size: 15px;
  }
  </style>
  <body>

    <!-- demo navbar -->
    <div class="" style="height: 2px">
    <nav class="navbar navbar-expand-lg navbar-light shadow" style="height: 1px; background-color: rgba(227, 232, 231, 0.55);">
      <a class="navbar-brand" href="#"></a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

        </ul>
      </div>
    </nav>
      </div>
    <!-- demo navbar -->

<!-- up down navbar -->
<?php
  if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == "teacher") {

        $teacher_course=0;
        $teacher_notice=0;

        //course number
        $sql = "SELECT * FROM course_teacher;";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);

        if ($resultcheck>0) {
          while ($row = mysqli_fetch_assoc($result)) {
            if ($row['teacher_id']==$_SESSION['user_id'] ) {
              $teacher_course++;
            }
          }
        }

        //notice
        $sql = "SELECT * FROM notice;";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);

        if ($resultcheck>0) {
          while ($row = mysqli_fetch_assoc($result)) {
            if ($row['sender']==$_SESSION['user_mail'] ) {
              $teacher_notice++;
            }
          }
        }

      echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow" style="border-bottom: solid #5CB85C 3px;">
              <div class="container" style="padding-top:5px; padding-bottom:5px;">
                <a class="navbar-brand mt-2" href="index.php">
                  <i class="fas fa-university"></i>
                  RAM</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <hr style="background-color: rgb(244, 245, 245)">
                  <ul class="navbar-nav ml-auto tazbinur-font">';

                  if (strpos($fullURL, "teacher_profile.php")) {
                    echo '<li class="nav-item pr-4 pt-1">
                        <a class="nav-link text-light" href="includes/header_profile.inc.php"><i class="fas fa-home" style="padding-left: 5px"></i> Home <span class="badge badge-success">3</span>  </a>
                      </li>';
                  } else{
                    echo '<li class="nav-item pr-4 pt-1">
                        <a class="nav-link" href="includes/header_profile.inc.php"><i class="fas fa-home" style="padding-left: 5px"></i> Home <span class="badge badge-secondary">3</span>  </a>
                      </li>';
                  }

                  if (strpos($fullURL, "profile_edit")) {
                    echo '<li class="nav-item pr-4 pt-1">
                        <a class="nav-link text-light" href="teacher_profile_edit.php"><i class="fas fa-clipboard" style="padding-left: 5px;"></i> Course manager <span class="badge badge-success">'.$teacher_course.'</span> </a>
                          </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1">
                        <a class="nav-link" href="teacher_profile_edit.php"><i class="fas fa-clipboard" style="padding-left: 5px;"></i> Course manager <span class="badge badge-secondary">'.$teacher_course.'</span> </a>
                          </li>';
                  }

                  if (strpos($fullURL, "statistics")) {
                    echo '<li class="nav-item pr-4 pt-1">
                  <a class="nav-link text-light" href="view_statistics.php"><i class="fas fa-chart-pie" style="padding-left: 5px;"></i> View Statistics </a>
                    </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1">
                  <a class="nav-link" href="view_statistics.php"><i class="fas fa-chart-pie" style="padding-left: 5px;"></i> View Statistics </a>
                    </li>';
                  }

                  if (strpos($fullURL, "manage_notice.php")) {
                    echo '<li class="nav-item pr-4 pt-1">
                  <a class="nav-link text-light" href="manage_notice.php"><i class="fas fa-bullhorn" style="padding-left: 5px;"></i> Notice manager <span class="badge badge-success">'.$teacher_notice.'</span> </a>
                    </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1">
                  <a class="nav-link" href="manage_notice.php"><i class="fas fa-bullhorn" style="padding-left: 5px;"></i> Notice manager <span class="badge badge-secondary">'.$teacher_notice.'</span> </a>
                    </li>';
                  }

                  if (strpos($fullURL, "teacher-data-edit.php")) {
                    echo '<li class="nav-item pr-4 pt-1">
                  <a class="nav-link text-light" href="teacher-data-edit.php"><i class="fas fa-user-cog" style="padding-left: 5px;"></i> Profile </a>
                    </li>';
                  } else {
                //     echo '<li class="nav-item pr-4 pt-1">
                //   <a class="nav-link" href="teacher-data-edit.php"><i class="fas fa-user-cog" style="padding-left: 5px;"></i> Profile </a>
                //     </li>';
                  }

                  echo '
                  <li class="nav-item pr-1"> <hr class="bg-light d-md-none">
                      <form class="form-inline my-2 my-lg-0" action="includes/logout.inc.php" method="POST">
                        <button class="btn btn-sm mr-3 btn-outline-danger my-2 my-sm-2" name="logout" type="submit"> <i class="fas fa-sign-out-alt" style="padding-left: 5px"></i> Log out</button>
                      </form>
                  </li>
                  </ul>
                </div>
            </div>
            </nav>';
    }

    if ($_SESSION['status'] == "student") {
      //student badge
      $badge = $_SESSION['user_roll'];
      $b_series = ($badge[0]*10)+$badge[1];
      $b_dept_code = ($badge[2]*10)+$badge[3];
      $b_roll = ($badge[4]*100)+($badge[5]*10)+$badge[6];

      $course_badge=0;
      $notepad_badge=0;
      $notice_badge=0;


      $notepad_arr=array();
      unset($notepad_arr);
      $notepad_arr=array();

      //course badge
      $sql = "SELECT * FROM course_teacher;";
      $result = mysqli_query($conn, $sql);
      $resultcheck = mysqli_num_rows($result);

      if ($resultcheck>0) {
        while ($row = mysqli_fetch_assoc($result)) {
          if ($row['series']==$b_series && $row['dept_code']==$b_dept_code && ( $row['start_roll']<=$b_roll && $b_roll<=$row['end_roll'] ) ) {
            $course_badge++;
            array_push($notepad_arr, $row['id']);
          }
        }
      }

      //notepad badge
      $sql = "SELECT * FROM student_note;";
      $result = mysqli_query($conn, $sql);
      $resultcheck = mysqli_num_rows($result);

      if ($resultcheck>0) {
        while ($row = mysqli_fetch_assoc($result)) {
          if ($row['roll']==$badge ) {
            $notepad_badge++;
          }
        }
      }

      //notice badge
      $sql = "SELECT * FROM notice;";
      $result = mysqli_query($conn, $sql);
      $resultcheck = mysqli_num_rows($result);

      if ($resultcheck>0) {
        while ($row = mysqli_fetch_assoc($result)) {
          foreach ($notepad_arr as $key) {
            if ($key==$row['receiver']) {
              $notice_badge++;
            }
          }
        }
      }

      echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow" style="border-bottom: solid #5CB85C 3px;">
              <div class="container" style="padding-top:5px; padding-bottom:5px;">
                <a class="navbar-brand mt-2" href="index.php">
                  <i class="fas fa-university"></i>
                  RAM</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <hr style="background-color: rgb(244, 245, 245)">
                  <ul class="navbar-nav ml-auto tazbinur-font">';

                  if (strpos($fullURL, "student_profile.php")) {
                    echo '<li class="nav-item pr-4 pt-1">
                        <a class="nav-link text-light" href="includes/header_profile.inc.php"><i class="fas fa-home" style="padding-left: 5px"></i> Home <span class="badge badge-success">'.$course_badge.'</span> </a>
                      </li>';
                  } else{
                    echo '<li class="nav-item pr-4 pt-1">
                        <a class="nav-link" href="includes/header_profile.inc.php"><i class="fas fa-home" style="padding-left: 5px"></i> Home <span class="badge badge-secondary">'.$course_badge.'</span> </a>
                      </li>';
                  }

                  if (strpos($fullURL, "student_note")) {
                    echo '<li class="nav-item pr-4 pt-1">
                        <a class="nav-link text-light" href="student_note.php"><i class="far fa-edit" style="padding-left: 5px;"></i> Notepad <span class="badge badge-success">'.$notepad_badge.'</span> </a>
                      </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1">
                        <a class="nav-link" href="student_note.php"><i class="far fa-edit" style="padding-left: 5px;"></i> Notepad <span class="badge badge-secondary">'.$notepad_badge.'</span> </a>
                      </li>';
                  }

                  if (strpos($fullURL, "notice_page")) {
                    echo '<li class="nav-item pr-4 pt-1">
                        <a class="nav-link text-light" href="notice_page.php"><i class="fas fa-bullhorn" style="padding-left: 5px;"></i> Notice <span class="badge badge-success">'.$notice_badge.'</span> </a>
                      </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1">
                        <a class="nav-link" href="notice_page.php"><i class="fas fa-bullhorn" style="padding-left: 5px;"></i> Notice <span class="badge badge-secondary">'.$notice_badge.'</span> </a>
                      </li>';
                  }

                  echo '
                  <li class="nav-item pr-1"> <hr class="bg-light d-md-none">
                      <form class="form-inline my-2 my-lg-0" action="includes/logout.inc.php" method="POST">
                        <button class="btn btn-sm mr-3 btn-outline-danger my-2 my-sm-2" name="logout" type="submit"> <i class="fas fa-sign-out-alt" style="padding-left: 5px"></i> Log out</button>
                      </form>
                  </li>
                  </ul>
                </div>
            </div>
            </nav>';
    }

    if ($_SESSION['status'] == "admin") {
      echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow" style="border-bottom: solid #5CB85C 3px;">
              <div class="container" style="padding-top:5px; padding-bottom:5px;">
                <a class="navbar-brand mt-2" href="index.php">
                  <i class="fas fa-university"></i>
                  RAM</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <hr style="background-color: rgb(244, 245, 245)">
                  <ul class="navbar-nav ml-auto tazbinur-font">';

                  if (strpos($fullURL, "admin_page")) {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link text-light" href="admin_page.php"><i class="fas fa-align-center" style="padding-right: 5px;"></i> Admin Panel </a>
                      </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link" href="admin_page.php"><i class="fas fa-align-center" style="padding-right: 5px;"></i> Admin Panel </a>
                      </li>';
                  }

                  /*
                  if (strpos($fullURL, "add_dept")) {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link text-light" href="add_dept.php"><i class="fas fa-plus-circle" style="padding-left: 5px;"></i> Add department </a>
                      </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link" href="add_dept.php"><i class="fas fa-plus-circle" style="padding-left: 5px;"></i> Add department </a>
                      </li>';
                  }

                  if (strpos($fullURL, "add_series")) {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link text-light" href="add_series.php"><i class="fas fa-plus-circle" style="padding-left: 5px;"></i> Add series </a>
                      </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link" href="add_series.php"><i class="fas fa-plus-circle" style="padding-left: 5px;"></i> Add series </a>
                      </li>';
                  }

                  if (strpos($fullURL, "delete_series")) {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link text-light" href="delete_series.php"><i class="fas fa-minus-circle" style="padding-left: 5px;"></i> Delete series </a>
                      </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link" href="delete_series.php"><i class="fas fa-minus-circle" style="padding-left: 5px;"></i> Delete series </a>
                      </li>';
                  } */

                  if (strpos($fullURL, "view_report")) {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link text-light" href="view_report.php"><i class="fas fa-envelope-open" style="padding-right: 5px;"></i> Reports </a>
                      </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link" href="view_report.php"><i class="fas fa-envelope-open" style="padding-right: 5px;"></i> Reports </a>
                      </li>';
                  }

                  if (strpos($fullURL, "post_news")) {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link text-light" href="post_news.php"><i class="fas fa-paste" style="padding-right: 5px;"></i> Post A News </a>
                      </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1" style="margin-right: -20px">
                        <a class="nav-link" href="post_news.php"><i class="fas fa-paste" style="padding-right: 5px;"></i> Post A News </a>
                      </li>';
                  }

                  if (strpos($fullURL, "pending_list")) {
                    echo '<li class="nav-item pr-4 pt-1 mr-2" style="margin-right: -20px">
                        <a class="nav-link text-light" href="pending_list.php"><i class="fas fa-exclamation-triangle" style="padding-right: 5px;"></i> Pending List </a>
                      </li>';
                  } else {
                    echo '<li class="nav-item pr-4 pt-1 mr-2" style="margin-right: -20px">
                        <a class="nav-link" href="pending_list.php"><i class="fas fa-exclamation-triangle" style="padding-right: 5px;"></i> Pending List </a>
                      </li>';
                  }

                  echo '
                  <li class="nav-item pr-1"> <hr class="bg-light d-md-none">
                      <form class="form-inline my-2 my-lg-0" action="includes/logout.inc.php" method="POST">
                        <button class="btn btn-sm mr-3 btn-outline-danger my-2 my-sm-2" name="logout" type="submit"> <i class="fas fa-sign-out-alt" style="padding-left: 5px"></i> Log out</button>
                      </form>
                  </li>
                  </ul>
                </div>
            </div>
            </nav>';
    }
  }

  else {
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow" style="border-bottom: solid #5CB85C 3px;">
            <div class="container" style="padding-top:5px; padding-bottom:5px;">
              <a class="navbar-brand mt-2" href="index.php">
                <i class="fas fa-university"></i>
                RAM</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <hr style="background-color: rgb(244, 245, 245)">
                <ul class="navbar-nav ml-auto tazbinur-font">';


                echo '<li class="text-light">
                <a href="teacher-signup.php" class="btn btn-success btn-sm mr-3 my-2 my-sm-2" text-light> <i class="fas fa-user text-light" style="padding-right: 5px"></i> Sign Up as Teacher</a>
                </li>
                <li class="text-light">
                <a href="student-signup.php" class="btn btn-success btn-sm mr-3 my-2 my-sm-2"> <i class="fas fa-user-graduate" style="padding-right: 5px"></i> Sign Up as Student</a>
                </li>

                </ul>
              </div>
          </div>
          </nav>';
  }
 ?>
<!-- up down navbar -->


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
