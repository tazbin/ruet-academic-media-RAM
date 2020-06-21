<?php
  include 'header.php';
  //include 'includes/result.form.inc.php';
  if ( !isset($_SESSION['user_name']) || $_SESSION['status']!="teacher"  ) {
     header("Location: index.php?authentication=protected");
     exit();
  }
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Edit profile</title>
  </head>
  <style>
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }
  </style>
  <body>
    <div style="background-color: rgb(241, 244, 244); min-height:500px; padding-bottom:50px">
      <div class="container">

        <h3 class="display-4 text-center" style="padding-top:30px; font-size: 30px">
          <i class="fas fa-cogs" style="padding-right: 10px"></i> Edit Profile
        </h3>

        <hr>

        <?php
            $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if ( strpos($fullURL, "inf0=updated") ) {
              echo '<p class="lead text-center text-primary"><i class="fas fa-check" style="padding-right: 10px"></i> Info Updated</p>';
            }
         ?>

         <?php

         $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

         if (strpos($fullURL, "data=wrong-pass")) {
           echo '<p class="text-danger text-center"><i class="fas fa-exclamation-triangle" style="padding-right: 10px"></i> Wrong Password!</p>';
         }

          ?>

        <form class="" action="includes/teacher-data-inc.php" method="post">

        <div class="container">
          <table class="table table-striped text-center">
            <thead>
              <tr>
                <th scope="col">Field</th>
                <th scope="col">Present</th>
                <th scope="col">Change to</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Name: </td>
                <td>
                  <?php
                    echo $_SESSION['user_name'];
                   ?>
                </td>
                <td>
                  <?php
                    echo '<input type="text" name="user-name">';
                   ?>
                </td>
              </tr>
              <tr>
                <td>Designation: </td>
                <td>
                  <?php
                    echo $_SESSION['user_designation'];
                   ?>
                </td>
                <td class="text-center">
                  <?php
                    echo '<input type="text" name="user-designation">';
                   ?>
                </td>
              </tr>
              <tr>
                <td>Department: </td>
                <td>
                  <?php
                    echo $_SESSION['user_dept'];
                   ?>
                </td>
                <td>
                  <?php
                    echo '<input type="text" name="user-dept">';
                   ?>
                </td>
              </tr>
              <tr>
                <td>E-mail: </td>
                <td>
                  <?php
                    echo $_SESSION['user_mail'];
                   ?>
                </td>
                <td>
                  <?php
                    echo '<input type="text" name="user-mail">';
                   ?>
                </td>
              </tr>
              <tr>
                <td>Phone: </td>
                <td>
                  <?php
                    echo $_SESSION['user_phone'];
                   ?>
                </td>
                <td>
                  <?php
                    echo '<input type="number" name="user-phone">';
                   ?>
                </td>
              </tr>
              <tr>
                <td>New password: </td>
                <td>

                </td>
                <td>
                  <?php
                    echo '<input type="number" name="user-new-pass">';
                   ?>
                </td>
              </tr>
            </tbody>
          </table>

          <br>
          <div class="text-center">
            <input type="password" name="user-old-pass" placeholder="Enter your password to ensure" style="width: 400px; height: 30px; border-radius: 5px; border: 1px solid rgb(17, 159, 62);" class="text-center mx-auto">
            <br><br>
            <button type="submit" name="save-change" class="btn btn-sm btn-success px-5"><i class="fas fa-check" style="padding-right: 10px"></i>Save Changes</button>
          </div>
        </div>
        </form>

      </div>

        </div>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
