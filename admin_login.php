<!DOCTYPE html>
<?php
  include 'header.php';
  /*if (!isset($_SESSION['status'])) {
    $_SESSION['status']="";
  } */
  //include 'includes/result.form.inc.php';
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Admin Login</title>
  </head>
  <body class="bg-dark">
    <div class="container text-light text-center" style="height:400px">
      <?php
        if (isset($_SESSION['admin'])) {
          echo '<br><i class="fas fa-4x fa-unlock-alt" style="margin-top:50px"></i>';
          echo '<p class="lead text-light display-4 text-center" style="margin-top:20px">Admin is logged in</p>';
        } elseif ( isset($_SESSION['status']) ) {
          if ( $_SESSION['status']=="teacher" || $_SESSION['status']=="student" ) {
            echo '<br><i class="fas fa-4x fa-exclamation-triangle" style="margin-top:50px"></i>';
            echo '<p class="lead text-light display-4 text-center" style="margin-top:20px">You have to log out first</p>';
          }
        }  else {
          echo '<form  class="mx-auto" style="max-width:300px; margin-top:100px; margin-bottom:0px;" method="post" action="includes/admin.login.inc.php">
            <div class="form-group">
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" placeholder="admin name">
              <small id="emailHelp" class="form-text text-muted">Only admins are authorized to enter here!</small>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="exampleInputPassword1" name="pass" placeholder="first Password">
            </div>
            <button type="submit" class="btn btn-outline-light" name="admin">Admin in</button>
          </form>';
        }

      $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (strpos($fullURL, "empty")) {
          echo '<br> <p class="text-danger text-center">Fill up all fields!</p>';
        } elseif (strpos($fullURL, "invalied")) {
          echo '<br> <p class="text-danger text-center">Invalied data!</p>';
        }
       ?>
    </div>
  </body>
</html>

<?php
  include 'footer.php';
 ?>
