<!DOCTYPE html>
<?php
  include 'header.php';
  //include 'includes/result.form.inc.php';

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Home</title>
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

        <br> <br> <br>
        <div class="text-center text-success">
          <i class="fas fa-4x fa-envelope-open-text"></i>
        </div>
        <br>
        <?php

        $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (strpos($fullURL, "empty")) {
          echo '<p class="text-danger text-center">Fill all the fields!</p>';
        } elseif (strpos($fullURL, "received")) {
          echo '<p class="text-success text-center">Your resport has been received!</p>';
        }

         ?>

        <form class="mx-auto" style="max-width:500px;  border-radius: 5px;" action="includes/report.inc.php" method="post">


          <div class="form-group">
            <input class="form-control" type="text" name="user_name" placeholder="Enter your name">
          </div>
          <div class="form-group">
            <input class="form-control" type="email" name="user_mail" placeholder="Enter your e-mail">
          </div>
          <div class="form-group">
            <input class="form-control" type="number" name="user_phone" placeholder="Enter your phone number">
          </div>
          <div class="form-group">
            <textarea class="form-control" type="text" rows="5" name="user_report" placeholder="Enter your report/message/text"></textarea>
          </div>

          <button type="submit" name="submit" class="btn btn-sm btn-block btn-outline-success"><i class="fas fa-location-arrow" style="padding-right:10px"></i>Sent your report</button>
        </form>


        <br>

      </div>

        </div>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
