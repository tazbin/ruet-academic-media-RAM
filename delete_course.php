<?php
  include 'header.php';

  if ( !isset($_SESSION['user_name']) || $_SESSION['status']!="teacher"  ) {
     header("Location: index.php?authentication=protected");
     exit();
  }

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> RAM | Delete Cours</title>
  </head>
  <style>
  .shadow {
    -webkit-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    -moz-box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
    box-shadow: 12px 13px 16px -12px rgba(0,0,0,0.75);
  }
  </style>
  <body >
    <div style="background-color: rgb(241, 244, 244); min-height:500px; padding-bottom:50px">
      <div class="container">

        <h3 class="display-4 text-center" style="padding-top:30px; font-size: 30px">
          <?php
            echo $_SESSION['user_name'];
           ?>
        </h3>
        <p class="lead text-muted text-center" style="font-size: 15px">Deleting a course!</p>
        <hr>
        <br>

        <?php

        $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (strpos($fullURL, "empty")) {
          echo '<p class="text-danger text-center">Fill all the fields!</p>';
        }

         ?>

        <form class="mx-auto shadow" style="max-width:320px; border: 1px solid rgb(219, 5, 18); border-radius: 5px; padding:30px;" action="includes/delete.course.inc.php" method="post">

          <div class="form-group">
            <label for="exampleInputEmail1">Select course</label>
            <select class="btn btn-block btn-outline-danger" name="delete_course">
              <option value="none">-</option>

              <?php
              $sql = "SELECT * FROM course_teacher;";
              $result = mysqli_query($conn, $sql);
              $check_result = mysqli_num_rows($result);

              while ($row = mysqli_fetch_assoc($result)) {
                if ($row['teacher_id'] == $_SESSION['user_id']) {
                  $name = $row['course_number']." ".$row['dept']."-".$row['series'];
                  echo "<option value=".$row['id'].'>'.$name.'</option>';
                }
              }
               ?>

            </select>
          </div>


          <button type="submit" name="submit" class="btn btn-block btn-danger"><i class="fas fa-minus" style="padding-right: 5px"></i>Delete course</button>
        </form>


        </div>
        </div>

  </body>
</html>

<?php
  include 'footer.php';
 ?>
