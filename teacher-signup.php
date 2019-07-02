<!DOCTYPE html>
<?php
  include 'includes/dbh.inc.php';

  if ( isset($_SESSION['user_name'])  ) {
     header("Location: index.php?authentication=protected");
     exit();
  }

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Teacher Signup</title>
    <link rel="icon" href="image/ram_fav.ico" type="image/gif" sizes="16x16">
  </head>
  <style>
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }

  .shadow_red {
    -webkit-box-shadow: 4px 6px 14px -4px rgba(235,7,7,1);
-moz-box-shadow: 4px 6px 14px -4px rgba(235,7,7,1);
box-shadow: 4px 6px 14px -4px rgba(235,7,7,1);
  }
  </style>
  <body>
        <!-- -->
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="border-bottom: solid #5CB85C 3px;">
          <div class="container" style="padding-top:3px; padding-bottom:5px;">
      <a class="navbar-brand mt-2" href="index.php">
        <i class="fab fa-accusoft"></i>
        RAM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <hr style="background-color: rgb(244, 245, 245)">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item pr-4">
              <a class="btn btn-sm btn-success px-3" href="index.php"><i class="fas fa-sign-in-alt" style="padding-left: 10px;"></i> log in </a>
          </li>
        </ul>
      </div>
    </div>
    </nav>
        <!-- -->
        <div style="background-color: rgb(221, 223, 223); padding-top:50px; padding-bottom:50px">
        <div class="container">

          <?php
              $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              if ( strpos($fullURL, "empty") ) {
                echo '<p class="lead text-center text-danger"><i class="fas fa-exclamation-triangle" style="padding-right: 10px"></i> Fill all fields</p>';
              } elseif ( strpos($fullURL, "not_matched") ) {
                echo '<p class="lead text-center text-danger"><i class="fas fa-exclamation-triangle" style="padding-right: 10px"></i>Password did not matched</p>';
              } elseif ( strpos($fullURL, "teacher_code") ) {
                echo '<p class="lead text-center text-danger"><i class="fas fa-exclamation-triangle" style="padding-right: 10px"></i>Teacher code did not matched</p>';
              } elseif ( strpos($fullURL, "roll_invalied") ) {
                echo '<p class="lead text-center text-danger"><i class="fas fa-exclamation-triangle" style="padding-right: 10px"></i>Invalied student roll</p>';
              } elseif ( strpos($fullURL, "again") ) {
                echo '<p class="lead text-center text-danger"><i class="fas fa-exclamation-triangle" style="padding-right: 10px"></i>This email id has already been taken, Please use another one!</p>';
              }
           ?> <br>

          <form style="max-width:400px" class="mx-auto container" action="includes/teacher.sign.up.inc.php" method="post">
            <hr style="background-color: rgb(6, 208, 93);">
            <p class="lead text-center" style="color: rgb(5, 189, 84); font-size:35px; margin-top:-46px"><span style="background-color: rgb(221, 223, 223);" class="px-3">Sign up</span></p>
            <div class="input-group mb-3">
              <div class="input-group-prepend shadow">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
              </div>
              <?php
                if (isset($_GET['name'])) {
                  $name = $_GET['name'];
                  echo '<input type="text" class="form-control shadow" placeholder="Name" name="name" aria-label="Username" aria-describedby="basic-addon1" value='.$name.'>';
                }else {
                  echo '<input type="text" class="form-control shadow" placeholder="Name" name="name" aria-label="Username" aria-describedby="basic-addon1">';
                };
               ?>
            </div>
            <div class="input-group">
              <div class="input-group-prepend shadow">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-briefcase"></i></span>
              </div>
              <?php
                if (isset($_GET['designation'])) {
                  $designation = $_GET['designation'];
                  echo '<input type="text" class="form-control shadow" placeholder="Designation" name="designation" aria-label="Username" aria-describedby="basic-addon1" value='.$designation.'>';
                }else {
                  echo '<input type="text" class="form-control shadow" placeholder="Designation" name="designation" aria-label="Username" aria-describedby="basic-addon1">';
                };
               ?>
            </div>
            <small class="form-text text-muted mb-3">i.e. Professor/Lecturer.. etc.</small>
            <div class="input-group">
              <div class="input-group-prepend shadow">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-list-ol"></i></span>
              </div>
              <?php
                if (isset($_GET['code'])) {
                  $code = $_GET['code'];
                  echo '<input type="number" class="form-control shadow" placeholder="Code" name="code" aria-label="Username" aria-describedby="basic-addon1" value='.$code.'>';
                }else {
                  echo '<input type="number" class="form-control shadow" placeholder="Code" name="code" aria-label="Username" aria-describedby="basic-addon1">';
                };
               ?>
              <small class="form-text text-info mb-3">*to register as teacher, enter the code provided to you</small>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend shadow">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-university"></i></span>
              </div>
              <?php
                if (isset($_GET['department'])) {
                  $department = $_GET['department'];
                  echo '<input type="text" class="form-control shadow" placeholder="Department" name="department" aria-label="Username" aria-describedby="basic-addon1" value='.$department.'>';
                }else {
                  echo '<input type="text" class="form-control shadow" placeholder="Department" aria-label="Username" aria-describedby="basic-addon1" name="department">';
                };
               ?>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend shadow">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
              </div>
              <?php
                if (isset($_GET['phone'])) {
                  $phone = $_GET['phone'];
                  echo '<input type="number" class="form-control shadow" placeholder="Phone Number" name="phone" aria-label="Username" aria-describedby="basic-addon1" value='.$phone.'>';
                }else {
                  echo '<input type="number" class="form-control shadow" id="exampleInputPassword1" aria-label="Username" aria-describedby="basic-addon1" placeholder="Phone Number" name="phone">';
                };
               ?>
            </div>

            <div class="input-group">
              <div class="input-group-prepend shadow">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
              </div>
              <?php
                if (isset($_GET['email'])) {
                  $email = $_GET['email'];
                  echo '<input type="email" class="form-control shadow" placeholder="E-mail" name="email" aria-label="Username" aria-describedby="basic-addon1" value='.$email.'>';
                }else {
                  echo '<input type="email" class="form-control shadow" id="exampleInputPassword1" aria-label="Username" aria-describedby="basic-addon1" placeholder="E-mail" name="email">';
                };
               ?>
            </div>

            <small class="form-text text-center text-muted mb-3">Your data & record will be sucured with RAM.</small>
            <div class="input-group mb-3">
              <div class="input-group-prepend shadow">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" class="form-control shadow" id="exampleInputPassword1" placeholder="Password" name="pass_one" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-4">
              <div class="input-group-prepend shadow">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" class="form-control shadow" id="exampleInputPassword1" placeholder="Re-enter password" name="pass_two" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <button type="submit" class="btn btn-block btn-success shadow" name="sign_up"><i class="fas fa-sign-in-alt" style="padding-right:10px"></i>Sign me Up</button>
            <br>


          </form>

           <div class="text-center">
             <text class="lead text-muted" style="font-size:15px">already registered?</text><br>
             <a class="mx-auto text-info" style="font-size:15px" href="index.php">Log in</a>
           </div>

        </div>
      </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
