<!DOCTYPE html>
<?php
  include 'header.php';

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Home</title>
  </head>
  <style>
    .shadow{
      -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
      -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
      box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    }

  </style>
  <body>
    <div style="background-color:rgb(244, 245, 245); min-height:500px; padding-bottom:50px">
      <div class="container">

        <p class="text-center lead display-4" style="padding-top: 40px; padding-bottom: 5px; color: #f0ad4e"><i class="fas fa-exclamation-triangle"></i></p>


        <div class="mx-auto" style="max-width: 700px">
                <p class="text-muted text-center lead" style="font-size: 20px"><i>Hello <strong> <?php echo $_SESSION['pending_user']; ?>
                </strong><br> <p class="text-muted text-center lead" style="font-size: 17px"> Glad to have you in RAM. Your account is still in pending stage. After verifying all your information, your account will be operational. It will take a little more time to go. Till then you can enjoy other feathers available for public in RAM.<br>
                <text style="font-size:13px;" class="text-warning">*please note that your account won't be verified if you are not a current student of RUET.</text>
                <br> Thank You!</i></p></p>
        </div>

      <?php
      session_unset();
      session_destroy();
       ?>

      </div>
    </div>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
