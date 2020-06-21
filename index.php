<?php
  include 'header.php';
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Home</title>
    <style>
    .shadow {
      -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
      -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
      box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    }

    .taz-font{
      font-size: 15px;
    }

    @media only screen and (min-width: 800px) {
      #tazbinur-rahaman {
        display: block;
      }
      #tazbinur{
        display: none;
      }
    }

    @media only screen and (max-width: 799px) {
      #tazbinur-rahaman {
        display: none;
      }
      #tazbinur{
        display: block;
      }
    }
    </style>
  </head>
  <body>
    <?php
    $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($fullURL, "authentication")) {
      echo '<div class="bg-danger shadow" style="height: 35px">
              <p class="pt-1 text-center text-light"><i class="fas fa-exclamation-triangle" style="padding-left: 10px"></i> authentication protected!</p>
            </div>';
    }
    ?>

    <div style="background-color: rgba(227, 232, 231, 0.55)" class="shadow">
      <div class="container" style="padding-top:50px; padding-bottom:50px">
        <div class="row align-iteams-center">
          <!--<div class="col-8 d-none d-sm-block">-->
              <div class="col-lg-8 d-none d-md-block">
            <h3 class="display-3"><strong class="text-success">R</strong>uet <strong class="text-success">A</strong>cademic <strong class="text-success">M</strong>edia</h3>
            <hr>
            <br>
            <p class="lead">
              An online automated system to asset academic tasks of <strong class="text-success">RUET</strong> for both teachers & students. it is currently desinged well for each department of each series!
            </p>
            <p class="lead">
              It is developed to take attendance, post notice & exam results, calculate & generate marks as well as real time notice posting. Many more upgradation is coming up to make the communication of officials more faster & easier.
            </p>
          </div>

          <!--<div class="shadow col-12 col-sm-4 bg-light container" style="border-radius: 20px">-->
          <div class="shadow col-12 col-md-12 col-lg-4 bg-light container" style="border-radius: 20px">


            <!-- logout form -->
            <?php
              if (isset($_SESSION['user_pass'])) {
                echo
                '<form class="text-center container" action="includes/logout.inc.php" method="post" style="min-height: 250px">
                  <p class="lead" style="font-size:30px; margin-top:20px">Welcome!
                  </p>
                  <small class="form-text text-muted" style="margin-top:-10px; margin-bottom:10px">All ready to help you up!</small>
                  <div class="form-group">
                    <h3 class="display-4 text-center">'.$_SESSION['user_name'].'</h3>

                  </div>

                  <button type="submit" name="logout" style="margin-bottom:10px" class="btn btn-block btn-sm btn-outline-danger"> <i class="fas fa-sign-out-alt" style="padding-left: 5px"></i> Log Out</button>

                </form>';

              } elseif (isset($_SESSION['admin'])) {
                echo
                '<form class="text-center container" action="includes/logout.inc.php" method="post" style="min-height: 250px">
                  <p class="lead" style="font-size:30px; margin-top:20px">Welcome!
                  </p>
                  <small class="form-text text-muted" style="margin-top:-10px; margin-bottom:10px">All ready to help you up!</small>
                  <div class="form-group">
                    <h3 class="display-3 text-center">Admin</h3>

                  </div>

                  <button type="submit" name="logout" style="margin-bottom:10px" class="btn btn-block btn-sm btn-outline-danger"> <i class="fas fa-sign-out-alt" style="padding-left: 5px"></i> Log Out</button>

                </form>';

              }
              else{
                echo '<!-- signin form -->
                <form class="text-center container" action="includes/login.inc.php" method="post" style="min-height: 200px">
                <br>
                <!--  <p class="lead" style="font-size:30px; margin-top:20px">Welcome!
                  </p>
                  <small class="form-text text-muted" style="margin-top:-10px; margin-bottom:10px">All ready to help you up!</small> -->
                    <div class="alert alert-danger" role="alert">
                      student roll: 1610010 <br>
                      student pass: 123 <hr style="margin: 3px">
                      teacher email: t@gmail.com <br>
                      teacher pass: 123
                    </div>
                  <div class="input-group shadow">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                    </div>
                    <input type="text" class="form-control" name="user_name" aria-label="Username" aria-describedby="basic-addon1" placeholder="Email / Roll">
                  </div>
                  <small id="emailHelp" class="form-text text-warning mt-2">*email required if you are a teacher</small>
                  <small id="emailHelp" class="form-text text-warning mb-3">*roll required if you are a student</small>

                  <div class="input-group mb-4 shadow">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" name="user_pass" aria-label="Username" aria-describedby="basic-addon1" placeholder="Password">
                  </div>

                  <button type="submit" name="login" style="margin-bottom:10px" class="shadow btn btn-block btn-sm btn-outline-success"> <i class="fas fa-sign-in-alt" style="padding-left: 5px"></i> Log in</button>

                  <!-- error message -->

                </form>';
                $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                  if (strpos($fullURL, "empty_fields")) {
                    echo '<p class="text-danger text-center">Fill up all fields!</p>';
                  }
                  else if (strpos($fullURL, "login_wrong_data")) {
                    echo '<p class="text-danger text-center">Wrong email/roll or password!</p>';
                  }

                  else if (strpos($fullURL, "login_success")) {
                    echo '<p class="text-success text-center">You are logged in!</p>';
                  }
              }
             ?>

             <br><br>

          </div>

        </div>
      </div>
    </div>

    <?php
      $teacher_count=0;
      $student_count=0;
      $dept_count=0;
      $series_count=0;

      //teacher count
      $sql = "SELECT * FROM teacher_data;";
      $result = mysqli_query($conn, $sql);
      $result_check = mysqli_num_rows($result);

      if( $result_check > 0 ){
        while ($row = mysqli_fetch_assoc($result)) {
          $teacher_count++;
          }
        }

        $teacher_count-=1;

      //students count
      $sql = "SELECT * FROM student_data;";
      $result = mysqli_query($conn, $sql);
      $result_check = mysqli_num_rows($result);

      if( $result_check > 0 ){
        while ($row = mysqli_fetch_assoc($result)) {
          $student_count++;
          }
        }

      //dept count
      $sql = "SELECT * FROM dept_series;";
      $result = mysqli_query($conn, $sql);
      $result_check = mysqli_num_rows($result);

      if( $result_check > 0 ){
        while ($row = mysqli_fetch_assoc($result)) {
          $dept_count++;
          }
        }

      //series_count
      $sql = "SELECT * FROM dept_series;";
      $res = mysqli_query($conn, $sql);
      $title = array();

      while ($head = mysqli_fetch_field($res)) {
        $series_count++;
      }

      $series_count-=2;

     ?>

    <!-- cards -->
      <div class="container">
        <div class="row" style="padding-top: 30px">

          <div class="col-sm-6 col-md-3" style="padding-top: 10px">
            <div class="card shadow" style="background-color: rgb(5, 190, 147)">
              <div class="card-body text-light">
                <div class="row px-1 align-items-center">
                  <div class="col-4">
                    <i class="fas fa-3x fa-users"></i>
                  </div>
                  <div class="col-8 text-right">
                    <h1 class="card-title"><?php echo $teacher_count; ?></h1>
                    <p class="card-text lead" style="font-size: 20px">Teachers</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3" style="padding-top: 10px">
            <div class="card shadow" style="background-color: rgb(5, 190, 147)">
              <div class="card-body text-light">
                <div class="row px-1 align-items-center">
                  <div class="col-4">
                    <i class="fas fa-3x fa-user-graduate"></i>
                  </div>
                  <div class="col-8 text-right">
                    <h1 class="card-title"><?php echo $student_count; ?></h1>
                    <p class="card-text lead" style="font-size: 20px">Students</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3" style="padding-top: 10px">
            <div class="card shadow" style="background-color: rgb(5, 190, 147)">
              <div class="card-body text-light">
                <div class="row px-1 align-items-center">
                  <div class="col-4">
                    <i class="fas fa-3x fa-university"></i>
                  </div>
                  <div class="col-8 text-right">
                    <h1 class="card-title"><?php echo $dept_count; ?></h1>
                    <p class="card-text lead" style="font-size: 20px">Departments</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-3" style="padding-top: 10px">
            <div class="card shadow" style="background-color: rgb(5, 190, 147)">
              <div class="card-body text-light">
                <div class="row px-1 align-items-center">
                  <div class="col-4">
                    <i class="fas fa-3x fa-list"></i>
                  </div>
                  <div class="col-8 text-right">
                    <h1 class="card-title"><?php echo $series_count; ?></h1>
                    <p class="card-text lead" style="font-size: 20px">Series</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    <!--cards -->

    <!-- midddle line -->
    <div style="background-color: rgb(51, 179, 148); margin-top: 50px" class="shadow">
      <div class="container text-light text-center">
        <p class="lead" style="padding-top: 25px; padding-bottom: 0px;">Have a look to the system and get known how easy things are now
        </p> <i class="fas fa-10x fa-sort-down" style="margin-top: -90px; margin-bottom: 20px;"></i>
      </div>
    </div>
    <!--middle lone-->

    <!-- small user interfacing -->
      <div class="container" id="tazbinur" style="color: rgb(5, 190, 147);">
        <br><br>
        <div class="row justify-content-center">
          <div class="col-sm-12 col-md-2 text-center" style="padding-top: 10px">
            <i class="fas fa-2x fa-clipboard-check" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 20px;">Attendace</p> <hr>
            <text class="text-muted taz-font">Teachers can take attendance of his selected courses.</text>
          </div>
          <div class="col-sm-12 col-md-2 text-center" style="padding-top: 10px">
            <i class="fas fa-2x fa-paste" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 20px;">Exam result</p> <hr>
            <text class="text-muted taz-font">Teachers can post results of his selected courses.</text>
          </div>
          <div class="col-sm-12 col-md-2 text-center" style="padding-top: 10px;">
            <i class="fas fa-2x fa-bullhorn" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 20px;">Notice</p> <hr>
            <text class="text-muted taz-font">Teachers can easily post notice for students.</text>
          </div>
          <div class="col-sm-12 col-md-2 text-center" style="padding-top: 10px;">
            <i class="far fa-2x fa-newspaper" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 20px;">Campus news</p> <hr>
            <text class="text-muted taz-font">Every visitor can read regular campus news to get updated.</text>
          </div>
          <div class="col-sm-12 col-md-2 text-center" style="padding-top: 10px;">
            <i class="fas fa-2x fa-cloud-upload-alt" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 20px;">Cloud Storage</p> <hr>
            <text class="text-muted taz-font">Teacher can upload & delete any file for student.</text>
          </div>
          <div class="col-sm-12 col-md-2 text-center" style="padding-top: 10px;">
            <i class="far fa-2x fa-edit" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 20px;">RAM Notepad</p> <hr>
            <text class="text-muted taz-font">Students can add emportant note & can delete those here.</text>
          </div>
        </div>
        <br><br>
      </div>
      <br>
    <!-- small user interfacing -->

    <!-- large user interfacing -->
      <div class="container" id="tazbinur-rahaman" style="color: rgb(5, 190, 147);">
        <br><br> <br>
        <div class="row justify-content-center">
          <div class="col-4 text-center">
            <i class="fas fa-5x fa-clipboard-check" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 25px;">Attendace</p>
          </div>
          <div class="col-8 text-center">
            <text class="text-muted lead taz-font">Teachers can add their custom course with course name, section name, starting & ending roll of students belong to that course. Thei can also take attendance of that course & the attendance mark will be automatically generate & students can have a live look into it.</text>
          </div>
        </div>
        <hr>

        <br>
        <div class="row justify-content-center">
          <div class="col-8 text-center">
            <text class="text-muted lead taz-font">As teachers can add their custome course to their profile, they will be able to publish class test results for that course students. The students belong to that course will be able to view their marks both in numaric & graph presentation</text>
          </div>
          <div class="col-4 text-center">
            <i class="fas fa-5x fa-paste" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 25px;">Exam result</p>
          </div>
        </div>
        <hr>

        <br>
        <div class="row justify-content-center">
          <div class="col-4 text-center">
            <i class="fas fa-5x fa-bullhorn" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 25px;">Notice</p>
          </div>
          <div class="col-8 text-center">
            <text class="text-muted lead taz-font">Teachers can also sent any notice related to their any custom course's students. They can also attach files with that notice. Teacher can also delete their notice. Studnets will get those notice in real time.</text>
          </div>
        </div>
        <hr>

        <br>
        <div class="row justify-content-center">
          <div class="col-8 text-center">
            <text class="text-muted lead taz-font">In RAM, there is a dedicataded news section. The admin can post or delete local news related to RUET Campus events. Any one can read our news from RAM located in the bottom section of this system.</text>
          </div>
          <div class="col-4 text-center">
            <i class="far fa-5x fa-newspaper" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 25px;">Campus news</p>
          </div>
        </div>
        <hr>

        <br>
        <div class="row justify-content-center">
          <div class="col-4 text-center">
            <i class="fas fa-5x fa-cloud-upload-alt" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 25px;">Cloud Storage</p>
          </div>
          <div class="col-8 text-center">
            <text class="text-muted lead taz-font">Teachers can attach files with their notices. Studnets can receive/view.download files from that notice. Soon RAM is planning to manage a personal cloud drive system for each students.</text>
          </div>
        </div>
        <hr>

        <br>
        <div class="row justify-content-center">
          <div class="col-8 text-center">
            <text class="text-muted lead taz-font">There is a seperated pesonal notepad system for each students. Students can add or delete their own notepad at any time. The system is secured enough to keep those notes privet for each students.</text>
          </div>
          <div class="col-4 text-center">
            <i class="far fa-5x fa-edit" style="padding-bottom: 0px"></i> <br>
            <p class="lead" style="font-size: 25px;">RAM Notepad</p>
          </div>
        </div>

        <br><br>
      </div>
      <br>
    <!-- large user interfacing -->

  </body>
</html>

<?php
  include 'footer.php';
 ?>
