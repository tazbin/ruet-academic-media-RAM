<?php
  include 'header.php';

  if ( $_SESSION['status']!="admin"  ) {
     header("Location: index.php?authentication=protected");
     exit();
  }

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> RAM | Change pass</title>
  </head>
  <body style="background-color: rgb(244, 245, 245);">

    <form style="max-width:300px; padding-top: 100px" class="mx-auto" action="includes/admin.change.inc.php" method="post">
      <div class="form-group">
        <input type="password" class="shadow form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter old password" name="old_pass">
      </div>
      <div class="form-group">
        <input type="password" class="shadow form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter new password" name="new_pass">
      </div>
      <div class="form-group">
        <input type="password" class="shadow form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter new password again" name="new_pass_again">
      </div>

      <button type="submit" name="change" class="shadow btn btn-sm btn-block btn-success">Change Pass</button>
    </form>

    <?php
    $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

      if (strpos($fullURL, "empty")) {
        echo '<br> <p class="text-danger text-center">Fill up all fields!</p>';
      } elseif (strpos($fullURL, "wrong")) {
        echo '<br> <p class="text-danger text-center">wrong password!</p>';
      } elseif (strpos($fullURL, "not-matched")) {
        echo '<br> <p class="text-danger text-center">password not matched!</p>';
      }
     ?>

     <br><br><br>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
